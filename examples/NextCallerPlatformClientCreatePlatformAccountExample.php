<?php

require(__DIR__ . '/vendor/autoload.php');

use NextCaller\NextCallerPlatformClient;

$user = "";
$password = "";
$sandbox = true;
$data = array('email' => 'xxx', 'id' => 'user1');

$client = new NextCallerPlatformClient($user, $password, $sandbox);
try {
    $client->createPlatformAccount($data);
} catch (\NextCaller\Exception\RateLimitException $e) {
    var_dump($e->getRateLimit());
    var_dump($e->getResetTime());
} catch (\NextCaller\Exception\BadResponseException $e) {
    // Example
    // 422
    var_dump($e->getCode());
    // Validation Error
    var_dump($e->getMessage());
    /*
     array(
        'message' => 'Validation Error',
        'code' => '422',
        'type' => 'Unprocessable Entity',
        'description' => array(
            'email' => array('Invalid email address')
        )
    );
    */
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