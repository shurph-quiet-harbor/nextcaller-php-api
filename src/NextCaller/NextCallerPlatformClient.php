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
     * Create array with Nc-Account-Id header if $account_id was provided
     * 
     * @param string $account_id
     * @return array
     */
    protected function compileAccountIdHeaders($account_id = NULL){
        $headers = array();
        if($account_id){
            $headers = array('Nc-Account-Id' => $account_id);
        }
        return $headers;
    }

    /**
     * @link https://nextcaller.com/platform/documentation/#/get-profile/get-profile-id/php
     * @param string $id
     * @param string $account_id
     * @return array
     * @throws FormatException
     */
    public function getByProfileId($id, $account_id = NULL) {
        $headers = $this->compileAccountIdHeaders($account_id);
        $request = $this->browser->get('users/' . $id . '/', array(), $headers);
        return $this->proceedResponse($request);
    }

    /**
     * @link https://nextcaller.com/platform/documentation/#/get-profile/get-profile-phone/php
     * @param string $phone
     * @param string $account_id
     * @return array
     * @throws FormatException
     */
    public function getByPhone($phone, $account_id = NULL) {
        $headers = $this->compileAccountIdHeaders($account_id);
        $params = array('phone' => $phone);
        $request = $this->browser->get('records/', $params, $headers);
        return $this->proceedResponse($request);
    }
    
    /**
     * @link https://nextcaller.com/platform/documentation/#/get-profile/get-profile-name-and-address/php
     * @param array $nameAddressData
     * @param string $account_id
     * @return array
     * @throws FormatException
     */
    public function getByNameAddress($nameAddressData, $account_id = NULL) {
        $headers = $this->compileAccountIdHeaders($account_id);
        $request = $this->browser->get('records/', $nameAddressData, $headers);
        return $this->proceedResponse($request);
    }
    
    /**
     * @link https://nextcaller.com/platform/documentation/#/profiles/get-profile-email/php
     * @param string $email
     * @param string $account_id
     * @return array
     * @throws FormatException
     */
    public function getByEmail($email, $account_id = NULL) {
        $headers = $this->compileAccountIdHeaders($account_id);
        $params = array('email' => $email);
        $request = $this->browser->get('records/', $params, $headers);
        return $this->proceedResponse($request);
    }
    
    /**
     * @link https://nextcaller.com/platform/documentation/#/post-profile/php
     * @param string $id
     * @param array $data
     * @param string $account_id
     * @return array
     */
    public function updateByProfileId($id, $data, $account_id = NULL) {
        $url = 'users/' . $id . '/';
        $headers = $this->compileAccountIdHeaders($account_id);
        $response = $this->browser->post($url, array(), json_encode($data), $headers);
        return $this->proceedResponse($response);
    }

    /**
     * @link https://nextcaller.com/platform/documentation/#/get-fraud-level/php
     * @param $phone
     * @param $account_id
     * @return array
     * @throws Exception\BadResponseException
     * @throws FormatException
     */
    public function getFraudLevel($phone, $account_id = NULL) {
        $headers = $this->compileAccountIdHeaders($account_id);
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
     * @param string $account_id
     * @return array
     * @throws Exception\BadResponseException
     * @throws FormatException
     */
    public function getPlatformAccount($account_id) {
        $request = $this->browser->get('accounts/' . urlencode($account_id) . '/');
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
     * @param string $account_id
     * @param array $data
     * @return array
     * @throws Exception\BadResponseException
     * @throws FormatException
     */
    public function updatePlatformAccount($account_id, $data) {
        $url = 'accounts/' . urlencode($account_id) . '/';
        $response = $this->browser->put($url, array(), json_encode($data));
        return $this->proceedResponse($response);
    }

}