<?php


namespace MyApp\View\Renders;

use MyApp\Http\Session;

class ShowProductsRenderer
{
    public function render(array $products)
    {
        $session= new Session();
        if($session->isLoggedIn()) {
            $name=$session->getSessionVariable('username');
        }

        $header = $session->isLoggedIn() ? "src/View/Templates/header-logged-in.php" : "src/View/Templates/header-not-logged-in.php";
        require $header;
        require "src/View/Templates/home-page.php";
        require "src/View/Templates/footer.php";
    }
}