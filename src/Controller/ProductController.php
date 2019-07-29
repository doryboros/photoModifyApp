<?php

namespace MyApp\Controller;

use MyApp\Model\DomainObject\Product;
use MyApp\View\Renders\showProductRenderer;
use MyApp\View\Renders\ShowProductsRenderer;
use MyApp\View\Renders\showRegisterFormRenderer;

class ProductController
{
    public static function showProducts()
    {
        $products = [
            (new Product())->setTitle('asd')->setId(2),
            (new Product())->setTitle('asd')->setId(1),
            (new Product())->setTitle('asd')->setId(3),
            (new Product())->setTitle('asd'),
            (new Product())->setTitle('asd'),
            (new Product())->setTitle('asd'),
            (new Product())->setTitle('asd'),
            (new Product())->setTitle('asd'),
            (new Product())->setTitle('asd'),
        ];

        (new ShowProductsRenderer())->render($products);
    }

    public static function showProduct(int $id)
    {
        (new showProductRenderer())->render();
    }
}
