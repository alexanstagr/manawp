<?php

add_action('admin_enqueue_scripts', 'manawp_enqueue_admin_style');

function manawp_enqueue_admin_style($hook) {
    if ($hook != 'settings_page_manawp') {
        return;
    }

    wp_enqueue_style(
        'manawp-admin-style',
        plugin_dir_url(__FILE__) . 'assets/css/plugin.css',
        array(),
        '1.0'
    );
}