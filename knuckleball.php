<?php
/**
 * Plugin Name:     Knuckball
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     This plugin is for baseball card collectors who send cards out to past players and current players in hopes of getting them signed.
 * Author:          allenjd3
 * Author URI:      https://allenjd3.github.io
 * Text Domain:     knuckball
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Knuckball
 */

// Your code starts here.

spl_autoload_register('knuckleball_autoloader');

function knuckleball_autoloader($class_name) {
	$namespace = 'Ohio_Tokyo_International_Sea_Monster_Society\\';

	if (strpos($class_name, $namespace) === 0) {
		$classes_dir = realpath(plugin_dir_path(__FILE__)) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR;
		$class_file = str_replace($namespace, '', $class_name);
		$class_file = str_replace('\\', DIRECTORY_SEPARATOR, $class_file) . '.php';
		$file = $classes_dir . $class_file;

		if (file_exists($file)) {
			require_once $file;
		}
	}
}

\Ohio_Tokyo_International_Sea_Monster_Society\Knuckleball\Knuckleball::init();
