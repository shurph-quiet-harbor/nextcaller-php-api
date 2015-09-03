<?php

namespace NextCaller\Test\PlatformClient;

use NextCaller\NextCallerPlatformClient;

class SetPlatformUser extends \PHPUnit_Framework_TestCase
{
    const DATA = '{"first_name": "platform_user1_fname"}';
    const PROFILE_PHONE = '2125558383';
    const PLATFORM_USERNAME = 'user12345';

    public function testSetPlatformUser() {
        $client = new NextCallerPlatformClient(null, null, true);
        $data = json_decode(self::DATA);
        $result = $client->createPlatformAccount(self::PLATFORM_USERNAME, $data);
        $this->assertEquals($result, null);
    }

}