<?php
session_start();

$redis = new Redis();
$redis->connect('redis', 6379);

$redis_data = json_decode($redis->get($_SERVER['PHP_AUTH_USER']));

if (!$redis_data) {
    $default_data = [
        "theme" => 'light',
        "language" => 'en',
        "nickname" => '',
    ];

    $default_data_redis = json_encode($default_data);

    $redis->set($_SERVER['PHP_AUTH_USER'], $default_data_redis);

    $redis_data = json_decode($default_data_redis);
}

$_SESSION['theme'] = $redis_data->theme;
$_SESSION['language'] = $redis_data->language;
$_SESSION['nickname'] = $redis_data->nickname;


