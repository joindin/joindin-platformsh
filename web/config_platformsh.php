<?php

$routes = json_decode(base64_decode($_ENV['PLATFORM_ROUTES']), true);
if (empty($routes)) {
    throw new \Exception("PLATFORM_ROUTES Not Set Or Empty.");
}

function getDomainFor(string $id)
{
    global $routes;
    foreach ($routes as $domain => $route) {
        if ($route['id'] == $id) {
            return $domain;
        }
    }
}

$relationships = json_decode(base64_decode($_ENV['PLATFORM_RELATIONSHIPS']), true);

if (empty($relationships)) {
    throw new \Exception("PLATFORM_RELATIONSHIPS Not Set or empty.");
}

$redis     = $relationships['redis'][0];
$redis['scheme'] = 'tcp';

$variables = json_decode(base64_decode($_ENV['PLATFORM_VARIABLES']), true);

if (empty($variables)) {
    throw new \Exception("PLATFORM_VARIABLES Not Set Or Empty.");
}

$config = [
    'slim' => [
        'mode'     => 'development',
        'debug'    => 1,
        'cookies'  => [
            'secret_key' => $variables['web.config.slim.cookies.secret_key'],
        ],
        'custom'   => [
            'redis'             => [
                'connection' => $redis,
                'options'    => [
                    'prefix' => 'live-',
                ],
            ],
            'apiUrl'            => rtrim(getDomainFor("api"), "/"),
            'googleAnalyticsId' => $variables['web.config.slim.custom.googleAnalyticsId'],
            'csrfSecret'        => $variables['web.config.slim.custom.csrfSecret']
            //'useMinifiedFiles' => true
        ],
        'oauth'    => [
            'client_id'     => $variables['web.config.slim.oauth.client_id'],
            'client_secret' => $variables['web.config.slim.oauth.client_secret'],
        ],
        'twig'     => [
            'cache' => $variables['web.config.slim.twig.cache'],
        ],
        'facebook' => [
            'app_id' => $variables['web.config.slim.facebook.app_id'],
        ],
    ],
];
