<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$variables = json_decode(base64_decode($_ENV['PLATFORM_VARIABLES']), true);

if (empty($variables)) {
    throw new \Exception("PLATFORM_VARIABLES Not Set Or Empty.");
}

$config = array(
    'slim' => array(
        'mode' => 'live',
        'debug' => 0,
        'cookies' => array(
            'secret_key' => $variables['web.config.slim.cookies.secret_key'],
        ),
        'custom' => array(
            'redisKeyPrefix' => 'live-',
            'apiUrl' => $variables['web.config.slim.custom.apiUrl'],
            'googleAnalyticsId' => $variables['web.config.slim.custom.googleAnalyticsId'],
            'csrfSecret' => $variables['web.config.slim.custom.csrfSecret']
            //'useMinifiedFiles' => true
        ),
        'oauth' => array(
            'client_id' => $variables['web.config.slim.oauth.client_id'],
            'client_secret' => $variables['web.config.slim.oauth.client_secret'],
        ),
        'twig' => array(
            'cache' => $variables['web.config.slim.twig.cache']
        ),
        'facebook' => array(
            'app_id' => $variables['web.config.slim.facebook.app_id'],
        ),
    ),
);
