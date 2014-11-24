<?php

namespace NextCaller\Test\PlatformClient;

use NextCaller\NextCallerPlatformClient;

class GetFraudLevelTest extends \PHPUnit_Framework_TestCase
{
    const JSON_RESPONSE = '{"spoofed": "unknown","fraud_risk": "medium"}';

    const PROFILE_PHONE = '2125558383';
    const PLATFORM_USERNAME = 'user12345';

    public function testGetFraudLevel() {
        $client = new NextCallerPlatformClient(null, null, true);
        $profile = $client->getFraudLevel(self::PROFILE_PHONE, self::PLATFORM_USERNAME);
        $this->assertEquals($profile, json_decode(self::JSON_RESPONSE, true));
    }

}