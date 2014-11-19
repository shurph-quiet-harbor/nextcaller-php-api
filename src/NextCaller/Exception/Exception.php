<?php

namespace NextCaller\Exception;

use Guzzle\Http\Message\RequestInterface;
use Guzzle\Http\Message\Response;


class Exception extends \Exception
{

    /** @var Response */
    protected $response;
    /** @var RequestInterface */
    protected $request;

    public function setRequest(RequestInterface $request) {
        $this->request = $request;

        return $this;
    }

    public function getRequest() {
        return $this->request;
    }

    public function setResponse(Response $response) {
        $this->response = $response;

        return $this;
    }

    public function getResponse() {
        return $this->response;
    }
}