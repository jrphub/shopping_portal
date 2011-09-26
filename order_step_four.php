<?php
ini_set("session.gc_maxlifetime", 20*60);
session_start();
require_once 'includes/config.php';
require_once 'class/sqlFunctions.php';
$sqlObject = new SqlFunctions();
if (!$_SESSION['userId']) {
    header("Location:login.php");
    die();
}
if (!$_SESSION['quantity'] || !$_SESSION['confirmed']) {
    header("Location:index.php");
    die();
}
$updateQuery = "UPDATE xyz_orders SET
                    price = '" . $_SESSION['price'] . "',
                    quantity = '" . $_SESSION['quantity'] . "',
                    total_price = '" . $_SESSION['total_price'] . "',
                    name = '" . $_SESSION['name'] . "',
                    address = '" . $_SESSION['address'] . "',
                    city = '" . $_SESSION['city'] . "',
                    state = '" . $_SESSION['state'] . "',
                    pincode = '" . $_SESSION['pincode'] . "',
                    phone = '" . $_SESSION['phone'] . "',
                    status = 'processing',
                    ref_key = '" . $_SESSION['key'] . "',
                    modified_by = '" . $_SESSION['userId'] . "',
                    created = NOW(),
                    modified = NOW()
                WHERE id = '" . $_SESSION['order_id'] . "'";
$sqlObject->executeQuery($updateQuery);

$title = 'Step-4: Order page';
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
    margin-bottom: 10px;
    background: lightgrey;
    height: 510px;
    }

    #heading
    {
        padding-top: 100px;
        font-size: 20px;
        font-weight: bold;
    }
</style>

    <body>
        <div align="center" id="container" style="padding-top: 30px;">
            <div style="color: #726918; font-size: 26px;">Thanks for your order</div>
            <br>
            <br>
            <div style="font-size: 22px;">Your&nbsp;"<?php echo $_SESSION['model_name'];?>" will be delivered within 3-5 business days</div>
            <br>
            <table style="font-size: 18px">
                <tr>
                    <td>
                        Your Reference number
                    </td>
                    <td>
                        <b><?php echo $_SESSION['key']; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>
                    Status:
                    </td>
                    <td>Processing</td>
                </tr>
                <tr>
                    <td>
                        Amount Payable:
                    </td>
                    <td><b>Rs.<?php echo $_SESSION['total_price']; ?></b></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <a href="index.php" class="button">Back to Home</a></td>
                </tr>
            </table>

        </div>

    <?php

require_once 'includes/footer.php';
?>