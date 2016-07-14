'use strict';

module.exports = function( grunt ) {

	grunt.initConfig( {
		config: {
			src: 'src/',

			tests: {
				php: 'tests/php/'
			}
		},

		/**
		 * @see {@link https://github.com/sindresorhus/grunt-eslint grunt-eslint}
		 * @see {@link https://github.com/eslint/eslint ESLint}
		 */
		eslint: {
			gruntfile: {
				src: [ 'Gruntfile.js' ]
			}
		},

		/**
		 * @see {@link https://github.com/brandonramirez/grunt-jsonlint grunt-jsonlint}
		 * @see {@link https://github.com/zaach/jsonlint JSON Lint}
		 */
		jsonlint: {
			options: {
				indent: 2
			},

			configs: {
				src: [ '.*rc' ]
			},

			json: {
				src: [ '*.json' ]
			}
		},

		/**
		 * @see {@link https://github.com/jgable/grunt-phplint grunt-phplint}
		 */
		phplint: {
			src: {
				src: [ '<%= config.src %>**/*.php' ]
			},

			tests: {
				src: [ '<%= config.tests.php %>**/*.php' ]
			}
		},

		/**
		 * @see {@link https://github.com/sindresorhus/grunt-shell grunt-shell}
		 */
		shell: {
			phpunit: {
				command: 'phpunit'
			}
		},

		/**
		 * @see {@link https://github.com/gruntjs/grunt-contrib-watch grunt-contrib-watch}
		 */
		watch: {
			options: {
				spawn: false
			},

			configs: {
				files: [ '.*rc' ],
				tasks: [
					'newer:jsonlint:configs'
				]
			},

			gruntfile: {
				files: [ 'Gruntfile.js' ],
				tasks: [
					'eslint:gruntfile'
				]
			},

			json: {
				files: [ '*.json' ],
				tasks: [
					'newer:jsonlint:json'
				]
			},

			php: {
				files: [
					'<%= config.src %>**/*.php',
					'<%= config.tests.php %>**/*.php'
				],
				tasks: [
					'newer:phplint'
				]
			}
		}
	} );

	/**
	 * @see {@link https://github.com/sindresorhus/load-grunt-tasks load-grunt-tasks}
	 */
	require( 'load-grunt-tasks' )( grunt );

	grunt.registerTask( 'develop', [
		'newer:jsonlint',
		'newer:phplint'
	] );

	grunt.registerTask( 'ci', [
		'jsonlint',
		'eslint',
		'phplint',
		'shell:phpunit'
	] );

	grunt.registerTask( 'pre-commit', [
		'newer-clean',
		'ci'
	] );

	grunt.registerTask( 'release', [
		'pre-commit'
	] );

	grunt.registerTask( 'default', 'develop' );

};
