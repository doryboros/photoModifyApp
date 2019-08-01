<?php

namespace MyApp\Controller;

use MyApp\Http\Request;
use MyApp\Http\Session;
use MyApp\ImageSaver\ImageDownload;
use MyApp\ImageSaver\ImageSaver;
use MyApp\Model\DomainObject\OrderItem;
use MyApp\Model\DomainObject\Product;
use MyApp\Model\DomainObject\Tier;
use MyApp\Model\Persistence\Finder\ProductFinder;
use MyApp\Model\Persistence\Finder\TierFinder;
use MyApp\Model\Persistence\Mapper\OrderMapper;
use MyApp\View\Renders\showProductRenderer;
use MyApp\View\Renders\ShowProductsRenderer;
use MyApp\Model\Persistence\PersistenceFactory;
use MyApp\View\Renders\showUploadsRenderer;



class ProductController
{
    /**
     * Show products on home page
     */
    public static function showProducts()
    {
        $productFinder = PersistenceFactory::createFinder('product');
        $products = $productFinder->findAllProducts();

        (new ShowProductsRenderer())->render($products);
    }

    /**
     * Show upload form
     */
    public static function showUploads()
    {
        (new showUploadsRenderer())->render();
    }

    /**
     * Upload a photo and create the tiers
     * @param Request $request
     */
    public static function uploadProduct(Request $request)
    {

       $imageSaver= new ImageSaver($request);

        $session= new Session();

        $artistNameHash=md5($request->getPostData('artistName'));


        $path= "uploads/" . $artistNameHash;

        if(!file_exists($path)){
            mkdir($path);
        }

        move_uploaded_file($_FILES['image']['tmp_name'], $path . "/" . $_FILES['image']['name']);

        $product = new Product(
            $request->getPostData('imageTitle'),
            $request->getPostData('imageDescription'),
            $request->getPostData('cameraSpecs'),
            $request->getPostData('captureDate'),
            $path . "/" .  $_FILES['image']['name'],
            $request->getPostData('tags'),
            $session->getSessionVariable('userId')
        );

        $productMapper = PersistenceFactory::createMapper('product');
        $productId = $productMapper->save($product);

        $uniquePathFragment = uniqid();

        $imageSaver->saveTierWithoutWateramrk(
            $artistNameHash ."/". $_FILES['image']['name'],
            $artistNameHash . "/small". $uniquePathFragment. $_FILES['image']['name'],
            'S');
        $imageSaver->saveTierWithoutWateramrk(
            $artistNameHash ."/". $_FILES['image']['name'],
            $artistNameHash . "/medium". $uniquePathFragment. $_FILES['image']['name'],
            'M');
        $imageSaver->saveTierWithoutWateramrk(
            $artistNameHash ."/". $_FILES['image']['name'],
            $artistNameHash . "/large".$uniquePathFragment. $_FILES['image']['name'],
            'L');

        $imageSaver->saveTierWithWateramrk(
            $artistNameHash ."/". $_FILES['image']['name'],
            $artistNameHash . "/small-watermark". $uniquePathFragment. $_FILES['image']['name'],
                                    'S');
        $imageSaver->saveTierWithWateramrk(
            $artistNameHash ."/". $_FILES['image']['name'],
            $artistNameHash . "/medium-watermark". $uniquePathFragment. $_FILES['image']['name'],
            'M');
        $imageSaver->saveTierWithWateramrk(
            $artistNameHash ."/". $_FILES['image']['name'],
            $artistNameHash . "/large-watermark". $uniquePathFragment. $_FILES['image']['name'],
             'L');

        $smallTier= new Tier(
                       "S",
                        $request->getPostData('price')-5,
                        $path . "/small-watermark".$uniquePathFragment. $_FILES['image']['name'],
                        $path . "/small". $uniquePathFragment. $_FILES['image']['name'],
                        $productId
        );

        $mediumTier = new Tier(
                        "M",
                        $request->getPostData('price')-3,
                        $path . "/medium-watermark". $uniquePathFragment. $_FILES['image']['name'],
                        $path . "/medium". $uniquePathFragment. $_FILES['image']['name'],
                        $productId
        );

        $largeTier = new Tier(
                            "L",
                            $request->getPostData('price'),
                            $path . "/large-watermark". $uniquePathFragment. $_FILES['image']['name'],
                            $path . "/large".$uniquePathFragment. $_FILES['image']['name'],
                            $productId
        );



        $tierMapper = PersistenceFactory::createMapper('tier');
        $tierMapper->save($smallTier);
        $tierMapper->save($mediumTier);
        $tierMapper->save($largeTier);

        header('Location:/');

    }


    /**
     * @param $id
     * @return string
     */
    private static function getFileForDownload($id)
    {
        $tierFinder = PersistenceFactory::createFinder('tier');
        /**
         * @var TierFinder $tierFinder
         */
        $tier = $tierFinder->getById($id);
        return $tier->getPathWithoutWatermark();
    }

    /**
     * @param Request $request
     * @throws \Exception
     */
    public static function buyProduct(Request $request)
    {

        $id = $request->getPathParam('id');
        $filePath = self::getFileForDownload($id);

        /**
         * @var OrderMapper $orderMapper
         */
        $oderMapper = PersistenceFactory::createMapper('order');
        $oderMapper->save(new OrderItem($_SESSION['userId'],$id));

        $imageDownload = new ImageDownload($filePath);
        $imageDownload->downloadPhoto($filePath);
    }


    /**
     * @param Request $request
     * @throws \Exception
     */
    public static function showProduct(Request $request)
    {
        $id = $request->getPathParam('id');

        /** @var ProductFinder $productFinder */
        $productFinder = PersistenceFactory::createFinder('product');
        $product = $productFinder->findById($id);

        $tierFinder = PersistenceFactory::createFinder('tier');
        $tiers = $tierFinder->findAllTiersByProductId($product->getId());


        (new showProductRenderer())->render(
            ['product' => $product, 'tiers' => $tiers]
        );
    }



}
