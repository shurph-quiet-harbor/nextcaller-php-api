<?php

namespace NextCaller\Test\ClientMocker;

use NextCaller\NextCallerClient;

class ProfileGetByPhoneTest extends \PHPUnit_Framework_TestCase
{
    const JSON_RESPONSE = '{"records":[{"id":"9a2d1ca6e4d34575c34efc879511a4","first_name":"Benjamin","middle_name":"","last_name":"Knight","name":"Benjamin Knight","language":"English","phone":[{"number":"2125558383","resource_uri":"/v2/records/2125558383/"}],"carrier":"New Cingular Wireless Pcs, Llc - Ga","address":[{"city":"West Palm Beach","extended_zip":"2414","country":"USA","line1":"1437 Palm Beach Lakes Blvd","line2":"","state":"FL","zip_code":"33401"}],"relatives":[],"email":"ussvijmwhf@example.com","linked_emails":[],"dob":"","age":"65+","education":"","gender":"Male","high_net_worth":"","home_owner_status":"Own","household_income":"15k-25k","length_of_residence":"20+ years","line_type":"Mobile","marital_status":"Single","market_value":"100k-150k","occupation":"","presence_of_children":"No","department":"not specified","resource_uri":"/v2/users/9a2d1ca6e4d34575c34efc879511a4/"}]}';

    const PROFILE_PHONE = '2125558383';


    protected static $mock;
    /** @var  NextCallerClient client */
    protected static $client;

    public static function setUpBeforeClass() {
        $client = new NextCallerClient(null, null, true);
        $mocker = new \Guzzle\Plugin\Mock\MockPlugin();
        $mocker->addResponse(new \Guzzle\Http\Message\Response(200, array(), self::JSON_RESPONSE));
        $client->addSubscriber($mocker);
        self::$client = $client;
        self::$mock = $mocker;
    }

    public function testGetByPhone() {
        $client = self::$client;
        $profiles = $client->getByPhone(self::PROFILE_PHONE);
        $this->assertEquals($profiles, json_decode(self::JSON_RESPONSE, true));
    }
}