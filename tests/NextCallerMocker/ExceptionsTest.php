<?php

namespace NextCaller\Test\Mocker;

use NextCaller\Exception\BadResponseException;
use NextCaller\NextCallerClient;

class ExceptionsMockerTest extends \PHPUnit_Framework_TestCase
{

    const PROFILE_ID = 'c7c17736128033c92771b7f33fead7';
    const PROFILE_ID_WRONG = '97d949a413f4ea8b85e9586e1';
    const PROFILE_ID_WRONG_FORMAT = '97d949a413f4ea8b85e9586e1ERROR';

    protected static $mock;
    /** @var  NextCallerClient client */
    protected static $client;

    public static function setUpBeforeClass() {
        $client = new NextCallerClient(null, null, true);
        $mocker = new \Guzzle\Plugin\Mock\MockPlugin();
        $mocker->addResponse(new \Guzzle\Http\Message\Response(404,
            array(),
            '{"error": {"message": "Resource hasn\'t been found .", "code": "404", "type": "Bad Request"}}'));
        $mocker->addResponse(new \Guzzle\Http\Message\Response(400,
            array(),
            '{"error": {"message": "The profile id you have entered is invalid. Please ensure your profile id contains 30 symbols.", "code": "558", "type": "Bad Request"}}'));
        $mocker->addResponse(new \Guzzle\Http\Message\Response(400,
            array(),
            '{"error": {"message": "Validation Error", "code": "422", "type": "Unprocessable Entity", "description": {"email": ["Invalid email address"]}}}'));
        $client->addSubscriber($mocker);
        self::$client = $client;
        self::$mock = $mocker;
    }

    public static function tearDownAfterClass(){
        $client = self::$client;
        $client->removeSubscriber(self::$mock);
    }

    public function testWrongFormat() {
        $client = self::$client;
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
        $client = self::$client;
        try {
            $client->getByProfileId(self::PROFILE_ID_WRONG);
        } catch (BadResponseException $expected) {
            $this->assertEquals(400, $expected->getResponse()->getStatusCode());
            $this->assertEquals(558, $expected->getCode());
            return;
        }

        $this->fail('An expected exception has not been raised.');
    }

    public function testNotValid() {
        $client = self::$client;
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