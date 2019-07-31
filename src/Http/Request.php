<?php /** @noinspection ALL */


namespace MyApp\Http;

use Exception;

class Request
{

    /**
     * @var array
     */
    private $pathParameters;

    /**
     * Request constructor.
     * @param $pathParameters
     */
    public function __construct(array $pathParameters)
    {
        $this->pathParameters = $pathParameters;
    }

    /**
     * @param string|null $key
     * @return mixed
     */
    public function getPostData(string $key = null)
    {
        return (empty($key)) ? $_POST : $_POST[$key];
    }

    /**
     * @param string|null $key
     * @return mixed
     */
    public function getGetData(string $key = null)
    {
        return (empty($key)) ? $_GET : $_GET[$key];
    }

    /**
     * @param string $key
     * @return string
     */
    public function getPathParam(string $key): string
    {
        if (!isset($this->pathParameters[$key])) {
            throw new Exception('No param with name ' . $key);
        }

        return $this->pathParameters[$key];
    }

}