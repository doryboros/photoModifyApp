<?php


namespace MyApp\View\Renders;


class showUploadsRenderer
{
    public function render()
    {
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']===true){
            require "src/View/Templates/header-logged-in.php";
        }
        require "src/View/Templates/header-not-logged-in.php";
        require "src/View/Templates/upload-form.php";
        require "src/View/Templates/footer.php";
    }
}