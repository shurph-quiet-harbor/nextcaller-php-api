<?php

require(__DIR__ . '/vendor/autoload.php');

use NextCaller\NextCallerPlatformClient;

$user = "";
$password = "";
$PROFILE_ID = 'e79ba4dab9cdd3da41c95ef734ec5b';
$platformUser = 'user1';
$sandbox = true;

$client = new NextCallerPlatformClient($user, $password, $sandbox);
try {
    $profile = $client->getProfile($PROFILE_ID, $platformUser);
    var_dump($profile);
} catch (\NextCaller\Exception\BadResponseException $e) {
    var_dump($e->getCode());
    var_dump($e->getMessage());
} catch (\NextCaller\Exception\FormatException $e) {
    var_dump($e->getCode());
    var_dump($e->getMessage());
}