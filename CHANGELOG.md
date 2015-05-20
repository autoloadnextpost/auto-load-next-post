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
