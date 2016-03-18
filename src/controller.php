<?php

$app->get("/", function() use ($app) {
    return "homepage";

})
->bind("home");
