<?php

namespace NextCaller;

use Buzz\Browser;
use Buzz\Client\ClientInterface;
use Buzz\Client\Curl;
use Buzz\Listener\BasicAuthListener;
use Buzz\Message\Factory\FactoryInterface;
use Buzz\Message\MessageInterface;
use Buzz\Message\RequestInterface;
use Buzz\Util\Url;

require_once('Constants.php');


class BasicListener implements \Buzz\Listener\ListenerInterface
{
    public function preSend(RequestInterface $request) {
        $request->addHeader('Content-Type: application/json');
    }

    public function postSend(RequestInterface $request, MessageInterface $response) {
    }
}


class NextCallerBrowser extends Browser
{
    protected $hostMask;

    /**
     * @param ClientInterface $client
     * @param FactoryInterface $factory
     */
    public function __construct(ClientInterface $client = null, FactoryInterface $factory = null) {
        parent::__construct($client ?: new Curl(), $factory);
    }

    /**
     * @param boolean $sandbox
     * @return $this
     */
    public function setSandbox($sandbox) {
        $this->hostMask = $sandbox ? BASE_SANDBOX_URL : BASE_URL;
        return $this;
    }

    /**
     * @param string $user
     * @param string $password
     * @return $this
     */
    public function setAuth($user, $password) {
        $this->setListener(new BasicAuthListener($user, $password));
        $this->addListener(new BasicListener());
        return $this;
    }

    /**
     * @param $url
     * @param array $query
     * @param array $headers
     * @return \Buzz\Message\MessageInterface
     */
    public function get($url, $query = array(), $headers = array()) {
        $url = $this->buildUrl($url, $query);
        return parent::get($url, $headers);
    }

    /**
     * @param $url
     * @param array $query
     * @param string $content
     * @param array $headers
     * @return \Buzz\Message\MessageInterface
     */
    public function post($url, $query = array(), $content = '', $headers = array()) {
        $url = $this->buildUrl($url, $query);
        return parent::post($url, $headers, $content);
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $headers
     * @param string $content
     * @return \Buzz\Message\MessageInterface
     */
    public function call($url, $method, $headers = array(), $content = '') {
        if (!$url instanceof Url) {
            $url = new Url($url);
        }
        $response = parent::call($url, $method, $headers, $content);
        return $response;
    }

    /**
     * @param string $url
     * @param array $query
     * @return string
     */
    protected function buildUrl($url, $query = array()) {
        $query = $query + array('format' => 'json');
        foreach ($query as $key => $value) {
            if (empty($value)) {
                unset($query[$key]);
            }
        }
        return sprintf($this->hostMask, DEFAULT_API_VERSION) . $url . '?' . http_build_query($query);
    }

}