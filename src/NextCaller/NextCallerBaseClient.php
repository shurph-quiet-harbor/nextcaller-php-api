<?php

namespace NextCaller;

use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Http\Message\Request;
use NextCaller\Exception\BadResponseException;
use NextCaller\Exception\FormatException;
use NextCaller\Exception\RateLimitException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

abstract class NextCallerBaseClient
{

    /** @var NextCallerBrowser */
    protected $browser;

    /**
     * @param string $user
     * @param string $password
     * @param boolean $sandbox
     */
    public function __construct($user, $password, $sandbox = false) {
        if (empty($user)) {
            $user = getenv('NC_API_KEY');
        }
        if (empty($password)) {
            $password = getenv('NC_API_SECRET');
        }
        $this->browser = new NextCallerBrowser();
        return $this->browser->setSandbox($sandbox)->setAuth($user, $password);
    }

    /**
     * @param EventSubscriberInterface $client
     */
    public function addSubscriber(EventSubscriberInterface $client) {
        $this->browser->getClient()->addSubscriber($client);
    }

    /**
     * @param EventSubscriberInterface $client
     */
    public function removeSubscriber(EventSubscriberInterface $client) {
        $this->browser->getClient()->getEventDispatcher()->removeSubscriber($client);
    }

    /**
     * @param Request $request
     * @return array|null
     * @throws BadResponseException
     * @throws FormatException
     */
    protected function proceedResponse(Request $request) {
        try {
            $response = $request->send();
        } catch (ClientErrorResponseException $e) {
            $response = $e->getResponse();
        }
        $body = $response->getBody(true);
        if (empty($body) && $response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            return null;
        }
        $result = json_decode($body, true);
        if ($result === null) {
            # When response is just a sting.
            $result = $body;
        }
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            return $result;
        }
        if (!$result || !$result['error']) {
            throw new FormatException('Not valid error response', 3, null, $request, $response);
        }
        $message = $result['error']['message'];
        $code = $result['error']['code'];
        if ($response->getStatusCode() == 429) {
            throw new RateLimitException($message, $code, null, $request, $response);
        }
        $e = new BadResponseException($message, $code, null, $request, $response);
        $e->setError($result['error']);
        throw $e;
    }
}