<?php

namespace NextCaller\Test\PlatformClientMocker;

use NextCaller\NextCallerPlatformClient;

class GetPlatformUser extends \PHPUnit_Framework_TestCase
{

    const JSON_RESPONSE = '{"username":"user12345","first_name":"","last_name":"","company_name":"","email":"","number_of_operations":0,"total_calls":[],"successful_calls":[],"resource_uri":"/v2/platform_users/user12345/"}';
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

    public function testGetPlatformUser() {
        $client = self::$client;
        $data = $client->getPlatformUser(self::PLATFORM_USERNAME);
        $this->assertTrue(!empty($data));
    }

}