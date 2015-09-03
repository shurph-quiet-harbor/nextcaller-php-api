<?php

require(__DIR__ . '/vendor/autoload.php');

use NextCaller\NextCallerClient;

$user = "";
$password = "";
$id = "c7c17736128033c92771b7f33fead7";
$sandbox = true;

$client = new NextCallerClient($user, $password, $sandbox);
try {
    $profile = $client->getByProfileId($id);
    /* array(
        'id' => 'c7c17736128033c92771b7f33fead7',
        'first_name' => 'James',
        'middle_name' => '',
        'last_name' => 'Johnson',
        'name' => 'James Johnson',
        'language' => 'English',
        'phone' => array(
            array(
                'number' => '2125558345',
                'resource_uri' => '/v2/records/2125558345/',
            )

        ),
        'carrier' => 'Allied Wireless Communication Llc Dba Alltel - Sc',
        'address' => array(
            array(
                'city' => 'Orangeburg',
                'extended_zip' => '5320',
                'country' => 'USA',
                'line1' => '248 Jensen St',
                'line2' => '',
                'state' => 'SC',
                'zip_code' => '29115',
            )

        ),
        'relatives' => array(),
        'email' => 'udjqamsrtu@example.com',
        'linked_emails' => array(),
        'dob' => '',
        'age' => '',
        'education' => '',
        'gender' => 'Male',
        'high_net_worth' => '',
        'home_owner_status' => '',
        'household_income' => '',
        'length_of_residence' => '',
        'line_type' => 'Mobile',
        'marital_status' => '',
        'market_value' => '',
        'occupation' => '',
        'presence_of_children' => '',
        'department' => 'not specified',
        'resource_uri' => '/v2/users/c7c17736128033c92771b7f33fead7/',
    );*/
    var_dump($profile);
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