<?php

require(__DIR__ . '/vendor/autoload.php');

use NextCaller\NextCallerClient;

$user = "";
$password = "";
$phoneNumber = "6925558386";
$sandbox = true;

$client = new NextCallerClient($user, $password, $sandbox);
try {
    $records = $client->getProfileByPhone($phoneNumber);
    var_dump($records);
} catch (\NextCaller\Exception\BadResponseException $e) {
    var_dump($e->getCode());
    var_dump($e->getMessage());
    var_dump($e->getError());
    $request = $e->getRequest();
    $response = $e->getResponse();
} catch (\NextCaller\Exception\FormatException $e) {
    var_dump($e->getCode());
    var_dump($e->getMessage());
    $request = $e->getRequest();
    $response = $e->getResponse();
} catch (\Buzz\Exception\RequestException $e) {
    var_dump($e->getCode());
    var_dump($e->getMessage());
    var_dump($e->getRequest());
}