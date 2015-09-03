<?php

namespace NextCaller\Test\PlatformClient;

use NextCaller\NextCallerPlatformClient;

class UpdatePlatformAccountTest extends \PHPUnit_Framework_TestCase
{
    const DATA = '{"first_name": "platform_user1_fname"}';
    const RESPONSE_STR = 'Update Received.';
    const PLATFORM_ACCOUNT_ID = 'user12345';

    public function testUpdatePlatformAccount() {
        $client = new NextCallerPlatformClient(null, null, true);
        $data = json_decode(self::DATA);
        $result = $client->updatePlatformAccount(self::PLATFORM_ACCOUNT_ID, $data);
        $this->assertEquals($result, self::RESPONSE_STR);
    }

}