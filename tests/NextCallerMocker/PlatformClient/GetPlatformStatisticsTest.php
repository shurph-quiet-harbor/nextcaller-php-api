<?php

namespace NextCaller\Test\PlatformClientMocker;

use NextCaller\NextCallerPlatformClient;

class GetPlatformStatistics extends \PHPUnit_Framework_TestCase
{

    const JSON_RESPONSE = '{"object_list":[{"username":"user2","first_name":"","last_name":"","company_name":"","email":"","number_of_operations":1,"total_calls":{"2014-11":1},"successful_calls":{"2014-11":1},"resource_uri":"/v2/platform_users/user2/"},{"username":"user1","first_name":"user1_fname","last_name":"user1_lname","company_name":"company1_name","email":"email@company1.com","number_of_operations":11,"total_calls":{"2014-11":11},"successful_calls":{"2014-11":11},"resource_uri":"/v2/platform_users/user1/"},{"username":"user3","first_name":"","last_name":"","company_name":"","email":"","number_of_operations":0,"total_calls":[],"successful_calls":[],"resource_uri":"/v2/platform_users/user3/"},{"username":"user4","first_name":"user4_fname","last_name":"user4_lname","company_name":"company4_name","email":"email@company4.com","number_of_operations":0,"total_calls":[],"successful_calls":[],"resource_uri":"/v2/platform_users/user4/"},{"username":"user5","first_name":"","last_name":"","company_name":"","email":"","number_of_operations":0,"total_calls":[],"successful_calls":[],"resource_uri":"/v2/platform_users/user5/"},{"username":"user6","first_name":"","last_name":"","company_name":"","email":"","number_of_operations":0,"total_calls":[],"successful_calls":[],"resource_uri":"/v2/platform_users/user6/"},{"username":"user7","first_name":"","last_name":"","company_name":"","email":"","number_of_operations":0,"total_calls":[],"successful_calls":[],"resource_uri":"/v2/platform_users/user7/"},{"username":"user8","first_name":"","last_name":"","company_name":"","email":"","number_of_operations":0,"total_calls":[],"successful_calls":[],"resource_uri":"/v2/platform_users/user8/"},{"username":"user9","first_name":"","last_name":"","company_name":"","email":"","number_of_operations":0,"total_calls":[],"successful_calls":[],"resource_uri":"/v2/platform_users/user9/"},{"username":"user10","first_name":"","last_name":"","company_name":"","email":"","number_of_operations":0,"total_calls":[],"successful_calls":[],"resource_uri":"/v2/platform_users/user10/"},{"username":"user11","first_name":"","last_name":"","company_name":"","email":"","number_of_operations":0,"total_calls":[],"successful_calls":[],"resource_uri":"/v2/platform_users/user11/"},{"username":"user12","first_name":"","last_name":"","company_name":"","email":"","number_of_operations":0,"total_calls":[],"successful_calls":[],"resource_uri":"/v2/platform_users/user12/"},{"username":"user13","first_name":"","last_name":"","company_name":"","email":"","number_of_operations":0,"total_calls":[],"successful_calls":[],"resource_uri":"/v2/platform_users/user13/"},{"username":"user14","first_name":"","last_name":"","company_name":"","email":"","number_of_operations":0,"total_calls":[],"successful_calls":[],"resource_uri":"/v2/platform_users/user14/"},{"username":"user15","first_name":"","last_name":"","company_name":"","email":"","number_of_operations":0,"total_calls":[],"successful_calls":[],"resource_uri":"/v2/platform_users/user15/"},{"username":"user16","first_name":"","last_name":"","company_name":"","email":"","number_of_operations":0,"total_calls":[],"successful_calls":[],"resource_uri":"/v2/platform_users/user16/"},{"username":"user17","first_name":"","last_name":"","company_name":"","email":"","number_of_operations":0,"total_calls":[],"successful_calls":[],"resource_uri":"/v2/platform_users/user17/"},{"username":"user18","first_name":"","last_name":"","company_name":"","email":"","number_of_operations":0,"total_calls":[],"successful_calls":[],"resource_uri":"/v2/platform_users/user18/"},{"username":"user19","first_name":"","last_name":"","company_name":"","email":"","number_of_operations":0,"total_calls":[],"successful_calls":[],"resource_uri":"/v2/platform_users/user19/"},{"username":"user20","first_name":"","last_name":"","company_name":"","email":"","number_of_operations":0,"total_calls":[],"successful_calls":[],"resource_uri":"/v2/platform_users/user20/"}],"page":1,"has_next":true,"total_pages":2,"total_platform_calls":{"2014-11":34},"successful_platform_calls":{"2014-11":34}}';

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