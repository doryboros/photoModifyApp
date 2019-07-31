<?php

namespace MyApp\Http;

class Session
{
    /**
     * Session constructor.
     */
    public function __construct()
    {
        if(!isset($_SESSION['loggedIn'])){
            $_SESSION['loggedIn']=false;
        }
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * @param string|null $key
     * @return mixed
     */
    public function getSessionVariable(string $key=null)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        return (empty($key)) ? $_SESSION : $_SESSION[$key];
    }

    /**
     * @param string $key
     * @param $data
     */
    public function setSessionVariable(string $key, $data)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION[$key] = $data;
    }

    /**
     * @param string $key
     */
    public function unsetSessionData(string $key)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION[$key]);
    }


    public function isLoggedIn()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return (isset($_SESSION) && $_SESSION['loggedIn']==true);
    }

}