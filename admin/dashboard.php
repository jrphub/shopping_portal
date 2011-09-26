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

$itemQuery = "SELECT O.id AS order_id, O.prod_id, O.user_id, U.username, O.status, O.created, O.modified
    FROM xyz_orders AS O
    INNER JOIN xyz_users AS U ON U.id = O.user_id
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
$title = 'ADMIN: Dashboard';
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
        <a href="add.php" class="button add">Add Items</a>
        <a href="item_list.php" class="button">See Items</a>
        <h3>All the orders are here</h3>
        <div id="paging">
        <?php echo $pagingReturn['pagingHtml']; ?>
        </div>
        <table border="1">
            <tr>
                <th>product id</th>
                <th>User Id</th>
                <th>Username</th>
                <th>Order Status</th>
                <th>Created</th>
                <th>Modified</th>
                <th>Option</th>
            </tr>
            <?php while ($itemResult = mysql_fetch_array($itemResultSet)) { ?>
            <tr id="order_<?php echo $itemResult['order_id'];?>">
                <td><?php echo $itemResult['prod_id'];?></td>
                <td><?php echo $itemResult['user_id'];?></td>
                <td><?php echo $itemResult['username'];?></td>
                <td><?php echo $itemResult['status'];?></td>
                <td><?php echo date('Y-m-d', strtotime($itemResult['created']));?></td>
                <td><?php echo date('Y-m-d', strtotime($itemResult['modified'])); ?></td>
                <td><a href="order_edit.php?order_id=<?php echo $itemResult['order_id'];?>" class="button edit">Edit</a></td>
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
