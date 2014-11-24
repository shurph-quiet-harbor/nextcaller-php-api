<?php

namespace NextCaller\Test\ClientMocker;

use NextCaller\NextCallerClient;

class ProfileSetTest extends \PHPUnit_Framework_TestCase
{
    const JSON_DATA = '{
    "first_name": "Clark",
    "last_name": "Kent"
}';
    const PROFILE_ID = 'c7c17736128033c92771b7f33fead7';
    const PROFILE_PLATFORM_USER = 'user12345';

    protected static $mock;
    /** @var  NextCallerClient client */
    protected static $client;

    public static function setUpBeforeClass() {
        $client = new NextCallerClient(null, null, true);
        $mocker = new \Guzzle\Plugin\Mock\MockPlugin();
        $mocker->addResponse(new \Guzzle\Http\Message\Response(204));
        $client->addSubscriber($mocker);
        self::$client = $client;
        self::$mock = $mocker;
    }

    public function testProfileArray() {
        $client = self::$client;
        $data = json_decode(self::JSON_DATA, true);
        $response = $client->setProfile(self::PROFILE_ID, $data);
        $this->assertEquals($response, null);
    }

}