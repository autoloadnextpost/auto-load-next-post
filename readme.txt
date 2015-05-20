=== Auto Load Next Post ===
Contributors:      sebd86
Donate link:       http://www.sebastiendumont.com/donation/
Tags:              auto load, posts, scrolling, history
Requires at least: 4.0
Tested up to:      4.2.2
Stable tag:        1.3.2
License:           GPLv2 or later
License URI:       http://www.gnu.org/licenses/gpl-2.0.html

Simply auto loads the previous post as you scroll down the page. Also changes the URL address and the page title from that post.

== Description ==
Have you ever felt tired of going back and forth between blog posts? I know I have so I decided to develop a solution. One where you would need to do very little coding and require very little to set up on your blog.

[youtube https://www.youtube.com/watch?v=EvBCPXVe2U4]

= What is it? =
Auto Load Next Post is a lightweight plugin that simply loads the previous post, one after another as you scroll down the page. It simply reads the post navigation in your theme at the end of each post and collects the post URL for the previous post. WordPress will then do a partial load and place the content of the previous post underneath the parent post.

Not only that, it updates your web history by manipulating the web address and page title. This allows you to return to any post you have looked at in your browser history. When you refresh the page, the page will take you to the post you were viewing last.

= Features =
* Can restrict it to load only on specific post types. - NEW in v1.3.2
* Have the option to hide the comments if you wish. - NEW in v1.3.2
* Track each post load with Google Analytics. ( Requires Google Analytics to be applied for this to work. )

= Documentation =
Documentation, for this plugin, can be found at the GitHub repository [Wiki](https://github.com/seb86/Auto-Load-Next-Post/wiki).

= Contributing and reporting bugs =
You can contribute code to this plugin via GitHub: https://github.com/seb86/auto-load-next-post and localizations via Transifex: https://www.transifex.com/projects/p/auto-load-next-post/

= Support =
Use the WordPress.org forums for [community support](https://wordpress.org/support/plugin/auto-load-next-post). If you spot a bug, you can of course log it on [Github](https://github.com/seb86/Auto-Load-Next-Post/issues) instead where I can act upon it more efficiently.

If you need help with customization. Please consider [hiring me](http://www.sebastiendumont.com/hire-me/) to apply your website's customizations for this plugin.

= Demo Site =
Want to try it out? [Go to the demo site](http://demos.sebastiendumont.com/auto-load-next-post/) and view a post. Scroll down and see the plugin in action.

= Donations and Reviews =
To keep this plugin working and support many themes as possible, please consider making a [donation](http://www.sebastiendumont.com/donation/) or [write a review](https://wordpress.org/support/view/plugin-reviews/auto-load-next-post?rate=5#postform).

** More information **
- Other [WordPress plugins](http://profiles.wordpress.org/sebd86/) by [Sébastien Dumont](http://www.sebastiendumont.com/)
- Contact Sebastien on Twitter: [@sebd86](http://twitter.com/sebd86)
- If you're a developer yourself, follow or contribute to the [Auto Load Next Post plugin on GitHub](https://github.com/seb86/auto-load-next-post)

== Installation ==
Installing "Auto Load Next Post" can be done either by searching for "Auto Load Next Post" via the "Plugins > Add New" screen in your WordPress dashboard, or by using the following steps:

1. Download the plugin via WordPress.org
2. Upload the ZIP file through the 'Plugins > Add New > Upload' screen in your WordPress dashboard.
3. Activate the plugin through the 'Plugins' menu in WordPress.
4. Go to the plugin settings page 'Settings > Auto Load Next Post'.
5. Enter each of the containers specified in the theme you are using and press "Save".

Once you have activated the plugin, you may get an admin notice telling you that you have not declared support for the plugin. This is perfectly normal and with a little setting up, the notification will remove automatically. There are two buttons. The first leads you to documentation to help you support the plugin. The second allows you to force hide the admin notice.

See [documentation](https://github.com/seb86/Auto-Load-Next-Post/wiki) for more information.

== Screenshots ==
1. Admin Settings Page
2. Theme Support Admin Notification

== Changelog ==

= 1.3.2 : 20th May 2015 =
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

= 1.0.0 : 4th April 2015 =
* Initial version

== Upgrade Notice ==
= 1.3.2 : 20th May 2015 =
* Please upgrade for better theme support and security fix.
