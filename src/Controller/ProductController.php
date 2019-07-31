<?php

namespace MyApp\Controller;

use MyApp\Http\Request;
use MyApp\Http\Session;
use MyApp\Model\DomainObject\Product;
use MyApp\Model\Persistence\Finder\ProductFinder;
use MyApp\View\Renders\showProductRenderer;
use MyApp\View\Renders\ShowProductsRenderer;
use MyApp\Model\Persistence\PersistenceFactory;
use MyApp\View\Renders\showUploadsRenderer;


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

    public static function showUploads()
    {
        (new showUploadsRenderer())->render();
    }

    public static function uploadProduct(Request $request)
    {

        $session= new Session();

        $path= "uploads/" . $request->getPostData('artistName');
        var_dump($path);
        if(!file_exists($path)){
            mkdir($path);
        }

        move_uploaded_file($_FILES['image']['tmp_name'], $path . "/" . $_FILES['image']['name']);

            $product = new Product(
                $request->getPostData('imageTitle'),
                $request->getPostData('imageDescription'),
                $request->getPostData('cameraSpecs'),
                $request->getPostData('captureDate'),
                $path,
                $request->getPostData('tags'),
                $session->getSessionVariable('userId')
            );

            $productMapper = PersistenceFactory::createMapper('product');
            $productMapper->save($product);

    }

    public static function showProduct(Request $request)
    {
        $id = $request->getPathParam('id');

        /** @var ProductFinder $productFinder */
        $productFinder = PersistenceFactory::createFinder('product');
        $product = $productFinder->findById($id);

        (new showProductRenderer())->render(['product' => $product]);
    }


}
