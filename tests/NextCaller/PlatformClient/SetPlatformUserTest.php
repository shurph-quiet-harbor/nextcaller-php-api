<?php

namespace NextCaller\Test\PlatformClient;

use NextCaller\NextCallerPlatformClient;

class SetPlatformUser extends \PHPUnit_Framework_TestCase
{
    const DATA = '{
    "first_name": "platform_user1_fname",
}';
    const JSON_RESPONSE = '{"username":"user12345","first_name":"","last_name":"","company_name":"","email":"","number_of_operations":31,"total_calls":{"2014-11":31},"successful_calls":{"2014-11":31},"resource_uri":"/v2/platform_users/user12345/"}';

    const PROFILE_PHONE = '2125558383';
    const PLATFORM_USERNAME = 'user12345';

    public function testSetPlatformUser() {
        $client = new NextCallerPlatformClient(null, null, true);
        $data = json_decode(self::DATA);
        $result = $client->updatePlatformUser(self::PLATFORM_USERNAME, $data);
        $this->assertEquals($result, null);
    }

}