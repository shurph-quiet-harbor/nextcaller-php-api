<?php

namespace NextCaller;

use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Http\Message\Request;
use NextCaller\Exception\BadResponseException;
use NextCaller\Exception\FormatException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class NextCallerClient
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
     * @link https://nextcaller.com/documentation/#/get-profile/php
     * @param string $id
     * @param $platformUsername
     * @return array
     * @throws FormatException
     */
    public function getProfile($id, $platformUsername = null) {
        $request = $this->browser->get('users/' . $id . '/', array('platform_username' => $platformUsername));
        return $this->proceedResponse($request);
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
            throw new FormatException('JSON parse error', 1, null, $request, $response);
        }
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            return $result;
        }
        if (!$result || !$result['error']) {
            throw new FormatException('Not valid error response', 3, null, $request, $response);
        }
        $e = new BadResponseException($result['error']['message'], $result['error']['code'], null, $request, $response);
        $e->setError($result['error']);
        throw $e;
    }

    /**
     * @link https://nextcaller.com/documentation/#/get-profile/php
     * @param string $phone
     * @param null $platformUsername
     * @return array
     * @throws FormatException
     */
    public function getProfileByPhone($phone, $platformUsername = null) {
        $request = $this->browser->get('records/', array('phone' => $phone, 'platform_username' => $platformUsername));
        return $this->proceedResponse($request);
    }

    /**
     * @link https://nextcaller.com/documentation/#/post-profile/php
     * @param string $id
     * @param array $data
     * @param string $platformUsername
     * @return array
     */
    public function setProfile($id, $data, $platformUsername = null) {
        $response = $this->browser->post('users/' . $id . '/',
            array('platform_username' => $platformUsername),
            json_encode($data));
        return $this->proceedResponse($response);
    }

    /**
     * @link https://nextcaller.com/documentation/#/get-fraud-level/php
     * @param $phone
     * @param $platformUsername
     * @return array
     * @throws Exception\BadResponseException
     * @throws FormatException
     */
    public function getFraudLevel($phone, $platformUsername) {
        $response = $this->browser->get('fraud/',
            array('phone' => $phone, 'platform_username' => $platformUsername));
        return $this->proceedResponse($response);
    }
}