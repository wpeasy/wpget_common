<?php
namespace MBW\modules\WP_Rocket\Controller;

use MBW\Controller\ApplicationController;
use MBW\modules\WP_Rocket\Model\CacheModel;

class ModuleController {
	private static $_init;
	public static $config;

	static function init()
	{
		if (self::$_init) {
			return;
		}
		self::$_init = true;

        add_action('init', [__CLASS__, 'on_init']);
        register_deactivation_hook(MBW_PLUGIN_URL_FILE, [__CLASS__, 'on_deactivate']);

        add_action('rest_api_init', [__CLASS__, 'register_rest_endpoints']);
        add_action('admin_enqueue_scripts', [__CLASS__, 'admin_enqueue_scripts']);
	}

    function on_init(){
        if(function_exists('run_rocket_sitemap_preload') ){
            self::$config = require_once dirname(__DIR__) . '/config.php';
            SettingsController::init(self::$config);
            ApplicationController::register_loaded_module(self::$config);

            add_action('wpg_wp_rocket_cron_on_clear_hook' , 'run_rocket_sitemap_preload');

            $s = SettingsController::get_settings();
            if(@$s['enable_sitemap_preload_on_clear']){
                self::set_sitemap_cron_on_clear();
            }else{
                self::clear_cron_on_clear();
            }
            if(@$s['enable_hourly_sitemap_preload']){
                self::set_sitemap_hourly_preload_cron();
            }else{
                self::clear_hourly_preload_cron();
            }
        }
    }

    static function on_deactivate()
    {
        self::clear_cron_on_clear();
        self::clear_hourly_preload_cron();
    }

    static function set_sitemap_cron_on_clear()
    {
        add_action( 'after_rocket_clean_domain', [__CLASS__, 'set_sitemap_cron_on_clear_callback'] ); // Run if cache gets cleared. No delay, run on next CRON parse
        add_action( 'upgrader_process_complete', [__CLASS__, 'set_sitemap_cron_on_clear_callback']); //Run after updates. Use delayed schedule to avoid overload if multiple sites are updated
        add_action( 'before_run_rocket_sitemap_preload', [__CLASS__, 'clear_cron_on_clear'] ); //Hook to clear schedule if the preload has already run
    }

    static function set_sitemap_cron_on_clear_callback()
    {
        if ( ! wp_next_scheduled('wpg_wp_rocket_cron_on_clear_hook') ) {
            wp_schedule_single_event( time() + 60, 'wpg_wp_rocket_cron_on_clear_hook' );
        }
    }



    static function clear_cron_on_clear()
    {
        wp_clear_scheduled_hook('wpg_wp_rocket_cron_on_clear_hook');
    }

    static function set_sitemap_hourly_preload_cron()
    {
        $hook = 'wpg_rocket_hourly_preload_cron';
        if ( ! wp_next_scheduled( $hook) ) {
            wp_schedule_event( time(), 'hourly', $hook );
        }

        add_action('wpg_rocket_hourly_preload_cron' , function (){
            if ( function_exists( 'run_rocket_sitemap_preload' ) ) {
                run_rocket_sitemap_preload();
            }
        });
    }

    static function clear_hourly_preload_cron()
    {
        wp_clear_scheduled_hook('wpg_rocket_hourly_preload_cron');
    }




    static function register_rest_endpoints()
    {
        register_rest_route(
            'wpg_wprocket_debug/v1',
            'process/(?P<type>[\w-]+)',
            [
                'methods' => 'GET',
                'callback' => [__CLASS__, 'process_cache_records_endpoint']
            ]
        );
    }



    static function process_cache_records_endpoint($request){
        $current_user = wp_get_current_user();
        if (user_can( $current_user, 'administrator' )) {
            $nonce =   $_SERVER['HTTP_X_WP_NONCE'];
            if(empty($nonce) || wp_verify_nonce($nonce)){
                return new \WP_REST_Response(array('error' => 'Not Authorised, invalid nonce.'), 401);
            }

            CacheModel::process($request['type']);

            return [
                'html' => CacheModel::$processed_html,
                'total' => CacheModel::$processed_total,
                'not_cached' => CacheModel::$processes_not_cached_total,
                'cached' => CacheModel::$processed_cached_total
            ];
        }
        return new \WP_REST_Response(array('error' => 'Not Authorised.'), 401);
    }

    static function admin_enqueue_scripts()
    {
        wp_enqueue_script(self::$config['options_name'], MBW_PLUGIN_URL . 'assets/js/wp-rocket-debug.js' , ['jquery']);

    }
}
