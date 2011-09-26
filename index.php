<?php
ini_set("session.gc_maxlifetime", 24*60*60);
session_start();
require_once 'includes/config.php';
require_once 'class/sqlFunctions.php';
$sqlObject = new SqlFunctions();

$itemQuery = "SELECT prod_id, model_name, price, thumbnail FROM xyz_products order by created desc LIMIT 4";
$itemResultSet = $sqlObject->executeQuery($itemQuery, 1);

$prodQuery = "SELECT O.prod_id, sum(O.quantity) AS quant,P.model_name,P.price, P.thumbnail
              FROM xyz_products AS P INNER JOIN xyz_orders AS O ON O.prod_id = P.prod_id
              group by O.prod_id order by quant desc LIMIT 4";
$prodResultSet = $sqlObject->executeQuery($prodQuery, 1);
require_once('includes/header.php');
require_once('includes/left_sidebar.php');
require_once("includes/right_sidebar.php");
?>
<style type="text/css">
    
</style>
<link rel="stylesheet" type="text/css" href="css/main.css"/>

    <body>
        <table>
            <tr>
                
                <td style="padding: 30px;">
                    <table>
                        <tr>
                            <td>
                                <p style="font-size: 24px; color: olivedrab; font-weight: bold;">New Arrivals</p>
                            </td>
                        </tr>

                        <tr>
                        <?php
                            while ($itemResult = mysql_fetch_array($itemResultSet)) {
                            ?>
                           <td style="padding: 10px;">
                               <div style="padding-top: 30px;">
                                <a href="product.php?id=<?php echo $itemResult['prod_id'];?>">
                                    <img alt="<?php echo $itemResult['thumbnail'];?>"  src="images/<?php echo $itemResult['thumbnail'];?>">
                                </a>
                               </div>
                               <div style="font-size:12px;color:#726918; padding-top: 20px;">
                                    <a href="product.php?id=<?php echo $itemResult['prod_id'];?>"><?php echo $itemResult['model_name']; ?></a>
                               </div>
                                <div>
                                    Rs.<?php echo $itemResult['price']; ?>
                                </div>
                            </td>

                        <?php
                            }
                        ?>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-size: 24px; color: olivedrab; font-weight: bold;">Best Selling</p>
                            </td>
                        </tr>

                        <tr>
                        <?php
                            while ($prodResult = mysql_fetch_array($prodResultSet)) {
                            ?>
                           <td style="padding: 10px;">
                               <div style="padding-top: 30px;">
                                <a href="product.php?id=<?php echo $prodResult['prod_id'];?>">
                                    <img alt="<?php echo $prodResult['thumbnail'];?>"  src="images/<?php echo $prodResult['thumbnail'];?>">
                                </a>
                               </div>
                               <div style="font-size:12px;color:#726918; padding-top: 20px;">
                                    <a href="product.php?id=<?php echo $prodResult['prod_id'];?>"><?php echo $prodResult['model_name']; ?></a>
                               </div>
                                <div>
                                    Rs.<?php echo $prodResult['price']; ?>
                                </div>
                            </td>

                        <?php
                            }
                        ?>
                        </tr>
                    </table>
                </td>
                <td>

                </td>
<tr>
                    <td colspan='2' align="center">
                        <div style="border: 1px solid;
                        margin: 10px 0px;
                        padding:15px 10px 5px 30px;
                        background-repeat: no-repeat;
                        color:#348017;
                        background-color: #FFE87C;">
                        To access ADMIN Module, Please use below credentials to log in
                        <br>
                        Email id : admin123@xyz.com<br>
                        password : admin123
                    </div>
                    </td>
                </tr>
        </table>
<?php 

require_once("includes/footer.php");
?>


