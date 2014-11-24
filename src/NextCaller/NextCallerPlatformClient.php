<?php

namespace NextCaller;

use NextCaller\Exception\FormatException;


class NextCallerPlatformClient extends NextCallerClient
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

    public function getProfile($id, $platformUsername = null) {
        return parent::getProfile($id, $platformUsername);
    }

    public function getProfileByPhone($phone, $platformUsername = null) {
        return parent::getProfileByPhone($phone, $platformUsername);
    }

    public function setProfile($id, $data, $platformUsername = null) {
        return parent::setProfile($id, $data, $platformUsername);
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
        $response =
            $this->browser->post('platform_users/' . urlencode($platformUsername) . '/', array(), json_encode($data));
        return $this->proceedResponse($response);
    }

}