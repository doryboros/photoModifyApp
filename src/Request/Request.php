<?php /** @noinspection ALL */


namespace MyApp\Request;


class Request
{
    /**
     * @param string|null $key
     * @return mixed
     */
    public function getPostData(?string $key)
    {
        return (empty($key)) ? $_POST : $_POST[$key];
    }

    /**
     * @param string|null $key
     * @return mixed
     */
    public function getGetData(?string $key)
    {
        return (empty($key)) ? $_GET : $_GET[$key];
    }

    /**
     * @param string|null $key
     * @return mixed
     */
    public function getSessionVariable(?string $key)
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