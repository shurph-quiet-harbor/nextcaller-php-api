<?php

require(__DIR__ . '/vendor/autoload.php');

use NextCaller\NextCallerClient;

$user = "";
$password = "";
$id = "c7c17736128033c92771b7f33fead7";
$phone = '6925558386';
$platformUsername = 'user1';
$sandbox = true;

$client = new NextCallerClient($user, $password, $sandbox);
try {
    $fraudLevel = $client->getFraudLevel($phone, $platformUsername);
    /*
    array(
        'spoofed' => 'unknown',
        'fraud_risk' => 'medium'
    );
    */
    var_dump($fraudLevel);
} catch (\NextCaller\Exception\BadResponseException $e) {
    // Example
    // 555
    var_dump($e->getCode());
    // The number you have entered is invalid. Please ensure your number contains 10 digits.
    var_dump($e->getMessage());
    /* array(
     *      "message" => "The number you have entered is invalid. Please ensure your number contains 10 digits.",
     *      "code" => "555",
     *      "type" => "Bad Request"
     * );
     * */
    var_dump($e->getError());
    /** @var \Guzzle\Http\Message\Request $request */
    $request = $e->getRequest();
    /** @var \Guzzle\Http\Message\Response $response */
    $response = $e->getResponse();
} catch (\NextCaller\Exception\FormatException $e) {
    // Example
    // 3
    var_dump($e->getCode());
    // Not valid error response
    var_dump($e->getMessage());
    /** @var \Guzzle\Http\Message\Request $request */
    $request = $e->getRequest();
    /** @var \Guzzle\Http\Message\Response $response */
    $response = $e->getResponse();
}