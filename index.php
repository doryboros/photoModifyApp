<?php

require 'vendor/autoload.php';
$config = require 'config.php';

use MyApp\Model\DomainObject\User;
use MyApp\Model\Persistence\Finder;

$router = new \MyApp\Controller\Router();
$router->match($_SERVER['REQUEST_URI']);

//$user = new \MyApp\Model\DomainObject\User(null,'3223');
// $f = \MyApp\Model\Persistence\PersistenceFactory::createFinder('user');
// var_dump($f->findById(1));
// $s=\MyApp\Model\Persistence\PersistenceFactory::createMapper('user');
// $s->update(new User(2,'merge','bala','s'));
$test=\MyApp\Model\Persistence\PersistenceFactory::createMapper('product');
/**
 * @var     \MyApp\Model\Persistence\Mapper\ProductMapper $test
 */
//if (rand(0, 100000)%3 == 2) {
//    $test->save(\MyApp\Model\DomainObject\Product::createFromRow([
//        'id' => null,
//        'title' => 'de ce',
//        'description' => 'dd',
//        'cameraSpecs' => 'dgfdg',
//        'captureDate' => '2017-08-17',
//        'thumbnailPath' => 'img/logo.jpg',
//        'tags' => ['animal'],
//        'userId' => 1]));
//}




