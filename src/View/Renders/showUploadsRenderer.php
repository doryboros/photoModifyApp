<?php


namespace MyApp\View\Renders;

use MyApp\Http\Session;

class showUploadsRenderer
{
    public function render()
    {
        $session= new Session();
        if($session->isLoggedIn()) {
            $name=$session->getSessionVariable('username');
        }
        require "src/View/Templates/header-logged-in.php";
        require "src/View/Templates/upload-form.php";
        require "src/View/Templates/footer.php";
    }
}