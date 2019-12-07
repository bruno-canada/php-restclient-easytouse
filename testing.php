<?php
/**
* @author Bruno (github.com/bruno-canada)
*
* This tests are related to Dear System Inventory
* API Documentation: https://dearinventory.docs.apiary.io
*/

//You don't need this if you are using composer, this is only needed for non-composer installation
include "src/RequestFactory.php";
include "src/APIClient.php";

//URL to send the request to
$endpointRoot = "";
$endpoint = $endpointRoot . "";

//Required Headers based on the API documentation
$username = "";
$password = "";
$header = [
    'Content-Type: application/json',
    'api-auth-accountid: '.$username,
    'api-auth-applicationkey: '.$password
];

//IF you pass parameters for GET request, it will be converted to URL parameters and added to the endpoint
$parameters = ["ID"=>""];


//Simple and quick way to do all the request
try {

    $getSales = EASYREST\APIClient::get($endpoint, $header, $parameters);
    print_r($getSales);
} catch (\Exception $e) {

    echo "Error: " . $e->getMessage();
}
