---
date: '2025-11-03T13:51:42+01:00'
slug: 'stateful-php-to-stateless-mercure-cakephp'
draft: false
title: 'From Stateful PHP to Stateless Mercure: Real-Time in CakePHP'
images:
    -  teaserimage.jpg
description: 'Explore the journey of integrating real-time features into CakePHP using Mercure, including architectural challenges, lessons learned from failed SSE implementations, and practical strategies for stateless push notifications with the MercureComponent and ViewUpdate.'
tags:
    - CakePHP
    - Real-time
    - Mercure
---

## ☕ Why Your App Still Feels Like Dial-Up

Let's face it: as PHP developers, we're masters of the **request-response** cycle. We handle that HTTP handshake, do the business, send the payload, and then our script dies a graceful, memory-free death. It’s stateless, scalable, and *fast*.

But try to introduce **"real-time"** features—a live dashboard, instant notifications, a collaborative feed—and suddenly, the clean, stateless architecture gets dragged into the mud. We start looking at WebSockets, persistent connections, Node.js sidecar apps, and all the complexity that comes with maintaining **state**.

This struggle is what led me to write **[my Mercure plugin](https://github.com/josbeir/cakephp-mercure)** for CakePHP. The core idea was simple: leverage the **[Mercure protocol](https://mercure.rocks/)** to inject a pub/sub layer into the classic MVC stack. A lot of my initial understanding of how to correctly implement the protocol's JWT and publishing flow was helped by studying the **Symfony Mercure Component**, which provided a great blueprint.

My initial attempts at integration were rough; the correct tooling felt hidden. But once the pattern solidified—centered around the **`MercureComponent`** and the **`ViewUpdate`** class—the architectural feasibility became clear. It's a pragmatic escape from unnecessary WebSocket complexity, but it is, fundamentally, a trade-off.

-----

## Controller-as-SSE-Server 💥

Before Mercure, my approach to achieving real-time was the obvious, naive one for a PHP developer: use the Controller. I figured since **Server-Sent Events (SSE)** uses simple HTTP, I could just set the appropriate `Content-Type: text/event-stream` header, enter an infinite `while(true)` loop, and use `echo "data: ...\n\n"` followed by `flush()` to push data.

It worked, technically. But it was an **operational nightmare**. Every single active client immediately hijacked a PHP process. Memory usage became unpredictable, the CPU spiked, and I quickly realized that PHP—built to serve requests and *die*—was fundamentally unsuited to acting as a long-running SSE server. It was a brutal lesson in trying to force a synchronous, stateless architecture into an asynchronous, stateful role.

The Mercure approach was born from this failure. It was the realization that the **message broker** needed to be external, leaving CakePHP to do what it does best: generate a single, authenticated publish request and then immediately terminate.

-----

## Embracing Stateless Push 🚪

![Mercure cycle](cycle.png)

The standard WebSockets solution requires you to either use a persistent PHP runtime (Swoole, etc.) or deploy a completely different technology to manage connections. This context switch is often the single biggest blocker for adding real-time features to an existing monolith.

Mercure bypasses this by reframing the problem. Instead of forcing PHP to manage connections, it relies on **Server-Sent Events (SSE)**, where a dedicated broker (the Mercure Hub) manages the long-lived client connection.

What does the CakePHP application do? It makes a **single, asynchronous HTTP POST request** to the Hub.

  * **Request:** CakePHP hits the Hub's publication endpoint with the payload and a JWT.
  * **Response:** CakePHP gets an immediate `202 Accepted`.
  * **Death:** The CakePHP script exits, having used minimal resources.

This paradigm lets us keep our MVC monolith clean and stateless. The architectural cost is shifted: complexity is moved from the application logic to the deployment environment, specifically by requiring the Mercure Hub.

-----

## 🧐 The Component's Mandate

The ability to integrate Mercure cleanly into CakePHP is dependent on two concepts: **Authorization** and **Payload Generation**. The framework's architecture provides the perfect hooks for both.

### 1\. Authorization: Tying JWTs to the Request Lifecycle

In Mercure, the ability to **subscribe** to a private topic is secured by a **JWT cookie**. The subscriber must present this cookie to the Mercure Hub to validate their access to the requested topic selectors.

The **`MercureComponent`** was designed to make this operation native to the framework:

  * It gathers subscription topics via methods like `$this->Mercure->addSubscribe()`.
  * The crucial `$this->Mercure->authorize()` call then signs the JWT and sets the cookie on the response.

This coupling is technically critical: **authorization logic stays where it belongs—in the controller, alongside the business logic that grants access to the resource.** The component handles the security and cookie manipulation, while the application code remains focused on permissions.

### 2. Payload Generation 🛣️

The architectural decision isn't *if* you'll publish data, but *what format* that data will take. In real-time development, this is a critical choice that dictates your frontend stack.

#### Option A: JSON Payload for SPAs (Data-First)

This is the standard choice if you're running a separate **Vue**, **React**, or other Single Page Application (SPA). The client receives raw data and relies on its own JavaScript templating engine to render the update. My plugin supports this using the dedicated `JsonUpdate` class and the `Publisher` facade:

```php
// Inside a Table's afterSave() callback or a dedicated Service
use Mercure\Update\JsonUpdate;
use Mercure\Publisher;

// This update signals a new transaction occurred
$update = JsonUpdate::create(
    topics: "/user/{$userId}/transactions",
    data: [
        'id' => $transaction->id,
        'amount' => $transaction->amount,
        'currency' => 'EUR'
    ],
    private: true // Only the authorized user receives this
);

Publisher::publish($update);
```

With this approach, the burden of rendering is fully on the client.

#### Option B: HTML Payload for MVC Apps (Render-First)

This is the efficient choice if you are committed to server-side rendering, which is typical for CakePHP applications paired with tools like **HTMX** or **Hotwire**. The **`ViewUpdate`** class is used to publish a fully-rendered HTML fragment.

```php
// Inside a Controller action after saving a new message
public function addMessage()
{
    // ... validation and saving logic ...
    $message = $this->Messages->newEntity($this->request->getData());
    $this->Messages->save($message);

    // Publish the update using the component's convenience method
    $this->Mercure->publishView(
        topics: "/chat/general",
        element: 'Messages/message_row', // Renders /templates/element/Messages/message_row.php
        viewVars: ['message' => $message], // Passes $message to the element for rendering
        private: false
    );

    // ...
}
```

This feature is significant because it eliminates the need for client-side templating for updates. When a client receives the message, the payload is ready to be dropped straight into the DOM. It's a powerful way to keep business logic and presentation unified on the server.

-----

## The Trade-Offs 🛠️

While my plugin is robust for the common use case, it's necessary to maintain critical perspective on its limits:

1.  **Unidirectional by Design:** Mercure is built on SSE, which is strictly **Server-to-Client**. If your application requires frequent, low-latency client-to-server communication (e.g., collaborative text editing, real-time input), you will still need a proper **WebSockets** implementation. Mercure tells the client what *happened*; it doesn't listen to the client.

2.  **Infrastructure Dependency:** The simplification in the PHP layer is counterbalanced by the introduction of the mandatory, external **Mercure Hub**. This is an additional process that must be deployed, monitored, and scaled. While simpler than managing custom stateful servers, it remains a critical dependency in the architecture.

3.  **Security Responsibility:** The entire security model rests on the **correct generation and configuration of the JWT cookie**. Errors in setting the cookie domain, path, or expiration—or a mismatch in the shared secret between the app and the Hub—can lead to total authorization failure. It demands strict adherence to configuration rules.

In the end, this plugin is an attempt to create an architecturally appropriate solution that allows traditional CakePHP applications to adopt **push capabilities** without forcing a rewrite into an async framework. It's the right tool for notifications, dashboards, and feeds, and by using the **`MercureComponent`** and **`ViewUpdate`**, the integration ultimately feels native to the framework.
