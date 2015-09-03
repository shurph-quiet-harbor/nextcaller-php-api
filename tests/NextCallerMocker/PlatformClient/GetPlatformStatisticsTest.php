<?php

namespace NextCaller\Test\PlatformClientMocker;

use NextCaller\NextCallerPlatformClient;

class GetPlatformStatistics extends \PHPUnit_Framework_TestCase
{

    const JSON_RESPONSE = '{"data": [{"id": "test_user1", "first_name": "John", "last_name": "Smith", "company_name": "Super Company", "email": "test@example.com", "object": "account", "number_of_operations": 0, "total_operations": {}, "billed_operations": {}, "resource_uri": "/v2.1/accounts/test_user1/"}, {"id": "test_user2", "first_name": "", "last_name": "", "company_name": "", "email": "", "object": "account", "number_of_operations": 0, "total_operations": {}, "billed_operations": {}, "resource_uri": "/v2.1/accounts/test_user2/"}, {"id": "test_user3", "first_name": "", "last_name": "", "company_name": "", "email": "", "object": "account", "number_of_operations": 0, "total_operations": {}, "billed_operations": {}, "resource_uri": "/v2.1/accounts/test_user3/"}, {"id": "test_pl_user", "first_name": "", "last_name": "", "company_name": "", "email": "", "object": "account", "number_of_operations": 1, "total_operations": {"2015-06": 1}, "billed_operations": {"2015-06": 1}, "resource_uri": "/v2.1/accounts/test_pl_user/"}, {"id": "test_user4", "first_name": "", "last_name": "", "company_name": "", "email": "", "object": "account", "number_of_operations": 1, "total_operations": {"2015-06": 1}, "billed_operations": {"2015-06": 1}, "resource_uri": "/v2.1/accounts/test_user4/"}, {"id": "me", "first_name": "", "last_name": "", "company_name": "", "email": "", "object": "account", "number_of_operations": 4, "total_operations": {"2015-09": 4}, "billed_operations": {"2015-09": 4}, "resource_uri": "/v2.1/accounts/me/"}, {"id": "test_libs", "first_name": "CCCClark", "last_name": "Updated", "company_name": "", "email": "", "object": "account", "number_of_operations": 4, "total_operations": {"2015-09": 4}, "billed_operations": {"2015-09": 4}, "resource_uri": "/v2.1/accounts/test_libs/"}, {"id": "clark_lib_user", "first_name": "Clark", "last_name": "Kent", "company_name": "", "email": "", "object": "account", "number_of_operations": 0, "total_operations": {}, "billed_operations": {}, "resource_uri": "/v2.1/accounts/clark_lib_user/"}], "page": 1, "has_next": false, "total_pages": 1, "object": "page", "total_platform_operations": {"2015-06": 2, "2015-09": 12}, "billed_platform_operations": {"2015-06": 2, "2015-09": 12}}';
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

    public function testProfileJson() {
        $client = self::$client;
        $client->getPlatformStatistics();
        $this->assertTrue(true);
    }

}