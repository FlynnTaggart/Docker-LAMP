<?php
require_once 'Api.php';
require_once 'Database.php';
require_once 'Models.php';
require_once 'Products.php';

class ProductsApi extends Api {

    public $apiName = 'products';

    protected function indexAction() {
        $DB = new Database();

        $limit = $this->requestParams["limit"];

        if($limit) {
            try {
                $products = Products::getAllProducts($DB, $limit);
                return $this->response($products, 200);
            } catch (Exception $e) {
                return $this->response(array(
                    "message" => $e->getMessage()
                ), 401);
            }
        }
        try {
            $products = Products::getAllProducts($DB);
            return $this->response($products, 200);
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
                $product = Products::getProductById($DB, $id);
                if($product)
                    return $this->response($product, 200);
                else
                    return $this->response(array(
                        "message" => "No products with such id"
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

        $product = new Product($this->requestParams);

        try {
            $id = Products::createProduct($DB, $product);
            return $this->response($id, 201);
        } catch (Exception $e) {
            return $this->response(array(
                "message" => $e->getMessage()
            ), 401);
        }
    }

    protected function updateAction() {
        $DB = new Database();

        $product = new Product($this->requestParams);
        $id = $this->requestUri[0];

        try {
            Products::updateProductById($DB, $product, $id);
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
                Products::delteProdcutById($DB, $id);
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