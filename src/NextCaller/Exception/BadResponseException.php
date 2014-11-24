<?php

namespace NextCaller\Exception;

class BadResponseException extends Exception
{
    protected $error;

    public function getError() {
        return $this->error;
    }

    public function setError($error) {
        $this->error = $error;
    }
}