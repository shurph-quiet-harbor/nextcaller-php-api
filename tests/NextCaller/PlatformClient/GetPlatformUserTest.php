<?php

namespace NextCaller\Test\PlatformClient;

use NextCaller\NextCallerPlatformClient;

class GetPlatformUser extends \PHPUnit_Framework_TestCase
{
    const JSON_RESPONSE = '{"username":"user12345","first_name":"","last_name":"","company_name":"","email":"","number_of_operations":0,"total_calls":[],"successful_calls":[],"resource_uri":"/v2/platform_users/user12345/"}';

    const PROFILE_PHONE = '2125558383';
    const PLATFORM_USERNAME = 'user12345';

    public function testGetPlatformUser() {
        $client = new NextCallerPlatformClient(null, null, true);
        $data = $client->getPlatformAccount(self::PLATFORM_USERNAME);
        $this->assertTrue(!empty($data));
    }

}