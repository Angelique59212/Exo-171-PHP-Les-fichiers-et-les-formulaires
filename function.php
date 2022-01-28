<?php

function getRandomFile(String $name):string {
    $infos = pathinfo($name);
    try {
        $bytes = random_bytes(20);
    }
    catch (Exception $fe) {
        $bytes = openssl_random_pseudo_bytes(20);
    }
    return bin2hex($bytes) . '.' . $infos['extension'];
}