<?php
/*
Plugin Name: ManaWP
Plugin URI: https://github.com/alexanstagr/manawp
Description: Manage multiple WordPress websites.
Version: 1.0.0
Author: Alexandros Anastasiadis
Author URI: https://alexansta.gr
License: GPL2
*/

require_once plugin_dir_path(__FILE__) . 'api.php';
require_once plugin_dir_path(__FILE__) . 'styler.php';


if (!defined('ABSPATH')) exit;


add_action('admin_menu', function () {
    add_options_page('Token API Settings', 'ManaWP', 'manage_options', 'manawp', 'admin_settings_page');
});


add_action('admin_init', function () {
    register_setting('manawp_settings_group', 'manawp_token');
});





function admin_settings_page()
{
    include plugin_dir_path(__FILE__) . 'views/settings.php';
}


function QRValidator()
{

    $validator = get_site_url() . "/wp-json/manawp/v1/validate";
    $manatoken = get_option('manawp_token');

    $data = "hostname=$validator&token=$manatoken";

    $url = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($data) . "&size=90x90";


    return '<img src="' . $url . '" alt="QR Code">';
}


add_action('template_redirect', function () {

    $maintenance_enabled = get_option('manawp_maintenance_mode', false);

    if ($maintenance_enabled && !current_user_can('manage_options')) {
        $template = plugin_dir_path(__FILE__) . 'templates/maintenance.php';
        if (file_exists($template)) {
            status_header(503);
            include $template;
            exit;
        }
    }
});


function wp_maintenance_mode()
{

    if (!current_user_can('edit_themes') || !is_user_logged_in()) {

        wp_die('<h1 style="color:red">Website under Maintenance</h1><br />We are performing scheduled maintenance. We will be back on-line shortly!');
    }
}
add_action('get_header', 'wp_maintenance_mode');
