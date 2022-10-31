<?php
class Order {
    public string $clientName = "";
    public string $firstDish = "";
    public string $secondDish = "";
    public string $drink = "";
    public int    $cost = 0;

    function __construct($params){
        if(is_array($params)){
            if($params["client_name"] != null)
                $this->clientName = $params["client_name"];
            if($params["first_dish"] != null)
                $this->firstDish = $params["first_dish"];
            if($params["second_dish"] != null)
                $this->secondDish = $params["second_dish"];
            if($params["drink"] != null)
                $this->drink = $params["drink"];
            if($params["cost"] != null)
                $this->cost = $params["cost"];
        }
    }
}

class Product {
    public string $productName = "";
    public float $amount = 0;

    function __construct($params){
        if(is_array($params)){
            if($params["product_name"] != null)
                $this->productName = $params["product_name"];
            if($params["amount"] != null)
                $this->amount = $params["amount"];
        }
    }
}