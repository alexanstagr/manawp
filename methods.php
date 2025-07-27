<?php


function manawp_validate()
{

    $headers = getallheaders();

    return rest_ensure_response([
        'success' => true,
        'message' => 'You can now save your connection',
        'connection' => [
            'website' => get_site_url() . 'wp-json/manawp/v1',
            'token' => isset($headers['manatoken']) ? md5($headers['manatoken']) : null
        ]
    ]);
}
