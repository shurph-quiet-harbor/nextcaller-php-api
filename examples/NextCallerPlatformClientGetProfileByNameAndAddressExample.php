<?php

require(__DIR__ . '/vendor/autoload.php');

use NextCaller\NextCallerPlatformClient;

$user = "";
$password = "";
$nameAddressData = array(
    'first_name' => 'Jerry',
    'last_name' => 'Seinfeld',
    'address' => '129 West 81st Street',
    'city' => 'New York',
    'state' => 'NY',
    'zip_code' => '10024'
);
$platformUsername = 'user1';
$sandbox = false;

$client = new NextCallerPlatformClient($user, $password, $sandbox);
try {
    $records = $client->getProfileByNameAndAddress($nameAddressData, $platformUsername);
    /* array(
        'id' => '97d949a413f4ea8b85e9586e1f2d9a',
        'first_name' => 'Jerry',
        'middle_name' => 'Allen',
        'last_name' => 'Seinfeld',
        'name' => 'Jerry Allen Seinfeld',
        'language' => 'English',
        'phone' => array(
            array(
                'number' => '2125558383',
                'resource_uri' => '/v2/records/2125558383/',
            )
        ),
        'carrier' => 'Verizon Wireless',
        'line_type' => 'Mobile',
        'address' => array(
            array(
                'city' => 'New York',
                'extended_zip' => '2344',
                'country' => 'USA',
                'line1' => '129 West 81st Street',
                'line2' => 'Apt 5A',
                'state' => 'NY',
                'zip_code' => '10024',
            ),
            array(
                'city' => 'New York',
                'extended_zip' => '2345',
                'country' => 'USA',
                'line1' => '129 West 81st Street',
                'line2' => 'Apt 5A',
                'state' => 'NY',
                'zip_code' => '10024',
            )

        ),
        'relatives' => array(
            array(
                'id' => '30400c6a0567b3a5168c9812ed617c',
                'name' => 'Morty Seinfeld',
                'resource_uri' => '/v2/users/30400c6a0567b3a5168c9812ed617c/'
            ),
            array(
                'id' => '6d342b76b2b9b00c63324a0d0fcca8',
                'name' => 'Helen Seinfeld',
                'resource_uri' => '/v2/users/6d342b76b2b9b00c63324a0d0fcca8/'
            ),
        ),
        'email' => 'jerry@example.org',
        'linked_emails' => array(
            'jerry@example.org',
            'badman@example.org',
            'domainmaster@example.org',
            'hellooooooo@example.org',
            'jaseinfeld@example.org',
            'jerry_seinfeld@example.org',
            'puffyshirt@example.org',
            'seinfeld4@example.org',
        ),
        'social_links' => array(
            array(
                'type' => 'twitter',
                'url' => 'https://twitter.com/jerryseinfeld',
                'followers' => 26700
            ),
            array(
                'type' => 'facebook',
                'url' => 'https://www.facebook.com/JerrySeinfeld',
                'followers' => 6584
            ),
            array(
                'type' => 'linkedin',
                'url' => 'https://www.linkedin.com/pub/jerry-seinfeld'
            )
        ),
        'age' => '45-54',
        'education' => 'Completed College',
        'gender' => 'Male',
        'high_net_worth' => 'Yes',
        'home_owner_status' => 'Rent',
        'household_income' => '50k-75k',
        'length_of_residence' => '10 Years',
        'marital_status' => 'Single',
        'market_value' => '500k-1mm',
        'occupation' => 'White Collar Worker',
        'presence_of_children' => 'No',
        'department' => 'not specified',
        'resource_uri' => '/v2/users/97d949a413f4ea8b85e9586e1f2d9a/',
    ); */
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
