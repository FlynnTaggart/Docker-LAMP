<?php
require_once 'Api.php';
require_once 'Database.php';
require_once 'Models.php';
require_once 'Restaurant.php';

class RestaurantApi extends Api {

    public $apiName = 'orders';

    protected function indexAction() {
        $DB = new Database();

        $limit = $this->requestParams["limit"];

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
        $DB = new Database();

        $id = $this->requestUri[0];

        if($id) {
            try {
                $order = Restaurant::getOrderById($DB, $id);
                if($order)
                    return $this->response($order, 200);
                else
                    return $this->response(array(
                        "message" => "No orders with such id"
                    ), 401);
            } catch (Exception $e) {
                return $this->response(array(
                    "message" => $e->getMessage()
                ), 401);
            }
        }
    }

    protected function createAction() {
        $DB = new Database();

        $order = new Order($this->requestParams);

        try {
            $id = Restaurant::createOrder($DB, $order);
            return $this->response($id, 201);
        } catch (Exception $e) {
            return $this->response(array(
                "message" => $e->getMessage()
            ), 401);
        }
    }

    protected function updateAction() {
        $DB = new Database();

        $order = new Order($this->requestParams);
        $id = $this->requestUri[0];

        try {
            Restaurant::updateOrderById($DB, $order, $id);
            return $this->response(array(
                "id" => $id
            ), 201);
        } catch (Exception $e) {
            return $this->response(array(
                "message" => $e->getMessage()
            ), 401);
        }
    }

    protected function deleteAction() {
        $DB = new Database();

        $id = $this->requestUri[0];

        if($id) {
            try {
                Restaurant::delteOrderById($DB, $id);
                return $this->response(array(
                    "id" => $id
                ), 201);
            } catch (Exception $e) {
                return $this->response(array(
                    "message" => $e->getMessage()
                ), 401);
            }
        }
    }
}