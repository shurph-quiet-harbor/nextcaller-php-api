<?php

namespace NextCaller\Test\PlatformClient;

use NextCaller\NextCallerPlatformClient;

class GetPlatformStatistics extends \PHPUnit_Framework_TestCase
{
    public function testProfileJson() {
        $client = new NextCallerPlatformClient(null, null, true);
        $client->getPlatformStatistics();
        $this->assertTrue(true);
    }

}