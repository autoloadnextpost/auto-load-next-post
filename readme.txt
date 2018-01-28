=== Auto Load Next Post ===
Contributors:      sebd86
Donate link:       https://autoloadnextpost.com/donate/
Tags:              AJAX, ajax load posts, ajax pagination, ajax posts, infinite, infinite scroll, infinite scrolling, post scrolling, pagination, scroll, post history, browsing history, navigation
Requires at least: 4.3
Tested up to:      4.7
Stable tag:        1.4.9
License:           GPLv2 or later
License URI:       http://www.gnu.org/licenses/gpl-2.0.html

Gain more post views on your site as readers continue reading your posts scrolling down the page.

== Description ==

= What is Auto Load Next Post? =
Auto Load Next Post is a WordPress plugin developed to increase page views by engaging the site viewers to keep them reading the blogs content as they reach the bottom of an article rather than having to go back and select another post to read.

It simply loads the next post on your blog automatically once the user has reached the bottom of the initial post the viewer is reading and repeats as the user reads the content until there are no more posts to load.

= How does it work? =
At the end of every single post their is a post navigation which is used to detect and collect the previous post URL for the next post to load. JavaScript then loads the post by inserting the content via a special template that matches the theme structure for a single post and places the content underneath the parent post within the main post container.

The JavaScript detects when you are reading the next post and updates your browser URL address bar and page title to that post. Should you refresh the browser, the post you are currently reading would load as the new initial post.

All previous posts of the blog are still retained in your browser history.

