<?php
require_once 'Api.php';
require_once 'Database.php';
require_once 'Models.php';
require_once 'Restaurant.php';

class RestaurantApi extends Api {

    public $apiName = 'orders';

    protected function indexAction() {
        $DB = new Database();

        $limit = $this->requestParams[0];

        if($limit) {
            try {
                $orders = Restaurant::getAllOrders($DB, $limit);
                return $this->response($orders, 200);
            } catch (Exception $e) {
                return $this->response(array(
                    "message" => $e->getMessage()
                ), 401);
            }
        }
        try {
            $orders = Restaurant::getAllOrders($DB);
            return $this->response($orders, 200);
        } catch (Exception $e) {
            return $this->response(array(
                "message" => $e->getMessage()
                ), 401);
        }
    }

    protected function viewAction() {
        return $this->response("Lox", 405);
    }

    protected function createAction() {
        return $this->response("Lox", 405);
    }

    protected function updateAction() {
        return $this->response("Lox", 405);
    }

    protected function deleteAction() {
        return $this->response("Lox", 405);
    }
}