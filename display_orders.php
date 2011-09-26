<?php
ini_set("session.gc_maxlifetime", 20*60);
session_start();
require_once 'includes/config.php';
require_once 'class/sqlFunctions.php';
require_once('class/paging_class.php');
$sqlObject = new SqlFunctions();
$pagingObject = new Paging();
if (!$_SESSION['userId']) {
    header("Location:index.php");
    die();
}
$itemQuery = "SELECT P.thumbnail, P.model_name,O.id, O.quantity, O.total_price, O.created, O.ref_key, O.status
            FROM xyz_orders AS O INNER JOIN xyz_products AS P ON P.prod_id = O.prod_id
            WHERE O.user_id=" . $_SESSION['userId'];
$totalItems = $sqlObject->executeQuery($itemQuery, 4);
$startItem = 0;
if ($_REQUEST['page'])
    $activePage = $_REQUEST['page'];
else
    $activePage = 1;
$pagingReturn = $pagingObject->showPaging($totalItems, $activePage, 'Records');
$startItem = $pagingReturn['startItem'];
$itemQuery .= " LIMIT " . $startItem . ", " . ITEMS_PER_PAGE;

$itemResultSet = $sqlObject->executeQuery($itemQuery, 1);
$title = 'All Your Orders';
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
        <div align="center" id="container">
        <?php
        if ($totalItems == 0) {?>
        <div style="padding-top: 30px;">You have not ordered anything yet</div>
        <?php } else {?>
       <h3 style="padding-top: 10px;">All your orders are here</h3>
        <div id="paging">
        <?php echo $pagingReturn['pagingHtml']; ?>
        </div>
        <table border="1">
            <tr>
                <th>Image</th>
                <th>Model</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Ref. No.</th>
                <th>Status</th>
                <th>Ordered On</th>
            </tr>
            <?php while ($itemResult = mysql_fetch_array($itemResultSet)) { ?>
            <tr id="order_<?php echo $itemResult['id'];?>">
                <td><img alt="<?php echo $itemResult['model_name'];?>" src="images/<?php echo $itemResult['thumbnail'];?>"</td>
                <td><?php echo $itemResult['model_name'];?></td>
                <td><?php echo $itemResult['quantity'];?></td>
                <td><?php echo $itemResult['total_price'];?></td>
                <td><?php echo $itemResult['ref_key'];?></td>
                <td><?php echo $itemResult['status'];?></td>
                <td><?php echo date('Y-m-d',  strtotime($itemResult['created']));?></td>
            </tr>
            <?php } ?>
        </table>
        <div id="paging">
        <?php echo $pagingReturn['pagingHtml']; ?>
        </div>
       <?php } ?>
       <div align="center"><a href="index.php" class="button play">Continue shopping</a></div>
       </div>
    <?php

require_once 'includes/footer.php';
?>
