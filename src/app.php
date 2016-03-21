<?php

use Silex\Application;

use Silex\Provider\TwigServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpCacheServiceProvider;
use Gigablah\Silex\OAuth\OAuthServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\FormServiceProvider;

$app = new Application();

$app->register(new TwigServiceProvider());
$app->register(new MonologServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new HttpCacheServiceProvider());
$app->register(new UrlGeneratorServiceProvider());
$app->register(new SessionServiceProvider());
$app->register(new OAuthServiceProvider(),[
    'oauth.services'=> [
        'Twitter' => [
            'key' => getenv('TWITTER_KEY'),
            'secret' => getenv('TWITTER_SECRET'),
            'scope' => [],
            // Note: permission needs to be obtained from Twitter to use the include_email parameter
            'user_endpoint' => 'https://api.twitter.com/1.1/account/verify_credentials.json?include_email=true',
            'user_callback' => function ($token, $userInfo, $service) {
                $token->setUser($userInfo['name']);
                $token->setEmail($userInfo['email']);
                $token->setUid($userInfo['id']);
            }
        ]
    ]
]);

$app->register(new FormServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'default' => array(
            'pattern' => '^/',
            'anonymous' => true,
            'oauth' => array(
                #'login_path' => '/auth/{service}',
                #'callback_path' => '/auth/{service}/callback',
                #'check_path' => '/auth/{service}/check',
                'failure_path' => '/login',
                'with_csrf' => true
            ),
            'logout' => array(
                'logout_path' => '/logout',
                'with_csrf' => true
            ),
            // OAuthInMemoryUserProvider returns a StubUser and is intended only for testing.
            // Replace this with your own UserProvider and User class.
                'users' => new Gigablah\Silex\OAuth\Security\User\Provider\OAuthInMemoryUserProvider()
        )
    ),
    'security.access_rules' => array(
        array('^/auth', 'ROLE_USER')
    )
));

return $app;

