<?php


namespace MBW\modules\Elementor\Controller;


use MBW\Controller\ApplicationController;

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
        add_filter( 'elementor/controls/animations/additional_animations', [__CLASS__, 'wpg_entrance_animations']);
	}

    static function after_plugins_loaded()
    {
        if(defined('ELEMENTOR_VERSION')){
            self::$config = require_once dirname(__DIR__) . '/config.php';
            SettingsController::init(self::$config);
            ApplicationController::register_loaded_module(self::$config);
            add_action('admin_enqueue_scripts', [__CLASS__, 'admin_enqueue_scripts']);
            add_action('wp_enqueue_scripts', [__CLASS__, 'wp_enqueue_scripts']);
        }
    }


    static function admin_enqueue_scripts()
    {
        wp_enqueue_style('highligh-js');
        wp_enqueue_script('highligh-js');
        self::_maybe_enqueue_styles();
    }

    static function wp_enqueue_scripts()
    {
        self::_maybe_enqueue_styles();
    }

    private static function _maybe_enqueue_styles(){
        $settings = SettingsController::get_settings();
        if(@$settings['load_common_css'] == 1){
            wp_enqueue_style('wpg-common-css', MBW_PLUGIN_URL . 'assets/css/frontend.style.min.css');
        }
        /*@todo WooCommerceStyles */
        if(@$settings['load_woocommerce_css'] == 1){
            wp_enqueue_style('wpg-woo-css', MBW_PLUGIN_URL . 'assets/css/woocommerce-styles.css');
        }
    }

    static function  wpg_entrance_animations() {
        return [
            'WPGet Slide Animations' => [
                'smallFadeSlideLeft' => 'Small Fade Slide Left',
                'smallFadeSlideRight' => 'Small Fade Slide Right',
                'smallFadeSlideUp' => 'Small Fade Slide Up',
                'smallFadeSlideDown' => 'Small Fade Slide Down',
                'wpe-clip-reveal-from-bottom' => 'Clip Reveal Bottom',
                'wpe-clip-reveal-from-top' => 'Clip Reveal Top',
                'tilt-in-fwd-tr' => 'Tilt in Fwd TR',
                'tilt-in-fwd-tl' => 'Tilt in Fwd Tl',
                'tilt-in-fwd-br' => 'Tilt in Fwd BR',
                'tilt-in-fwd-bl' => 'Tilt in Fwd BL',
                'tilt-in-right-1' => 'Tilt in Right',
                'tilt-in-left-1' => 'Tilt in Left',
                'slit-in-vertical' => 'Slit in Vertical',
                'slit-in-horizontal' => 'Slit in Horizontal',
                'slit-in-diagonal-1' => 'Slit in Diag 1',
                'slit-in-diagonal-2' => 'Slit in Diag 2'
            ],
            'WPGet Text' => [
                'wpg-char-drop-rotate' => 'Char Drop & Rotate',
                'wpg-char-drop-down' => 'Char Drop Down',
                'wpg-char-drop-up' => 'Char Drop Up',
                'wpg-char-in-right' => 'Char In Right',
                'wpg-char-in-left' => 'Char In Left',
                'wpg-char-zoom-pop' => 'Char Zoom Pop',
                'wpg-char-spin' => 'Char Spin',
                'wpg-y-flip-in' => 'Char Y Flip',
                'wpg-x-flip-in' => 'Char X Flip',
                'wpg-rotate-dtr' => 'Char Rotate TR'
            ],
            'WPG Block' => [
                'wpg-block-reveal-left' => 'Block Reveal Left',
                'wpg-block-reveal-right' => 'Block Reveal Right',
                'wpg-block-reveal-top' => 'Block Reveal Top',
                'wpg-block-reveal-bottom' => 'Block Reveal Bottom'
            ],
            'WPG Highlighters' => [
                'wpg-highlight-red' => 'Highlight Red',
                'wpg-highlight-yellow' => 'Highlight Yellow',
            ],
            'WPG Custom' => [
                'wpg-custom1' => 'wpg-custom1',
                'wpg-custom2' => 'wpg-custom2',
                'wpg-custom3' => 'wpg-custom3',
                'wpg-custom4' => 'wpg-custom4',
                'wpg-custom5' => 'wpg-custom5'
            ]
        ];
    }

}
