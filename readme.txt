=== WordPress Infinite Scroll by Auto Load Next Post ===
Contributors: autoloadnextpost, sebd86
Donate link: https://sebdumont.xyz/donate/
Tags: infinite scroll, infinite scrolling, scroll, infinite
Requires PHP: 5.6
Requires at least: 4.7
Tested up to: 5.2.3
Stable tag: 1.5.14
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Increase pageviews while your readers continue to infinitely scroll down your content.

== Description ==

You have great content. That's great but you shouldn't have to work twice as hard to get the pageviews you want. While Auto Load Next Post is not the only infinite scrolling plugin out there it is the first that is designed to work and match with your theme and track the content that is being viewed, NOT the excerpts from your post archives like other plugins out there. All of your posts content!

**Auto Load Next Post templating experience is the best in class - _by a long shot_.**

Don't just take my word for it. [Read what Rich Tabor](https://wordpress.org/support/topic/best-in-class-35/) (Author of [ThemeBeans](https://themebeans.com/?utm_source=wordpressorg&utm_medium=wp.org&utm_content=auto-load-next-post)) had to say in his review.

## What is Auto Load Next Post?

[Auto Load Next Post](https://autoloadnextpost.com/?utm_source=wordpressorg&utm_medium=wp.org&utm_campaign=readme&utm_content=auto-load-next-post) is a WordPress plugin developed to increase your pageviews by engaging the site viewers to keep reading your content rather than increasing your bounce rate.

It simply automatically loads the next post on your blog once the viewer has reached the bottom of the initial post they are reading and repeats the process as they read your content until there are no more posts to load.

= ✏️ Note to New Users =

Auto Load Next Post is a plugin _designed_ for self-hosted WordPress sites. This means you will need to [switch from WordPress.com to WordPress.org](http://www.wpbeginner.com/wp-tutorials/how-to-properly-move-your-blog-from-wordpress-com-to-wordpress-org/) if you want to use this plugin on your WordPress site.

= See for yourself =

Want to see how it works? [Go to the demo site](https://demo.autoloadnextpost.com/?utm_source=wordpressorg&utm_medium=wp.org&utm_campaign=demo-link&utm_content=auto-load-next-post), view any single post and scroll down to see the plugin in action.

= Increase Your PageViews Today =

Intrigued? _I bet you are._ Once you try Auto Load Next Post, your pageviews will increase 📈 and you will not want to go back. **Guaranteed.**

## Built with developers in mind

Extendable and open source — Auto Load Next Post is created with theme and plugin developers in mind. If you're intersted to jump in the project, there are opportunities for developers at all levels to get involved. [Contribute to Auto Load Next Post on GitHub](https://github.com/autoloadnextpost/auto-load-next-post/blob/master/CONTRIBUTING.md) and join the party. 🎉

Need to trigger something during each post load? [See the JavaScript triggers available](https://autoloadnextpost.com/documentation/javascript-triggers/) in the documentation for details.

## Track Your PageViews

If you have Google Analytics added to your site then you can track your pageviews just as you would any single post. Simply ask Auto Load Next Post to Update Google Analytics via the settings page and all pageviews will be tracked.

## Customizable Repeater Template

Auto Load Next Post is completly customizable to help match to your theme. Should you need to completly override the repeater template for your theme you can do just that. Follow [the guide in the documentation](https://github.com/autoloadnextpost/alnp-documentation/blob/master/en_US/repeater-template.md#repeater-template) for more details.

## 3rd Party Support

Auto Load Next Post has started to support 3rd Party plugins 🎉 starting with [WP Rocket](https://wp-rocket.me) and more will be added over time.

= Free Add-ons =

WordPress.org is home to some great add-ons for Auto Load Next Post, including:
- [Facebook Pixel Tracking](https://wordpress.org/plugins/alnp-facebook-pixel-tracking/)

Keen to see them all? View all add-ons for [Auto Load Next Post](https://wordpress.org/plugins/tags/auto-load-next-post/).

> Have a free add-on for Auto Load Next Post? [Let me know about it](https://autoloadnextpost.com/contact/?utm_source=wordpressorg&utm_medium=wp.org&utm_campaign=have-addon-to-share-link).

## Auto Load Next Post Pro

Want more? _I bet you do._ A premium extension is currently in development with some of the most highly requested features.<br />

* Page and Media Attachment Support<br />
* Custom Post Type Support<br />
* Paginated Posts Supported<br />
* Exclude Post Formats<br />
* Limit Posts per Session<br />
* Query Posts by Category, Tag, Related or Custom Query<br />
* Exclude User Roles and Specific Users<br />
* Pre-Query Posts Ready to Load<br />
* Toggle Comments to Hide or Show<br />
* Multilingual Support for WPML and Polylang<br />

On top of that you also get:<br />

* Email Support<br />
* and many more features and add-ons to follow.

[Find out more](https://autoloadnextpost.com/pro/?utm_source=wordpressorg&utm_medium=wp.org&utm_campaign=after-features-info-link) | [Sign up to be notified >>](http://eepurl.com/bvLz2H)

### More information

* [Visit the Auto Load Next Post website](https://autoloadnextpost.com/?utm_source=wordpressorg&utm_medium=wp.org&utm_campaign=readme).
* [View the documentation](https://github.com/autoloadnextpost/alnp-documentation) for detailed guides and code snippets.
* [Subscribe to updates](http://eepurl.com/bvLz2H)
* [Follow on Twitter](https://twitter.com/autoloadnxtpost)
* [Follow on Instagram](https://instagram.com/autoloadnextpost)
* [Like us on Facebook](https://www.facebook.com/autoloadnextpost/)
* [GitHub](https://github.com/autoloadnextpost/auto-load-next-post)

This plugin is created and maintained by [Sébastien Dumont](https://sebastiendumont.com).

== Installation ==

= Automatic installation =

Automatic installation is the easiest option as WordPress handles the file transfers itself and you don't need to leave your web browser. To do an automatic install of Auto Load Next Post, log in to your WordPress dashboard, navigate to the Plugins menu and click Add New.

In the search field type "Auto Load Next Post" and click Search Plugins. Once you've found the plugin you can view details about it such as the point release, rating and description. Most importantly, of course, you can install it by simply clicking "Install Now".

= Manual installation =

The manual installation method involves downloading the plugin and uploading it to your web server via your favourite FTP application. The WordPress codex contains [instructions on how to do this here](https://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation).

If the theme already supports Auto Load Next Post then you do not need to complete the remaining steps:

1. Go to the plugin settings page by 'Settings > Auto Load Next Post'.
2. Enter each of the selectors specified for the theme you are using and press "Save Changes".

= Updating =

Automatic updates should work like a charm; as always though, ensure you backup your site just in case.

== Frequently Asked Questions ==

= How does it work technically? =

When a viewer reaches near the end of the article, the post navigation at the end of the post is used to identify and find the next post to load. It loads that post by inserting the content via a customizable repeater template and places the content underneath the parent post within the post container. This is done via Ajax.

It also detects what the viewer is reading and updates the browser URL address bar and page title to that post. Should the reader refresh the browser, the post they are currently reading would load as the new initial post.

All previous posts of the blog are still retained in the browser history and to top it off, each post read can be tracked as a pageview using Google Analytics.

= Is Auto Load Next Post free? =

Yes! Auto Load Next Post's core features are and always will be free.

= Will Auto Load Next Post work with my theme? =

Yes, Auto Load Next Post will work with any theme but may require some configuration for it to understand your theme. Please see the [documentation](https://github.com/autoloadnextpost/alnp-documentation) for help or read further down to see if your question has already been answered.

= Is Auto Load Next Post translatable? =

Yes! Auto Load Next Post is deployed with full translation and localization support via the 'auto-load-next-post' text-domain. [How to translate?](https://autoloadnextpost.com/documentation/can-i-install-auto-load-next-post-language/?utm_source=wordpressorg&utm_medium=wp.org&utm_campaign=faq-link)

= Where can I find the settings for this plugin? =

Go to **Settings -> Auto Load Next Post**. There you will find the options to change any of the theme selectors, enable Google Analytics and remove comments.

= Is overriding the repeater template file required? =

No. This was put in place to support themes that have coded their template files differently from [WordPress theme code standards](https://codex.wordpress.org/Theme_Development#Theme_Development_Standards). For example, the [Genesis Framework](https://autoloadnextpost.com/product/genesis-framework-support/?utm_source=wordpressorg&utm_medium=wp.org&utm_campaign=faq-link) displays content via many action hooks instead so for this case overriding the template is a required.

= Can I use JetPack Social Links and Like Button? =

Yes. No further configuration is needed if you already have JetPack setup with social icons and like button.

= Is it compatible with the JetPack's related posts module? =

This is not possible but it would also drive away the purpose of this plugin if related posts where to be displayed.

= Can I load content before and after the next post has loaded? =

Yes, you can. In the default repeater template, there are [action hooks](https://github.com/autoloadnextpost/alnp-documentation/blob/master/en_US/action-hooks.md) available that you can use.

= After the first post has loaded, all I get is the same post over and over again. Why is that? =

If you have this issue and you have created a custom repeater template file to support the theme then you may have placed the post navigation outside of the post query.

You need to place it inside the loop. If that is not the case then you have not included the content of the post correctly according to the theme you are using.

= Does the plugin detect my theme and insert the theme selectors for me? =

If the theme author has added support for Auto Load Next Post and has set the theme selectors then yes, it will set the theme selectors for you. If not supported then it does not. You may follow this guide to help you [find your theme selectors](https://github.com/autoloadnextpost/alnp-documentation/blob/master/en_US/theme-selectors.md).

= My theme does not work with the plugin, what do I do? =

Check that you have a post navigation at the end of your post. If one does exists then you may need to copy and modify the repeater template file **content-alnp.php** in order to support your theme.

Not all themes are coded the same way so some alterations will be needed to match the theme. If you need help with this then I can provide [theme support](https://autoloadnextpost.com/product/theme-support/?utm_source=wordpressorg&utm_medium=wp.org&utm_campaign=faq-link) on request.

= What is the post order? =

The post order is descending order from the initial post the visitor started reading from.

= How can I get the Google Analytics option to work? =

You first need to have Google Analytics added to your site. Either by inserting the analytics into your theme yourself or by using the [Google Analytics plugin by MonsterInsights](https://wordpress.org/plugins/google-analytics-for-wordpress/).

Once you have Google Analytics applied to your site you can enable to track each post via the plugin settings.

= Can I track Facebook Pixels instead? =

You can. All you have to do is simply install the [Facebook Pixel Tracking add-on](https://wordpress.org/plugins/alnp-facebook-pixel-tracking/) and activate. All that is required is that you have your Facebook Pixel tracker installed on the site first.

= Does Auto Load Next Post support WordPress Network / Multisite websites? =

It does. Just make sure that you activate the plugin on the site you want it used on and then make sure the selectors match the theme that site is using.

== Screenshots ==

1. Plugin Settings: Theme Selectors, here is where we define the elements Auto Load Next Post will look for.
2. Plugin Settings: Misc Settings, here you can enable Google Analytics tracking, remove comments and set the JavaScript to load in the footer of your website instead should you need to.
3. Plugin Settings: Events, here you can support custom triggers or 3rd-party plugins to trigger their own once a post has loaded or when the visitor is entering a post.
4. Theme Customizer: The same settings can be applied via the theme customizer.

== Changelog ==

= 1.5.13 - 27th May 2019 =

* Tweaked: Upgrade warning notice in preparation for version 1.6.0 release.

= 1.5.12 - 23rd April 2019 =

* Tweaked: Repeater template now looks for `content-post.php` should `content-single.php` not exist before fallback to `content.php`.
* Tweaked: Help tab copy and links on the plugin settings page.
* Tweaked: Need help button now opens the help panel for the settings in view if one exists.
* Updated: Review link.
* Updated: POT file for translations.

= 1.5.11 - 11th April 2019 =

* NEW: Excluded JS files from defer for the [WP Rocket](https://wp-rocket.me) plugin.
* Dev Feature: Reset button added to the Misc settings to allow users to remove all settings and re-initialize the plugin.
* Fixed: Incorrect function name used when applying filter for [WP Rocket](https://wp-rocket.me) plugin.
* Tweaked: Admin notices to only appear on the Dashboard, the Plugins page, the Themes page and Auto Load Next Post settings page.
* Tweaked: Admin notices have been re-ordered to allow correct flow of display.
* Tweaked: Improved Admin JavaScript and added a confirmation for when the reset button is pressed. 
* Tweaked: Code clean up to remove functions or inline documentation that is no longer needed or used.
* Updated: POT file for translations.

= 1.5.10 - 5th April 2019 =

* NEW: Added 3rd Party support for the [WP Rocket](https://wp-rocket.me) plugin. Excludes Auto Load Next Post scripts from JS minification.
* Corrected: Added missing [Poseidon](https://wordpress.org/themes/poseidon/) theme options used to determin if post thumbnails should show in repeater template.
* Tweaked: Theme selectors admin notification should the active theme be supported via a plugin.
* Tweaked: `uninstall.php` file.

= 1.5.9 - 2nd April 2019 =

* NEW: Added support for [Poseidon](https://wordpress.org/themes/poseidon/) theme.

= 1.5.8 - 1st April 2019 =

* NEW: Added support for [OceanWP](https://wordpress.org/themes/oceanwp/) theme.
* Corrected: Typo in Congratulations admin notification.
* Tweaked: Improved loading of Auto Load Next Post if set in the footer.
* Tweaked: Disqus comments is also removed if **Remove Comments** is enabled.
* Tweaked: The plugins JavaScript will stop running if user scrolls to quickly. Solves [issue #156](https://github.com/autoloadnextpost/auto-load-next-post/issues/156)
* Updated: POT file for translations.

[View the full changelog here](https://github.com/autoloadnextpost/auto-load-next-post/blob/master/CHANGELOG.md).

== Upgrade Notice ==

Developer Warning: Please install version 1.5.4 or above. Version 1.5.0 to 1.5.3 had some issues that were not picked up straight away.
