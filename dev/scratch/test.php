<?php
add_filter( 'elementor/controls/animations/additional_animations', function ($current){

    $new = [
        'WPG Custom' => [
            'wpg-custom1' => 'wpg-custom1',
            'wpg-custom2' => 'wpg-custom2',
            'wpg-custom3' => 'wpg-custom3',
            'wpg-custom4' => 'wpg-custom4',
            'wpg-custom5' => 'wpg-custom5'
        ]
    ];

    return array_merge($current, $new);

} );