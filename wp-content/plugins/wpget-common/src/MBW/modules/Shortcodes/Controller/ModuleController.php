<?php


namespace MBW\modules\Shortcodes\Controller;


use MBW\Controller\ApplicationController;
use MBW\lib\ViewHelper;

class ModuleController {
	private static $_init;

	public static $config;

	static function init()
	{
		if (self::$_init) {
			return;
		}
		self::$_init = true;
        add_action('plugins_loaded', [__CLASS__, 'after_plugins_loaded']);
	}

    static function after_plugins_loaded()
    {
        self::$config = require_once dirname(__DIR__) . '/config.php';
        ApplicationController::register_loaded_module(self::$config);
        add_action('admin_enqueue_scripts', [__CLASS__, 'admin_enqueue_scripts']);
        add_action('wp_enqueue_scripts', [__CLASS__, 'wp_enqueue_scripts']);
        add_action('admin_menu', [__CLASS__, 'add_sub_menu_page']);

        self::add_shortcodes();
    }

    static function add_sub_menu_page(){
        add_submenu_page(
            'wpget-common',
            self::$config['module_title'],
            self::$config['menu_title'],
            'manage_options',
            self::$config['menu_slug'],
            [__CLASS__, 'output_menu_page']
        );
    }

    static function output_menu_page()
    {
        ViewHelper::getView(dirname(__DIR__) . '/View/shortcodes_admin_view.phtml');
    }

    static function add_shortcodes()
    {
        add_shortcode('wpg_crockoblock_get_option',function ($args){
            if(!isset($args['page_slug']) || ! isset($args['option'])){
                return 'Error: Invalid shortcode options';
            }
            return jet_engine()->listings->data->get_option($args['page_slug'] . '::' .  $args['option'] );
        });

        add_shortcode('site_url', function (){ return site_url();});
        add_shortcode('current_date', function ($args){
            $atts = shortcode_atts(
                [
                    'format' => 'd/m/Y'
                ],
                $args
            );
            return date($args['format']);
        });
    }

    static function admin_enqueue_scripts()
    {

    }

    static function wp_enqueue_scripts()
    {

    }


}
