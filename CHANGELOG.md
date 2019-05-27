<!--
# Markdown validation notes

1. Make sure the latest release heading is one #
2. All previous headings must have two ##
3. Lists must have one space above after heading
-->

# 1.6.0 - ?? ?? 2019

* NEW: Added a Setup Wizard to scan the theme you have active and identify your theme selectors and templates location.
* NEW: Added a Getting Started page which introduces the user to the setup wizard.
* NEW: Settings page now previews features coming in Auto Load Next Post Pro. [#7174140](https://github.com/autoloadnextpost/auto-load-next-post/commit/7174140)
* NEW: Added extensions page listing available extensions for the plugin thanks for the class provided by [@dcooney](https://github.com/dcooney/).
* NEW: Added validation for required settings. [#761f7e9](https://github.com/autoloadnextpost/auto-load-next-post/commit/761f7e9)
* NEW: Added button on theme selectors settings to open theme customizer if theme not supported. [#1030d4b](https://github.com/autoloadnextpost/auto-load-next-post/commit/1030d4b)
* NEW: Added option under **Misc** to disable Auto Load Next Post from running on mobile devices. [#7bf0caa](https://github.com/autoloadnextpost/auto-load-next-post/commit/7bf0caa)
* NEW: Added Templates section for users to set the template location without the need of applying a filter. Filter was designed for theme developers.
* NEW: jQuery-confirm.js is used to replace previous confirmation dialogs as they were not working in Firefox and is used to improve user experience both for the Settings page and the new Setup Wizard. [#1fe1eec](https://github.com/autoloadnextpost/auto-load-next-post/commit/1fe1eec)
* Removed: Welcome notice as it has been replaced with the Getting Started page. [#1fe1eec](https://github.com/autoloadnextpost/auto-load-next-post/commit/1fe1eec)
* Improved: UI of the settings page.
* Improved: Code base throughout the whole of the plugin.
* Tweaked: Theme selector fields are set to read-only if theme is supported by the theme developer. [#074b780](https://github.com/autoloadnextpost/auto-load-next-post/commit/074b780)
* Tweaked: Made review notice more personal to the user. [#4123372](https://github.com/autoloadnextpost/auto-load-next-post/commit/4123372)
* Tweaked: Sign up form in sidebar now pre-fills with current logged in user for quicker sign up. [#a70cfcb](https://github.com/autoloadnextpost/auto-load-next-post/commit/a70cfcb)
* Tweaked: Made translating the plugin easier by merging near identical strings.
* Dev: All CSS has been converted into SCSS.
* Dev: Grunt tasks have been improved for better development.
* Dev: Auto Load Next Post can be installed via WP-CLI without redirect issues.

## 1.5.13 - 27th May 2019

* Tweaked: Upgrade warning notice in preparation for version 1.6.0 release.

## 1.5.12 - 23rd April 2019

* Tweaked: Repeater template now looks for `content-post.php` should `content-single.php` not exist before fallback to `content.php`.
* Tweaked: Help tab copy and links on the plugin settings page.
* Tweaked: Need help button now opens the help panel for the settings in view if one exists.
* Updated: Review link.
* Updated: POT file for translations.

## 1.5.11 - 10th April 2019

* NEW: Excluded JS files from defer for the [WP Rocket](https://wp-rocket.me) plugin.
* Dev Feature: Reset button added to the Misc settings to allow users to remove all settings and re-initialize the plugin.
* Fixed: Incorrect function name used when applying filter for [WP Rocket](https://wp-rocket.me) plugin.
* Tweaked: Admin notices to only appear on the Dashboard, the Plugins page, the Themes page and Auto Load Next Post settings page.
* Tweaked: Admin notices have been re-ordered to allow correct flow of display.
* Tweaked: Improved Admin JavaScript and added a confirmation for when the reset button is pressed.
* Tweaked: Code clean up to remove functions or inline documentation that is no longer needed or used.
* Updated: POT file for translations.

## 1.5.10 - 5th April 2019

* NEW: Added 3rd Party support for the [WP Rocket](https://wp-rocket.me) plugin. Excludes Auto Load Next Post scripts from JS minification.
* Corrected: Added missing Poseidon theme options used to determin if post thumbnails should show in repeater template.
* Tweaked: Theme selectors admin notification should the active theme be supported via a plugin.
* Tweaked: `uninstall.php` file.

## 1.5.9 - 2nd April 2019

* NEW: Added support for [Poseidon](https://wordpress.org/themes/poseidon/) theme.

## 1.5.8 - 1st April 2019

* NEW: Added support for [OceanWP](https://wordpress.org/themes/oceanwp/) theme.
* Corrected: Typo in Congratulations admin notification.
* Tweaked: Improved loading of Auto Load Next Post if set in the footer.
* Tweaked: Disqus comments is also removed if **Remove Comments** is enabled.
* Tweaked: The plugins JavaScript will stop running if user scrolls to quickly. Solves issue [#156](https://github.com/autoloadnextpost/auto-load-next-post/issues/156)
* Updated: POT file for translations.

## 1.5.7 - 25th March 2019

* Corrected: Meta name used to determin if the JavaScript should load in the footer.
* Tweaked: Congratulations admin notification. Issue [#154](https://github.com/autoloadnextpost/auto-load-next-post/issues/154)

## 1.5.6 - 29th November 2018

* Corrected: Twenty Nineteen support for the featured image was missing an inner wrapper to provide the correct styling.

## 1.5.5 - 28th November 2018

* NEW: The WordPress UX for the help tab sucks so I added a custom button to the settings page that will help users find help.
* NEW: Added support for the [Sydney](https://wordpress.org/themes/sydney/) theme.
* NEW: Added support for the new default theme Twenty Nineteen ready for WP v5.0 release.
* NEW: Added screen reader support for links missing them.
* Checked: Compatibility with WordPress 5.0
* Fixed: Missing semicolon at the end of the JavaScript and minified with correction.
* Fixed: WP dashboard footer is only styled on the ALNP settings page.
* Tweaked: Improved managing themes supported so future themes can be added out of the box.
* Tweaked: Renamed all theme class files and folders for all default WordPress themes to match theme slug.
* Tweaked: Code cleanup.
* Updated: CSS assets did not fully minify properly since last CSS update.
* Updated: POT file for translations.

## 1.5.4 - 10th November 2018

* Fixed: Welcome notice. A class was not defined to return `alnp_get_random_page_permalink()` function for unsuported themes.
* Tweaked: Moved `alnp_get_random_page_permalink()` function to core functions so it is globally used instead.
* Tweaked: Added an if condition to check each global function if `function_exists`
* Updated: The `uninstall.php` file to also remove user interactions saved in the **usermeta** table.

## 1.5.3 - 15th September 2018

* Corrected: Meta name for when locking the JavaScript in the footer if set via theme support.

## 1.5.2 - 14th September 2018

* Reverted: The JavaScript from not requiring the document to be ready due to JS minification breaking it.

## 1.5.1 - 14th September 2018

* Fixed: No such file for including the admin settings when setting default options due to a file rename.

## 1.5.0 - 14th September 2018

* NEW: All settings are available in the theme customizer.
* NEW: Option to load the JavaScript in the footer.
* NEW: Support for themes that require Auto Load Next Post to load in the footer.
* NEW: Added trigger event support for third-party plugins thanks to Stelios Patsatzis.
* NEW: Support for theme [Make](https://wordpress.org/themes/make/) and [Understrap](https://wordpress.org/themes/understrap/).
* NEW: Privacy policy guide content.
* NEW: Beta notice if trying out beta releases. Explains how you can provide feedback and can be dismissed for 7 days.
* NEW: Welcome notice to users who install Auto Load Next Post for the first time.
* NEW: Added detection of plugin support. If supported, set the theme selectors for the currently active theme even when the theme has changed.
* NEW: Added a filter for the repeater template location so theme or plugin developers can move it to another location should they need to.
* NEW: Added a user agent checker to see if the request was made from a known bot. This prevents SEO indexing issues.
* NEW: Added admin notice to tell the user the theme supports Auto Load Next Post. Only shows once.
* NEW: Added admin notice to tell the user the theme selectors have already been set by the current theme if that theme supports Auto Load Next Post.
* NEW: Added admin notice under **Theme Selectors** settings only if all three or one of the required theme selectors is not set.
* NEW: Added admin notice under the **Misc** settings only if remove comments was enabled but the comments container selector was not set.
* NEW: Added a sidebar to the settings page to promote Auto Load Next Post Pro and allow users to sign up.
* NEW: Added [Select2](https://github.com/select2/select2) to replace previous JavaScript library _chosen_ for better support and performance.
* Fixed: The trigger to override the post URL.
* Fixed: Install date to a timestamp for those who have previously installed Auto Load Next Post so when you see the review notice, it does not say it's been 48 years since you installed because that is just crazy. LOL :laughing:
* Tweaked: Changed the rewrite endpoint to be more distinct for Auto Load Next Post and prevent any conflicts.
* Tweaked: Changed the settings page to separate **Theme Selectors** and **Miscellaneous** settings into their individual setions.
* Tweaked: Changed the JavaScript so it does not require the document to be ready. This is especially helpful if you have enabled the JavaScript to load in the footer.
* Tweaked: Added a check to see if JetPack is active.
* Tweaked: Added a check in the JavaScript to prevent it from loading if a user is requesting to post a comment. - Initial post only.
* Tweaked: Improved theme support and all default WordPress themes are supported out of the box. (Twenty Ten to Twenty Seventeen)
* Tweaked: Moved flushing rewrite rules so it only runs once during installation or updating Auto Load Next Post.
* Tweaked: Admin setting fields and added placeholder support.
* Tweaked: Inline PHPdocs
* Tweaked: Renamed the repeater template from `content-partial.php` to `content-alnp.php`
* Removed: Admin notice for the theme has not declared support.
* Removed: Template location filter from the repeater template as it has been moved for better support.
* Removed: PHP version check.
* Removed: JavaScript library "chosen".
* Updated: POT file for translations.
* Updated: Repeater template due to improvements with this release.

## 1.4.13 - 20th August 2018

* Added: Upgrade warning notice in preparation for version 1.5.0 release.

## 1.4.12 - 19th May 2018

* Fixed: Corrected post type returned for single posts in the repeater template.
* Removed: The need to check if the theme has declared support before the plugin loads the JavaScript.

## 1.4.11 - 23rd April 2018

* Fixed: Initial post id was failing the rest of the script if undefined with some themes.

## 1.4.10 - 21st April 2018

* NEW: Added support for the [Storefront](https://wordpress.org/themes/storefront/) theme.
* NEW: Added two new action hooks in the template to support post types in preparation for Auto Load Next Post Pro. - [See action hooks in the documentation for details.](https://autoloadnextpost.com/documentation/action-hooks/)
* Changed: Two action hooks in the template to be inconsistent with the new action hooks for post types. - [See action hooks in the documentation for details.](https://autoloadnextpost.com/documentation/action-hooks/)
* Changed: PHP minimum requirement to version 5.6
* Fixed: Issue with plugin setting up default settings once activated.
* Fixed: Issue with History.js already been loaded when previewing in the customizer.
* Fixed: Issue with Google Analytics returning the full URL... sometimes.
* Tweaked: Added a compatible HTML semantics lookup check if HTML5 is not used for article.
* Tweaked: Added an alternative post navigation lookup check for some theme frameworks.
* Tweaked: Browser back button now scrolls to the top of the previous post if any. Thanks to @lex111
* Tweaked: Detect if Auto Load Next Post parameters exist before running the script.
* Tweaked: Added attributes to identify which post is the initial post both on the post divider and the article.
* Tweaked: ScrollSpy now identifies the post divider via the new data attribute.
* Tweaked: Hidden the post divider completely. Inline styling is used instead for better compatibility with themes.
* Tweaked: Auto Load Next Post now does not run if the post URL has a hashtag for a specific comment on an initial load.
* Tweaked: Improved the uninstallation of the plugin. Now refreshes the permalinks to remove custom rewrite permalink for the plugin.
* Tweaked: Improved the code base in preparation for Auto Load Next Post Pro.
* Updated: Template file header to provide clear information for overriding repeater template.
* Updated: Template to include support for other post types in preparation for Auto Load Next Post Pro.
* Updated: Settings page to display the theme selectors descriptions rather than using tips.
* Updated: The help tab on the settings page.
* Updated: POT file for translations.
* Updated: Documentation links in the plugin.
* Updated: Documentation links in readme.txt
* Updated: FAQ's in readme.txt

## 1.4.9 - 30th December 2016

* NEW: Added support for Twenty Sixteen theme.
* Updated: Admin notice for contribution.
* Updated: Admin settings field labels and help tips.
* Updated: POT file for translations.

## 1.4.8 - 25th December 2016

* NEW: Added support for child-themes so they too can also use the plugin. Thanks to [lwesolowski](https://github.com/lwesolowski)
* NEW: Added new template location filter. [See Documentation](https://github.com/autoloadnextpost/alnp-documentation/blob/master/en_US/filter-hooks.md).
* NEW: Added new action hook for when there are no new posts to load.
* NEW: Added a post count variable in the JavaScript for the posts that have loaded. Can be used to trigger an event after X amount of posts have loaded.
* NEW: Added a new variable in the JavaScript that can be set to prevent further posts from loading.
* NEW: Added support for Twenty Seventeen theme.
* Dev Feature: Can view the console logs if debug mode is enabled for Auto Load Next Post. Must have `SCRIPT_DEBUG` set to true also. [See Documentation](https://github.com/autoloadnextpost/alnp-documentation/).
* Dev Feature: JavaScript triggers have been added so developers can do fun stuff. [See Documentation](https://github.com/autoloadnextpost/alnp-documentation/blob/master/en_US/javascript-triggers.md).
* Tweaked: Corrected plugin links and improved spelling and grammar.
* Tweaked: Corrected admin notices to now use WordPress style instead.
* Fixed: Google Analytics bug that prevented more than 3 posts to load. Thanks to [PatriceVB](https://github.com/PatriceVB)
* Improved: How Google Analytics is triggered.
* Improved: The JavaScript now identifies the post ID of each post including the initial post on load.
* Improved: The JavaScript to remove the comments on load instead if requested.
* Improved: The default template `content-partial.php`.
* Removed: The post navigation from the template `content-partial.php` file and applied it via an action hook instead.
* Removed: The comments from the template `content-partial.php` file and applied it via an action hook instead.
* Removed: History state on the initial post load. Not required.
* Removed: All languages except the POT file from the plugin as they will now be downloaded from WordPress.org
* Removed: The support section on the plugins page as the help tab has been improved.
* Updated: The admin help sections on the plugins page.
* Updated: The admin footer on the plugins page.
* Updated: POT file for translations.
* Updated: The readme.txt file.
* Updated: Gruntfile.js file.
* Updated: package.json file.

## 1.4.7 - 4th April 2016

* NEW: Added the Russian (Russia) translation.
* Updated: The English (United Kingdom) translation.
* Updated: The Italian (Italy) translation.

## 1.4.6 - 3rd April 2016

* NEW: Added two additional help tabs on the plugin settings page.
* Compatible: Tested up to WordPress `4.4.2`
* Tweaked: Corrected links within the readme.txt file.
* Tweaked: Provided a list of extra features coming with Auto Load Next Post Premium in the readme.txt file.
* Tweaked: Fixed undefined issue with Google Analytics.
* Tweaked: Removed all console log and console error in the JavaScript.
* Updated: F.A.Q's in the readme.txt file.
* Updated: `uninstall.php` file.
* Updated: POT file for translations.

## 1.4.5 - 30th November 2015

* New: Added the English (United Kingdom) translation.
* Updated: Italian (Italy) translation.

## 1.4.4 - 29th November 2015

* Tweaked: Fixed the activation of the plugin from the broken update in version `1.4.3`
* Tweaked: Removed code that is not needed and certain parts that are not for the free version of Auto Load Next Post.
* Tweaked: Removed additional whitespace in the code making the plugin just a little bit lighter.
* Tweaked: Improved the [WP Update Php](https://github.com/WPupdatePHP/wp-update-php) class originally created by [Coen Jacobs](https://github.com/coenjacobs). Also renamed the class a little so that it doesn't cause any conflicts with other plugins when activating.
* Updated: Copy in the settings page.
* Updated: French translation.

## 1.4.3 - 20th October 2015

* NEW: Added a German translation.
* NEW: Added a support tab to the plugin settings page.
* NEW: Added an upgrade link on the plugins page.
* NEW: Added a community support link on the plugins page.
* NEW: Added PHP detection to make sure the site is running the required PHP version.
* NEW: Core themes are supported except for Twenty Eleven. Theme notification only shows now if not a core theme.
* Corrected: Undefined function for Google Analytics tracking in the JavaScript.
* Corrected: A loading issue of the template file should the theme have one also.
* Tweaked: Improved Google Analytics. Now detects old, classic, current and Yoast method of tracking pageviews.
* Tweaked: Changed the default content container setting to match Twenty Fifteen.
* Tweaked: Improved the partial content template file. Now has a fallback. Should be more compatible with themes.
* Tweaked: Redefined the constants.
* Tweaked: Moved admin functions under the directory `includes/admin`
* Tweaked: Moved library assets under a new folder for both CSS and JavaScript.
* Tweaked: Improved copy in the settings page and the help tab.
* Tweaked: The readme.txt file with better copy.
* Tweaked: Removed public variables and hardcoded them into the plugin instead.
* Tweaked: Removed whitespace.
* Tweaked: Removed @return void on `__construct()` functions.
* Tweaked: Cleaned up the code base.
* Updated: POT file for translations.

## 1.4.2 - 31st July 2015

* NEW: Added two languages for localizing the plugin settings page. Français (French) and Româna (Romanian).

## 1.4.1 - 13th June 2015

* NEW: Added action hooks in template file `content-partial.php` - See the [documentation for a list of hooks](https://github.com/autoloadnextpost/alnp-documentation/blob/master/en_US/action-hooks.md).
* Tweaked: Removed an error from the admin side when debug is enabled.

## 1.3.2 - 20th May 2015

* NEW: Added Chosen (v1.4.2) JavaScript by [Harvest](http://harvesthq.github.io/chosen/)
* NEW: Added console logs in the JavaScript for debugging purposes.
* NEW: Added more theme support with compatible theme template file which can be overridden.
* NEW: Added option to enable autoloading posts for specific post types.
* NEW: Added option for comments. Now you can choose to show or hide rather than forcing it to hide automatically.
* Corrected: Text domain name in plugin header.
* Corrected: Access to function `load_file()` from private to public
* Corrected: Access to function `register_scripts_and_styles()` from private to public
* Corrected: Error with the `uninstall.php` file
* Tweaked: Moved function `register_scripts_and_styles()` to `class-auto-load-next-post-admin.php`
* Tweaked: Filtered the JavaScript to load only on singular posts and the enabled post types.
* Tweaked: Removed security issue in the main plugin file by accessing `$GLOBALS` directly.
* Tweaked: Removed all closing PHP tags omitting at the end of each file.

### Versions in between were development builds

> All development builds were merged into version `1.3.2` above.

## 1.0.0 - 4th April 2015

* Initial release ⭐️
