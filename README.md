## Auto Load Next Post

[![Built with Grunt](https://cdn.gruntjs.com/builtwith.png?style=flat)](http://gruntjs.com/)  [![GitHub forks](https://img.shields.io/github/forks/seb86/Auto-Load-Next-Post.svg?style=flat)](https://github.com/seb86/Auto-Load-Next-Post/network) [![GitHub license](https://img.shields.io/badge/license-GPLv2-blue.svg?style=flat)](https://raw.githubusercontent.com/seb86/Auto-Load-Next-Post/master/license.txt) [![WordPress plugin](https://img.shields.io/wordpress/plugin/v/auto-load-next-post.svg?style=flat)](https://wordpress.org/plugins/auto-load-next-post/) [![WordPress](https://img.shields.io/wordpress/plugin/dt/auto-load-next-post.svg?style=flat)](https://wordpress.org/plugins/auto-load-next-post/) [![WordPress](https://img.shields.io/wordpress/v/auto-load-next-post.svg?style=flat)](https://wordpress.org/plugins/auto-load-next-post/) [![Build Status](https://scrutinizer-ci.com/g/seb86/Auto-Load-Next-Post/badges/build.png?b=master)](https://scrutinizer-ci.com/g/seb86/Auto-Load-Next-Post/build-status/master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/seb86/Auto-Load-Next-Post/badges/quality-score.png)](https://scrutinizer-ci.com/g/seb86/Auto-Load-Next-Post/) [![Code Climate](https://codeclimate.com/github/seb86/Auto-Load-Next-Post/badges/gpa.svg)](https://codeclimate.com/github/seb86/Auto-Load-Next-Post)

Welcome to the Auto Load Next Post repository on GitHub. Here you can browse the source, look at [open issues](https://github.com/seb86/Auto-Load-Next-Post/issues) and keep track of development. We recommend all developers to [follow the blog](https://autoloadnextpost.com) to stay up to date about everything happening in the project or simply view the [feature roadmap](https://autoloadnextpost.com/feature-roadmap/).

If you are not a developer, please use the [Auto Load Next Post plugin page](https://wordpress.org/plugins/auto-load-next-post/) on WordPress.org.

Want to contribute to the project? Then please ready the [contribute guidelines](https://github.com/seb86/Auto-Load-Next-Post/blob/master/CONTRIBUTING.md) clearly.

### What is Auto Load Next Post?
Auto Load Next Post is a WordPress plugin developed to increase page views by engaging the site viewers to keep them reading the blogs content as they reach the bottom of an article rather than having to go back and select another post to read.

It simply loads the next post on your blog automatically once the user has reached the bottom of the initial post the viewer is reading and repeats as the user reads the content until there are no more posts to load.

### How does it work?
At the end of every single post their is a post navigation which is used to detect and collect the previous post URL for the next post to load. JavaScript then loads the post by inserting the content via a special template that matches the theme structure for a single post and places the content underneath the parent post within the main post container.

The JavaScript detects when you are reading the next post and updates your browser URL address bar and page title to that post. Should you refresh the browser, the post you are currently reading would load as the new initial post.

All previous posts of the blog are still retained in your browser history.

### Note to Beginners
Auto Load Next Post is a plugin for self-hosted WordPress sites. This means you will need to [switch from WordPress.com to WordPress.org](http://www.wpbeginner.com/wp-tutorials/how-to-properly-move-your-blog-from-wordpress-com-to-wordpress-org/) if you want to use this plugin on your WordPress site.

### Features
* Action hooks to load content in the loop file.
* Developer Friendly.
* Hide Comments.
* Track posts with Google Analytics. ***Requires Google Analytics to be applied on your site first for this to work.***
* Over-writable template loop file.
* Child-theme Support.
* WordPress Network / Multisite Support.

> #### Auto Load Next Post Premium
> There's an even better version of the plugin coming out soon with the following extra features:
> - Custom Post Type Support<br />
> - Media Attachments Support<br />
> - Over-writable Template for Pages<br />
> - More popular themes supported<br />
> - Priority Email Support<br />
> - and many more features to follow.
>
> [More information](https://autoloadnextpost.com/premium/?utm_source=github-repo&utm_medium=link&utm_campaign=after-features-info-link) | [Sign up to be notified >>](http://eepurl.com/bvLz2H)

### Found a Bug?
If you find a bug within Auto Load Next Post, please [report the issue](https://github.com/seb86/Auto-Load-Next-Post/issues?state=open) by creating a ticket on the GitHub repository where we can deal with it more appropriately. Please ensure that you read the [contribution guidelines](https://github.com/seb86/Auto-Load-Next-Post/blob/master/CONTRIBUTING.md) prior to submitting your report. To help us solve the issue, please be as descriptive as possible.

### Contributing to Auto Load Next Post
If you have a patch, or stumbled upon an issue with Auto Load Next Post, you can contribute this back to the code. Please read our [contribution guidelines](https://github.com/seb86/Auto-Load-Next-Post/blob/master/CONTRIBUTING.md) for more information how you can do this.

### Translation Support
Auto Load Next Post is in need of translations. Is the plugin not translated in your language or do you spot errors with the current translations? Helping out is easy! Click on "[Translate Auto Load Next Post](https://translate.wordpress.org/projects/wp-plugins/auto-load-next-post)" on the side of this page.

### Libraries Used
- [chosen](https://github.com/harvesthq/chosen)
- [jQuery.history](https://github.com/browserstate/history.js)
- [jQuery.tiptip](https://github.com/drewwilson/TipTip)
- [scrollspy](https://github.com/thesmart/jquery-scrollspy)

The libraries above are used with the plugin.

> #### PHP Requirement
> This plugin requires PHP version 5.3 or higher.<br />
> If you're still at PHP 5.2, it's time to update. [Read here why and how.](http://www.wpupdatephp.com/update/)<br />
> Updating to a newer PHP version is almost always done in minutes and free of charge!

### More information
* [Visit Auto Load Next Post website](https://autoloadnextpost.com)
* Other [WordPress plugins](http://profiles.wordpress.org/sebd86/) by [Sébastien Dumont](https://sebastiendumont.com)
* Contact Sébastien on Twitter: [@sebd86](https://twitter.com/sebd86)
* This plugin uses a modified version of the [WP Update Php](https://github.com/seb86/wp-update-php) library class.
