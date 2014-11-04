<?php

namespace NextCaller\Test;

use NextCaller\Client;

class ProfileGetByPhoneTest extends \PHPUnit_Framework_TestCase
{
    const JSON_RESPONSE = '{"records":[{"id":"97d949a413f4ea8b85e9586e1f2d9a","first_name":"Jerry","middle_name":"","last_name":"Seinfeld","name":"Jerry Seinfeld","language":"English","phone":[{"number":"2125558383","resource_uri":"\/v2\/records\/2125558383\/"}],"carrier":"Verizon Wireless","address":[{"city":"New York","extended_zip":"","country":"USA","line1":"129 West 81st Street","line2":"Apt 5a","state":"NY","zip_code":"10024"}],"relatives":[],"email":"demo@nextcaller.com","linked_emails":["demo@nextcaller.com"],"dob":"","age":"","education":"","gender":"Male","high_net_worth":"","home_owner_status":"","household_income":"","length_of_residence":"","line_type":"","marital_status":"","market_value":"","occupation":"","presence_of_children":"","department":"not specified","resource_uri":"\/v2\/users\/97d949a413f4ea8b85e9586e1f2d9a\/"}]}';

    const PROFILE_PHONE = '2125558383';

    public function testProfileJson() {
        $client = new Client(null, null);
        $profiles = $client->getProfileByPhone(self::PROFILE_PHONE);
        $this->assertEquals($profiles, json_decode(self::JSON_RESPONSE,true));
    }
}