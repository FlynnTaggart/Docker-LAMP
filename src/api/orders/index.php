<?php
define("DB_HOST", "mysql");
define("DB_USER", "user");
define("DB_PASSWORD", "sayhi");
define("DB_DATABASE_NAME", "appDB");

require '../core/RestaurantApi.php';


error_reporting(E_ERROR | E_PARSE);

try {
    $api = new RestaurantApi();
    echo $api->run();
}
catch (Exception $e) {
    echo json_encode(Array('message' => $e->getMessage()));
}

?>