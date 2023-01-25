<?php

require_once __DIR__ . "/src/Dispatch.php";
require_once __DIR__ . "/src/Webrouter.php";

use Cafewebcode\Webrouter\Dispatch;
use Cafewebcode\Webrouter\Webrouter;

$router = new Webrouter("https://www.localhost/cafewebcode/webrouter/");

var_dump($router);