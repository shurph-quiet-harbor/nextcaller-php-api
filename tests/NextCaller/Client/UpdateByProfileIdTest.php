<?php

namespace NextCaller\Test;

use NextCaller\NextCallerClient;

class UpdateByProfileIdTest extends \PHPUnit_Framework_TestCase
{
    const JSON_DATA = '{
    "first_name": "Clark",
    "last_name": "Kent"
}';
    const PROFILE_ID = 'c7c17736128033c92771b7f33fead7';

    public function testUpdateByProfileId() {
        $client = new NextCallerClient(null, null, true);
        $data = json_decode(self::JSON_DATA, true);
        $response = $client->updateByProfileId(self::PROFILE_ID, $data);
        $this->assertEquals($response, null);
    }

}