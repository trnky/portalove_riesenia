<?php
include_once"header.php";

if(isset($_GET['id'])) {
    $deleteOrder = $db->deleteOrder($_GET['id']);
    var_dump($deleteOrder);

    if($deleteOrder) {
        header("Location: index.php");
    } else {
        echo "ERROR!!!";
    }
} else {
    echo "ERROR!!!";
}
?>