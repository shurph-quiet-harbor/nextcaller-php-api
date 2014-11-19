<?php

namespace NextCaller;

use Guzzle\Http\Client;
use Guzzle\Http\Message\Request;
use NextCaller\Exception\FormatException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

require_once('Constants.php');

class NextCallerClient
{
    /** @var Client */
    protected static $_client;
    /** @var string */
    protected static $_auth;
    /** @var string */
    protected static $_format = 'json';
    /** @var string */
    protected static $_url;

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
        if (empty(self::$_client)) {
            self::$_client = new Client();
        }
        return $this->setBasicAuth($user, $password)->setUrl($sandbox);
    }

    public function addSubscriber(EventSubscriberInterface $client) {
        self::$_client->addSubscriber($client);
    }

    public function removeSubscriber(EventSubscriberInterface $client) {
        self::$_client->getEventDispatcher()->removeSubscriber($client);
    }

    /**
     * @param string $user
     * @param string $password
     * @return $this
     */
    public function setBasicAuth($user, $password) {
        self::$_auth = array($user, $password);
        return $this;
    }

    /**
     * @param boolean $sandbox
     * @return $this
     */
    public function setUrl($sandbox) {
        self::$_url = sprintf($sandbox ? BASE_SANDBOX_URL : BASE_URL, DEFAULT_API_VERSION);
        return $this;
    }

    /**
     * @link https://dev.nextcaller.com/documentation/get-profile/
     * @param string $id
     * @return array
     */
    public function getProfile($id) {
        $response = $this->getProfileResponse($id);
        $response->setAuth(self::$_auth[0], self::$_auth[1]);
        return $this->proceedResponse($response);
    }

    /**
     * @param string $id
     * @internal param string $phone
     * @return Request
     */
    public function getProfileResponse($id) {
        $options = array('query' => array('format' => self::$_format));
        return self::$_client->get(self::$_url . 'users/' . $id . '/', null, $options);
    }

    /**
     * @param string $phone
     * @return array
     */
    public function getProfileByPhone($phone) {
        $response = $this->getProfileByPhoneResponse($phone);
        $response->setAuth(self::$_auth[0], self::$_auth[1]);
        return $this->proceedResponse($response);
    }

    /**
     * @param string $phone
     * @return Request
     */
    public function getProfileByPhoneResponse($phone) {
        $options = array('query' => array('phone' => $phone, 'format' => self::$_format));
        return self::$_client->get(self::$_url . 'records/',null, $options);
    }

    /**
     * @link https://dev.nextcaller.com/documentation/post-profile/
     * @param string $id
     * @param array
     * @return array
     */
    public function setProfile($id, $data) {
        $options = array('query' => array('format' => self::$_format));
        $response = self::$_client->post(self::$_url . 'users/' . $id . '/', null, json_encode($data), $options);
        $response->setAuth(self::$_auth[0], self::$_auth[1]);
        return $this->proceedResponse($response);
    }

    /**
     * @param Request $response
     * @throws FormatException
     * @return array
     */
    protected function proceedResponse(Request $response) {
        $response = $response->send();
        $body = $response->getBody(true);
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300 && empty($body)) {
            return null;
        }
        if ($response->getHeader('content-type') == 'application/json') {
            return $response->json();
        }
        throw new FormatException('Not valid response content type');
    }
}