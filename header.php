<?php
include_once "db.php";
use Project\DB;

$db = new DB ("localhost", "root", "", "orders");

global $orderItems;
$orderItems = $db->getOrders();
?>