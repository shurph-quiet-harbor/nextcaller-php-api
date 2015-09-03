<?php

namespace NextCaller\Test\PlatformClientMocker;

use NextCaller\NextCallerPlatformClient;

class UpdateByProfileIdAccount extends \PHPUnit_Framework_TestCase
{
    const DATA = '{"first_name": "platform_user1_fname"}';
    const PROFILE_ID = '12848e91004c7bdbd77fcc2be75e5b';
    const RESPONSE_STR = 'Update Received.';
    const PLATFORM_ACCOUNT_ID = 'user12345';

    protected static $mock;
    /** @var NextCallerPlatformClient client */
    protected static $client;

    public static function setUpBeforeClass() {
        $client = new NextCallerPlatformClient(null, null, true);
        $mocker = new \Guzzle\Plugin\Mock\MockPlugin();
        $mocker->addResponse(new \Guzzle\Http\Message\Response(200, array(), self::RESPONSE_STR));
        $client->addSubscriber($mocker);
        self::$client = $client;
        self::$mock = $mocker;
    }

    public function testUpdateByProfileId() {
        $client = self::$client;
        $data = json_decode(self::DATA);
        $result = $client->updateByProfileId(self::PROFILE_ID, $data, self::PLATFORM_ACCOUNT_ID);
        $this->assertEquals($result, self::RESPONSE_STR);
    }

}