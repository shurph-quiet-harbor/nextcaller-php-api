<?php

require(__DIR__ . '/vendor/autoload.php');

use NextCaller\NextCallerPlatformClient;

$user = "";
$password = "";
$sandbox = true;

$client = new NextCallerPlatformClient($user, $password, $sandbox);
try {
    $statistic = $client->getPlatformStatistics();
    /*
    array(
        array(
            array
            (
                'id' => 'user1',
                'first_name' => 'user1_fname',
                'last_name' => 'user1_lname',
                'company_name' => 'company1_name',
                'email' => 'email@company1.com',
                'number_of_operations' => '15',
                'total_operations' => array('2014-11' => '15'),
                'billed_operations' => array('2014-11' => '15'),
                'resource_uri' => '/v2/platform_users/user1/',
            ),
            array(
                'id' => 'user2',
                'first_name' => '',
                'last_name' => '',
                'company_name' => '',
                'email' => '',
                'number_of_operations' => '1',
                'total_operations' => array('2014-11' => '1'),
                'billed_operations' => array('2014-11' => '1',),
                'resource_uri' => '/v2/platform_users/user2/',
            ),
            ............
        ),
        'page' => '1',
        'has_next' => '1',
        'total_pages' => '2',
        'total_platform_calls' => array('2014-11' => '50'),
        'successful_platform_calls' => array('2014-11' => '50'),
    );
    */
    var_dump($statistic);
} catch (\NextCaller\Exception\RateLimitException $e) {
    var_dump($e->getRateLimit());
    var_dump($e->getResetTime());
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