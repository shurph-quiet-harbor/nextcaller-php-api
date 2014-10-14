<?php

namespace NextCaller\Test;

use NextCaller\Client;

class ProfileMockerGetByPhoneTest extends \PHPUnit_Framework_TestCase
{
    const JSON_RESPONSE = '{"records": [{"name": "Jerry Seinfeld","first_name": "Jerry","last_name": "Seinfeld","language": "English","fraud_threat": "low","email": "demo@nextcaller.com","phone": [{"number": "2125558383"}],"carrier": "Verizon Wireless","address": [{"line1": "129 West 81st Street","line2": "Apt 5a","city": "New York","state": "NY","zip_code": "10024","extended_zip": "","country": "USA"}],"department": "not specified","id": "97d949a413f4ea8b85e9586e1f2d9a","line_type": "","relatives": []}],"number": "2125558383"}';

    const PROFILE_PHONE = '2125558383';

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
        $profiles = $client->getProfileByPhone(self::PROFILE_PHONE);
        $this->assertEquals($profiles, json_decode(self::JSON_RESPONSE,true));
    }

}