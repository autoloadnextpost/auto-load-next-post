=== WordPress Infinite Scroll by Auto Load Next Post ===
Contributors: autoloadnextpost, sebd86
Donate link: https://autoloadnextpost.com/donate/
Tags: AJAX, ajax load posts, ajax pagination, ajax posts, infinite, infinite scroll, infinite scrolling, post scrolling, pagination, scroll, post history, browsing history, navigation
Requires PHP: 5.6
Requires at least: 4.4
Tested up to: 4.9.5
Stable tag: 1.4.10-beta.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Increase your pageviews on your site as readers continue reading your posts scrolling down the page.

== Description ==

You have great content. That's great but you shouldn't have to work twice as hard to get the pageviews you want. While Auto Load Next Post is not the only infinite scrolling plugin out there it is the first that is designed to work and match the theme you are using and track the content that is viewed and not the excerpts in your post archives like other plugins out there. All of your posts content.

**Auto Load Next Post templating experience is the best in class - by a long shot.**

Don't take my word for it. [Read what Rich Tabor](https://wordpress.org/support/topic/best-in-class-35/) "Author of [ThemeBeans](https://themebeans.com/?utm_source=wp-plugin-repo&utm_medium=link)" had to say in his review.

= What is Auto Load Next Post? =

Auto Load Next Post is a WordPress plugin developed to increase your pageviews by engaging the site viewers to keep reading your content rather than increasing your bounce rate.

It simply automatically loads the next post on your blog once the user has reached the bottom of the initial post the viewer is reading and repeats the process as the user reads your content until there are no more posts to load.

= How does it work? =

At the end of every single post their is a post navigation which is used to detect and collect the previous post URL for the next post to load. JavaScript then loads the post by inserting the content via a customizable repeater template that matches the theme structure for a single post and places the content underneath the parent post within the main post container.

The JavaScript detects when you are reading the next post and updates your browser URL address bar and page title to that post. Should you refresh the browser, the post you are currently reading would load as the new initial post.

All previous posts of the blog are still retained in your browser history and too top it off, you can track each post read the same way a single post is tracked as a pageview.

= Note to Beginners =

