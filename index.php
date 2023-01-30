<?php

require_once __DIR__ . "/src/Dispatch.php";
require_once __DIR__ . "/src/Webrouter.php";

use Cafewebcode\Webrouter\Dispatch;
use Cafewebcode\Webrouter\Webrouter;

$router = new Webrouter("https://www.localhost/cafewebcode/webrouter/");
$router->group("/app");
$router->namespace("Webrouter");

$router->get("/test/{user_id}/{user}", "User@index");

var_dump($router);