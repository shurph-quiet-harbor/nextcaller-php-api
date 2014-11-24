<?php

require(__DIR__ . '/vendor/autoload.php');

use NextCaller\NextCallerClient;

$user = "";
$password = "";
$phoneNumber = "6925558386";
$sandbox = true;

$client = new NextCallerClient($user, $password, $sandbox);
try {
    $records = $client->getProfileByPhone($phoneNumber);
    /*
    array(
        'records' => array(
            array(
                'id' => '68293d3f87db2c4ee97545add4bc67',
                'first_name' => 'Dawn',
                'middle_name' => 'E',
                'last_name' => 'Brady',
                'name' => 'Dawn E Brady',
                'language' => 'English',
                'phone' => array(
                    array(
                        'number' => '6925558386',
                        'resource_uri' => '/v2/records/6925558386/'
                    )
                ),
                'carrier' => 'Verizon Wireless',
                'address' => array(
                    array(
                        'city' => 'San Juan Capistrano',
                        'extended_zip' => '4913',
                        'country' => 'USA',
                        'line1' => '33382 Via DE Agua',
                        'line2' => '',
                        'state' => 'CA',
                        'zip_code' => '92675'
                    ),
                    array(
                        'city' => 'Aliso Viejo',
                        'extended_zip' => '1344',
                        'country' => 'USA',
                        'line1' => '23511 Aliso Creek Rd',
                        'line2' => '',
                        'state' => 'CA',
                        'zip_code' => '92656'
                    )
                ),
                'relatives' => array(),
                'email' => 'vysrqstilt@example.com',
                'linked_emails' => array(),
                'dob' => '',
                'age' => '',
                'education' => '',
                'gender' => 'Female',
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
                'resource_uri' => '/v2/users/68293d3f87db2c4ee97545add4bc67/'
            )
        )
    );*/
    var_dump($records);
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