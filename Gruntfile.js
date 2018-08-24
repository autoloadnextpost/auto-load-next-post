module.exports = function(grunt) {
	'use strict';

	require('load-grunt-tasks')(grunt);

	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		cssmin: {
			target: {
				files: [{
					expand: true,
					cwd: 'assets/css/admin',
					src: [
						'auto-load-next-post.css',
						'!auto-load-next-post.min.css'
					],
					dest: 'assets/css/admin',
					ext: '.min.css'
				}]
			}
		},

		uglify: {
			options: {
				compress: {
					global_defs: {
						"EO_SCRIPT_DEBUG": false
					},
					dead_code: true
				},
				banner: '/*! <%= pkg.title %> <%= pkg.version %> <%= grunt.template.today("yyyy-mm-dd HH:MM") %> */\n'
			},
			build: {
				files: [{
					expand: true, // Enable dynamic expansion.
					src: [
						'assets/js/frontend/*.js',
						'!assets/js/frontend/*.min.js',
						'!assets/js/frontend/*.dev.js',
						'assets/js/admin/*.js',
						'!assets/js/admin/*.min.js'
					],
					ext: '.min.js', // Dest filepaths will have this extension.
				}]
			}
		},

		jshint: {
			options: {
				reporter: require('jshint-stylish'),
				globals: {
					"EO_SCRIPT_DEBUG": false,
				},
				'-W099': true, // Mixed spaces and tabs
				'-W083': true, // Fix functions within loop
				'-W082': true, // Declarations should not be placed in blocks
				'-W020': true, // Read only - error when assigning EO_SCRIPT_DEBUG a value.
			},
			all: [
				'assets/js/frontend/*.js',
				'!assets/js/frontend/*.min.js',
				'assets/js/frontend/*.dev.js',
				'assets/js/admin/*.js',
				'!assets/js/admin/*.min.js'
			]
		},

		// Generate .pot file
		makepot: {
			target: {
				options: {
					type: 'wp-plugin', // Type of project (wp-plugin or wp-theme).
					domainPath: 'languages', // Where to save the POT file.
					mainFile: '<%= pkg.name %>.php', // Main project file.
					potFilename: '<%= pkg.name %>.pot', // Name of the POT file.
					potHeaders: {
						'Report-Msgid-Bugs-To': 'https://github.com/AutoLoadNextPost/Auto-Load-Next-Post/issues',
						'language-team': 'Sébastien Dumont <mailme@sebastiendumont.com>',
						'language': 'en_US'
					},
					exclude: [
						'releases',
						'node_modules',
						'wp-update-php'
					]
				}
			}
		},

		checktextdomain: {
			options:{
				text_domain: '<%= pkg.name %>', // Project text domain.
				keywords: [
					'__:1,2d',
					'_e:1,2d',
					'_x:1,2c,3d',
					'esc_html__:1,2d',
					'esc_html_e:1,2d',
					'esc_html_x:1,2c,3d',
					'esc_attr__:1,2d',
					'esc_attr_e:1,2d',
					'esc_attr_x:1,2c,3d',
					'_ex:1,2c,3d',
					'_n:1,2,4d',
					'_nx:1,2,4c,5d',
					'_n_noop:1,2,3d',
					'_nx_noop:1,2,3c,4d'
				]
			},
			files: {
				src:  [
					'*.php',
					'**/*.php', // Include all files
					'!node_modules/**', // Exclude node_modules/
					'!wp-update-php/**'
				],
				expand: true
			},
		},

		potomo: {
			dist: {
				options: {
					poDel: false
				},
				files: [{
					expand: true,
					cwd: 'languages',
					src: ['*.po'],
					dest: 'languages',
					ext: '.mo',
					nonull: false
				}]
			}
		},

		// Bump version numbers (replace with version in package.json)
		replace: {
			Version: {
				src: [
					'readme.txt',
					'<%= pkg.name %>.php'
				],
				overwrite: true,
				replacements: [
					{
						from: /Stable tag:.*$/m,
						to: "Stable tag: <%= pkg.version %>"
					},
					{
						from: /Version:.*$/m,
						to: "Version:     <%= pkg.version %>"
					},
					{
						from: /public static \$version = \'.*.'/m,
						to: "public static $version = '<%= pkg.version %>'"
					}
				]
			}
		},

		// Copies the plugin to create deployable plugin.
		copy: {
			deploy: {
				src: [
					'**',
					'!.*',
					'!*.md',
					'!.*/**',
					'!.htaccess',
					'!Gruntfile.js',
					'!package.json',
					'!package-lock.json',
					'!releases/**',
					'!node_modules/**',
					'!.DS_Store',
					'!npm-debug.log',
					'!*.sh',
					'!*.zip',
					'!*.jpg',
					'!*.jpeg',
					'!*.gif',
					'!*.png'
				],
				dest: '<%= pkg.name %>',
				expand: true,
				dot: true
			}
		},

		// Compresses the deployable plugin folder.
		compress: {
			zip: {
				options: {
					archive: './releases/<%= pkg.name %>-v<%= pkg.version %>.zip',
					mode: 'zip'
				},
				files: [
					{
						expand: true,
						cwd: './<%= pkg.name %>/',
						src: '**',
						dest: '<%= pkg.name %>'
					}
				]
			}
		},

		// Deletes the deployable plugin folder once zipped up.
		clean: [ '<%= pkg.name %>' ]
	});

	// Set the default grunt command to run test cases.
	grunt.registerTask( 'default', [ 'test' ] );

	// Checks for errors with the javascript and text domain.
	grunt.registerTask( 'test', [ 'jshint', 'checktextdomain' ]);

	// Updates version, minify css and javascript and finaly runs i18n tasks.
	grunt.registerTask( 'dev', [ 'replace', 'cssmin', 'newer:uglify', 'makepot' ]);

	/**
	 * Run i18n related tasks.
	 *
	 * This includes extracting translatable strings, updating the master pot file.
	 * If this is part of a deploy process, it should come before zipping everything up.
	 */
	grunt.registerTask( 'update-pot', [ 'checktextdomain', 'makepot' ]);

	/**
	 * Creates a deployable plugin zipped up ready to upload
	 * and install on a WordPress installation.
	 */
	grunt.registerTask( 'zip', [ 'copy', 'compress', 'clean' ]);
};
