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
     * @link https://nextcaller.com/platform/documentation/get-profile-id/
     * @param string $id
     * @param $platformUsername
     * @return array
     * @throws FormatException
     */
    public function getProfile($id, $platformUsername) {
        $request = $this->browser->get('users/' . $id . '/', array('platform_username' => $platformUsername));
        return $this->proceedResponse($request);
    }

    /**
     * @link https://nextcaller.com/platform/documentation/get-profile/
     * @param string $phone
     * @param null $platformUsername
     * @return array
     * @throws FormatException
     */
    public function getProfileByPhone($phone, $platformUsername) {
        $request = $this->browser->get('records/', array('phone' => $phone, 'platform_username' => $platformUsername));
        return $this->proceedResponse($request);
    }

    /**
     * @link https://nextcaller.com/platform/documentation/post-profile/
     * @param string $id
     * @param array $data
     * @param string $platformUsername
     * @return array
     */
    public function setProfile($id, $platformUsername, $data) {
        $url = 'users/' . $id . '/';
        $response = $this->browser->post($url, array('platform_username' => $platformUsername), json_encode($data));
        return $this->proceedResponse($response);
    }

    /**
     * @link https://nextcaller.com/platform/documentation/get-fraud-level/
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

    /**
     * @link https://nextcaller.com/platform/documentation/get-summary/
     * @return array
     * @throws Exception\BadResponseException
     * @throws FormatException
     */
    public function getPlatformStatistics() {
        $response = $this->browser->get('platform_users/');
        return $this->proceedResponse($response);
    }

    /**
     * @link https://nextcaller.com/platform/documentation/get-platform-user/
     * @param $platformUsername
     * @return array
     * @throws Exception\BadResponseException
     * @throws FormatException
     * @internal param string $phone
     */
    public function getPlatformUser($platformUsername) {
        $request = $this->browser->get('platform_users/' . urlencode($platformUsername) . '/');
        return $this->proceedResponse($request);
    }

    /**
     * @link https://nextcaller.com/platform/documentation/post-platform-user/
     * @param $platformUsername
     * @param $data
     * @return array
     * @throws Exception\BadResponseException
     * @throws FormatException
     * @internal param string $id
     * @internal param $array
     */
    public function updatePlatformUser($platformUsername, $data) {
        $url = 'platform_users/' . urlencode($platformUsername) . '/';
        $response = $this->browser->post($url, array(), json_encode($data));
        return $this->proceedResponse($response);
    }

}