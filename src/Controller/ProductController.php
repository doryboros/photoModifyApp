<?php

namespace MyApp\Controller;

use MyApp\View\Renders\showProductRenderer;
use MyApp\View\Renders\ShowProductsRenderer;
use MyApp\Model\Persistence\PersistenceFactory;


class ProductController
{
    public static function showProducts()
    {

//        $test=\MyApp\Model\Persistence\PersistenceFactory::createMapper('product');
//        $test->save(\MyApp\Model\DomainObject\Product::createFromRow([
//            'id' => null,
//            'title' => 'de ce',
//            'description' => 'dd',
//            'cameraSpecs' => 'dgfdg',
//            'captureDate' => '2017-08-17',
//            'thumbnailPath' => 'img/logo.jpg',
//            'tags' => ['animal'],
//            'userId' => 1]));

        $productFinder = PersistenceFactory::createFinder('product');
        $products = $productFinder->findAllProducts();

        (new ShowProductsRenderer())->render($products);
    }

    public static function showProduct(int $id)
    {
        (new showProductRenderer())->render();
    }
}
