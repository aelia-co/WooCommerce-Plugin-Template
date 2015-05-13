module.exports = function(grunt) {
	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		'string-replace': {
			// Replace each plugin token with the corresponding value from configuration
			'plugin-tokens': {
				files: {
					'./': ['*', 'src/**', 'tests/**', '!*.log', '!package.json', '!gruntfile.js', '!.git*', '!.git/**']
				},
				options: {
					replacements: [
						{
							pattern: /(PLUGIN_NAME|PLUGIN_DESCRIPTION|PLUGIN_VERSION|PLUGIN_AUTHOR|PLUGIN_AUTH_URI|PLUGIN_LICENSE|PLUGIN_NSPACE|PLUGIN_CLASS_NAME|PLUGIN_SLUG_VALUE|PLUGIN_MENU_SLUG|PLUGIN_TEXT_DOMAIN|PLUGIN_SUPPORT_URL|PLUGIN_CONTACT_URL|PLUGIN_SETTINGS_KEY|PLUGIN_FILTER_PREFIX)/g,
							replacement: function(match, p1) {
								var config = grunt.config.get('pkg');
								var plugin_info = config.plugin_info;
								plugin_info['PLUGIN_DESCRIPTION'] = config.description;
								plugin_info['PLUGIN_VERSION'] = config.version;
								plugin_info['PLUGIN_AUTHOR'] = config.author.name;
								plugin_info['PLUGIN_AUTH_URI'] = ('url' in config.author) ? config.author.url : '';
								plugin_info['PLUGIN_LICENSE'] = config.license;

								grunt.log.writeln("MATCH: " + p1);
								grunt.log.writeln("REPLACEMENT: " + (match in plugin_info) ? plugin_info[match] : ("NOT_FOUND_" + match));
								return (match in plugin_info) ? plugin_info[match] : ("NOT_FOUND_" + match);
							}
						}
					]
				}
			},
			// Replace the reference to the "plugin-template.php" file with the name
			// of the main plugin file (see rename:main-plugin-file task).
			'main-plugin-file-references': {
				files: {
					'./': ['src/**', 'tests/**', '!*.log', '!package.json', '!gruntfile.js', '!.git*', '!.git/**']
				},
				options: {
					replacements: [
						{
							pattern: 'plugin-template.php',
							replacement: '<%= pkg.plugin_info["PLUGIN_SLUG_VALUE"] %>.php'
						}
					]
				}
			}
		},
		// Rename the main plugin file. The file name will match the plugin slug.
		'rename': {
			'main-plugin-file': {
				src: './plugin-template.php',
				dest: './<%= pkg.plugin_info["PLUGIN_SLUG_VALUE"] %>.php'
			}
		}
	});

	grunt.loadNpmTasks('grunt-string-replace');
	grunt.loadNpmTasks('grunt-rename');

	// Default task(s).
  grunt.registerTask('default', [
		'string-replace:plugin-tokens',
		'string-replace:main-plugin-file-references'
		//'rename:main-plugin-file',
	]);
};