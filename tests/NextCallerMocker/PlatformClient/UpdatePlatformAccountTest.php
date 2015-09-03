<?php

namespace NextCaller\Test\PlatformClientMocker;

use NextCaller\NextCallerPlatformClient;

class UpdatePlatformAccount extends \PHPUnit_Framework_TestCase
{
    const DATA = '{"first_name": "platform_user1_fname"}';
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

    public function testUpdatePlatformAccount() {
        $client = self::$client;
        $data = json_decode(self::DATA);
        $result = $client->updatePlatformAccount(self::PLATFORM_ACCOUNT_ID, $data);
        $this->assertEquals($result, self::RESPONSE_STR);
    }

}