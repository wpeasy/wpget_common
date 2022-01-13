<?php
add_action('wp_footer', function () {
    if (!defined('ELEMENTOR_VERSION')) {
        return;
    }
    ?>
    <script>
        const $ = jQuery;

        console.log(elementorFrontend); //Logs an object
        console.log(elementorFrontend.hooks) //logs undefined

        setTimeout(() => {
            console.log(elementorFrontend); //Logs an object
            console.log(elementorFrontend.hooks) //logs an object
        }, 100);
    </script>
    <?php
});



add_shortcode('cb_get_hours_for_current_day', function ($args){

    $args = shortcode_atts( array(
        'time_format' => 'H:ia',
        'show_name' => 'false',
        'separator' => '-'
    ), $args );



    $page = jet_engine()->options_pages->registered_pages[$args['page_slug']];
    $value = $page->get($args['option_name']);

    $selectedItem = null;
    foreach( $value as $item){
        if($item['day'] != date('w')){
            continue;
        }else{
            $selectedItem = $item;
            break;
        }
    }

    $str = $args['show_name'] == 'true' ? $selectedItem['name'] : '';
    $open = date($args['time_format'], strtotime($selectedItem['open']));
    $str.= $open;

    return $str;


});
