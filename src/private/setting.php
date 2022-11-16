<?php
include 'session.php';

$data_redis = json_encode([
    "theme" => $_POST['theme'],
    "language" => $_POST['language'],
    "nickname" => $_POST['nickname'],
]);

$redis->set($_SERVER['PHP_AUTH_USER'], $data_redis);

$_SESSION['theme'] = $_POST['theme'];
$_SESSION['language'] = $_POST['language'];
$_SESSION['nickname'] = $_POST['nickname'];

header('Location: /private/index.php');