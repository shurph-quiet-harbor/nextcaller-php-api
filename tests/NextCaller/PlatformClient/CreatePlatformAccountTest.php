<?php

namespace NextCaller\Test\PlatformClient;

use NextCaller\NextCallerPlatformClient;

class CreatePlatformAccountTest extends \PHPUnit_Framework_TestCase
{
    const DATA = '{"first_name": "platform_user1_fname", "id": "user12345"}';
    const RESPONSE_STR = 'Successfully created.';
    const PROFILE_PHONE = '2125558383';

    public function testCreatePlatformAccount() {
        $client = new NextCallerPlatformClient(null, null, true);
        $data = json_decode(self::DATA);
        $result = $client->createPlatformAccount($data);
        $this->assertEquals($result, self::RESPONSE_STR);
    }

}