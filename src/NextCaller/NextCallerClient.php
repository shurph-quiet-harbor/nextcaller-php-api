<?php

namespace NextCaller;

class NextCallerClient extends NextCallerBaseClient
{
    /**
     * @link https://nextcaller.com/documentation/#/get-profile/php
     * @param string $id
     * @return array
     * @throws FormatException
     */
    public function getProfile($id) {
        $request = $this->browser->get('users/' . $id . '/');
        return $this->proceedResponse($request);
    }

    /**
     * @link https://nextcaller.com/documentation/#/get-profile/php
     * @param string $phone
     * @return array
     * @throws FormatException
     */
    public function getProfileByPhone($phone) {
        $request = $this->browser->get('records/', array('phone' => $phone));
        return $this->proceedResponse($request);
    }

    /**
     * @link https://nextcaller.com/documentation/#/post-profile/php
     * @param string $id
     * @param array $data
     * @return array
     */
    public function setProfile($id, $data) {
        $response = $this->browser->post('users/' . $id . '/', array(), json_encode($data));
        return $this->proceedResponse($response);
    }

    /**
     * @link https://nextcaller.com/documentation/#/get-fraud-level/php
     * @param $phone
     * @param $platformUsername
     * @return array
     * @throws Exception\BadResponseException
     * @throws FormatException
     */
    public function getFraudLevel($phone, $platformUsername) {
        $response = $this->browser->get('fraud/', array('phone' => $phone, 'platform_username' => $platformUsername));
        return $this->proceedResponse($response);
    }
}