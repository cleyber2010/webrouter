<?php

require_once __DIR__ . "/src/Dispatch.php";
require_once __DIR__ . "/src/Webrouter.php";
require_once __DIR__ . "/exemple/controller/Test/User.php";

use Cafewebcode\Webrouter\Dispatch;
use Cafewebcode\Webrouter\Webrouter;

$router = new Webrouter("https://www.localhost/cafewebcode/webrouter/");
$router->namespace("Test");

$router->get("/test/{user_id}/{user}", "User@index");

$router->execute();

if ($router->error()) {
    var_dump($router->error());
}