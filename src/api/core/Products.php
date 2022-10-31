<?php
require_once 'Models.php';

class Products {
    public static function getAllProducts(DatabaseInt $DB, $limit = -1){
        if ($limit != -1) {
            try {
                return $DB->query("SELECT * FROM products ORDER BY id ASC LIMIT ?", ["i", $limit]);
            } catch (Exception $e) {
                throw $e;
            }
        }
        else {
            try {
                return $DB->query("SELECT * FROM products ORDER BY id", []);
            } catch (Exception $e) {
                throw $e;
            }
        }
    }

    public static function getProductById(DatabaseInt $DB, $id){
        $res = $DB->query("SELECT * FROM products WHERE id = ? LIMIT 1", ["i", $id]);
        if (count($res) > 0)
            return $res[0];
        else return;
    }

    public static function createProduct(DatabaseInt $DB, Product $product){
        $DB->query("INSERT INTO products (product_name, amount) VALUES (?, ?) ",
            ["sd", $product->productName, $product->amount]);
        $res = $DB->query("SELECT LAST_INSERT_ID() as id", []);
        if(count($res) < 1)
            throw new Exception("Failed to create product");
        return $res[0];
    }

    public static function updateProductById(DatabaseInt $DB, Product $product, $id){
        $res = $DB->query("SELECT * FROM products WHERE id = ? LIMIT 1", ["i", $id]);
        if (count($res) > 0){
            $old_product = new Product($res[0]);

            if($product->clientName == "" && $old_product->clientName != "")
                $product->clientName = $old_product->clientName;
            if($product->amount == 0 && $old_product->amount != 0)
                $product->amount = $old_product->amount;
            
            $DB->query("UPDATE products SET product_name = ?, amount = ? WHERE id = ? ",
                ["sdi", $product->clientName, $product->firstDish, $id]);
            return true;
        }
        else return;
    }

    public static function delteProdcutById(DatabaseInt $DB, $id){
        $DB->query("DELETE FROM products WHERE id = ?", ["i", $id]);
    }
}