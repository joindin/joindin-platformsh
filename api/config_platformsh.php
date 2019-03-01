<?php
ini_set('display_errors', 0);

$variables = json_decode(base64_decode($_ENV['PLATFORM_VARIABLES']), true);

if (empty($variables)) {
    throw new \Exception("PLATFORM_VARIABLES Not Set Or Empty.");
}


if ('development' == $variables['api.config.mode']) {
    error_reporting(-1);
    ini_set('display_errors', 1);
    ini_set('html_errors', 1);
    ini_set('display_startup_errors', 1);
}


$config = [
    'mode'        => $variables['api.config.mode'],

    // the URL of web2 website is used in links within emails
    'website_url' => $variables['api.config.website_url'],

    'oauth'            => [
        'expirable_client_ids' => [
            // some clients, (e.g. web2) do not hold onto their token after the
            // user logs out of the client, so we can expire their old tokens.
            $variables['api.config.oauth.expirable_client_ids'],
        ],
    ],
    'event_image_path' => __DIR__.'/../../joindin-web2/web/inc/img/event_icons/',
    'email'            => [
        'contact'        => $variables['api.config.email.contact'],
        'from'           => $variables['api.config.email.from'],
        'forward_all_to' => false,
    ],
    'twitter'          => [
        // set up the key at https://apps.twitter.com/
        // configure the callback url as /user/twitter-access on web2
        'consumer_key'    => $variables['api.config.twitter.consumer_key'],
        'consumer_secret' => $variables['api.config.twitter.consumer_secret'],
    ],
    'facebook'         => [
        // set up at https://developers.facebook.com/apps/
        // configure url in OAuth Settings as /user/facebook-access on web2
        'app_id'     => $variables['api.config.facebook.app_id'],
        'app_secret' => $variables['api.config.facebook.app_secret'],
    ],
    'features'         => [
        'allow_auto_verify_users'   => false,
        'allow_auto_approve_events' => false,
    ],
    'limits'           => [
        'max_pending_events'       => 3,
        'max_comment_edit_minutes' => 15,
    ],
];
