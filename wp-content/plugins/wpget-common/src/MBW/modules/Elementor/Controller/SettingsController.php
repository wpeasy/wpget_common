<?php


namespace MBW\modules\Elementor\Controller;

class SettingsController
{
    private static $_init;
    private static $_options_name;
    private static $_slug;
    private static $_page_title;
    private static $_menu_title;

    static function init($settings)
    {
        if (self::$_init) {
            return;
        }
        self::$_init = true;

        self::$_options_name = $settings['options_name'];
        self::$_slug = $settings['menu_slug'];
        self::$_page_title = $settings['module_title'];
        self::$_menu_title = $settings['menu_title'];

        add_action('admin_menu', [__CLASS__, 'add_settings_page']);
        add_action('admin_init', [__CLASS__, 'register_settings']);
    }

    static function get_settings()
    {
        return get_option(self::$_options_name);
    }

    static function add_settings_page()
    {
        $s = add_submenu_page(
            'wpget-common',
            self::$_page_title,
            self::$_menu_title,
            'manage_options',
            self::$_slug,
            [__CLASS__, 'do_settings_menu']
        );
    }

    static function do_settings_menu()
    {
        $settings = self::get_settings();
        $tabNav = '<ul class="wpg-tabs">';
        $tabContainers = '';
        $tabCount = 0;

        //Common CSS
        if ($settings['load_common_css'] == 1) {
            $id= 'tab' . $tabCount;
            $tabCount++;
            $tabNav.= "<li><a id='$id'>Common CSS</a></li>";
            $id.= 'C';
            $content = file_get_contents(MBW_PLUGIN_URL . 'assets/css/elementor-styles.css');
            $tabContainers .= <<<CONT
<div class="wpg-tab-container" id="{$id}">
<h2>Common CSS Loaded, Please read comments for usage</h2>
<h3>Note: This is loaded after Custom CSS. To override make your class more specific.</h3>
<h3>You can do this by prefixing the override with something like body.elementor-default (for default template)</h3>
<pre id="wpg_css"><code>
{$content}
</code></pre>
<script>hljs.highlightElement(document.getElementById("wpg_css"));</script>
</div>
CONT;
        }


        //Woo CSS
        if ($settings['load_woocommerce_css'] == 1) {
            $id= 'tab' . $tabCount;
            $tabCount++;
            $tabNav.= "<li><a id='$id'>Woocommerce CSS</a></li>";
            $id.= 'C';
            $content = file_get_contents(MBW_PLUGIN_URL . 'assets/css/woocommerce-styles.css');
            $tabContainers .= <<<CONT
<div class="wpg-tab-container" id="{$id}">
<h2>Woocommerce CSS Loaded, Please read comments for usage</h2>
<pre id="wpg_woo_css"><code>
{$content}
</code></pre>
<script>hljs.highlightElement(document.getElementById("wpg_woo_css"));</script>
</div>
CONT;
        }

        $tabNav.= '</ul>';


        ?>
        <div class="wrap">
            <div id="icon-themes" class="icon32"></div>
            <h2>WPGet Elementor Settings</h2>
            <?php
            settings_errors();
            ?>
            <form method="POST" action="options.php">
                <?php
                settings_fields(self::$_options_name);
                do_settings_sections(self::$_options_name);
                submit_button();
                ?>
            </form>

        <hr/>

        <?= $tabNav ?>
        <?= $tabContainers?>

        <script>
            (function ($) {
                $('.wpg-tabs li a:not(:first)').addClass('inactive');
                $('.wpg-tab-container').hide();
                $('.wpg-tab-container:first').show();

                $('.wpg-tabs li a').click(function () {
                    let t = $(this).attr('id');
                    if ($(this).hasClass('inactive')) { //this is the start of our condition
                        $('.wpg-tabs li a').addClass('inactive');
                        $(this).removeClass('inactive');

                        $('.wpg-tab-container').hide();
                        $('#' + t + 'C').fadeIn('slow');
                    }
                });
            })(jQuery)
        </script>
        </div>
        <?php

    }

    static function register_settings()
    {

        $conf = ModuleController::$config;

        //Set defaults if not set yet
        if (get_option(self::$_options_name) === false) { // Nothing yet saved
            update_option(self::$_options_name,
                $conf['default_settings']
            );
        }

        register_setting(self::$_options_name, self::$_options_name);

        add_settings_section('style_settings', 'Styles', function () {
        }, self::$_options_name);

        foreach ($conf['settings'] as $setting_name => $setting_conf) {
            add_settings_field(
                $setting_name,
                $setting_conf['title'],
                ['MBW\lib\AdminSettingsHelper', 'print_' . $setting_conf['type']],
                self::$_options_name,
                'style_settings',
                [$setting_name, $setting_conf, self::get_settings(), self::$_options_name]
            );
        }


    }

}


