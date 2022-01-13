<?php


namespace MBW\Controller;


class ApplicationController {
	private static $_init;
    private static $_loaded_modules = [];

	static function init() {
		if ( self::$_init ) {
			return;
		}
		self::$_init = true;

		add_action( 'admin_menu', [__CLASS__, 'add_root_menu'] );
        add_action('admin_enqueue_scripts', [__CLASS__, 'register_scripts']);
        add_action('wp_enqueue_scripts', [__CLASS__, 'register_scripts']);;
        add_action('admin_enqueue_scripts', [__CLASS__, 'admin_enqueue_scripts']);
        add_action('wp_enqueue_scripts', [__CLASS__, 'frontend_enqueue_scripts']);;

	}

    static function register_loaded_module($conf)
    {
        self::$_loaded_modules[] = $conf;
    }
    static function get_loaded_modules()
    {

    }

    static function register_scripts(){
        wp_register_script('wpg-common-vendor', MBW_PLUGIN_URL . 'assets/js/vendor.bundle.js');
        wp_register_script('wpg-common-common', MBW_PLUGIN_URL . 'assets/js/common.bundle.min.js',['wpg-common-vendor']);
        wp_register_script('wpg-common-admin', MBW_PLUGIN_URL . 'assets/js/admin.bundle.min.js', ['wpg-common-common','jquery']);
        wp_register_script('wpg-common-frontend', MBW_PLUGIN_URL . 'assets/js/frontend.bundle.min.js', ['wpg-common-common','jquery']);
        wp_register_style('wpg-common-common', MBW_PLUGIN_URL . 'assets/css/common.style.min.css');
        wp_register_style('wpg-common-admin', MBW_PLUGIN_URL . 'assets/css/admin.style.min.css', ['wpg-common-common']);
        wp_register_style('wpg-common-frontend', MBW_PLUGIN_URL . 'assets/css/frontend.style.min.css',  ['wpg-common-common']);
    }
    static function admin_enqueue_scripts()
    {
        wp_enqueue_style('wpg-common-admin');
        wp_enqueue_script('wpg-common-admin');
        wp_register_script('highligh-js', '//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js' );
        wp_register_style( 'highligh-js', '//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/styles/default.min.css');
    }

    static function frontend_enqueue_scripts()
    {
        wp_enqueue_style('wpg-common-frontend');
        wp_enqueue_script('wpg-common-frontend');
    }


