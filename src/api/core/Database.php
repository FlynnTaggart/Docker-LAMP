<?php

require_once 'DatabaseInt.php';

class Database implements DatabaseInt {
    protected $connection = null;
 
    public function __construct() {
        try {
            $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
         
            if ( mysqli_connect_errno()) {
                throw new Exception("Could not connect to database.");   
            }
        } catch (Exception $e) {
            throw $e;
        }           
    }
 
    public function query($query = "" , $params = []) {
        try {
            $stmt = $this->exec( $query , $params );
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);               
            $stmt->close();
 
            return $result;
        } catch(Exception $e) {
            throw $e;
        }
        return false;
    }
 
    private function exec($query = "" , $params = []) {
        try {
            $stmt = $this->connection->prepare($query);
 
            if($stmt === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }
 
            if( $params ) {
                $stmt->bind_param($params[0], $params);
            }
 
            $stmt->execute();
 
            return $stmt;
        } catch(Exception $e) {
            throw $e;
        }   
    }
}