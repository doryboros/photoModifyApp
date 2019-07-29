<?php

namespace MyApp\Controller;

use MyApp\View\Renders\showProfileRenderer;
use MyApp\View\Renders\showRegisterFormRenderer;
use MyApp\View\Renders\showLoginFormRenderer;
use MyApp\View\Renders\showUploadsRenderer;

class UserController
{
    public static function showLoginForm()
    {
        (new showLoginFormRenderer())->render();
    }

    public function showRegisterForm()
    {
        (new showRegisterFormRenderer())->render();
    }

    public function showUploads()
    {
        (new showUploadsRenderer())->render();
    }

    public function showProfile()
    {
        (new showProfileRenderer())->render();
    }

}