Auto Load Next Post is a plugin for self-hosted WordPress sites. This means you will need to [switch from WordPress.com to WordPress.org](http://www.wpbeginner.com/wp-tutorials/how-to-properly-move-your-blog-from-wordpress-com-to-wordpress-org/) if you want to use this plugin on your WordPress site.

= Demo Site =

Want to see how it works? [Go to the demo site](https://demo.autoloadnextpost.com?utm_source=wp-plugin-repo&utm_medium=link&utm_campaign=demo-link) and view any single post. Scroll down and see the plugin in action.

= Increase Your PageViews Today =

Intrigued? I bet you are. Once you try Auto Load Next Post, you pageviews will increase and you will not want to go back. Guaranteed.

= Built with developers in mind =

Extendable and open source — Auto Load Next Post is created with developers in mind.

> #### Auto Load Next Post Pro
> There's an even better version of the plugin coming out soon with the following extra features:<br />
>
> - Custom Post Type Support<br />
> - Media Attachments Support<br />
> - Customizable Template for Pages<br />
> - Priority Email Support<br />
> - and many more features to follow.
>
> [More information](https://autoloadnextpost.com/pro/?utm_source=wp-plugin-repo&utm_medium=link&utm_campaign=after-features-info-link) | [Sign up to be notified >>](http://eepurl.com/bvLz2H)

This plugin is created and maintained by [Sébastien Dumont](https://sebastiendumont.com).

**More information**

- [Visit Auto Load Next Post website](https://autoloadnextpost.com)
- If you're a developer yourself, follow or contribute to the [Auto Load Next Post plugin on GitHub](https://github.com/AutoLoadNextPost/auto-load-next-post)

== Installation ==

Installing "Auto Load Next Post" can be done either by searching for "Auto Load Next Post" via the "Plugins > Add New" screen in your WordPress dashboard, or by using the following steps:

1. Download the plugin via WordPress.org
2. Upload the ZIP file through the 'Plugins > Add New > Upload' screen in your WordPress dashboard.
3. Activate the plugin through the 'Plugins' menu in WordPress.
4. Go to the plugin settings page 'Settings > Auto Load Next Post'.
5. Enter each of the selectors specified for the theme you are using and press "Save Changes".

Once you have activated the plugin, you may get an admin notice telling you that you have not declared support for the plugin. This is perfectly normal and with a little setting up, the notification will remove automatically. There are two buttons. The first leads you to documentation to help you support the plugin in your theme. The second allows you to hide the admin notice. - This notification does not show for any of WordPress core themes.

See [documentation](https://autoloadnextpost.com/documentation/) for more information.

== Frequently Asked Questions ==

= How do I declare Auto Load Next Post support in a theme? =

Simple add this to your ***functions.php*** file.<br />
> ```add_theme_support('auto-load-next-post');```<br />

= Where's the settings screen? =

Settings > Auto Load Next Post.

= Is overriding the template file required? =

No. This was put in place to support themes that have coded their template files differently from [WordPress theme code standards](https://codex.wordpress.org/Theme_Development#Theme_Development_Standards). For example, the [Genesis Framework](https://autoloadnextpost.com/product/genesis-framework-support/) displays content via many action hooks instead so for this case overriding the template is a required.

= How can I override the default template file? =

You first need to create a new folder in your theme directory like so: **your-theme-name/auto-load-next-post/** and copy the template file **content-partial.php** from the plugin template folder into that new folder.

Modify it to match how your theme’s content is loaded for a single post. Your new template will be used to load the posts.

= Can I use JetPack Social Links and Like Button? =

Yes. No further configuration is needed if you already have JetPack setup with social icons and like button.

= Is it compatible with the JetPack's related posts module? =

This is not possible but it would also drive away the purpose of this plugin if related posts where to be displayed.

= Can I load content before and after the next post has loaded? =

Yes. In the plugin template, there are [action hooks](https://autoloadnextpost.com/documentation/action-hooks/) that you can use along with an example on how to use them.

I have also prepared a [plugin demonstrating](https://github.com/AutoLoadNextPost/alnp-action-hooks-demonstration) the action hooks used when called. Simply download and install the plugin to see.

= After the first post has loaded, all I get is the same post over and over again. Why is that? =

If you have this issue and you have created a custom template file to support the theme then you may have placed the post navigation outside of the post query.

You need to place it inside the loop. If that is not the case then you have not included the content of the post correctly according to the theme you are using.

= Does the plugin detect my theme and insert the correct selectors for me? =

No, it does not. You may follow this guide to help you [find your theme selectors](https://autoloadnextpost.com/documentation/find-theme-selectors/).

= My theme does not work with the plugin, what do I do? =

If after adding theme support to your `functions.php` file, first, check that you have a post navigation at the end of your post. If one does exists then you may need to copy and modify the template file **content-partial.php** in order to support your theme.

Not all themes are coded the same way so some alterations will be needed to match the theme. If you need help with this then I provide [theme support](https://autoloadnextpost.com/product/theme-support/) on request.

= I'm confused about the post order. Why is the plugin called Auto Load Next Post? =

Well, WordPress loads posts in descending order by default so the next post is the previous post and a user reads content going down not up so it loads the next post, not previous.

= How can I get the Google Analytics option to work? =

You first need to have Google Analytics added to your site. Either by inserting the analytics into your theme yourself or by using the [Google Analytics plugin by MonsterInsights](https://wordpress.org/plugins/google-analytics-for-wordpress/).

= Does Auto Load Next Post support WordPress Network / Multisite websites? =

It does. Just make sure that you activate the plugin on the site you want it used on and then make sure the selectors match the theme the site is using.

== Screenshots ==

1. Plugin Settings Page
2. Theme Support Admin Notification

== Changelog ==
= 1.4.10 : 16th April 2018 =
* Added: Alternative post navigation lookup for some theme frameworks.
* Changed: PHP minimum requirement to version 5.6
* Fixed: Issue with plugin setting up default settings once activated.
* Fixed: Issue with History.js already been loaded when previewing in the customizer.
* Fixed: Issue with Google Analytics returning the full URL... sometimes.
* Enhanced: Browser back button now scrolls to the top of the previous post if any. Thanks to @lex111
* Enhanced: Detect if Auto Load Next Post parameters exist.
* Enhanced: Added attributes to identify which post is the initial post both on the post divider and the article.
* Enhanced: Hidden the post divider completely. Inline styling is used instead for better compatibility with themes.
* Enhanced: ScrollSpy now identifies the post divider via the new data attribute.
* Enhanced: Auto Load Next Post now does not run if the post url has a hashtag for a specific comment on an initial load.
* Improved: The uninstallation of plugin. Now refreshes the permalinks to remove custom rewrite permalink for the plugin.
* Improved: Code base in preparation for Auto Load Next Post Pro.
* Updated: Template file header to provide clear information for overriding repeater template.
* Updated: Settings page to display the theme selectors descriptions rather than using tips.
* Updated: The help tab on the settings page.
* Updated: POT file.
* Updated: Documentation links in the plugin.
* Updated: Documentation links in readme.txt
* Updated: FAQ's in readme.txt

= 1.4.9 : 30th December 2016 =
* Added: Support for Twenty Sixteen.
* Updated: Admin notice for contribution.
* Updated: Admin settings field labels and help tips.
* Updated: POT file.

= 1.4.8 : 25th December 2016 =
* Added: Support for child-themes so they too can also use the plugin. Thanks to [lwesolowski](https://github.com/lwesolowski)
* Added: New template location filter. [See Documentation](https://autoloadnextpost.com/documentation/).
* Added: New action hook for when there are no new posts to load.
* Added: a post count of the posts that have loaded. Can be used to trigger an event after X amount of posts have loaded.
* Added: a new variable that can be set to prevent further posts from loading.
* Added: Support for Twenty Seventeen.
* Corrected: Plugin links and improved spelling and grammar.
* Corrected: Admin notices now use WordPress style.
* Dev Feature: Can view the console.logs if debug mode is enabled for Auto Load Next Post. Must have SCRIPT_DEBUG set to true also. [See Documentation](https://autoloadnextpost.com/documentation/).
* Dev Feature: JavaScript triggers have been added so developers can do fun stuff. [See Documentation](https://autoloadnextpost.com/documentation/).
* Fixed: Google Analytics bug that prevented more than 3 posts to load. Thanks to [PatriceVB](https://github.com/PatriceVB)
* Improved: How Google Analytics is triggered.
* Improved: The JavaScript now identifies the post ID of each post including the initial post on load.
* Improved: The JavaScript to remove the comments on load instead if requested.
* Improved: The default template "content-partial.php".
* Removed: The post navigation from the template "content-partial.php" file and applied it via an action hook instead.
* Removed: The comments from the template "content-partial.php" file and applied it via an action hook instead.
* Removed: History state on the initial post load. Not required.
* Removed: All languages except the POT file from the plugin as they will now be downloaded from WordPress.org
* Removed: The support section on the plugins page as the help tab has been improved.
* Updated: The admin help sections on the plugins page.
* Updated: The admin footer on the plugins page.
* Updated: The POT file.
* Updated: The readme.txt file.

= 1.4.7 : 4th April 2016 =
* Added the Russian (Russia) translation.
* Updated the English (United Kingdom) translation.
* Updated the Italian (Italy) translation.

= 1.4.6 : 3rd April 2016 =
* Corrected links within the readme.txt file.
* Provided a list of extra features coming with Auto Load Next Post .
* Improved copy.
* Added two additional help tabs on the plugin settings page.
* Updated the F.A.Q's.
* Updated the uninstall.php file.
* Updated the POT file.
* Fixed undefined issue with Google Analytics.
* Removed all console.log and console.error in the Javascript.
* Tested up to WordPress 4.4.2

= 1.4.5 : 30th November 2015 =
* Added the English (United Kingdom) translation.
* Updated the Italian (Italy) translation.

= 1.4.4 : 29th November 2015 =
* Fixed the activation of the plugin from the broken update in version 1.4.3
* Removed code that is not needed and certain parts that are not for the free version of Auto Load Next Post.
* Removed additional whitespace in the code making the plugin just a little bit lighter.
* Improved the WP Update Php class originally created by Coen Jacobs. Also renamed the class a little so that it doesn't cause any conflicts with other plugins when activating.
* Updated the copy in the settings page.
* Updated the French translation.

= 1.4.3.1 : 20th October 2015 =
* Re-deployed v1.4.3 update as it failed using Ship by Big Bite Creative. Sorry about that. :(

= 1.4.3 : 19th October 2015 =
* Corrected undefined function for Google Analytics tracking in the JavaScript.
* Improved Google Analytics. Now detects old, classic, current and Yoast method of tracking pageviews.
* Changed the default content container setting to match Twenty Fifteen.
* Core themes are supported except for Twenty Eleven. Theme notification only shows now if not a core theme.
* Corrected a loading issue of the template file should the theme have one also.
* Improved the partial content template file. Now has a fallback. Should be more compatible with themes.
* Added a support tab to the plugin settings page.
* Added a upgrade link on the plugins page.
* Added a community support link on the plugins page.
* Added the German translation.
* Redefined the constants.
* Moved admin functions under the directory 'includes/admin'
* Moved library assets under a new folder for both CSS and JavaScript.
* Added PHP detection.
* Improved copy in the settings page and the help tab.
* Updated the default localization file.
* Removed public variables and hardcoded them into the plugin instead.
* Removed whitespace.
* Removed @return void on __construct() functions.
* Cleaned up the code.

= 1.4.2 : 31st July 2015 =
* Added two languages for localizing the plugin settings page. Français (French)(France) and Română (Romanian).

= 1.4.1 : 13th June 2015 =
* Added many action hooks in template file 'content-partial.php' - See documentation for a list of hooks.
* Removed an error from the admin side when debug is enabled.

= 1.3.2 : 20th May 2015 =
* Added more theme support with compatible theme template file which can be overridden.
* Added option to enable auto loading posts for specific post types.
* Added option for comments. Now you can choose to show or hide rather than forcing it to hide automatically.
* Added Chosen (v1.4.2) Javascript by [Harvest](http://harvesthq.github.io/chosen/)
* Added console.logs in the Javascript for debugging.
* Corrected text domain name in plugin header.
* Corrected access to function load_file() from private to public
* Corrected access to function register_scripts_and_styles() from private to public
* Corrected error with uninstall.php file
* Moved function register_scripts_and_styles() to class-auto-load-next-post-admin.php
* Filtered the Javascript to load only on singular posts and the enabled post types.
* Removed security issue in the main plugin file by accessing $GLOBALS directly.
* Removed all closing PHP tags omitting at the end of each file.

= 1.0.0 : 4th April 2015 =
* Initial version

== Upgrade Notice ==
= 1.4.10 : 16th April 2018 =
Many corrections and improvements have been made in this release. Please see the changelog for a full list.
