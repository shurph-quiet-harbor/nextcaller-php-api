<?php

namespace NextCaller\Test\PlatformClient;

use NextCaller\NextCallerPlatformClient;

class UpdateByProfileIdTest extends \PHPUnit_Framework_TestCase
{
    const JSON_DATA = '{
    "first_name": "Clark",
    "last_name": "Kent"
}';
    const PROFILE_ID = '12848e91004c7bdbd77fcc2be75e5b';
    const PLATFORM_ACCOUNT_ID = 'user12345';

    public function testProfileArray() {
        $client = new NextCallerPlatformClient(null, null, true);
        $data = json_decode(self::JSON_DATA, true);
        $response = $client->updateByProfileId(self::PROFILE_ID, $data, self::PLATFORM_ACCOUNT_ID);
        $this->assertEquals($response, null);
    }

}