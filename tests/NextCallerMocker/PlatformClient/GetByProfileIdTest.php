<?php

namespace NextCaller\Test\PlatformClientMocker;

use NextCaller\NextCallerPlatformClient;

class GetByProfileIdTest extends \PHPUnit_Framework_TestCase
{
    const JSON_RESPONSE = '{"id":"12848e91004c7bdbd77fcc2be75e5b","first_name":"Nyquela","middle_name":"","last_name":"Fields","name":"Nyquela Fields","language":"English","phone":[{"number":"2125558383","resource_uri":"/v2/records/2125558383/"}],"carrier":"","address":[{"city":"Powder Springs","extended_zip":"6781","country":"USA","line1":"149 Yellowstone Dr","line2":"","state":"GA","zip_code":"30127"}],"line_type":"","department":"not specified","resource_uri":"/v2/users/12848e91004c7bdbd77fcc2be75e5b/"}';
    const PROFILE_ID = '12848e91004c7bdbd77fcc2be75e5b';
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

    public function testGetByProfileIdTest() {
        $client = self::$client;
        $profile = $client->getByProfileId(self::PROFILE_ID, self::PLATFORM_ACCOUNT_ID);
        $this->assertEquals($profile, json_decode(self::JSON_RESPONSE, true));
    }

}