<?php
class Restaurant {
    public static function getAllOrders(DatabaseInt $DB, $limit = -1){
        if ($limit != -1) {
            try {
                return $DB->query("SELECT * FROM orders ORDER BY id ASC LIMIT ?", ["i", $limit]);
            } catch (Exception $e) {
                throw $e;
            }
        }
        else {
            try {
                return $DB->query("SELECT * FROM orders ORDER BY id", []);
            } catch (Exception $e) {
                throw $e;
            }
        }
    }

    public static function getOrderById(DatabaseInt $DB, $id){
        $res = $DB->query("SELECT * FROM orders WHERE id = ? LIMIT 1", ["i", $id]);
        if (count($res) > 0)
            return $res[0];
        else return;
    }

    public static function createOrder(DatabaseInt $DB, Order $order){
        $DB->query("INSERT INTO orders (client_name, first_dish, second_dish, drink, cost) VALUES (?, ?, ?, ?, ?) ",
            ["ssssi", $order->clientName, $order->firstDish, $order->secondDish, $order->drink, $order->cost])[0];
        $res = $DB->query("SELECT LAST_INSERT_ID() as id", []);
        if(count($res) < 1)
            throw new Exception("Failed to create order");
        return $res[0];
    }

    public static function updateOrderById(DatabaseInt $DB, Order $order, $id){
        $res = $DB->query("SELECT * FROM orders WHERE id = ? LIMIT 1", ["i", $id]);
        if (count($res) > 0){
            $old_order = new Order($res[0]);

            if($order->clientName == "" && $old_order->clientName != "")
                $order->clientName = $old_order->clientName;
            if($order->firstDish == "" && $old_order->firstDish != "")
                $order->firstDish = $old_order->firstDish;
            if($order->secondDish == "" && $old_order->secondDish != "")
                $order->secondDish = $old_order->secondDish;
            if($order->drink == "" && $old_order->drink != "")
                $order->drink = $old_order->drink;
            if($order->cost == 0 && $old_order->clientName != 0)
                $order->cost = $old_order->cost;
            
            $DB->query("UPDATE orders SET client_name = ?, first_dish = ?, second_dish = ?, drink = ?, cost = ? WHERE id = ? ",
                ["ssssii", $order->clientName, $order->firstDish, $order->secondDish, $order->drink, $order->cost, $id]);
            return true;
        }
        else return;
    }

    public static function delteOrderById(DatabaseInt $DB, $id){
        $DB->query("DELETE FROM orders WHERE id = ?", ["i", $id]);
    }
}