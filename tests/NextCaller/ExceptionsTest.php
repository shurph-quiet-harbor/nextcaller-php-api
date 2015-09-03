<?php

namespace NextCaller\Test;

use NextCaller\Exception\BadResponseException;
use NextCaller\NextCallerClient;

class ExceptionsTest extends \PHPUnit_Framework_TestCase
{

    const PROFILE_ID = 'c7c17736128033c92771b7f33fead7';
    const PROFILE_ID_WRONG = '97d949a413f4ea8b85e9586e1';
    const PROFILE_ID_WRONG_FORMAT = '97d949a413f4ea8b85e9586e1ERROR';

    public function testWrongFormat() {
        $client = new NextCallerClient(null, null, true);
        try {
            $client->getByProfileId(self::PROFILE_ID_WRONG_FORMAT);
        } catch (BadResponseException $expected) {
            $this->assertEquals(404, $expected->getResponse()->getStatusCode());
            $this->assertEquals(404, $expected->getCode());
            return;
        }

        $this->fail('An expected exception has not been raised.');
    }

    public function testWrongId() {
        $client = new NextCallerClient(null, null, true);
        try {
            $client->getByProfileId(self::PROFILE_ID_WRONG);
        } catch (BadResponseException $expected) {
            $this->assertEquals(400, $expected->getResponse()->getStatusCode());
            $this->assertEquals(558, $expected->getCode());
            return;
        }

        $this->fail('An expected exception has not been raised.');
    }

    public function testWrongPhone() {
        $client = new NextCallerClient(null, null, true);
        try {
            $client->getByPhone('69255583865');
        } catch (BadResponseException $expected) {
            $this->assertEquals(400, $expected->getResponse()->getStatusCode());
            $this->assertEquals(555, $expected->getCode());
            return;
        }

        $this->fail('An expected exception has not been raised.');
    }

    public function testNotValid() {
        $client = new NextCallerClient(null, null, true);
        try {
            $client->updateByProfileId(self::PROFILE_ID, array('email' => 'XXXXXXXXXXXX'));
        } catch (BadResponseException $expected) {
            $this->assertEquals(400, $expected->getResponse()->getStatusCode());
            $this->assertEquals(422, $expected->getCode());
            return;
        }

        $this->fail('An expected exception has not been raised.');
    }
}