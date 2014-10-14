<?php

namespace NextCaller\Test;

use NextCaller\Client;
use NextCaller\Exception\NoContentException;

class ProfileMockerSetTest extends \PHPUnit_Framework_TestCase
{
    const JSON_DATA = '{
    "first_name": "Clark",
    "last_name": "Kent",
    "shipping_address1": {
        "line1": "225 Kryptonite Ave.",
        "line2": "",
        "city": "Smallville",
        "state": "KS",
        "zip_code": "66002"
    }
}';

    const PROFILE_ID = '97d949a413f4ea8b85e9586e1f2d9a';

    protected static $mock;

    public static function setUpBeforeClass() {
        $client = new Client(null, null);
        $mocker = new \Guzzle\Plugin\Mock\MockPlugin();
        $mocker->addResponse(new \Guzzle\Http\Message\Response(204,array('content-type' => 'application/json')));
        $client->addSubscriber($mocker);
        self::$mock = $mocker;
    }

    public static function tearDownAfterClass() {
        $client = new Client(null, null);
        $client->removeSubscriber(self::$mock);
    }

    public function testProfileArray() {
        $client = new Client(null, null);
        $data = json_decode(self::JSON_DATA, true);
        $response = $client->setProfile(self::PROFILE_ID, $data);
        $this->assertEquals($response, null);
    }

}