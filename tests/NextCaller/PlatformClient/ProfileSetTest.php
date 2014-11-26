<?php

namespace NextCaller\Test\PlatformClient;

use NextCaller\NextCallerPlatformClient;

class ProfileSetTest extends \PHPUnit_Framework_TestCase
{
    const JSON_DATA = '{
    "first_name": "Clark",
    "last_name": "Kent"
}';
    const PROFILE_ID = '12848e91004c7bdbd77fcc2be75e5b';
    const PLATFORM_USERNAME = 'user12345';

    public function testProfileArray() {
        $client = new NextCallerPlatformClient(null, null, true);
        $data = json_decode(self::JSON_DATA, true);
        $response = $client->setProfile(self::PROFILE_ID, self::PLATFORM_USERNAME, $data);
        $this->assertEquals($response, null);
    }

}