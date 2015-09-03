<?php

namespace NextCaller;

use NextCaller\Exception\FormatException;


class NextCallerPlatformClient extends NextCallerBaseClient
{
    /**
     * @param string $user
     * @param string $password
     * @param boolean $sandbox
     */
    public function __construct($user, $password, $sandbox = false) {
        if (empty($user)) {
            $user = getenv('NC_PLATFORM_KEY');
        }
        if (empty($password)) {
            $password = getenv('NC_PLATFORM_SECRET');
        }
        return parent::__construct($user, $password, $sandbox);
    }
    
    /**
     * Create array with Nc-Account-Id header if $accountId was provided
     * 
     * @param string $accountId
     * @return array
     */
    protected function compileAccountIdHeaders($accountId = NULL){
        $headers = array();
        if($accountId){
            $headers = array(NC_ACCOUNT_ID => $accountId);
        }
        return $headers;
    }

    /**
     * @link https://nextcaller.com/platform/documentation/#/get-profile/get-profile-id/php
     * @param string $id
     * @param string $accountId
     * @return array
     * @throws FormatException
     */
    public function getByProfileId($id, $accountId = NULL) {
        $headers = $this->compileAccountIdHeaders($accountId);
        $request = $this->browser->get('users/' . $id . '/', array(), $headers);
        return $this->proceedResponse($request);
    }

    /**
     * @link https://nextcaller.com/platform/documentation/#/get-profile/get-profile-phone/php
     * @param string $phone
     * @param string $accountId
     * @return array
     * @throws FormatException
     */
    public function getByPhone($phone, $accountId = NULL) {
        $headers = $this->compileAccountIdHeaders($accountId);
        $params = array('phone' => $phone);
        $request = $this->browser->get('records/', $params, $headers);
        return $this->proceedResponse($request);
    }
    
    /**
     * @link https://nextcaller.com/platform/documentation/#/get-profile/get-profile-name-and-address/php
     * @param array $nameAddressData
     * @param string $accountId
     * @return array
     * @throws FormatException
     */
    public function getByNameAddress($nameAddressData, $accountId = NULL) {
        $headers = $this->compileAccountIdHeaders($accountId);
        $request = $this->browser->get('records/', $nameAddressData, $headers);
        return $this->proceedResponse($request);
    }
    
    /**
     * @link https://nextcaller.com/platform/documentation/#/profiles/get-profile-email/php
     * @param string $email
     * @param string $accountId
     * @return array
     * @throws FormatException
     */
    public function getByEmail($email, $accountId = NULL) {
        $headers = $this->compileAccountIdHeaders($accountId);
        $params = array('email' => $email);
        $request = $this->browser->get('records/', $params, $headers);
        return $this->proceedResponse($request);
    }
    
    /**
     * @link https://nextcaller.com/platform/documentation/#/post-profile/php
     * @param string $id
     * @param array $data
     * @param string $accountId
     * @return array
     */
    public function updateByProfileId($id, $data, $accountId = NULL) {
        $url = 'users/' . $id . '/';
        $headers = $this->compileAccountIdHeaders($accountId);
        $response = $this->browser->post($url, array(), json_encode($data), $headers);
        return $this->proceedResponse($response);
    }

    /**
     * @link https://nextcaller.com/platform/documentation/#/get-fraud-level/php
     * @param $phone
     * @param $accountId
     * @return array
     * @throws Exception\BadResponseException
     * @throws FormatException
     */
    public function getFraudLevel($phone, $accountId = NULL) {
        $headers = $this->compileAccountIdHeaders($accountId);
        $params = array('phone' => $phone);
        $response = $this->browser->get('fraud/', $params, $headers);
        return $this->proceedResponse($response);
    }

    /**
     * @link https://nextcaller.com/platform/documentation/#/get-summary/php
     * @param int $page
     * @return array
     * @throws Exception\BadResponseException
     * @throws FormatException
     */
    public function getPlatformStatistics($page = 1) {
        $response = $this->browser->get('accounts/', array('page' => $page));
        return $this->proceedResponse($response);
    }

    /**
     * @link https://nextcaller.com/platform/documentation/#/get-platform-user/php
     * @param string $accountId
     * @return array
     * @throws Exception\BadResponseException
     * @throws FormatException
     */
    public function getPlatformAccount($accountId) {
        $request = $this->browser->get('accounts/' . urlencode($accountId) . '/');
        return $this->proceedResponse($request);
    }

    /**
     * @link https://nextcaller.com/platform/documentation/#/accounts/post-platform-account/php
     * @param array $data
     * @return array
     * @throws Exception\BadResponseException
     * @throws FormatException
     */
    public function createPlatformAccount($data) {
        $response = $this->browser->post('accounts/', array(), json_encode($data));
        return $this->proceedResponse($response);
    }
    
    /**
     * @link https://nextcaller.com/platform/documentation/#/post-platform-user/php
     * @param string $accountId
     * @param array $data
     * @return array
     * @throws Exception\BadResponseException
     * @throws FormatException
     */
    public function updatePlatformAccount($accountId, $data) {
        $url = 'accounts/' . urlencode($accountId) . '/';
        $response = $this->browser->put($url, array(), json_encode($data));
        return $this->proceedResponse($response);
    }

}