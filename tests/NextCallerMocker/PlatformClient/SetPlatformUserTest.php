<?php

namespace NextCaller\Test\PlatformClientMocker;

use NextCaller\NextCallerPlatformClient;

class SetPlatformUser extends \PHPUnit_Framework_TestCase
{
    const DATA = '{"first_name": "platform_user1_fname"}';

    const PROFILE_PHONE = '2125558383';
    const PLATFORM_USERNAME = 'user12345';

    protected static $mock;
    /** @var NextCallerPlatformClient client */
    protected static $client;

    public static function setUpBeforeClass() {
        $client = new NextCallerPlatformClient(null, null, true);
        $mocker = new \Guzzle\Plugin\Mock\MockPlugin();
        $mocker->addResponse(new \Guzzle\Http\Message\Response(204));
        $client->addSubscriber($mocker);
        self::$client = $client;
        self::$mock = $mocker;
    }

    public function testSetPlatformUser() {
        $client = self::$client;
        $data = json_decode(self::DATA);
        $result = $client->createPlatformAccount(self::PLATFORM_USERNAME, $data);
        $this->assertEquals($result, null);
    }

}