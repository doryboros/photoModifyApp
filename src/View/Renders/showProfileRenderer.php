<?php


namespace MyApp\View\Renders;


class showProfileRenderer
{
    public function render()
    {
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']===true){
            require "src/View/Templates/header-logged-in.php";
        }
        require "src/View/Templates/header-not-logged-in.php";
        require "src/View/Templates/profile-page.php";
        require "src/View/Templates/footer.php";
    }
}