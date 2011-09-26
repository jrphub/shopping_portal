<?php
ini_set("session.gc_maxlifetime", 20*60);
session_start();
require_once '../includes/config.php';
require_once '../class/sqlFunctions.php';
require_once('../class/paging_class.php');
$sqlObject = new SqlFunctions();
$pagingObject = new Paging();

if ($_SESSION['userId'] != '7') {
    header("Location:../login.php");
    die();
}

$itemQuery = "SELECT prod_id, vendor_name, model_name, price FROM xyz_products
     order by created desc";
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
$title = 'ADMIN: List of items';
require_once '../includes/header.php';

?>
<link rel="stylesheet" type="text/css" href="../css/main.css"/>
<link rel="stylesheet" type="text/css" href="../css/button.css"/>
<style type="text/css">
    #container{
    margin-left: 100px;
    margin-right: 100px;
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
        <h3 style="padding-top: 10px;">All the products are here</h3>
        <div id="paging">
        <?php echo $pagingReturn['pagingHtml']; ?>
        </div>
        <table border="1">
            <tr>
                <th>Brand name</th>
                <th>Model Name</th>
                <th>Price</th>
                <th>No. of order</th>
                <th>Option</th>
            </tr>
            <?php while ($itemResult = mysql_fetch_array($itemResultSet)) {?>
            <tr id="product_<?php echo $itemResult['prod_id'];?>">
                <td><?php echo $itemResult['vendor_name'];?></td>
                <td><?php echo $itemResult['model_name'];?></td>
                <td><?php echo $itemResult['price'];?></td>
                <td>
                    <?php
                    $sellingQuery = "SELECT prod_id, sum(quantity) AS sold_count FROM xyz_orders WHERE prod_id = " . $itemResult['prod_id'];
                    $sellingResult = $sqlObject->executeQuery($sellingQuery, 2);
                    if ($sellingResult['prod_id'] == $itemResult['prod_id'])
                        echo $sellingResult['sold_count'];
                    else
                        echo '0';
                    ?>
                </td>
                <td><a href="item_edit.php?prod_id=<?php echo $itemResult['prod_id'];?>" class="button edit">Edit</a></td>
            </tr>
            <?php } ?>
        </table>
        <div id="paging">
        <?php echo $pagingReturn['pagingHtml']; ?>
        </div>
        </div>
    <?php

require_once '../includes/footer.php';
?>

