<?php
ini_set("session.gc_maxlifetime", 20*60);
session_start();
require_once 'includes/config.php';
require_once 'class/sqlFunctions.php';
$sqlObject = new SqlFunctions();
if (!$_GET['id']) {
    header("Location:index.php");
    die();
}
$itemQuery = "SELECT model_name, price, full_image, description FROM xyz_products WHERE prod_id = " . $_GET['id'];
$item = $sqlObject->executeQuery($itemQuery, 2);
$title = $item['model_name'];
require_once 'includes/header.php';
require_once 'includes/left_sidebar.php';
require_once 'includes/right_sidebar.php';

?>
<link rel="stylesheet" type="text/css" href="css/main.css"/>
<link rel="stylesheet" type="text/css" href="css/button.css"/>

    <body>
        <div align="center" style="padding-top: 50px;">
        <table width="50%">
            <tr>
                <td width="50%">
                    <img alt="<?php echo $item['model_name'];?>"  src="images/<?php echo $item['full_image'];?>">
                </td>
                <td>
                    <div style="font-size: 30px; color: darkred;">
                        <?php echo $item['model_name'];?>
                    </div>
                    <div style="font-size: 26px; color: darkgreen">
                        Rs.<?php echo $item['price']; ?>
                    </div>
                    <div style="font-size: 26px; color:brown; ">
                    Cash on delivery
                    </div>
                    <?php if ($_SESSION['userId']) { ?>
                    <a href="order.php?prod_id=<?php echo $_GET['id'];?>" class="button save">Buy</a>
                    <?php } else {
                    $loginPage = "login.php?targetUri=order.php?prod_id=" . $_GET['id'];
                    ?>
                    <a href="<?php echo $loginPage;?>" class="button save">Buy</a>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td>
                    <div style="font-size: 20px; color: darkslategray; padding-top: 50px;">Specifications:</div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div style="font-size: 16px; padding-left: 50px;">
                    <?php echo $item['description']; ?>
                    </div>
                </td>
            </tr>
        </table>
        </div>
    <?php

require_once 'includes/footer.php';
?>

