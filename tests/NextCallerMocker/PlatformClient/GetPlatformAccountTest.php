<?php

namespace NextCaller\Test\PlatformClientMocker;

use NextCaller\NextCallerPlatformClient;

class GetPlatformAccount extends \PHPUnit_Framework_TestCase
{

    const JSON_RESPONSE = '{"id": "test_user1", "first_name": "John", "last_name": "Smith", "company_name": "Super Company", "email": "test@example.com", "object": "account", "number_of_operations": 0, "total_operations": {}, "billed_operations": {}, "resource_uri": "/v2.1/accounts/test_user1/"}';
    const PLATFORM_ACCOUNT_ID = 'user12345';
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

    public function testGetPlatformAccount() {
        $client = self::$client;
        $data = $client->getPlatformAccount(self::PLATFORM_ACCOUNT_ID);
        $this->assertTrue(!empty($data));
    }

}