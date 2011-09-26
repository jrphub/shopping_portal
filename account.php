<?php
ini_set("session.gc_maxlifetime", 20*60);
session_start();
require_once 'includes/config.php';
require_once 'class/sqlFunctions.php';
$sqlObject = new SqlFunctions();
if (!$_SESSION['userId']) {
    header("Location:index.php");
    die();
}
$itemQuery = "SELECT name, address, city, state, pincode, phone FROM xyz_users WHERE id = " . $_SESSION['userId'];
$item = $sqlObject->executeQuery($itemQuery, 2);
if ($_POST['submit_key'] && strlen($_POST['ref_key']) != 0) {
        $keyQuery = "SELECT P.model_name, O.status FROM xyz_products AS P INNER JOIN
        xyz_orders AS O on O.prod_id = P.prod_id WHERE O.ref_key = " . $_POST['ref_key'];
    $key = $sqlObject->executeQuery($keyQuery, 2);
    if ($key['model_name']) {
       $display = 'block';
       $display_error = 'none';
    } else {
        $display = 'none';
        $display_error = 'block';
    }
} else {
    $display = 'none';
    $display_error = 'none';
}
$title = 'User: Dashboard';
require_once 'includes/header.php';
require_once 'includes/left_sidebar.php';
require_once 'includes/right_sidebar.php';

?>
<link rel="stylesheet" type="text/css" href="css/main.css"/>
<link rel="stylesheet" type="text/css" href="css/button.css"/>
<style type="text/css">
    #container{
    margin-left: 200px;
    margin-right: 180px;
    margin-top: 20px;
    margin-bottom: 20px;
    background: lightgrey;
    height: 540px;
    }

    #heading
    {
        padding-top: 100px;
        font-size: 20px;
        font-weight: bold;
    }
</style>
    <body>
        <div align="center" id="container">
        <div style="font-size: 20px;padding-top: 20px;">Your Address</div>
        <br>
        <?php
        if (!$item['name']) {
            echo "You have not registered your address";
        ?>
        <div><a href="my_address.php" class="button add">Register your address</a></div>
        <?php } else { ?>
            <table>
                <tr>
                    <td><label for="name">Name:</label></td>
                    <td><?php echo $item['name']; ?></td>
                </tr>
                <tr>
                    <td><label for="address">Address:</label></td>
                    <td><?php echo $item['address']; ?></td>
                </tr>
                <tr>
                    <td><label for="city">City:</label></td>
                    <td><?php echo $item['city'];?></td>
                </tr>
                <tr>
                    <td>
                        <label for="state">State:</label>
                    </td>
                    <td>
                        <?php echo $item['state']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Country:</td>
                    <td>India&nbsp;(We only ship within India)</td>
                </tr>
                <tr>
                    <td><label for="pincode">Pincode:</label></td>
                    <td><?php echo $item['pincode'];?></td>
                </tr>
                <tr>
                    <td><label for="phone">Phone:</label></td>
                    <td>+91-<?php echo $item['phone']; ?></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <a href="my_address.php" class="button edit">Edit</a>
                    </td>
                </tr>
                
            </table>
        <?php } ?>
        <div><a href="change_password.php" class="button edit">Change your password</a></div>
        <table>
            <tr>
                <td colspan="2">
                    <div> To know the status of specific order,</div>
                    <div>Submit the reference number of the order</div>
                    <form action="" method="post">
                        <input type ="text" name="ref_key" id="ref_key"/>
                        <input type ="submit" name="submit_key" class="button" id="submit_key" value="Submit" onclick="return validation();"/>
                    </form>
                    
                </td>
            </tr>
            <tr>
                <td style="display:<?php echo $display;?>">
                    <table border="1">
                        <tr>
                            <th>Product Name</th>
                            <th>Status</th>
                        </tr>
                        <tr>
                            <td><?php echo $key['model_name'];?></td>
                            <td><?php echo $key['status']; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2"><div  style="color: RED; display:<?php echo $display_error;?>">Sorry, You have entered wrong Reference number</div></td>
            </tr>
        </table>
        <div><a href="display_orders.php" class="button">See all your orders here</a></div>
        </div>
    <script type="text/javascript">
    function validation(){
        if (document.getElementById("ref_key").value == '') {
            alert("Please enter reference key of the order");
            document.getElementById("ref_key").focus();
            return false;
        }

    }
    </script>
    <?php

require_once 'includes/footer.php';
?>
