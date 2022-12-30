<?php
include_once "header.php";

$orderItems = $GLOBALS['orderItems'];

if(isset($_POST['submit'])) {
    $updatetOrder = $db->updateOrder($_POST['id'], $_POST['order_number'], $_POST['order_date'], $_POST['est_delivery'], $_POST['status_id'], $_POST['operator_id'], $_POST['location_id']);
    
    if($updatetOrder) {
        header("Location: index.php");
    } else {
        echo "ERROR!!!";
    }
} else {
    if(isset($_GET['id'])) {
        $order = $db->getOrder($_GET['id']);

        include_once "navigation.php";

?>
<div class="container">
   <div class="row">
        <div class="col">
            <p class="text-white mt-5 mb-5">Some text if <b>necessary</b></p>
        </div>
    </div>
    <div class="col-12 tm-block-col">
        <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">           
            <h2 class="tm-block-title">Update Order</h2>                            
            <form method="post" name="addProduct" action="">
                <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ORDER DETAILS</th>
                                    <th scope="col">DATA</th>
                                    
                                </tr>
                            </thead>
                            <tbody>                                
                                <tr>
                                    <th scope="row"><b>ORDER NO.</b></th>                           
                                    <td><input type="text" name="order_number" value="<?php echo $order[0]['order_number'] ?>"></td>                                   
                                </tr>    
                                <tr>
                                    <th scope="row"><b>STATUS</b></th>                           
                                    <td>
                                        <select name="status_id">
                                            <?php
                                                $status = $db->getStatus();                                                
                                                foreach ($status as $item) {
                                                    if ($item['id'] == $order[0]['status_id']) {
                                                        echo '<option value="' . $item['id'] . '" selected>' . $item['name'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </td>                                   
                                </tr> 
                                <tr>
                                    <th scope="row"><b>OPERATORS</b></th>                           
                                    <td>
                                        <select name="operator_id">
                                            <?php
                                                $operator = $db->getOperator();
                                                foreach ($operator as $item) {
                                                    if ($item['id'] == $order[0]['operator_id']) {
                                                        echo '<option value="' . $item['id'] . '" selected>' . $item['name'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </td>                                   
                                </tr>  
                                <tr>
                                    <th scope="row"><b>LOCATION</b></th>                           
                                    <td>
                                        <select name="location_id">
                                            <?php
                                                $location = $db->getLocation();
                                                foreach ($location as $item) {
                                                    if ($item['id'] == $order[0]['location_id']) {
                                                        echo '<option value="' . $item['id'] . '" selected>' . $item['city'] . ', ' . $item['country'] . ', ' . $item['distance'] .' km </option>';
                                                    } else {
                                                        echo '<option value="' . $item['id'] . '">' . $item['city'] . ', ' . $item['country'] . ', ' . $item['distance'] .' km </option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </td>                                   
                                </tr>  
                                <tr>
                                    <th scope="row"><b>START DATE</b></th>                           
                                    <td><input type="text" name="order_date" placeholder="YYYY-MM-DD HH:MM:SS" value="<?php echo $order[0]['order_date'] ?>"></td>                                   
                                </tr> 
                                <tr>
                                    <th scope="row"><b>EST DELIVERY DUE</b></th>                           
                                    <td><input type="text" name="est_delivery" placeholder="YYYY-MM-DD HH:MM:SS" value="<?php echo $order[0]['est_delivery'] ?>"></td>                                   
                                </tr> 
                                <tr>
                                    <th scope="row"><a href="index.php">RETURN TO PREVIOUS PAGE</a></th>
                                    <td>
                                        <input type="hidden" name="id" value="<?php echo $order[0]['id'] ?>">
                                        <input type="submit" name="submit" value="SAVE UPDATED ORDER">
                                    </td>
                                </tr>                                                          
                            </tbody>
                </table>
            </form>    
        </div>
    </div>
    </div>
        <?php
    } else {
        header("Location: index.php");
    }
}
?>