= Note to Beginners =
Auto Load Next Post is a plugin for self-hosted WordPress sites. This means you will need to [switch from WordPress.com to WordPress.org](http://www.wpbeginner.com/wp-tutorials/how-to-properly-move-your-blog-from-wordpress-com-to-wordpress-org/) if you want to use this plugin on your WordPress site.

= Features =
* Action hooks to load content in the loop file.
* Developer Friendly.
* Hide Comments.
* Track posts with Google Analytics. ***Requires Google Analytics to be applied on your site first for this to work.***
* Over-writable template loop file.
* Child-theme Support.
* WordPress Network / Multisite Support.

> #### Auto Load Next Post Premium
> There's an even better version of the plugin coming out soon with the following extra features:<br />
>
> - Custom Post Type Support<br />
> - Media Attachments Support<br />
> - Over-writable Template for Pages<br />
> - More popular themes supported<br />
> - Priority Email Support<br />
> - and many more features to follow.
>
> [More information](https://autoloadnextpost.com/premium/?utm_source=wp-plugin-repo&utm_medium=link&utm_campaign=after-features-info-link) | [Sign up to be notified >>](http://eepurl.com/bvLz2H)

= Found a Bug? =
If you find a bug within Auto Load Next Post, please [report the issue](https://github.com/seb86/Auto-Load-Next-Post/issues?state=open) by creating a ticket on the GitHub repository where I can deal with it more appropriately. Please ensure that you read the [contribution guidelines](https://github.com/seb86/Auto-Load-Next-Post/blob/master/CONTRIBUTING.md) prior to submitting your report. To help me solve the issue, please be as descriptive as possible.

= Demo Site =
Want to see how it works? [Go to the demo site](http://demo.autoloadnextpost.com) and view any single post. Scroll down and see the plugin in action.

= Support by Donating =
To keep this plugin actively developed and supported, donations help go along way in making the plugin much better. [Make a Donation](https://autoloadnextpost.com/donate/)

= Please Leave a Review =
Your ratings make a big difference. If you like Auto Load Next Post, please consider spending a minute or two [leaving a review](https://wordpress.org/support/view/plugin-reviews/auto-load-next-post?rate=5#postform) and tell me what you think about the plugin. Your ratings and reviews will help this plugin grow and provide the motivation needed to keep pushing it forward.

= Translation Support =

Auto Load Next Post is in need of translations. Is the plugin not translated in your language or do you spot errors with the current translations? Helping out is easy! Click on "[Translate Auto Load Next Post](https://translate.wordpress.org/projects/wp-plugins/auto-load-next-post)" on the side of this page.

**Libraries Used**

- [chosen](https://github.com/harvesthq/chosen)
- [jQuery.history](https://github.com/browserstate/history.js)
- [jQuery.tiptip](https://github.com/drewwilson/TipTip)
- [scrollspy](https://github.com/thesmart/jquery-scrollspy)

The libraries above are used with the plugin.

> #### PHP Requirement
> This plugin requires PHP version 5.3 or higher.<br />
> If you're still at PHP 5.2, it's time to update. [Read here why and how](http://www.wpupdatephp.com/update/)<br />
> Updating to a newer PHP version is almost always done in minutes and free of charge!

**More information**

- [Visit Auto Load Next Post website](https://autoloadnextpost.com)
- Other [WordPress plugins](http://profiles.wordpress.org/sebd86/) by [Sébastien Dumont](https://sebastiendumont.com)
- Contact Sébastien on Twitter: [@sebd86](http://twitter.com/sebd86)
- If you're a developer yourself, follow or contribute to the [Auto Load Next Post plugin on GitHub](https://github.com/seb86/auto-load-next-post)

== Installation ==
Installing "Auto Load Next Post" can be done either by searching for "Auto Load Next Post" via the "Plugins > Add New" screen in your WordPress dashboard, or by using the following steps:

1. Download the plugin via WordPress.org
2. Upload the ZIP file through the 'Plugins > Add New > Upload' screen in your WordPress dashboard.
3. Activate the plugin through the 'Plugins' menu in WordPress.
4. Go to the plugin settings page 'Settings > Auto Load Next Post'.
5. Enter each of the selectors specified for the theme you are using and press "Save Changes".
6. Finally, add support for **Auto Load Next Post** by simply adding a line of code to your ***functions.php*** file.

Once you have activated the plugin, you may get an admin notice telling you that you have not declared support for the plugin. This is perfectly normal and with a little setting up, the notification will remove automatically. There are two buttons. The first leads you to documentation to help you support the plugin. The second allows you to force hide the admin notice. - This notification does not show for any of WordPress core themes.

See [documentation](https://github.com/seb86/Auto-Load-Next-Post/wiki) for more information.

== Frequently Asked Questions ==

> #### Auto Load Next Post Premium
> There's an even better version of the plugin coming out soon with the following extra features:<br />
>
> - Custom Post Type Support<br />
> - Media Attachments Support<br />
> - Over-writable Template for Pages<br />
> - More popular themes supported<br />
> - Priority Email Support<br />
> - and many more features to follow.
>
> [More information](https://autoloadnextpost.com/premium/?utm_source=wp-plugin-repo&utm_medium=link&utm_campaign=faq-info-link) | [Sign up to be notified >>](http://eepurl.com/bvLz2H)

= How do I enable theme support for the plugin? =

Simple add this to your ***functions.php*** file.<br />
> ```add_theme_support('auto-load-next-post');```<br />

Then setup the selectors for your theme in the settings page.

= Where's the settings screen? =

Settings > Auto Load Next Post.

= Is overriding the template file required? =

No. This was put in place to support themes that have coded their template files differently from WordPress standard code.

= How can I override the default template file? =

Simply create a new folder in your theme like so: ***your-theme/auto-load-next-post/*** and copy the template file ***content-partial.php*** into that new folder. Modify it to match your theme and from now on the plugin will load that template file instead.

= Is it compatible with the JetPack's related posts module? =

It has been brought to my attention that this is no longer the case with the recent updates made in JetPack. I am looking into a new solution so look out for it on the feature roadmap.

= You mentioned action hooks to load content before and after the next post has loaded. What are they? =

The [action hooks](https://github.com/seb86/Auto-Load-Next-Post/wiki/Hooks) are documented on the GitHub repository along with an example on how to use them. I have also prepared a [plugin](https://github.com/seb86/Auto-Load-Next-Post-Hooks-Example) that shows you an example of added content using the hooks.

= After the first post has loaded, all I get is the same post over and over again. Why is that? =

If you created your own ***content-partial.php*** file, you may have placed the post navigation outside of the post query. You need to place it inside the loop. If that is not the case then you have not included the content of the post correctly.

= Does the plugin detect my theme and insert the correct selectors for me? =

No it does not, but this will be available in the premium version. However this will only work with themes that have been tested and approved.

= My theme does not work with the plugin, what do I do? =

You may need to copy and modify the template file ***content-partial.php*** in order to support your theme. Not all themes are coded the same way so some alterations will be needed. If you need help with this then create a support ticket and I will do my best to help you.

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
= 1.4.9 : 30th December 2016 =
* Added: Support for Twenty Sixteen.
* Updated: Admin notice for contribution.
* Updated: Admin settings field labels and help tips.
* Updated: POT file.

= 1.4.8 : 25th December 2016 =
* Added: Support for child-themes so they too can also use the plugin. Thanks to [lwesolowski](https://github.com/lwesolowski)
* Added: New template location filter. [See Documentation](https://github.com/seb86/Auto-Load-Next-Post/wiki).
* Added: New action hook for when there are no new posts to load.
* Added: a post count of the posts that have loaded. Can be used to trigger an event after X amount of posts have loaded.
* Added: a new variable that can be set to prevent further posts from loading.
* Added: Support for Twenty Seventeen.
* Corrected: Plugin links and improved spelling and grammar.
* Corrected: Admin notices now use WordPress style.
* Dev Feature: Can view the console.logs if debug mode is enabled for Auto Load Next Post. Must have SCRIPT_DEBUG set to true also. [See Documentation](https://github.com/seb86/Auto-Load-Next-Post/wiki).
* Dev Feature: JavaScript triggers have been added so developers can do fun stuff. [See Documentation](https://github.com/seb86/Auto-Load-Next-Post/wiki).
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
* Updated: Gruntfile.js file.
* Updated: package.json file.

= 1.4.7 : 4th April 2016 =
* Added the Russian (Russia) translation.
* Updated the English (United Kingdom) translation.
* Updated the Italian (Italy) translation.

= 1.4.6 : 3rd April 2016 =
* Corrected links within the readme.txt file.
* Provided a list of extra features coming with Auto Load Next Post Premium.
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
= 1.4.9 : 30th December 2016 =
* Added: Support for Twenty Sixteen.
* Updated: Admin notice for contribution.
* Updated: Admin settings field labels and help tips.
* Updated: POT file.

= 1.4.8 : 25th December 2016 =
* Added: Support for child-themes so they too can also use the plugin. Thanks to [lwesolowski](https://github.com/lwesolowski)
* Added: New template location filter. [See Documentation](https://github.com/seb86/Auto-Load-Next-Post/wiki).
* Added: New action hook for when there are no new posts to load.
* Added: a post count of the posts that have loaded. Can be used to trigger an event after X amount of posts have loaded.
* Added: a new variable that can be set to prevent further posts from loading.
* Added: Support for Twenty Seventeen.
* Corrected: Plugin links and improved spelling and grammar.
* Corrected: Admin notices now use WordPress style.
* Dev Feature: Can view the console.logs if debug mode is enabled for Auto Load Next Post. Must have SCRIPT_DEBUG set to true also. [See Documentation](https://github.com/seb86/Auto-Load-Next-Post/wiki).
* Dev Feature: JavaScript triggers have been added so developers can do fun stuff. [See Documentation](https://github.com/seb86/Auto-Load-Next-Post/wiki).
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
* Updated: Gruntfile.js file.
* Updated: package.json file.
