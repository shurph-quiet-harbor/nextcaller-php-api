<?php

namespace NextCaller\Test\PlatformClientMocker;

use NextCaller\NextCallerPlatformClient;

class CreatePlatformAccount extends \PHPUnit_Framework_TestCase
{
    const DATA = '{"first_name": "platform_user1_fname", "id": "user12345"}';
    const RESPONSE_STR = 'Successfully created.';
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

    public function testCreatePlatformAccount() {
        $client = self::$client;
        $data = json_decode(self::DATA);
        $result = $client->createPlatformAccount($data);
        $this->assertEquals($result, self::RESPONSE_STR);
    }

}