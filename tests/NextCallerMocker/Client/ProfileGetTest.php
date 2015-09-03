<?php

namespace NextCaller\Test\ClientMocker;

use NextCaller\NextCallerClient;

class ProfileGetTest extends \PHPUnit_Framework_TestCase
{
    const JSON_RESPONSE = '{"id":"c7c17736128033c92771b7f33fead7","first_name":"James","middle_name":"","last_name":"Johnson","name":"James Johnson","language":"English","phone":[{"number":"2125558345","resource_uri":"/v2/records/2125558345/"}],"carrier":"Allied Wireless Communication Llc Dba Alltel - Sc","address":[{"city":"Orangeburg","extended_zip":"5320","country":"USA","line1":"248 Jensen St","line2":"","state":"SC","zip_code":"29115"}],"relatives":[],"email":"udjqamsrtu@example.com","linked_emails":[],"dob":"","age":"","education":"","gender":"Male","high_net_worth":"","home_owner_status":"","household_income":"","length_of_residence":"","line_type":"Mobile","marital_status":"","market_value":"","occupation":"","presence_of_children":"","department":"not specified","resource_uri":"/v2/users/c7c17736128033c92771b7f33fead7/"}';
    const PROFILE_ID = 'c7c17736128033c92771b7f33fead7';

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

    public function testGetByProfileId() {
        $client = self::$client;
        $profile = $client->getByProfileId(self::PROFILE_ID);
        $this->assertEquals($profile, json_decode(self::JSON_RESPONSE, true));
    }

}