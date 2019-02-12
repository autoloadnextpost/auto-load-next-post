=== WordPress Infinite Scroll by Auto Load Next Post ===
Contributors: autoloadnextpost, sebd86
Donate link: https://sebdumont.xyz/donate/
Tags: infinite scroll, infinite scrolling, scroll, infinite, endless scroll, pagination, ajax pagination, ajax, ajax posts, ajax load more, browsing history, navigation
Requires PHP: 5.6
Requires at least: 4.7
Tested up to: 5.0.0
Stable tag: 1.5.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Increase pageviews while your readers continue to infinitely scroll down your content.

== Description ==

You have great content. That's great but you shouldn't have to work twice as hard to get the pageviews you want. While Auto Load Next Post is not the only infinite scrolling plugin out there it is the first that is designed to work and match with your theme and track the content that is being viewed, NOT the excerpts from your post archives like other plugins out there. All of your posts content!

**Auto Load Next Post templating experience is the best in class - _by a long shot_.**

Don't just take my word for it. [Read what Rich Tabor](https://wordpress.org/support/topic/best-in-class-35/) (Author of [ThemeBeans](https://themebeans.com/?utm_source=wordpressorg&utm_medium=wp.org)) had to say in his review.

= What is Auto Load Next Post? =

[Auto Load Next Post](https://autoloadnextpost.com/?utm_source=wordpressorg&utm_medium=wp.org&utm_campaign=readme&utm_content=auto-load-next-post) is a WordPress plugin developed to increase your pageviews by engaging the site viewers to keep reading your content rather than increasing your bounce rate.

It simply automatically loads the next post on your blog once the viewer has reached the bottom of the initial post they are reading and repeats the process as they read your content until there are no more posts to load.

= Note to New Users =

Auto Load Next Post is a plugin _designed_ for self-hosted WordPress sites. This means you will need to [switch from WordPress.com to WordPress.org](http://www.wpbeginner.com/wp-tutorials/how-to-properly-move-your-blog-from-wordpress-com-to-wordpress-org/) if you want to use this plugin on your WordPress site.

= See for yourself =

Want to see how it works? [Go to the demo site](https://demo.autoloadnextpost.com/?utm_source=wordpressorg&utm_medium=wp.org&utm_campaign=demo-link&utm_content=auto-load-next-post) and view any single post. Scroll down and see the plugin in action.

= Increase Your PageViews Today =

Intrigued? _I bet you are._ Once you try Auto Load Next Post, your pageviews will increase and you will not want to go back. **Guaranteed.**

= Built with developers in mind =

Extendable and open source — Auto Load Next Post is created with theme and plugin developers in mind. If you're intersted to jump in the project, there are opportunities for developers at all levels to get involved. [Contribute to Auto Load Next Post on GitHub](https://github.com/autoloadnextpost/auto-load-next-post/blob/master/CONTRIBUTING.md) and join the party. 🎉

Need to trigger something during each post load? [See the JavaScript triggers available](https://autoloadnextpost.com/documentation/javascript-triggers/) in the documentation for details. 3rd-party supported also.

= Free Add-ons =

WordPress.org is home to some great add-ons for Auto Load Next Post, including:
- [Facebook Pixel Tracking](https://wordpress.org/plugins/alnp-facebook-pixel-tracking/)

Keen to see them all? View all add-ons for [Auto Load Next Post](https://wordpress.org/plugins/tags/auto-load-next-post/).

> Have a free add-on for Auto Load Next Post? [Let me know about it](https://autoloadnextpost.com/contact/?utm_source=wordpressorg&utm_medium=wp.org&utm_campaign=have-addon-to-share-link).

= Auto Load Next Post Pro =

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

On top of that you also get:
* Email Support<br />
* and many more features and add-ons to follow.

[Find out more](https://autoloadnextpost.com/pro/?utm_source=wordpressorg&utm_medium=wp.org&utm_campaign=after-features-info-link) | [Sign up to be notified >>](http://eepurl.com/bvLz2H)

= Get started today =

This plugin is created and maintained by [Sébastien Dumont](https://sebastiendumont.com).

**More information**

* [Visit the Auto Load Next Post website](https://autoloadnextpost.com/?utm_source=wordpressorg&utm_medium=wp.org&utm_campaign=readme).
* [View the documentation](https://github.com/autoloadnextpost/alnp-documentation) for detailed guides and code snippets.
* [Subscribe to updates](http://eepurl.com/bvLz2H)
* [Follow on Twitter](https://twitter.com/autoloadnxtpost)
* [Like us on Facebook](https://www.facebook.com/autoloadnextpost/)
* [GitHub](https://github.com/autoloadnextpost/auto-load-next-post)

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

Yes, Auto Load Next Post will work with any theme but may require some configuration for it to understand your theme. Please see the [documentation](https://github.com/autoloadnextpost/alnp-documentation?utm_source=wordpressorg&utm_medium=wp.org&utm_campaign=faq-link) for help or read further down to see if your question has already been answered.

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

Yes, you can. In the default repeater template, there are [action hooks](https://github.com/autoloadnextpost/alnp-documentation/blob/master/en_US/action-hooks.md?utm_source=wordpressorg&utm_medium=wp.org&utm_campaign=faq-link) available that you can use.

= After the first post has loaded, all I get is the same post over and over again. Why is that? =

If you have this issue and you have created a custom repeater template file to support the theme then you may have placed the post navigation outside of the post query.

You need to place it inside the loop. If that is not the case then you have not included the content of the post correctly according to the theme you are using.

= Does the plugin detect my theme and insert the theme selectors for me? =

If the theme author has added support for Auto Load Next Post and has set the theme selectors then yes, it will set the theme selectors for you. If not supported then it does not. You may follow this guide to help you [find your theme selectors](https://github.com/autoloadnextpost/alnp-documentation/blob/master/en_US/theme-selectors.md?utm_source=wordpressorg&utm_medium=wp.org&utm_campaign=faq-link).

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
= 1.5.6 : 29th November 2018 =
* Corrected: Twenty Nineteen support for the featured image was missing an inner wrapper to provide the correct styling.

= 1.5.5 : 28th November 2018 =
* Added: Screen reader support for links missing them.
* Added: WordPress UX for the help tab sucks so I added a button to the settings page that will help users find the help.
* Added: Support for Sydney theme out of the box.
* Added: Support for the new default theme Twenty Nineteen ready for WP v5.0 release.
* Checked: Compatibility with WordPress 5.0
* Fixed: Missing semicolon at the end of the JavaScript and minified with correction.
* Fixed: WP dashboard footer is only styled on the ALNP settings page.
* Improved: Managing themes supported so future themes can be added out of the box.
* Renamed: All theme class files and folders for all default WordPress themes to match theme slug.
* Updated: CSS assets did not fully minify properly since last CSS update.
* Updated: POT file for translations.
* Updated: Code cleanup.

= 1.5.4 : 10th November 2018 =
* Fixed: Welcome notice. A class was not defined to return `alnp_get_random_page_permalink` function for unsuported themes.
* Moved: `alnp_get_random_page_permalink` function to core functions so it is globally used instead.
* Added: An if condition to check each global function if `function_exists`
* Updated: The **uninstall.php** file to also remove user interactions saved in the **usermeta** table.

= 1.5.3 : 15th September 2018 =
* Corrected: Meta name for when locking the JavaScript in the footer is set via theme support.

= 1.5.2 : 14th September 2018 =
* Reverted: The JavaScript from not requiring the document to be ready due to JS minification breaking it.

= 1.5.1 : 14th September 2018 =
* Fixed: No such file for including the admin settings when setting default options due to a file rename.

= 1.5.0 : 14th September 2018 =
* NEW: All settings are available in the theme customizer.
* NEW: Option to load the JavaScript in the footer.
* NEW: Support for themes that require Auto Load Next Post to load in the footer.
* NEW: Added trigger event support for third-party plugins thanks to Stelios Patsatzis.
* NEW: Support for theme Make, Storefront and Understrap.
* NEW: Privacy policy guide content.
* NEW: Beta notice if trying out beta releases. Explains how you can provide feedback and can be dismissed for 7 days.
* NEW: Welcome notice to users who install Auto Load Next Post for the first time.
* Added: A check to see if JetPack is active.
* Added: A check in the JavaScript to prevent it from loading if a user is requesting to post a comment. - Initial post only.
* Added: A filter for the repeater template location so theme or plugin developers can move it to another location should they need to.
* Added: A user agent checker to see if the request was made from a known bot.
* Added: Detection of plugin support. If supported, set the theme selectors for the currently active theme even when the theme has changed.
* Added: Admin notice to tell the user the theme supports Auto Load Next Post. Only shows once.
* Added: Admin notice to tell the user the theme selectors have already been set by the current theme if that theme supports Auto Load Next Post.
* Added: Admin notice under "Theme Selectors" settings only if all three or one of the required theme selectors is not set.
* Added: Admin notice under the "Misc" settings only if remove comments was enabled but the comments container selector was not set.
* Added: A sidebar to the settings page to promote Auto Load Next Post Pro and allow users to sign up.
* Added: Select2 to replace previous JavaScript library "chosen" for better support and performance.
* Changed: Rewrite endpoint to be more distinct for Auto Load Next Post and prevent any conflicts.
* Changed: Settings have been separated into Theme Selectors and Miscellaneous settings.
* Changed: The JavaScript now does not require the document to be ready. This is especially helpful if you have enabled the JavaScript to load in the footer.
* Fixed: The trigger to override the post URL.
* Fixed: Install date to a timestamp for those who have previously installed Auto Load Next Post so when you see the review notice, it does not say it's been 48 years since you installed because that is just crazy. LOL :laughing:
* Improved: Theme support and all default WordPress themes are supported out of the box. (Twenty Ten to Twenty Seventeen)
* Improved: Moved flushing rewrite rules so it only runs once during installation or updating Auto Load Next Post.
* Improved: Admin setting fields and added placeholder support.
* Improved: Inline PHPdocs
* Renamed: Repeater template from content-partial.php to content-alnp.php
* Removed: Admin notice for the theme has not declared support.
* Removed: Template location filter from the repeater template as it has been moved for better support.
* Removed: PHP version check.
* Removed: JavaScript library "chosen".
* Updated: POT file for translation.
* Updated: Repeater template due to improvements with this release.

[See changelog for all versions](https://raw.githubusercontent.com/autoloadnextpost/auto-load-next-post/master/CHANGELOG.md).

== Upgrade Notice ==
Developer Warning: Please install version 1.5.4 or above. Version 1.5.0 to 1.5.3 had some issues that were not picked up straight away.
