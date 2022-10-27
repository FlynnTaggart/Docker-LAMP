<?php
class Restaurant {
    public static function getAllOrders(DatabaseInt $DB, $limit = -1){
        if ($limit == -1) {
            try {
                return $DB->query("SELECT * FROM orders ORDER BY id ASC LIMIT ?", ["i", $limit]);
            } catch (Exception $e) {
                throw $e;
            }
        }
    }

    public static function getOrderById(DatabaseInt $DB, $id = -1){
        $res = $DB->query("SELECT * FROM users WHERE id = ? LIMIT 1", ["i", $id]);
        if (count($res) > 0)
            return $DB->query("SELECT * FROM users WHERE id = ? LIMIT 1", ["i", $id])[0];
        else return;
    }

    public static function createOrder(DatabaseInt $DB, Order $order){
        $DB->query("INSERT INTO orders (client_name, first_dish, second_dish, drink, cost) VALUES (?, ?, ?, ?, ?) RETURNING ",
            ["ssssi", $order->clientName, $order->firstDish, $order->firstDish, $order->drink, $order->cost])[0];
        return $DB->query("SELECT LAST_INSERT_ID()", []);
    }
}