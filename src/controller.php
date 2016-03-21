<?php

$app->get("/", function() use ($app) {
    return "homepage";

})
->bind("home");

$app->get("/login", function() use($app) {
    return $app['twig'] ->render("login.html.twig", [
        'login_paths' => $app['oauth.login_paths'],
    ]);
})
->bind("member");

$app->before(function (Symfony\Component\HttpFoundation\Request $request) use ($app) {
    if (isset($app['security.token_storage'])) {
        $token = $app['security.token_storage']->getToken();
    } else {
        $token = $app['security']->getToken();
    }

    $app['user'] = null;

    if ($token && !$app['security.trust_resolver']->isAnonymous($token)) {
        $app['user'] = $token->getUser();
    }
});

$app->match('/logout', function () {})->bind('logout');

