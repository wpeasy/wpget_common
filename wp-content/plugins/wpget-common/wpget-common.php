<?php
/**
 * Plugin Name:       WPGet Common
 * Plugin URI:        https://www.wpget.net
 * Description:       Core functions for WPGet Managed sites
 * Version:           0.0.1
 * Author:            Alan Blair
 * Author URI:        https://www.wpget.net
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wpget-common
 */


define('MBW_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('MBW_PLUGIN_URL_FILE', __FILE__);

define('MBW_PLUGIN_URL', plugin_dir_url(__FILE__));


require_once __DIR__ . '/vendor/autoload.php';
\MBW\Controller\ApplicationController::init();
\MBW\modules\Elementor\Controller\ModuleController::init();
\MBW\modules\WP_Rocket\Controller\ModuleController::init();
\MBW\modules\Shortcodes\Controller\ModuleController::init();
