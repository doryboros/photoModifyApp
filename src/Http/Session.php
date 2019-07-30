<?php


namespace MyApp\Http;


class Session
{
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
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION[$key] = $data;
    }

    /**
     * @param string $key
     */
    public function unsetSessionData(string $key)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        unset($_SESSION[$key]);
    }

}