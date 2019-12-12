<?php
/**
* @author Bruno (github.com/bruno-canada)
*/
namespace EASYREST;

use Exception;

class RequestFactory
{

    private $method;
    private $parameters;
    private $endpoint;
    private $header;

    public $response;

    /**
     * Define if you want to print or not request complete information
     *
     * @var integer
     */
    public $debug = 0;

    /**
     * Build information structure to send request
     *
     * @param string $method
     * @param string $endpoint
     * @param array $header
     * @param array $parameters
     * @return string It can be simple string or JSON
     */
    protected function buildRequest(string $method, string $endpoint, array $header, array $parameters = [])
    {
        $this->method = $method;
        $this->endpoint = $endpoint;
        $this->header = $header;
        $this->parameters = $parameters;

        //IF parameters are defined for GET, convert it to end point URL parameters
        if (!empty($this->parameters) && $this->method == "GET") {

            $buildURL = http_build_query($this->parameters);
            $this->endpoint = $this->endpoint . "?" . $buildURL;

            //Clean paramenters obj
            unset($this->parameters);
        }

        return $this->processRequest();
    }

    /**
     * Execute request method
     *
     * @return HTTP response
     */
    private function processRequest()
    {
        $this->HTTPRequest();
        return $this->HTTPResponse();
    }

    /**
     * Process actual HTTP request via CURL
     *
     * @return void
     */
    private function HTTPRequest()
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->method);
        curl_setopt($ch, CURLOPT_URL, $this->endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 600);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 360000);
        curl_setopt($ch, CURLOPT_MAXCONNECTS, 50);

        if ($this->method == "GET") {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header);
        } else {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->parameters));
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
        }
        curl_setopt($ch, CURLOPT_VERBOSE, true);

        $verbose = fopen('php://temp', 'w+');
        curl_setopt($ch, CURLOPT_STDERR, $verbose);

        $this->response = curl_exec($ch);

        if ($this->response === FALSE) {
            throw new Exception("cUrl error (#" . curl_errno($ch) . "):" . htmlspecialchars(curl_error($ch)) . "\r\n");
        }

        rewind($verbose);
        $verboseLog = stream_get_contents($verbose);

        //Save log
        if ($this->debug == 1) {
            $this->DebugLog($this->response, htmlspecialchars($verboseLog));
        }

        curl_close($ch);
    }

    /**
     * HTTP API response handler
     *
     * @return HTTP response
     */
    private function HTTPResponse()
    {
        if (empty($this->response)) {
            throw new Exception("Response is empty or no data has been submitted.");
        }

        return $this->response;
    }

    /**
     * IF debug is enabled, print response and verbose
     *
     * @param string $response
     * @param string $verboseLog
     * @return string Response and CURL verbose
     */
    private function DebugLog(string $response,string $verboseLog)
    {
        echo "Response: ".$response." \r\n Verbose: ".$verboseLog;
    }
}
