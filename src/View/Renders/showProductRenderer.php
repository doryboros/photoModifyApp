<?php


namespace MyApp\View\Renders;

use MyApp\Http\Session;

class showProductRenderer
{
    /**
     * Returns path to header based on whether the user is logged in.
     *
     * @return string
     */
    private function getHeader() : string
    {
        $session = new Session();
        return $session->isLoggedIn() ? "src/View/Templates/header-logged-in.php" : "src/View/Templates/header-not-logged-in.php";
    }

    /**
     * Returns the session variable with the users name.
     * @return mixed|string
     */
    private function getUserName(){
        $session = new Session();
        return $name = $session->isLoggedIn() ? $session->getSessionVariable('username') : '';
    }

    /**
     * Requires files needed for current page.
     *
     * @param array $data
     */
    public function render(array $data = [])
    {
        $header = $this->getHeader();
        $name=$this->getUserName();
        require $header;
        require "src/View/Templates/product-page.php";
        require "src/View/Templates/footer.php";
    }
}