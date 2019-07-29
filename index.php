<?php

require 'vendor/autoload.php';

$router = new \MyApp\Controller\Router();
$router-> match($_SERVER['REQUEST_URI']);