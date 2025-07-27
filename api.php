<?php


function verify_token($request)
{
    $user_token = $request->get_header('manatoken');
    $saved_token = get_option('manawp_token');
    return $user_token && $saved_token && hash_equals($saved_token, $user_token);
}


add_action('rest_api_init', function () {


    // validate connection
    register_rest_route('manawp/v1', '/validate', [
        'methods' => 'POST',
        'callback' => 'manawp_validate',
        'permission_callback' => 'verify_token',
    ]);


    //  get wordpress version
    register_rest_route('manawp/v1', '/version', [
        'methods' => 'GET',
        'callback' => 'wordpress_version',
        'permission_callback' => 'verify_token',
    ]);


    // get a list of posts
    register_rest_route('manawp/v1', '/posts', [
        'methods' => 'GET',
        'callback' => 'manawp_getposts',
        'permission_callback' => 'verify_token',
    ]);

    // delete a post
    register_rest_route('manawp/v1', '/post/(?P<id>\d+)', [
        'methods' => 'DELETE',
        'callback' => 'manawp_delete_post',
        'permission_callback' => 'verify_token',
    ]);


    // toggle maintenance mode ON/OFF
    register_rest_route('manawp/v1', '/maintenance', [
        'methods' => 'POST',
        'callback' => 'manawp_maintenance_mode',
        'permission_callback' => 'verify_token',
    ]);


    // get all users
    register_rest_route('manawp/v1', '/users', [
        'methods' => 'GET',
        'callback' => 'manawp_get_users',
        'permission_callback' => 'verify_token',
    ]);

    // get all plugins
    register_rest_route('manawp/v1', '/plugins', [
        'methods' => 'GET',
        'callback' => 'manawp_get_plugins',
        'permission_callback' => 'verify_token',
    ]);



    // get all themes
    register_rest_route('manawp/v1', '/themes', [
        'methods' => 'GET',
        'callback' => 'manawp_get_themes',
        'permission_callback' => 'verify_token',
    ]);
});
