<?php

namespace NextCaller\Exception;

class RateLimitException extends Exception
{   
    public function getRateLimit() {
        $header = $this->response->getHeader(RATE_LIMIT_LIMIT_HEADER)->toArray();
        if(count($header) > 0){
            return $header[0];
        }
        return NULL;
    }
    
    public function getResetTime() {
        $header = $this->response->getHeader(RATE_LIMIT_RESET_HEADER)->toArray();
        if(count($header) > 0){
            return $header[0];
        }
        return NULL;
    }
}