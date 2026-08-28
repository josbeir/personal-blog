export const en = {
  get_in_touch: 'Get in touch',
  all_posts: 'All posts',
  open_source_project: 'Open source project',
  who_i_am: 'Who I am',
  more_below: 'More below',
  copyright: 'Copyright \u00a9 {year} - All rights reserved',
  open_menu: 'Open menu',
  toggle_theme: 'Toggle theme',

  recent_posts_title: 'Recent posts',
  projects_title: 'Some of my open-source projects',
  github_projects_intro: '{count} public projects, refreshed from GitHub at build time.',
  github_projects_profile: 'View GitHub profile',
  github_projects_no_description: 'No description provided.',
  github_projects_unavailable: 'The project catalogue is temporarily unavailable. Visit GitHub to browse the repositories.',
  github_projects_cakephp: 'CakePHP',
  github_projects_other: 'Other projects',

  posted_on: '{date}',
  read_more: 'View post',
  teaser_image_alt: 'Teaser Image',

  site: {
    description:
      'Freelance full stack developer, core CakePHP developer, and open source creator.',
    hero: {
      title: "Hi! I'm Jasper",
      subtitle: 'Freelance Full Stack Developer',
      description:
        'Belgium-based freelance full stack developer and core CakePHP developer, specializing in CakePHP, Drupal, and open source tooling.',
    },
  },

  nav: {
    home: 'Home',
    posts: 'Posts',
    contact: 'Contact',
  },

  highlights: {
    cakephp: {
      title: 'Core CakePHP expertise',
      description:
        'As a core CakePHP developer, I bring framework-level insight to architecture, performance, and best practices.',
    },
    frontend: {
      title: 'Front-end engineering',
      description:
        'I build responsive, accessible interfaces using modern front-end technology, making complex products feel clear and considered.',
    },
    opensource: {
      title: 'Open source mindset',
      description:
        'I design practical tooling and workflows that improve developer experience and long-term project health.',
    },
    drupal: {
      title: 'Drupal architecture expertise',
      description:
        'I design and scale Drupal platforms with strong content architecture, integration patterns, and long-term maintainability.',
    },
  },

  projects: {
    harv: {
      description:
        'A fast terminal UI for Harvest time tracking. Start timers, log hours, and manage your timesheet without leaving the terminal.',
      label: 'View on GitHub',
    },
    sugar: {
      description:
        'A PHP template engine with layout inheritance, reusable components, and context-aware escaping.',
      label: 'Visit Sugar docs',
    },
    glaze: {
      description:
        'A fast static site generator in PHP combining Djot content, Sugar templates, and optional Vite.',
      label: 'Visit Glaze docs',
    },
  },

  homepage: {
    intro: {
      title: 'Who I am',
      description:
        'Freelance full stack developer focused on CakePHP, Drupal, and open source products.',
    },
  },

  posts_page: {
    title: 'Posts',
    eyebrow: 'Notes on code, tools and the web',
    description:
      'Discover insights on technology, creativity, and ideas. Explore articles on innovation, problem-solving, and the human side of the digital world.',
    intro:
      'Practical notes from open-source work, web platforms, and the tools I build along the way.\n\nExpect CakePHP, Drupal, PHP, front-end architecture, and the occasional experiment.',
  },

  contact_page: {
    title: "Let's talk",
    eyebrow: 'A good place to start',
    description:
      "Get in touch with me through the contact form. I'm ready to discuss your project ideas and explore collaboration opportunities.",
    intro:
      "Feel free to reach out to me directly via the contact form below. I'm eager to hear about your project ideas and discuss how we can collaborate to bring them to life. Let's connect and make something awesome together!",
    form_title: 'Tell me what you are working on',
    form_description: 'A little context helps me understand the problem and whether I am the right person to help.',
    hint_title: 'Useful context',
    hint: 'The goal, current setup, timeline, and any constraints are a great place to start.',
  },

  form: {
    email_label: 'Your email',
    email_placeholder: 'my@email.com',
    name_label: 'Name',
    name_placeholder: 'Your name',
    company_label: 'Company name',
    company_placeholder: 'Company name',
    phone_label: 'Phone',
    phone_placeholder: 'Phone number',
    message_label: 'Your message',
    message_placeholder: 'Hi there!',
    submit: 'Contact me',
    sending: 'Sending…',
    privacy_note: 'Your details are only used to reply to your message.',
    success_title: 'Message sent',
    success_message: 'Thanks for getting in touch. Your message is on its way and this page stays right here.',
    success_reset: 'Send another message',
    error: 'Unable to send your message right now. Please try again shortly.',
  },
} as const;
