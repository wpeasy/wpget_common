<?php


namespace MBW\modules\WP_Rocket\Controller;

use MBW\modules\WP_Rocket\Model\CacheModel;

class SettingsController
{
    private static $_init;

    static function init($settings)
    {
        if (self::$_init) {
            return;
        }
        self::$_init = true;
        add_action('admin_menu', [__CLASS__, 'add_settings_page']);
        add_action('admin_init', [__CLASS__, 'register_settings']);
        add_action('admin_init', [__CLASS__, 'admin_init']);
    }

    static function admin_init()
    {
        wp_localize_script( 'wp-api', 'wpApiSettings', array(
            'root' => esc_url_raw( rest_url() ),
            'nonce' => wp_create_nonce( 'wp_rest' )
        ) );
    }

    static function get_settings()
    {
        return get_option(ModuleController::$config['options_name']);
    }

    static function add_settings_page()
    {
        add_submenu_page(
            'wpget-common',
            ModuleController::$config['module_title'],
            ModuleController::$config['menu_title'],
            'manage_options',
            ModuleController::$config['menu_slug'],
            [__CLASS__, 'do_settings_menu']
        );
    }

    static function do_settings_menu()
    {
        ?>
        <div class="wrap">
            <div id="icon-themes" class="icon32"></div>
            <h2><?= ModuleController::$config['description'] ?></h2>
            <?php
            settings_errors();
            ?>
            <form method="POST" action="options.php">
                <?php
                settings_fields(ModuleController::$config['options_name']);
                do_settings_sections(ModuleController::$config['options_name']);
                submit_button();
                ?>
            </form>
        <hr/>
       <?php

        $types = CacheModel::get_post_types_to_process();
        $rows = '';
        foreach ($types as $type){
            $rows .= '<tr>';
            $rows .= "<td>$type</td>";
            $rows .= "<td id='{$type}_cached'>-</td><td id='{$type}_not_cached'>-</td><td id='{$type}_total'>-</td>";
            $rows .= "<td><button class='process-button button button-primary' data-type='$type'>Process </button><img class='hidden wpg-spinner' src='/wp-admin/images/loading.gif' /></td>";
            $rows .= '</tr>';
        }

        $out = <<<HTML
<div class="wpg-wprocket-cache-table>">
<h2>Check Current Cache:</h2>
<table class="wp-list-table widefat fixed striped table-view-list">
<thead>
<tr><th>Post Type</th><th>Cached</th><th>Not Cached</th><th>Total</th></th><th>Action</th></tr>
</thead>
<tbody>{$rows}</tbody>
</table>
<hr/>
<div id="wpb-response-placeholder"></div>
</div>
HTML;
        echo $out;
        echo '</div>';
    }

    static function register_settings()
    {

        //Set defaults if not set yet
        if (get_option(ModuleController::$config['options_name']) === false) { // Nothing yet saved
            update_option(ModuleController::$config['options_name'],
                ModuleController::$config['default_settings']
            );
        }

        register_setting(ModuleController::$config['options_name'], ModuleController::$config['options_name']);

        add_settings_section('sitemap_preload_fixes', 'Sitemap Preload Fixes', function () {
        }, ModuleController::$config['options_name']);

        foreach (ModuleController::$config['settings'] as $setting_name => $setting_conf) {
            add_settings_field(
                $setting_name,
                $setting_conf['title'],
                ['MBW\lib\AdminSettingsHelper', 'print_' . $setting_conf['type']],
                ModuleController::$config['options_name'],
                'sitemap_preload_fixes',
                [$setting_name, $setting_conf, self::get_settings(), ModuleController::$config['options_name']]
            );
        }


    }

}


