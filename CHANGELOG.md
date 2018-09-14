# 1.5.2 (14th September 2018)
* Reverted: The JavaScript from not requiring the document to be ready due to JS minification breaking it.

# 1.5.1 (14th September 2018)
* Fixed: No such file for including the admin settings when setting default options due to a file rename.

# 1.5.0 (14th September 2018)
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

# 1.4.13 (20th August 2018)
* Added: Upgrade warning notice in preparation for version 1.5.0 release.

# 1.4.12 (19th May 2018)
* Fixed: Corrected post type returned for single posts in the repeater template.
* Removed: The need to check if the theme has declared support before the plugin loads the JavaScript.

# 1.4.11 (23rd April 2018)
* Fixed: Initial post id was failing the rest of the script if undefined with some themes.

# 1.4.10 (21st April 2018)
* Added: Compatible HTML semantics lookup if HTML5 is not used for article.
* Added: Alternative post navigation lookup for some theme frameworks.
* Added: Storefront theme to the list of themes that work out of the box.
* Added: Two new action hooks in the template to support post types in preparation for Auto Load Next Post Pro. - [See action hooks in the documentation for details.](https://autoloadnextpost.com/documentation/action-hooks/)
* Changed: Two action hooks in the template to be inconsistent with the new action hooks for post types. - [See action hooks in the documentation for details.](https://autoloadnextpost.com/documentation/action-hooks/)
* Changed: PHP minimum requirement to version 5.6
* Fixed: Issue with plugin setting up default settings once activated.
* Fixed: Issue with History.js already been loaded when previewing in the customizer.
* Fixed: Issue with Google Analytics returning the full URL... sometimes.
* Enhanced: Browser back button now scrolls to the top of the previous post if any. Thanks to @lex111
* Enhanced: Detect if Auto Load Next Post parameters exist.
* Enhanced: Added attributes to identify which post is the initial post both on the post divider and the article.
* Enhanced: Hidden the post divider completely. Inline styling is used instead for better compatibility with themes.
* Enhanced: ScrollSpy now identifies the post divider via the new data attribute.
* Enhanced: Auto Load Next Post now does not run if the post URL has a hashtag for a specific comment on an initial load.
* Improved: The uninstallation of the plugin. Now refreshes the permalinks to remove custom rewrite permalink for the plugin.
* Improved: Code base in preparation for Auto Load Next Post Pro.
* Updated: Template file header to provide clear information for overriding repeater template.
* Updated: Template to include support for other post types in preparation for Auto Load Next Post Pro.
* Updated: Settings page to display the theme selectors descriptions rather than using tips.
* Updated: The help tab on the settings page.
* Updated: POT file.
* Updated: Documentation links in the plugin.
* Updated: Documentation links in readme.txt
* Updated: FAQ's in readme.txt

# 1.4.9 (30th December 2016)
* Added: Support for Twenty Sixteen.
* Updated: Admin notice for contribution.
* Updated: Admin settings field labels and help tips.
* Updated: POT file.

# 1.4.8 (25th December 2016)
* Added: Support for child-themes so they too can also use the plugin. Thanks to [lwesolowski](https://github.com/lwesolowski)
* Added: New template location filter. [See Documentation](https://github.com/AutoLoadNextPost/Auto-Load-Next-Post/wiki).
* Added: New action hook for when there are no new posts to load.
* Added: a post count of the posts that have loaded. Can be used to trigger an event after X amount of posts have loaded.
* Added: a new variable that can be set to prevent further posts from loading.
* Added: Support for Twenty Seventeen.
* Corrected: Plugin links and improved spelling and grammar.
* Corrected: Admin notices now use WordPress style.
* Dev Feature: Can view the console.logs if debug mode is enabled for Auto Load Next Post. Must have SCRIPT_DEBUG set to true also. [See Documentation](https://github.com/AutoLoadNextPost/Auto-Load-Next-Post/wiki).
* Dev Feature: JavaScript triggers have been added so developers can do fun stuff. [See Documentation](https://github.com/AutoLoadNextPost/Auto-Load-Next-Post/wiki).
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

# 1.4.7 (4th April 2016)
* Added the Russian (Russia) translation.
* Updated the English (United Kingdom) translation.
* Updated the Italian (Italy) translation.

# 1.4.6 (3rd April 2016)
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

## 1.4.5 (30th November 2015)
* Added the English (United Kingdom) translation.
* Updated the Italian (Italy) translation.

## 1.4.4 (29th November 2015)
* Fixed the activation of the plugin from the broken update in version 1.4.3
* Removed code that is not needed and certain parts that are not for the free version of Auto Load Next Post.
* Removed additional whitespace in the code making the plugin just a little bit lighter.
* Improved the WP Update Php class originally created by Coen Jacobs. Also renamed the class a little so that it doesn't cause any conflicts with other plugins when activating.
* Updated the copy in the settings page.
* Updated the French translation.

## 1.4.3 (20th October 2015)
* Corrected undefined function for Google Analytics tracking in the JavaScript.
* Improved Google Analytics. Now detects old, classic, current and Yoast method of tracking pageviews.
* Changed the default content container setting to match Twenty Fifteen.
* Core themes are supported except for Twenty Eleven. Theme notification only shows now if not a core theme.
* Corrected a loading issue of the template file should the theme have one also.
* Improved the partial content template file. Now has a fallback. Should be more compatible with themes.
* Added a support tab to the plugin settings page.
* Added an upgrade link on the plugins page.
* Added a community support link on the plugins page.
* Added the German translation.
* Redefined the constants.
* Moved admin functions under the directory 'includes/admin'
* Moved library assets under a new folder for both CSS and JavaScript.
* Added PHP detection.
* Improved copy in the settings page and the help tab.
* Updated the default localization file.
* Updated the readme.txt file with better copy.
* Removed public variables and hardcoded them into the plugin instead.
* Removed whitespace.
* Removed @return void on `__construct()` functions.
* Cleaned up the code.

## 1.4.2 (31st July 2015)
* Added two languages for localizing the plugin settings page. Français (French)(France) and Româna (Romanian).

## 1.4.1 (13th June 2015)
* Added many action hooks in template file 'content-partial.php' - See the documentation for a list of hooks.
* Removed an error from the admin side when debug is enabled.

## 1.3.2 (20th May 2015)
* Added more theme support with compatible theme template file which can be overridden.
* Added option to enable autoloading posts for specific post types.
* Added option for comments. Now you can choose to show or hide rather than forcing it to hide automatically.
* Added Chosen (v1.4.2) Javascript by [Harvest](http://harvesthq.github.io/chosen/)
* Added console.logs in the Javascript for debugging.
* Corrected text domain name in plugin header.
* Corrected access to function load_file() from private to public
* Corrected access to function register_scripts_and_styles() from private to public
* Corrected error with the uninstall.php file
* Moved function register_scripts_and_styles() to class-auto-load-next-post-admin.php
* Filtered the Javascript to load only on singular posts and the enabled post types.
* Removed security issue in the main plugin file by accessing $GLOBALS directly.
* Removed all closing PHP tags omitting at the end of each file.

## 1.0.0 (4th April 2015)

* Initial Release
