<?php


namespace MyApp\View\Renders;

use MyApp\Http\Session;

class showProfileRenderer
{
    public function render()
    {
        $session= new Session();
        if($session->isLoggedIn()) {
            $name=$session->getSessionVariable('username');
        }
        require "src/View/Templates/header-logged-in.php";
        require "src/View/Templates/profile-page.php";
        require "src/View/Templates/footer.php";
    }
}