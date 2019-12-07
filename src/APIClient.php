<?php
/**
* @author Bruno (github.com/bruno-canada)
*/
namespace EASYREST;

use Exception;

class APIClient extends RequestFactory
{
    public static $instance;

    public $headers;

    public $debug;

    private function __construct()
    { }

    public static function get(string $endpoint, array $header, array $parameters = NULL)
    {

        return APIClient::getInstance()->buildRequest("GET", $endpoint, $header, $parameters);
    }

    public static function post(string $endpoint, array $header, array $parameters = NULL)
    {
        return APIClient::getInstance()->buildRequest("POST", $endpoint, $header, $parameters);
    }

    public static function put(string $endpoint, array $header, array $parameters = NULL)
    {
        return APIClient::getInstance()->buildRequest("PUT", $endpoint, $header, $parameters);
    }

    private static function getInstance()
    {
        if (empty(APIClient::$instance)) {
            APIClient::$instance = new APIClient;
        }

        return APIClient::$instance;
    }
}
