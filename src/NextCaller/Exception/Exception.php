<?php

namespace NextCaller\Exception;

use Guzzle\Http\Message\Request;
use Guzzle\Http\Message\Response;

class Exception extends \Exception
{

    /** @var Response */
    protected $response;
    /** @var Request */
    protected $request;

    public function __construct($message, $code = 0, \Exception $previous = null, $request = null, $response = null) {
        parent::__construct($message, $code, $previous);
        $this->setRequest($request);
        $this->setResponse($response);
    }

    public function getRequest() {
        return $this->request;
    }

    public function setRequest(Request $request) {
        $this->request = $request;
        return $this;
    }

    public function getResponse() {
        return $this->response;
    }

    public function setResponse(Response $response) {
        $this->response = $response;
        return $this;
    }
}