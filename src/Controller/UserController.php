<?php

namespace MyApp\Controller;

use MyApp\Http\Request;
use MyApp\Model\DomainObject\User;
use MyApp\Model\Persistence\Finder\UserFinder;
use MyApp\Model\Persistence\Mapper\UserMapper;
use MyApp\Model\Persistence\PersistenceFactory;
use MyApp\View\Renders\showProfileRenderer;
use MyApp\View\Renders\showRegisterFormRenderer;
use MyApp\View\Renders\showLoginFormRenderer;
use MyApp\View\Renders\showUploadsRenderer;
use MyApp\Http\Session;

class UserController
{
    public static function showLoginForm()
    {
        (new showLoginFormRenderer())->render();
    }

    public static function login(Request $request)
    {
        $session = new Session();
        $credentialFinder = PersistenceFactory::createFinder('user');
        /**
         * @var UserFinder $credentialFinder
         */
        $user = $credentialFinder->findByCredentials($request->getPostData('email'), $request->getPostData('password'));
        var_dump($user);
        if ($user !== null) {
            $session->setSessionVariable('userId', $user->getId());
            $session->setSessionVariable('username', $user->getName());
            $session->setSessionVariable('loggedIn', true);
            header('Location:\\');
        }

    }

    public static function logOut()
    {
        $session = new Session();
        $session->unsetSessionData('userId');
        $session->unsetSessionData('username');
        $session->setSessionVariable('loggedIn', false);
        header('Location:\\');
    }

    public static function showRegisterForm()
    {
        (new showRegisterFormRenderer())->render();
    }

    public static function register(Request $request)
    {
        $userMapper = PersistenceFactory::createMapper('user');
        $user = new User(null, $request->getPostData('username'), $request->getPostData('email'), $request->getPostData('password'));
        /**
         * @var UserMapper $userMapper
         */
        $userMapper->save($user);
        header('Location: \\login');
    }


    public static function showProfile()
    {
        (new showProfileRenderer())->render();
    }

}