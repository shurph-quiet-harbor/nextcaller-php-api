<?php

namespace NextCaller\Test\ClientMocker;

use NextCaller\NextCallerClient;

class ProfileGetByEmailTest extends \PHPUnit_Framework_TestCase
{
    const JSON_RESPONSE = '{"records": [{"id": "b6402bb111e13b57094830f3c85192", "first_name": "", "first_pronounced": "", "middle_name": "", "last_name": "", "name": " ", "language": "English", "phone": [], "address": [], "relatives": [], "email": "email@exmaple.com", "line_type": "", "carrier": "", "linked_emails": ["email@exmaple.com"], "social_links": [], "age": "", "education": "", "gender": "", "high_net_worth": "", "home_owner_status": "", "household_income": "", "length_of_residence": "", "marital_status": "", "market_value": "", "occupation": "", "presence_of_children": "", "department": "not specified", "telco_zip": "", "telco_zip_4": "", "resource_uri": "/v2/users/b6402bb111e13b57094830f3c85192/"}]}';
    const PROFILE_EMAIL = 'email@exmaple.com';


    protected static $mock;
    /** @var  NextCallerClient client */
    protected static $client;

    public static function setUpBeforeClass() {
        $client = new NextCallerClient(null, null, true);
        $mocker = new \Guzzle\Plugin\Mock\MockPlugin();
        $mocker->addResponse(new \Guzzle\Http\Message\Response(200, array(), self::JSON_RESPONSE));
        $client->addSubscriber($mocker);
        self::$client = $client;
        self::$mock = $mocker;
    }

    public function testGetByEmail() {
        $client = self::$client;
        $profiles = $client->getByEmail(self::PROFILE_EMAIL);
        $this->assertEquals($profiles, json_decode(self::JSON_RESPONSE, true));
    }
}