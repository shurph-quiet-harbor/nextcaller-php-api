<?php

namespace NextCaller\Test;

use NextCaller\Client;

class ProfileMockerGetTest extends \PHPUnit_Framework_TestCase
{
    const JSON_RESPONSE = '{"last_name": "Seinfeld", "length_of_residence": "", "line_type": "", "home_owner_status": "", "education": "", "id": "97d949a413f4ea8b85e9586e1f2d9a", "occupation": "", "first_name": "Jerry", "carrier": "Verizon Wireless", "department": "not specified", "email": "demo@nextcaller.com", "market_value": "", "high_net_worth": "", "phone": [{"number": "2125558383"}], "address": [{"line1": "129 West 81st Street", "line2": "Apt 5a", "city": "New York", "state": "NY", "zip_code": "10024", "extended_zip": "", "country": "USA"}], "presence_of_children": "", "fraud_threat": "low", "name": "Jerry Seinfeld", "language": "English", "gender": "", "age": "", "marital_status": "", "household_income": ""}';

    const PROFILE_ID = '97d949a413f4ea8b85e9586e1f2d9a';

    protected static $mock;

    public static function setUpBeforeClass() {
        $client = new Client(null, null);
        $mocker = new \Guzzle\Plugin\Mock\MockPlugin();
        $mocker->addResponse(new \Guzzle\Http\Message\Response(200,
                array('content-type' => 'application/json'),
                self::JSON_RESPONSE));
        $client->addSubscriber($mocker);
        self::$mock = $mocker;
    }

    public static function tearDownAfterClass(){
        $client = new Client(null, null);
        $client->removeSubscriber(self::$mock);
    }

    public function testProfileJson() {
        $client = new Client(null, null);
        $profile = $client->getProfile(self::PROFILE_ID);
        $this->assertEquals($profile, json_decode(self::JSON_RESPONSE,true));
    }

}