<?php
ini_set("session.gc_maxlifetime", 20*60);
session_start();
require_once 'includes/config.php';
require_once 'class/sqlFunctions.php';
require_once('class/paging_class.php');
$sqlObject = new SqlFunctions();
$pagingObject = new Paging();

if (!$_GET['name']) {
    header("Location:index.php");
    die();
}

if ($_GET['name'] == 'all') {
    $filter='';
} else {
    $filter = " WHERE vendor_name='" . $_GET['name'] ."'";
}

$itemQuery = "SELECT prod_id, model_name, price, thumbnail FROM xyz_products" . $filter . " order by created desc";
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

$title = $_GET['name'] . ' - Products';
require_once 'includes/header.php';
require_once 'includes/left_sidebar.php';
require_once 'includes/right_sidebar.php';

?>
<link rel="stylesheet" type="text/css" href="css/main.css"/>
<link rel="stylesheet" type="text/css" href="css/button.css"/>


    <body>
        <div align="center">
        <div id="paging">
        <?php echo $pagingReturn['pagingHtml']; ?>
        </div>
        <table>
        <?php
        $i = 1;
		while ($itemResult = mysql_fetch_array($itemResultSet)) {
		?>
            <?php if ($i%2 == 1) {?>
            <tr>
            <?php } ?>
            <td>
                <table>
                    <tr>
                       <td>
                            <a href="product.php?id=<?php echo $itemResult['prod_id'];?>">
                                <img alt="<?php echo $itemResult['thumbnail'];?>"  src="images/<?php echo $itemResult['thumbnail'];?>">
                            </a>
                        </td>
                        <td>
                            <div style="font-size:12px;color:#726918;">
                                <a href="product.php?id=<?php echo $itemResult['prod_id'];?>"><?php echo $itemResult['model_name']; ?></a>
                            </div>
                            <div>
                                Rs.<?php echo $itemResult['price']; ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
            <?php if ($i%2 == 0) {?>
            </tr>
            <?php } 
            $i++;
                }
            ?>
        </table>
        <div id="paging">
        <?php echo $pagingReturn['pagingHtml']; ?>
        </div>
        </div>
    <?php

require_once 'includes/footer.php';
?>
