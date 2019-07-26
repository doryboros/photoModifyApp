<?php

namespace MyApp\Controller;

class ProductController
{
    public static function showProducts()
    {
        require "src/View/Templates/home-page.php";
    }

}
