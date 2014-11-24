<?php

namespace NextCaller\Test\PlatformClientMocker;

use NextCaller\NextCallerPlatformClient;

class GetFraudLevelTest extends \PHPUnit_Framework_TestCase
{
    const JSON_RESPONSE = '{"spoofed": "unknown","fraud_risk": "medium"}';

    const PROFILE_PHONE = '2125558383';
    const PLATFORM_USERNAME = 'user12345';

    protected static $mock;
    /** @var  NextCallerPlatformClient client */
    protected static $client;

    public static function setUpBeforeClass() {
        $client = new NextCallerPlatformClient(null, null, true);
        $mocker = new \Guzzle\Plugin\Mock\MockPlugin();
        $mocker->addResponse(new \Guzzle\Http\Message\Response(200, array(), self::JSON_RESPONSE));
        $client->addSubscriber($mocker);
        self::$client = $client;
        self::$mock = $mocker;
    }

    public function testGetFraudLevel() {
        $client = self::$client;
        $profile = $client->getFraudLevel(self::PROFILE_PHONE, self::PLATFORM_USERNAME);
        $this->assertEquals($profile, json_decode(self::JSON_RESPONSE, true));
    }

}