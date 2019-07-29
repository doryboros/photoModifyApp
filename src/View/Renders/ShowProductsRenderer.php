<?php


namespace MyApp\View\Renders;


class ShowProductsRenderer
{
    public function render(array $products)
    {
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']===true){
            require "src/View/Templates/header-logged-in.php";
        }
        require "src/View/Templates/header-not-logged-in.php";
        require "src/View/Templates/home-page.php";
        require "src/View/Templates/footer.php";
    }
}