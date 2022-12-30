<?php

namespace Project;

class DB{

    private $host;
    private $user;
    private $pass;
    private $db;
    private $port;
    private $connection;

    public function __construct($host = "localhost", $user = "root", $pass = "", $db = "orders", $port = 3306) {
        
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->db = $db;
        $this->port = $port;

        try {
            $this->connection = new \PDO('mysql:host=' . $host . ';dbname=' . $db . ";port=" . $port, $user, $pass);
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function insertItem($order_number, $order_date, $est_delivery, $status_id, $operator_id, $location_id) {

        $sql = "INSERT INTO `order` (id, order_number, order_date, est_delivery, status_id, operator_id, location_id)
                VALUES (NULL, '" . $order_number . "', '" . $order_date . "', '" . $est_delivery . "', '" . $status_id . "', '" . $operator_id . "', '" .  $location_id . "');";
                
        try{
            $this->connection->exec($sql);
            return true;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            return false;
        }
    }

    public function getOrders() {

        $orderItems = [];
        $sql = "SELECT * FROM `order` o
        INNER JOIN `order_location` ol ON o.location_id = ol.order_location_id
        INNER JOIN `order_status` os ON o.status_id = os.order_status_id
        INNER JOIN `operator` op ON o.operator_id = op.operator_id";

        try {
            $query = $this->connection->query($sql);
         while ($row = $query->fetch()){
                 $orderItems[] = [
                    "id" => $row['id'],
                    "order_number" => $row['order_number'],
                    "status_id" => $row['status_id'],
                    "status_name" => $row['status_name'],
                    "operator_id" => $row['operator_id'],
                    "operator_name" => $row['operator_name'],
                    "location_id" => $row['location_id'],
                    "city" => $row['city'],
                    "country" => $row['country'],
                    "distance" => $row['distance'],
                    "order_date" => $row['order_date'],
                    "est_delivery" => $row['est_delivery']
                ];
            }
            return $orderItems;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            return $orderItems;
        }
    }

    public function getStatus() {

        $status = [];

        try {
            $sql = "SELECT * FROM order_status";
            $query = $this->connection->query($sql);
            while ($row = $query->fetch()) {
                $status[] = [
                    "id" => $row['order_status_id'],
                    "name" => $row['status_name']
                ];
            }
            return $status;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            return $status;
        }
    }

    public function getLocation() {
        
        $location = [];
        $sql = "SELECT * FROM order_location";

        try {
            $query = $this->connection->query($sql);
            while($row = $query->fetch()) {
                $location[] = [
                    "id" => $row['order_location_id'],
                    "city" => $row['city'],
                    "country" => $row['country'],
                    "distance" => $row['distance']
                ];
            }
            return $location;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            return $location;
        }
    }

    public function getOperator() {

        $operator = [];
        $sql = "SELECT * FROM operator";

        try {
            $query = $this->connection->query($sql);
            while ($row = $query->fetch()) {
                $operator[] = [
                    "id" => $row['operator_id'],
                    "name" => $row['operator_name']
                ];
            }
            return $operator;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            return $operator;
        }
    }

    public function getOrder($id) {

        $order = [];

        $sql = "SELECT * FROM `order` o
        INNER JOIN `order_location` ol ON o.location_id = ol.order_location_id
        INNER JOIN `order_status` os ON o.status_id = os.order_status_id
        INNER JOIN `operator` op ON o.operator_id = op.operator_id 
        WHERE id=". $id;

        try {
            $query = $this->connection->query($sql);
            if ($row = $query->fetch()){
                $order[] = [
                    "id" => $row['id'],
                    "order_number" => $row['order_number'],
                    "status_id" => $row['status_id'],
                    "status_name" => $row['status_name'],
                    "operator_id" => $row['operator_id'],
                    "operator_name" => $row['operator_name'],
                    "location_id" => $row['location_id'],
                    "city" => $row['city'],
                    "country" => $row['country'],
                    "distance" => $row['distance'],
                    "order_date" => $row['order_date'],
                    "est_delivery" => $row['est_delivery']
                ];
            }
            return $order;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            return $order;
        }
    }

    public function updateOrder($id, $order_number, $order_date, $est_delivery, $status_id, $operator_id, $location_id) {

        $sql = "UPDATE `order` SET 
                   order_number='" . $order_number . "',
                   order_date='" . $order_date . "', 
                   est_delivery='" . $est_delivery . "', 
                   status_id='" . $status_id . "', 
                   operator_id='" . $operator_id . "', 
                   location_id='" . $location_id . "' 
                   WHERE id='" . $id . "';";
                   echo($sql);
        try{
            $this->connection->exec($sql);
            return true;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            return false;
        }
    }

    public function deleteOrder($id) {
        $sql = "DELETE FROM `order` WHERE id= " . $id;
        try {
            $this->connection->exec($sql);
            return true;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            return false;
        }
    }

}