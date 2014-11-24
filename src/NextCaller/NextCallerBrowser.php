<?php

namespace NextCaller;

use Guzzle\Http\Client;

require_once('Constants.php');


class NextCallerBrowser
{
    protected $user;
    protected $password;
    /** @var Client client */
    protected $client;

    public function __construct(Client $client = null) {
        if (empty($client)) {
            $client = new Client();
        }
        $this->client = $client;
    }

    public function getClient() {
        return $this->client;
    }

    /**
     * @param boolean $sandbox
     * @return $this
     */
    public function setSandbox($sandbox) {
        $this->client->setBaseUrl(sprintf($sandbox ? BASE_SANDBOX_URL : BASE_URL, DEFAULT_API_VERSION));
        return $this;
    }

    /**
     * @param string $user
     * @param string $password
     * @return $this
     */
    public function setAuth($user, $password) {
        $this->user = $user;
        $this->password = $password;
        return $this;
    }

    public function get($url, $query = array(), $headers = array()) {
        $request = $this->client->get($url, $this->buildHeaders($headers), $this->buildOptions($query));
        $request->setAuth($this->user, $this->password);
        return $request;
    }

    public function buildHeaders($headers) {
        return array('Content-Type' => 'application/json') + $headers;
    }

    /**
     * @param array $query
     * @return string
     */
    protected function buildOptions($query = array()) {
        $query = $query + array('format' => 'json');
        foreach ($query as $key => $value) {
            if (empty($value)) {
                unset($query[$key]);
            }
        }
        return array(
            'query' => $query,
        );
    }

    public function post($url, $query = array(), $content = '', $headers = array()) {
        $request = $this->client->post($url, $this->buildHeaders($headers), $content, $this->buildOptions($query));
        $request->setAuth($this->user, $this->password);
        return $request;
    }

}