	static function add_root_menu()
	{
		add_menu_page(
			__( 'WPGet Settings', 'wpget-common' ),
			'WPGet Menu',
			'manage_options',
			'wpget-common',
			[__CLASS__, 'echo_menu_instructions'],
			"data:image/svg+xml,%3C%3Fxml version='1.0' encoding='utf-8'%3F%3E%3C!-- Generator: Adobe Illustrator 26.0.1, SVG Export Plug-In . SVG Version: 6.00 Build 0) --%3E%3Csvg version='1.1' id='Layer_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' viewBox='0 0 22 22' style='enable-background:new 0 0 22 22;' xml:space='preserve'%3E%3Cstyle type='text/css'%3E .st0%7Bfill:%2392BF21;%7D%0A%3C/style%3E%3Cg%3E%3Cg%3E%3Cpath class='st0' d='M11,0.7c1.4,0,2.8,0.3,4,0.8c0.6,0.3,1.2,0.6,1.8,1c0.5,0.4,1.1,0.8,1.5,1.3c0.5,0.5,0.9,1,1.3,1.5 c0.4,0.6,0.7,1.1,1,1.8c0.5,1.3,0.8,2.6,0.8,4s-0.3,2.8-0.8,4c-0.3,0.6-0.6,1.2-1,1.8c-0.4,0.5-0.8,1.1-1.3,1.5 c-0.5,0.5-1,0.9-1.5,1.3c-0.6,0.4-1.1,0.7-1.8,1c-1.3,0.5-2.6,0.8-4,0.8c-1.4,0-2.8-0.3-4-0.8c-0.6-0.3-1.2-0.6-1.8-1 c-0.5-0.4-1.1-0.8-1.5-1.3c-0.5-0.5-0.9-1-1.3-1.5c-0.4-0.6-0.7-1.1-1-1.8c-0.5-1.3-0.8-2.6-0.8-4s0.3-2.8,0.8-4 c0.3-0.6,0.6-1.2,1-1.8c0.4-0.5,0.8-1.1,1.3-1.5c0.5-0.5,1-0.9,1.5-1.3c0.6-0.4,1.1-0.7,1.8-1C8.2,0.9,9.6,0.7,11,0.7 M11,0 C4.9,0,0,4.9,0,11c0,6.1,4.9,11,11,11c6.1,0,11-4.9,11-11C22,4.9,17.1,0,11,0L11,0z'/%3E%3Cg%3E%3Cpath class='st0' d='M10.9,1.9c-5.1,0-9.2,4.1-9.2,9.2c0,5.1,4.1,9.2,9.2,9.2c5.1,0,9.2-4.1,9.2-9.2C20.1,5.9,16,1.9,10.9,1.9z M15,17.1c-0.4,0.5-0.9,0.8-1.5,1.1c-0.9,0.3-2,0.5-3.2,0.5c-0.9,0-1.7-0.1-2.4-0.3c-0.7-0.2-1.3-0.4-1.6-0.7 c-0.3-0.3-0.5-0.6-0.5-1c0-0.3,0.1-0.6,0.4-0.9c0.2-0.3,0.7-0.5,1.4-0.6c-0.9-0.4-1.4-1.1-1.4-1.9c0-0.5,0.2-1,0.6-1.4 c0.4-0.5,1-0.9,1.8-1.2C7.6,10.5,6.9,10,6.5,9.4c-0.4-0.6-0.6-1.2-0.6-2c0-1,0.4-1.8,1.2-2.5c0.8-0.7,1.8-1.1,3.1-1.1 c0.7,0,1.3,0.1,2,0.4h3.3v1.2h-1.9c0.3,0.3,0.6,0.7,0.7,0.9c0.2,0.4,0.3,0.8,0.3,1.2c0,0.7-0.2,1.3-0.6,1.8 c-0.4,0.5-0.9,0.9-1.6,1.2c-0.7,0.3-1.3,0.4-1.8,0.4c0,0-0.5,0-1.3-0.1c-0.3,0-0.6,0.1-0.8,0.3c-0.2,0.2-0.3,0.5-0.3,0.7 c0,0.3,0.1,0.5,0.3,0.6C8.7,12.9,9,13,9.4,13l1.8,0c1.5,0,2.5,0.2,3.1,0.5c0.8,0.5,1.2,1.1,1.2,2.1C15.5,16.1,15.4,16.7,15,17.1z '/%3E%3Cpath class='st0' d='M12.8,15.7c-0.4-0.1-1.4-0.1-3.1-0.1c-0.7,0-1.2,0.1-1.4,0.2c-0.4,0.2-0.6,0.5-0.6,0.9c0,0.4,0.2,0.7,0.6,1 c0.4,0.3,1.2,0.4,2.4,0.4c1,0,1.8-0.1,2.3-0.4c0.6-0.3,0.8-0.6,0.8-1.1c0-0.2-0.1-0.3-0.2-0.4C13.5,15.9,13.2,15.7,12.8,15.7z'/%3E%3Cpath class='st0' d='M10.3,10.5c0.4,0,0.8-0.2,1.1-0.6c0.3-0.4,0.4-1.1,0.4-2.3c0-1.3-0.2-2.1-0.5-2.6c-0.2-0.3-0.5-0.5-1-0.5 c-0.4,0-0.8,0.2-1,0.6C9,5.6,8.9,6.5,8.9,7.8c0,1,0.1,1.8,0.4,2.2S9.9,10.5,10.3,10.5z'/%3E%3C/g%3E%3C/g%3E%3C/g%3E%3C/svg%3E%0A"
		);
	}

	static function echo_menu_instructions()
	{
        $modules = '<ul class="wpg-ul-list">';
        foreach(self::$_loaded_modules as $conf){
            $href = admin_url('admin.php?page=' . $conf['menu_slug']);
            $modules.= "<li><a href='$href'>{$conf['module_title']}</a> </li>";
        }
        $modules.= '<ul>';
		?>
<div class="wrap">
	<h2>WPGet Management Settings</h2>
	<h3>Please select sub menu items.</h3>
    <?= $modules ?>
</div>
<?php
	}




}
