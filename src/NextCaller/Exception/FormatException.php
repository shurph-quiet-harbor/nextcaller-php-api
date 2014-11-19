<?php

namespace NextCaller\Exception;

use Guzzle\Http\Exception\BadResponseException;

class FormatException extends Exception
{

    public function __construct($message, $code = 0, \Exception $previous = null, $request = null, $response = null) {

        parent::__construct($message, $code, $previous);

        if ($previous instanceof BadResponseException) {
            $request = $previous->getRequest();
            $response = $previous->getResponse();
        }

        $this->setRequest($request);
        $this->setResponse($response);

    }
}