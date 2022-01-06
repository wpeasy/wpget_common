<?php

return [
    'options_name' => 'wpget_elementor_options',
    'menu_slug' => 'wpget_elementor',
    'menu_title' => 'Elementor',
    'module_title' => 'Elementor Common Settings',
    'description' => 'Standard CSS, JS and features got WPGet Elementor sites',

    'default_settings' => [
        'load_common_css' => 1
    ],

    'settings' => [
        'load_common_css' => [
            'title' => 'Load Common CSS',
            'type' => 'checkbox',
            'class' => 'wpg-checkbox',
            'description' => 'If checked, loads the WPGet common css library for Elementor'
        ],
        'load_woocommerce_css' => [
            'title' => 'Load Woocommerce CSS',
            'type' => 'checkbox',
            'class' => 'wpg-checkbox',
            'description' => 'If checked, loads the WPGet common css library for Woocommerce'
        ]
    ]
];
