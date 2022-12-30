<?php
    include_once "header.php";

    $orderItems = $GLOBALS['orderItems'];

    //if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['submit'])) {
        
        
        $insertOrderItem = $db->insertItem($_POST['order_number'], $_POST['order_date'], $_POST['est_delivery'], $_POST['status_id'], $_POST['operator_id'], $_POST['location_id']);

        //var_dump($insertOrderItem);
        if($insertOrderItem) {
            header("Location: index.php");
        } else {
            echo "ERROR!!!";
        }

    } else {
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
                <h2 class="tm-block-title">Create Order</h2>                          
                <form method="post" action="">
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
                                <td><input type="text" name="order_number" value=""></td>                                   
                            </tr>    
                            <tr>
                                <th scope="row"><b>STATUS</b></th>                           
                                <td>
                                    <select name="status_id">
                                        <option value="">--Please choose an option--</option>
                                            <?php
                                                $status = $db->getStatus();                                                
                                                foreach ($status as $item) {
                                                    echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
                                                }
                                            ?>
                                    </select>
                                </td>                                   
                            </tr> 
                            <tr>
                                <th scope="row"><b>OPERATORS</b></th>                           
                                <td>
                                    <select name="operator_id">
                                        <option value="">--Please choose an option--</option>
                                            <?php
                                                $operator = $db->getOperator();
                                                foreach ($operator as $item) {
                                                    echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
                                                }
                                            ?>
                                    </select>
                                </td>                                   
                            </tr>  
                            <tr>
                                <th scope="row"><b>LOCATION</b></th>                           
                                <td>
                                    <select name="location_id">
                                        <option value="">--Please choose an option--</option>
                                            <?php
                                                $location = $db->getLocation();
                                                foreach ($location as $item) {
                                                    echo '<option value="' . $item['id'] . '">' . $item['city'] . ', ' . $item['country'] . ', ' . $item['distance'] .' km </option>';
                                                }
                                            ?>
                                        </select>
                                </td>                                   
                            </tr>  
                            <tr>
                                <th scope="row"><b>START DATE</b></th>                           
                                <td><input type="text" name="order_date" placeholder="YYYY-MM-DD HH:MM:SS" value="<?php  echo(date('Y-m-d H:i:s', time())) ?>"></td>                                   
                            </tr> 
                            <tr>
                                <th scope="row"><b>EST DELIVERY DUE</b></th>                           
                                <td><input type="text" name="est_delivery" placeholder="YYYY-MM-DD HH:MM:SS" value=""></td>                                   
                            </tr> 
                            <tr>
                                <th scope="row"><a href="index.php">RETURN TO PREVIOUS PAGE</a></th>
                                <td><input type="submit" name="submit" value="SAVE NEW ORDER"></td>
                            </tr>                                                          
                        </tbody>
                    </table>
                </form>    
            </div>
        </div>
    </div> 
<?php
    }
?>

