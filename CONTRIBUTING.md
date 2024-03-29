# How To Contribute

Community made patches, localizations, bug reports and contributions are always welcome and crucial to ensure Storefront remains the leading theme for WooCommerce. Your help is greatly appreciated.

When contributing please ensure you follow the guidelines below to help us keep on top of things.

**Please Note:**

GitHub is for _bug reports and contributions only_ - if you have a support question or a request for a customization this is not the right place to post it. Use [WooThemes Support](https://support.woothemes.com) for customer support, [WordPress.org](http://wordpress.org/support/themes/storefront) for community support, and for customizations we recommend one of the following services:

-   [Woo Experts](https://woo.com/experts/)
-   [Codeable](https://codeable.io/)

## Storefront Status

Please read [this document](./STOREFRONT_STATUS.md) explaining the current status of Storefront development.

## Contributing To The Core

### Reporting Issues

Reporting issues is a great way to became a contributor as it doesn't require technical skills. In fact you don't even need to know a programming language or to be able to check the code itself, you just need to make sure that everything works as expected and [submit an issue report](https://github.com/woothemes/woocommerce/issues/new) if you spot a bug. Sound like something you're up for? Go for it!

#### How To Submit An Issue Report

If something isn't working, congratulations you've found a bug! Help us fix it by submitting an issue report:

-   Make sure you have a [GitHub account](https://github.com/signup/free)
-   Search the [Existing Issues](https://github.com/woothemes/storefront/issues) to be sure that the one you've noticed isn't already there
-   Submit a report for your issue
    -   Clearly describe the issue (including steps to reproduce it if it's a bug)
    -   Make sure you fill in the earliest version that you know has the issue.

### Making Changes

Making changes to the core is a key way to help us improve Storefront. You will need some technical skills to make a change, like knowing a bit of PHP, CSS, SASS or JavaScript as well as some other development technologies (more on that shortly).

If you think something could be improved and you're able to do so, make your changes and submit a Pull Request. We'll be pleased to get it :)

#### Set up your development environment

To get started with your Storefront development environment:

-   Install [Node.js](https://nodejs.org/en/) with NPM, its package manager.
-   Install [Composer](https://getcomposer.org), a PHP dependency manager.
-   [Fork](https://help.github.com/articles/fork-a-repo/) the [Storefront repository](https://github.com/woothemes/storefront) on GitHub.
-   Pull the Storefront project dependencies into your environment by navigating to your `/storefront/` directory in Terminal then run `npm install`.
-   Run `composer install` to set up PHP dependencies.
-   Run the build script the command `npm run build`. This will create local copies of Storefront css (we do not version control the .css files) and minify those and the JS scripts.

You're now ready to go! You can now activate Storefront in your WordPress install and begin making changes.

**Please note:** any style changes you make should be done in the Sass files, not the .css files. Once you've changed a .scss file you will want to compile it to see those changes in your setup.

There are two ways to do this. See NPM commands below for more info about what commands are available.

-   `npm start` (recommended)
-   Manually build using `npm run build`

##### NPM commands

Storefront has npm commands configured for essential development & release tasks:

-   `npm run build:dev`: Builds files. Does not create a release archive.
-   `npm start`: Watches for changes to source files and continuously builds a development version.
-   `npm run build`: Builds a production version of the theme and creates a release archive.

There are some other commands which may be used occasionally:

-   `npm run build:css`: Runs the css build step only.
-   `npm run build:js`: Runs the JS build step only.
-   `npm run lint`: Checks source files against the PHP coding standards.
-   `npm run wp-env`: Provides access to a [wp-env development environment](https://developer.wordpress.org/block-editor/packages/packages-env/). This can be used for testing theme changes locally, or running e2e tests.
-   `npm run test:e2e`: Runs the end-to-end tests. Requires that the e2e environment is started (currently using wp-env).

#### How To Submit A PR

-   Make the changes to your forked repository
    -   **Ensure you stick to the WordPress Coding Standards for [PHP](http://make.wordpress.org/core/handbook/coding-standards/php/), [CSS](https://make.wordpress.org/core/handbook/best-practices/coding-standards/css/) and [Javascript](https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/).**
    -   Ensure you use LF line endings - no crazy Windows line endings please :)
-   When committing, reference your issue number (#1234) and include a note about the fix
-   Push the changes to your fork and submit a pull request on the master branch of the Storefront repository.
-   Please **don't** modify the changelog - this will be maintained by the Storefront developers.
-   Please **don't** add your localizations or update the .pot files - these will also be maintained by the Storefront developers. To contribute to the localization of Storefront, please join the [translate.wordpress.org project](https://translate.wordpress.org/projects/wp-themes/storefront). This is much needed, if you speak a language that needs translating consider yourself officially invited to the party.

After you follow the step above, the next stage will be waiting on us to merge your Pull Request. We review them all, and make suggestions and changes as and if necessary.

## Contribute To Localizing Storefront

Localization is a very important part of Storefront. We believe in net neutrality and want our theme to be available to everyone, everywhere with equal ease. When you localize Storefront, you are helping hundreds of people in the world, and all the people who speak your language. That's pretty neat.

We have a [project on translate.wordpress.org](https://translate.wordpress.org/projects/wp-themes/storefront). You can join the localization team of your language and help by translating Storefront.

If Storefront is already 100% translated for your language, join the team anyway! We regularly update our language files and there will definitely be need of your help soon.

# Additional Resources

-   [General GitHub documentation](http://help.github.com/)
-   [GitHub pull request documentation](http://help.github.com/send-pull-requests/)
