<?php

require(__DIR__ . '/vendor/autoload.php');

use NextCaller\NextCallerPlatformClient;

$user = "";
$password = "";
$id = 'e79ba4dab9cdd3da41c95efd734ec5b';
$accountId = 'user1';
$sandbox = true;

$client = new NextCallerPlatformClient($user, $password, $sandbox);
try {
    $profile = $client->getByProfileId($id, $accountId);
    /*
    array(
        'id' => 'e79ba4dab9cdd3da41c95ef734ec5b',
        'first_name' => 'Miguel',
        'middle_name' => '',
        'last_name' => 'Meneses',
        'name' => 'Miguel Meneses',
        'language' => 'English',
        'phone' => array(
            array(
                'number' => '6925558386',
                'resource_uri' => '/v2/records/6925558386/',
            )
        ),

        'carrier' => 'AT & T',
        'address' => array(
            array(
                'city' => 'Winnetka',
                'extended_zip' => '1511',
                'country' => 'USA',
                'line1' => 'Hackney St',
                'line2' => '',
                'state' => 'CA',
                'zip_code' => '91306',
            )
        ),

        'line_type' => 'Mobile',
        'department' => 'not specified',
        'resource_uri' => '/v2/users/e79ba4dab9cdd3da41c95ef734ec5b/'
    );
    */
    var_dump($profile);
} catch (\NextCaller\Exception\RateLimitException $e) {
    var_dump($e->getRateLimit());
    var_dump($e->getResetTime());
} catch (\NextCaller\Exception\BadResponseException $e) {
    // Example
    // 558
    var_dump($e->getCode());
    // The profile id you have entered is invalid. Please ensure your profile id contains 30 symbols.
    var_dump($e->getMessage());
    /* array(
     *      "message" => "The profile id you have entered is invalid. Please ensure your profile id contains 30 symbols.",
     *      "code" => "558",
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