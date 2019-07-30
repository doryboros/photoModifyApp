<?php /** @noinspection ALL */


namespace MyApp\Http;


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

}