<?php

namespace NextCaller\Exception;

use Guzzle\Http\Message\RequestInterface;
use Guzzle\Http\Message\Response;


class BadResponseException extends Exception
{
    public function __construct(\Guzzle\Http\Exception\BadResponseException $previous = null) {
        try {
            $json = $previous->getResponse()->json();
            $message = $json['error']['message'];
            $code = intval($json['error']['code']);
        } catch (\Exception $exception) {
            throw new FormatException('Not valid error response content type', 0, $previous);
        }
        parent::__construct($message, $code, $previous);

        $this->setResponse($previous->getResponse());
        $this->setRequest($previous->getRequest());
    }
}