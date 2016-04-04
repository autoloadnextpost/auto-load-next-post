## Auto Load Next Post

[![Built with Grunt](https://cdn.gruntjs.com/builtwith.png?style=flat)](http://gruntjs.com/)  [![GitHub forks](https://img.shields.io/github/forks/seb86/Auto-Load-Next-Post.svg?style=flat)](https://github.com/seb86/Auto-Load-Next-Post/network) [![GitHub license](https://img.shields.io/badge/license-GPLv2-blue.svg?style=flat)](https://raw.githubusercontent.com/seb86/Auto-Load-Next-Post/master/license.txt) [![WordPress plugin](https://img.shields.io/wordpress/plugin/v/auto-load-next-post.svg?style=flat)](https://wordpress.org/plugins/auto-load-next-post/) [![WordPress](https://img.shields.io/wordpress/plugin/dt/auto-load-next-post.svg?style=flat)](https://wordpress.org/plugins/auto-load-next-post/) [![WordPress](https://img.shields.io/wordpress/v/auto-load-next-post.svg?style=flat)](https://wordpress.org/plugins/auto-load-next-post/) [![Build Status](https://scrutinizer-ci.com/g/seb86/Auto-Load-Next-Post/badges/build.png?b=master)](https://scrutinizer-ci.com/g/seb86/Auto-Load-Next-Post/build-status/master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/seb86/Auto-Load-Next-Post/badges/quality-score.png)](https://scrutinizer-ci.com/g/seb86/Auto-Load-Next-Post/) [![Code Climate](https://codeclimate.com/github/seb86/Auto-Load-Next-Post/badges/gpa.svg)](https://codeclimate.com/github/seb86/Auto-Load-Next-Post)

Gain more post views by allowing your site viewers to continue reading your blog posts as they scroll down the page.

[![Auto Load Next Post Video](https://raw.githubusercontent.com/seb86/Auto-Load-Next-Post/master/youtube-video-screenshot.png)](https://www.youtube.com/watch?v=EvBCPXVe2U4)

### What is Auto Load Next Post?
Auto Load Next Post simply loads the next post on your blog automatically once the user has reached the bottom of the initial post. This is repeated until there are no more posts to load.

The post navigation at the end of each post is detected to collect the previous post URL for the next post to load. The Javacript then loads the post by inserting the content via a partial template underneath the parent post.

As it does this, your browser URL address bar and page title changes to the post that it has loaded. Should you refresh the browser, the post you were currently reading would load as the initial post.

Your browser still retains the history of the posts that were viewed on the blog.

### First Time Users
For new first time users I suggest reading [the documentation](https://github.com/seb86/Auto-Load-Next-Post/wiki) to understand how to setup the plugin and see how it works. By default when the plugin is activated, the settings are ready to be used with WordPress's core theme, Twenty Fifteen.

### Features
* Use action hooks to load content before and after the next post has loaded. [Example Plugin](https://github.com/seb86/Auto-Load-Next-Post-Hooks-Example)
* Have the option to hide the comments if you wish.
* Track each post load with Google Analytics. ( Requires Google Analytics to be applied for this to work. )
* Over-writable template file.
* WordPress Network / Multisite support.

> #### Auto Load Next Post Premium
> There's an even better version of the plugin coming out soon with the following extra features:
> - Custom Post Type Support<br />
> - Media Attachments Support<br />
> - Overwritable Template for Pages<br />
> - Supports more popular themes with auto setup detection<br />
> - [JetPack](https://wordpress.org/plugins/jetpack/) Supported<br />
> - [Related Posts for WordPress](https://wordpress.org/plugins/related-posts-for-wp/) Supported<br />
> - Priority Email Support<br />
>
> [More information](https://autoloadnextpost.com/?utm_source=github-repo&utm_medium=link&utm_campaign=after-features-info-link) | [Sign up to be notified >>](http://eepurl.com/bvLz2H)

### Contributing
You can [contribute code](https://github.com/seb86/Auto-Load-Next-Post/blob/master/CONTRIBUTING.md) to this plugin via the [GitHub](https://github.com/seb86/Auto-Load-Next-Post/blob/master/CONTRIBUTING.md) repository and localizations via [Transifex](https://www.transifex.com/projects/p/auto-load-next-post/).

### Forum Support and Issue Reporting
Use the WordPress.org forum for [community support](https://wordpress.org/support/plugin/auto-load-next-post). As this is a free plugin I can not provide support full time but I will do my best to respond. You are most likely to get a response from a none developer.

You may also find that a topic similar to yours has already been posted so join in rather than creating a new support ticket with the same issue.

If you spot a bug within the plugin, you can of course log it as an [issue](https://github.com/seb86/Auto-Load-Next-Post/issues) on Github where I can act upon it more efficiently.

If you need help with any customizations for this plugin. Please [hire me](https://sebastiendumont.com) to apply them for you.

### Demo Site
Want to try it out? [Go to the demo site](http://demo.autoloadnextpost.com) and view a post. Scroll down and see the plugin in action.

### Support by Donating
Donations of any sum help keep this plugin actively developed and supported. Your support goes along way in making this plugin better. [Make a Donation](https://autoloadnextpost.com/donate.htm)

### Leave a Review
Reviews are helpful to other users and this plugin reputation. Please consider spending a minute or two leaving a [review](https://wordpress.org/support/view/plugin-reviews/auto-load-next-post?rate=5#postform) and tell me what you think about the plugin. It matters a lot and is most appreciated.

### Languages and Translation Support
Current languages available:
* English(US)
* English(GB)
* Français (French)(France)
* German (Germany)
* Italian (Italy)
* Româna (Romanian)
* Russian (Russia)

Auto Load Next Post is currently available in 6 languages. The folks over at [WP Translations](http://wp-translations.org/) handle the translations, and it's because of them that these translations are available. More are on the way and with your help they can be released quicker. If you would like to help translate, go to the [Transifex](https://www.transifex.com/projects/p/auto-load-next-post/) project.

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
