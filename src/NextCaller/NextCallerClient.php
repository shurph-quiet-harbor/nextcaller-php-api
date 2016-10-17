<?php

namespace NextCaller;

class NextCallerClient extends NextCallerBaseClient
{
    /**
     * @link https://nextcaller.com/documentation/#/get-profile/get-profile-id/php
     * @param string $id
     * @return array
     * @throws FormatException
     */
    public function getByProfileId($id) {
        $request = $this->browser->get('users/' . $id . '/');
        return $this->proceedResponse($request);
    }

    /**
     * @link https://nextcaller.com/documentation/#/get-profile/get-profile-phone/php
     * @param string $phone
     * @return array
     * @throws FormatException
     */
    public function getByPhone($phone) {
        $request = $this->browser->get('records/', array('phone' => $phone));
        return $this->proceedResponse($request);
    }
    
    /**
     * @link https://nextcaller.com/documentation/#/get-profile/get-profile-name-and-address/php
     * @param array $nameAddressData
     * @return array
     * @throws FormatException
     */
    public function getByNameAddress($nameAddressData) {
        $request = $this->browser->get('records/', $nameAddressData);
        return $this->proceedResponse($request);
    }
    
    /**
     * @link https://nextcaller.com/documentation/#/profiles/retrieve-profile-email/php
     * @param string $email
     * @return array
     * @throws FormatException
     */
    public function getByEmail($email) {
        $request = $this->browser->get('records/', array('email' => $email));
        return $this->proceedResponse($request);
    }

    /**
     * @link https://nextcaller.com/documentation/#/post-profile/php
     * @param string $id
     * @param array $data
     * @return array
     */
    public function updateByProfileId($id, $data) {
        $response = $this->browser->post('users/' . $id . '/', array(), json_encode($data));
        return $this->proceedResponse($response);
    }
}