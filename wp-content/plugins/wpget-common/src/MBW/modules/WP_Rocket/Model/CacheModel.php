<?php

namespace MBW\modules\WP_Rocket\Model;

class CacheModel
{
    static $processed = null;
    static $processed_html = '';
    static $processed_total  = 0;
    static $processed_cached_total = 0;
    static $processes_not_cached_total = 0;
    static $processed_type = '';

    /**
     * @param $type
     * @param bool $html
     * @return string|null
     */
    public static function process($type, $html = true)
    {
        self::process_post_type($type);
        if($html){
            self::process_cache_html();
            return self::$processed_html;
        }
        return self::$processed;
    }

    static function get_post_types_to_process()
    {
        $post_types = get_post_types();
        $exclude = [
            "attachment"
            ,"nav_menu_item",
            "customize_changeset",
            "revision",
            'custom_css',
            'oembed_cache',
            'user_request',
            'wp_block',
            'wp_template',
            'e-landing-page',
            'elementor_library',
            'elementor_snippet',
            'frm_styles',
            'frm_display',
            'frm_form_actions',
            'postman_sent_mail',
            'ha_nav_content',
            'elementor_font',
            'elementor_icons'
        ];
        return array_diff($post_types, $exclude );
    }



    static function process_cache_html(){
        $records = self::$processed;

        $cached_rows_html = '';
        foreach ($records['cachedRecords'] as $cachedRecord) {
            $cached = $cachedRecord['cached'] ? 'YES' : 'NO';
            $cached_class = $cachedRecord['cached'] ? 'row-cached' : 'row-not-cached';
            $cached_rows_html .= "<tr class='$cached_class'>";
            $cached_rows_html .= "<td>{$cachedRecord['title']}</td>";
            $cached_rows_html .= "<td>{$cached}</td>";
            $cached_rows_html .= "<td>{$cachedRecord['age']}</td>";
            $cached_rows_html .= "<td>{$cachedRecord['permalink']}</td>";
            $cached_rows_html .= '</tr>';
        }

        $non_cached_rows_html = '';
        foreach ($records['nonCachedRecords'] as $cachedRecord) {
            $cached = $cachedRecord['cached'] ? 'YES' : 'NO';
            $cached_class = $cachedRecord['cached'] ? 'row-cached' : 'row-not-cached';
            $non_cached_rows_html .= "<tr class='$cached_class'>";
            $non_cached_rows_html .= "<td>{$cachedRecord['title']}</td>";
            $non_cached_rows_html .= "<td>{$cached}</td>";
            $non_cached_rows_html .= "<td>{$cachedRecord['age']}</td>";
            $non_cached_rows_html .= "<td>{$cachedRecord['permalink']}</td>";
            $non_cached_rows_html .= '</tr>';
        }

        $html = <<<HTML
<h2>Not Cached URLs: {$records['nonCached']}</h2>
<table class="wp-list-table widefat fixed striped table-view-list">
<thead>
<tr><th>Name</th><th>Cached</th><th>Age</th><th>Permalink</th></tr>
</thead>
<tbody>
{$non_cached_rows_html}
</tbody>
</table>

<h2>Cached URLs: {$records['cached']}</h2>
<table class="wp-list-table widefat fixed striped table-view-list">
<thead>
<tr><th>Name</th><th>Cached</th><th>Age</th><th>Permalink</th></tr>
</thead>
<tbody>
{$cached_rows_html}
</tbody>
</table>

HTML;
        self::$processed_html = $html;
        return $html;

    }


    static function process_post_type($type){

        $query = new \WP_Query(
            [
                'post_type' => $type,
                'posts_per_page' => -1,
                'post_status' => 'publish'
            ]
        );
        $results = $query->get_posts();
        $cachedCount = 0;
        $cachedRecords = [];
        $nonCachedCount = 0;
        $nonCachedRecords = [];
        foreach($results as $post){
            $path = trailingslashit(ABSPATH . '/wp-content/cache/wp-rocket/' .str_replace(['http://', 'https://'], '', get_permalink($post)));
            $cached = file_exists($path . 'index-https.html');
            $created = $cached? filemtime($path . 'index-https.html') : 'N/A';
            $age = $cached? number_format((time() - $created) / 3600, 2) . ' hours' : 'N/A';
            if($cached){
                $cachedCount ++;
                $cachedRecords[] = [
                    'title' => $post->post_title,
                    'permalink' => get_permalink($post),
                    'path' => $path . 'index-https.html',
                    'cached' => $cached,
                    'created' => $created,
                    'age' => $age
                ];
            }else{
                $nonCachedCount ++;

                $nonCachedRecords[] = [
                    'title' => $post->post_title,
                    'permalink' => get_permalink($post),
                    'path' => $path . 'index-https.html',
                    'cached' => $cached,
                    'created' => $created,
                    'age' => $age
                ];
            }
        }
        $ret = [
            'totalCount' => count($results),
            'cached' => $cachedCount,
            'nonCached' => $nonCachedCount,
            'cachedRecords' => $cachedRecords,
            'nonCachedRecords' => $nonCachedRecords,
        ];

        self::$processed_type = $type;
        self::$processed_total = $cachedCount + $nonCachedCount;
        self::$processed_cached_total = $cachedCount;
        self::$processes_not_cached_total = $nonCachedCount;
        self::$processed = $ret;

        return $ret;
    }
}
