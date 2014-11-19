<?php

namespace NextCaller\Test;

use NextCaller\NextCallerClient;

class ExceptionsMockerTest extends \PHPUnit_Framework_TestCase
{
    const PROFILE_ID = '97d949a413f4ea8b85e9586e1f2d9aERROR';

    protected static $mock;

    public static function setUpBeforeClass() {
        $client = new NextCallerClient(null, null);
        $mocker = new \Guzzle\Plugin\Mock\MockPlugin();
        $mocker->addResponse(new \Guzzle\Http\Message\Response(404,array(),''));
        $client->addSubscriber($mocker);
        self::$mock = $mocker;
    }

    public static function tearDownAfterClass(){
        $client = new NextCallerClient(null, null);
        $client->removeSubscriber(self::$mock);
    }

    public function testProfileArray() {
        $client = new NextCallerClient(null, null);
        try {
            $client->getProfile(self::PROFILE_ID);
        } catch (\Guzzle\Http\Exception\ClientErrorResponseException $expected) {
            $this->assertEquals(404,$expected->getResponse()->getStatusCode());
            return;
        }

        $this->fail('An expected exception has not been raised.');
    }
}