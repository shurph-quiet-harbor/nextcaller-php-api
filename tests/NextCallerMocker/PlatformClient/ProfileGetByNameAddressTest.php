<?php

namespace NextCaller\Test\PlatformClientMocker;

use NextCaller\NextCallerPlatformClient;

class ProfileGetByNameAddressTest extends \PHPUnit_Framework_TestCase
{
    const JSON_RESPONSE = '{"records": [{"id": "97d949a413f4ea8b85e9586e1f2d9a", "first_name": "Jerry", "middle_name": "Allen", "last_name": "Seinfeld", "name": "Jerry Allen Seinfeld", "language": "English", "phone": [{"number": "2125558383", "resource_uri": "/v2/records/2125558383/"}], "address": [{"city": "New York", "extended_zip": "2344", "country": "USA", "line1": "129 West 81st Street", "line2": "Apt 5A", "state": "NY", "zip_code": "10024"}, {"city": "New York", "extended_zip": "2345", "country": "USA", "line1": "129 West 81st Street", "line2": "Apt 5B", "state": "NY", "zip_code": "10024"}], "relatives": [{"id": "30400c6a0567b3a5168c9812ed617c", "name": "Morty Seinfeld", "resource_uri": "/v2/users/30400c6a0567b3a5168c9812ed617c/"}, {"id": "6d342b76b2b9b00c63324a0d0fcca8", "name": "Helen Seinfeld", "resource_uri": "/v2/users/6d342b76b2b9b00c63324a0d0fcca8/"}], "email": "jerry@example.org", "line_type": "Mobile", "carrier": "Verizon Wireless", "linked_emails": ["jerry@example.org", "badman@example.org", "domainmaster@example.org", "hellooooooo@example.org", "jaseinfeld@example.org", "jerry_seinfeld@example.org", "puffyshirt@example.org", "seinfeld4@example.org"], "social_links": [{"type": "twitter", "url": "https://twitter.com/jerryseinfeld", "followers": 26700}, {"type": "facebook", "url": "https://www.facebook.com/JerrySeinfeld", "followers": 6584}, {"type": "linkedin", "url": "https://www.linkedin.com/pub/jerry-seinfeld"}], "age": "45-54", "education": "Completed College", "gender": "Male", "high_net_worth": "Yes", "home_owner_status": "Rent", "household_income": "50k-75k", "length_of_residence": "10 Years", "marital_status": "Single", "market_value": "500k-1mm", "occupation": "White Collar Worker", "presence_of_children": "No", "department": "not specified", "resource_uri": "/v2/users/97d949a413f4ea8b85e9586e1f2d9a/"}]}';
    const PLATFORM_USERNAME = 'user12345';
    
    protected static $mock;
    /** @var  NextCallerPlatformClient client */
    protected static $client;

    public static function setUpBeforeClass() {
        $client = new NextCallerPlatformClient(null, null, true);
        $mocker = new \Guzzle\Plugin\Mock\MockPlugin();
        $mocker->addResponse(new \Guzzle\Http\Message\Response(200, array(), self::JSON_RESPONSE));
        $client->addSubscriber($mocker);
        self::$client = $client;
        self::$mock = $mocker;
    }

    public function testGetByNameAddress() {
        $client = self::$client;
        $nameAddressData = array(
            'first_name' => 'Jerry',
            'last_name' => 'Seinfeld',
            'address' => '129 West 81st Street',
            'city' => 'New York',
            'state' => 'NY',
            'zip_code' => '10024'
        );
        $profiles = $client->getProfileByNameAndAddress($nameAddressData, self::PLATFORM_USERNAME);
        $this->assertEquals($profiles, json_decode(self::JSON_RESPONSE, true));
    }
}