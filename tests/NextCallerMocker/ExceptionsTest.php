<?php

namespace NextCaller\Test;

use NextCaller\Client;

class ExceptionsMockerTest extends \PHPUnit_Framework_TestCase
{
    const PROFILE_ID = '97d949a413f4ea8b85e9586e1f2d9aERROR';

    protected static $mock;

    public static function setUpBeforeClass() {
        $client = new Client(null, null);
        $mocker = new \Guzzle\Plugin\Mock\MockPlugin();
        $mocker->addResponse(new \Guzzle\Http\Message\Response(404,array(),''));
        $client->addSubscriber($mocker);
        self::$mock = $mocker;
    }

    public static function tearDownAfterClass(){
        $client = new Client(null, null);
        $client->removeSubscriber(self::$mock);
    }

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