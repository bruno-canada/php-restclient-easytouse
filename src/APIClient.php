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

    /**
     * Singleton pattern 
     */
    private function __construct()
    { }

    /**
     * GET method to REST API
     *
     * @param string $endpoint
     * @param array $header
     * @param array $parameters
     * @return string raw API response
     */
    public static function get(string $endpoint, array $header, array $parameters = NULL)
    {

        return APIClient::getInstance()->buildRequest("GET", $endpoint, $header, $parameters);
    }

    /**
     * POST method to REST API
     *
     * @param string $endpoint
     * @param array $header
     * @param array $parameters
     * @return string raw API response
     */

    public static function post(string $endpoint, array $header, array $parameters = NULL)
    {
        return APIClient::getInstance()->buildRequest("POST", $endpoint, $header, $parameters);
    }

    /**
     * PUT method to REST API
     *
     * @param string $endpoint
     * @param array $header
     * @param array $parameters
     * @return string raw API response
     */
    public static function put(string $endpoint, array $header, array $parameters = NULL)
    {
        return APIClient::getInstance()->buildRequest("PUT", $endpoint, $header, $parameters);
    }

    /**
     * Check and instantiate class
     *
     * @return void
     */
    private static function getInstance()
    {
        if (empty(APIClient::$instance)) {
            APIClient::$instance = new APIClient;
        }

        return APIClient::$instance;
    }
}
