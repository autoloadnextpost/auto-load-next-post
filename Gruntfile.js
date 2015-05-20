module.exports = function(grunt) {

// Load multiple grunt tasks using globbing patterns
require('load-grunt-tasks')(grunt);

// Project configuration.
grunt.initConfig({
  pkg: grunt.file.readJSON('package.json'),

    makepot: {
      target: {
        options: {
          domainPath: 'languages/',               // Where to save the POT file.
          exclude: ['build/.*'],
          mainFile: 'auto-load-next-post.php',    // Main project file.
          potComments: 'Auto Load Next Post Copyright (c) {{year}}',      // The copyright at the beginning of the POT file.
          potFilename: 'auto-load-next-post.pot', // Name of the POT file.
          type: 'wp-plugin',                      // Type of project.
          updateTimestamp: true,                  // Whether the POT-Creation-Date should be updated without other changes.
          processPot: function( pot, options ) {
            pot.headers['report-msgid-bugs-to'] = 'https://github.com/seb86/Auto-Load-Next-Post/issues\n';
            pot.headers['plural-forms'] = 'nplurals=2; plural=n != 1;\n';
            pot.headers['last-translator'] = 'Auto Load Next Post <mailme@sebastiendumont.com>\n';
            pot.headers['language-team'] = 'WP-Translations <wpt@wp-translations.org>\n';
            pot.headers['x-poedit-basepath'] = '..\n';
            pot.headers['x-poedit-language'] = 'English\n';
            pot.headers['x-poedit-country'] = 'UNITED STATES\n';
            pot.headers['x-poedit-sourcecharset'] = 'utf-8\n';
            pot.headers['x-poedit-searchpath-0'] = '.\n';
            pot.headers['x-poedit-keywordslist'] = '__;_e;__ngettext:1,2;_n:1,2;__ngettext_noop:1,2;_n_noop:1,2;_c;_nc:4c,1,2;_x:1,2c;_ex:1,2c;_nx:4c,1,2;_nx_noop:4c,1,2;\n';
            pot.headers['x-textdomain-support'] = 'yes\n';
            return pot;
          }
        }
      }
    },

    exec: {
      npmUpdate: {
        command: 'npm update'
      },
      txpull: { // Pull Transifex translation - grunt exec:txpull
        cmd: 'tx pull -a --minimum-perc=60' // Change the percentage with --minimum-perc=yourvalue
      },
      txpush_s: { // Push pot to Transifex - grunt exec:txpush_s
        cmd: 'tx push -s'
      },
    },

    dirs: {
      lang: 'languages',
    },

    potomo: {
      dist: {
        options: {
         poDel: false // Set to true if you want to erase the .po
        },
        files: [{
          expand: true,
          cwd: '<%= dirs.lang %>',
          src: ['*.po'],
          dest: '<%= dirs.lang %>',
          ext: '.mo',
          nonull: true
        }]
      }
    },

});

// Default task. - grunt makepot
grunt.registerTask( 'default', 'makepot' );

// Makepot and push it on Transifex task(s).
grunt.registerTask( 'txpush', [ 'makepot', 'exec:txpush_s' ] );

// Pull from Transifex and create .mo task(s).
grunt.registerTask( 'txpull', [ 'exec:txpull', 'potomo' ] );

};
