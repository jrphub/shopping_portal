<?php
ini_set("session.gc_maxlifetime", 20*60);
session_start();
require_once 'includes/config.php';
require_once 'class/sqlFunctions.php';
$sqlObject = new SqlFunctions();

if (!$_GET['prod_id']) {
    header("Location:index.php");
    die();
}
$_SESSION['prod_id'] = $_GET['prod_id'];

if (!$_SESSION['userId']) {
    header("Location:login.php");
    die();
}

$itemQuery = "SELECT model_name, price, thumbnail FROM xyz_products WHERE prod_id = " . $_GET['prod_id'];
$item = $sqlObject->executeQuery($itemQuery, 2);
if ($_POST['submit']) {
    $_SESSION['model_name'] = $item['model_name'];
    $_SESSION['price'] = $item['price'];
    $_SESSION['quantity'] = $_POST['quantity'];
    $_SESSION['total_price'] = $item['price'] * $_POST['quantity'];
    header("Location:order_step_two.php");
    die();
}
$title = 'Order page';
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
    background: #EEEEEE;
    height: 490px;
    }

    #heading
    {
        padding-top: 100px;
        font-size: 20px;
        font-weight: bold;
    }
    td
    {
        text-align: center;
        
    }
    th
    {
       padding: 5px;
       background-color: #E6C18E;
    }
    table
    {
        border-collapse: collapse;
        border-color: #888888;
    }
</style>

    <body>
        <div align="center" id="container" style="padding-top: 50px;">
        <form action=""  method="post">
        <table border="1">
            <tr>
                <th>Item</th>
                <th>Item description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
            <tr>
                <td>
                    <img alt="<?php echo $item['model_name']; ?>"  src="images/<?php echo $item['thumbnail'];?>">
                </td>
                <td>
                    <?php echo $item['model_name']; ?>
                </td>
                <td>
                   Rs. <?php echo $item['price']; ?>
                </td>
                <td>
                    <input type="text" name="quantity" value="
                   <?php
                   if ($_POST['quantity'])
                       echo $_POST['quantity'];
                   else
                       echo "1";
                   ?>"/>
                </td>
                <td>
                    Rs. <?php echo $item['price']; ?>
                    <div>(Free shipping charge)</div>
                </td>
            </tr>
        </table>
            <input type="submit" name="submit" class="button" value="Place an order"/>
        </form>
        </div>
    <?php

require_once 'includes/footer.php';
?>