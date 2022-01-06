<?php

return [
    'options_name' => 'wpget_wp_rocket_options',
    'menu_slug' => 'wpget_wp_rocket',
    'menu_title' => 'WP Rocket',
    'module_title' => 'Common fixes for WP Rocket',
    'description' => 'Common fixes for WP Rocket as of version 3.10.3',

    'default_settings' => [
        'enable_sitemap_preload_on_clear' => 0,
        'enable_hourly_sitemap_preload' => 0
    ],

    'settings' => [
        'enable_sitemap_preload_on_clear' => [
            'title' => 'Enable Sitemap Preload on Clear',
            'type' => 'checkbox',
            'class' => 'wpg-checkbox',
            'description' => 'If checked, schedules a CRON to preload whenever Cache is cleared'
        ],
        'enable_hourly_sitemap_preload' => [
            'title' => 'Enable Sitemap Preload Hourly CRON',
            'type' => 'checkbox',
            'class' => 'wpg-checkbox',
            'description' => 'If checked, schedules a CRON to preload every hour. This is helpful because WP Rocket misses a lot of files when expired cache is cleared.'
        ]
    ]
];
