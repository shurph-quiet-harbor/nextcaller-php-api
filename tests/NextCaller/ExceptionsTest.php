<?php

namespace NextCaller\Test;

use NextCaller\Client;
use NextCaller\Exception\NoContentException;

class ExceptionsTest extends \PHPUnit_Framework_TestCase
{

    const PROFILE_ID = '97d949a413f4ea8b85e9586e1ERROR';

    public function testProfileArray() {
        $client = new Client(null, null);
        try {
            $response = $client->getProfile(self::PROFILE_ID);
        } catch (\Guzzle\Http\Exception\ClientErrorResponseException $expected) {
            $this->assertEquals(404,$expected->getResponse()->getStatusCode());
            return;
        }

        $this->fail('An expected exception has not been raised.');
    }

}