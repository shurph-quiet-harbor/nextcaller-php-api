<?php

namespace NextCaller\Test\PlatformClient;

use NextCaller\NextCallerPlatformClient;

class GetPlatformAccount extends \PHPUnit_Framework_TestCase
{
    const JSON_RESPONSE = '{"username":"user12345","first_name":"","last_name":"","company_name":"","email":"","number_of_operations":0,"total_operations":[],"billed_operations":[],"resource_uri":"/v2/platform_users/user12345/"}';

    const PROFILE_PHONE = '2125558383';
    const PLATFORM_ACCOUNT_ID = 'user12345';

    public function testGetPlatformAccount() {
        $client = new NextCallerPlatformClient(null, null, true);
        $data = $client->getPlatformAccount(self::PLATFORM_ACCOUNT_ID);
        $this->assertTrue(!empty($data));
    }

}