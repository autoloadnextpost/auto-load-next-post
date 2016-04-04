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
* Added a upgrade link on the plugins page.
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
* Removed @return void on __construct() functions.
* Cleaned up the code.

## 1.4.2 (31st July 2015)
* Added two languages for localizing the plugin settings page. Français (French)(France) and Româna (Romanian).

## 1.4.1 (13th June 2015)
* Added many action hooks in template file 'content-partial.php' - See documentation for list of hooks.
* Removed an error from the admin side when debug is enabled.

## 1.3.2 (20th May 2015)
* Added more theme support with compatible theme template file which can be overrided.
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

## 1.0.0 (4th April 2015)

* Initial Release
