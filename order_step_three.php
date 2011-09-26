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
if (!$_SESSION['quantity']) {
    header("Location:index.php");
    die();
}

if ($_POST['submit']) {
    $_SESSION['confirmed'] = 'yes';
    if (!$_SESSION['key'])
        $_SESSION['key'] = rand(100,999) . $_SESSION['order_id'] . rand(10,99);
    header("Location:order_step_four.php");
    die();
}
$title = 'Step-3: Order page';
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
            <div style="font-size: 20px;">Review Your Order</div>
            <br>
            <br>
            <table>
                <tr>
                    <td><b>Item Name:</b></td>
                    <td><?php echo $_SESSION['model_name']; ?></td>
                </tr>
                <tr>
                    <td><b>Quantity:</b></td>
                    <td><?php echo $_SESSION['quantity'];?></td>
                </tr>
                <tr>
                    <td><b>Shipping:</b></td>
                    <td style="color: RED;">FREE</td>
                </tr>
                <tr>
                    <td><b>Amount payable:</b></td>
                    <td>Rs.<?php echo $_SESSION['total_price'];?></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td><?php echo $_SESSION['name'];?></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><?php echo $_SESSION['address'];?></td>
                </tr>
                <tr>
                    <td>City:</td>
                    <td><?php echo $_SESSION['city'];?></td>
                </tr>
                <tr>
                    <td>State:</td>
                    <td><?php echo $_SESSION['state'];?></td>
                </tr>
                <tr>
                    <td>Country:</td>
                    <td>India</td>
                </tr>
                <tr>
                    <td>Pin code</td>
                    <td><?php echo $_SESSION['pincode'];?></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><?php echo $_SESSION['phone'];?></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <form action="" method="POST">
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" name="submit" class="button" value="Continue"/>
                        </td>
                    </tr>
                </form>
            </table>
        </div>
    <?php

require_once 'includes/footer.php';
?>