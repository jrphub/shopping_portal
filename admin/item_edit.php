<?php
ini_set("session.gc_maxlifetime", 20*60);
session_start();
require_once '../includes/config.php';
require_once '../class/sqlFunctions.php';
$sqlObject = new SqlFunctions();
if(!$_GET['prod_id']) {
    header("Location:item_list.php");
    die();
}
if ($_SESSION[userId] != '7') {
    header("Location: ../login.php");
    die();
}

if ($_POST['cancel']) {
    header("Location:item_list.php");
    die();
}
$itemQuery = "SELECT vendor_name, model_name, price, description FROM xyz_products WHERE prod_id=" .$_GET['prod_id'];
$totalItems = $sqlObject->executeQuery($itemQuery, 2);


if ($_POST['submit']) {
   $updateQuery = "UPDATE xyz_products SET
                        vendor_name = '" . $_POST['vendor_name'] . "',
                        model_name = '" . $_POST['model_name'] . "',
                        price = '" . $_POST['price'] . "',
                        thumbnail = '" . $_POST['thumbnail'] . "',
                        full_image = '" . $_POST['full_image'] . "',
                        description = '" . $_POST['description'] . "',
                        modified_by = '" . $_SESSION['userId'] . "',
                        modified = NOW()
                    WHERE id = '" . $_GET['prod_id'] . "'";
    $sqlObject->executeQuery($updateQuery);
    header("Location:item_list.php");
    die();
}

$title = 'ADMIN: Edit Item';
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
        padding-top: 30px;
        font-size: 20px;
        font-weight: bold;
    }
</style>

    <body>
        <div align="center" id="container">
        <form method="post">
            <table>
                <tr>
                    <td  colspan="2" align="center" id="heading">
                        Edit Item
                    </td>
                </tr>
                <tr>
                    <td height="10px;"></td>
                </tr>
                <tr>
                    <td>
                        <label for="vendor_name">Vendor Name:</label>
                    </td>
                    <td>
                        <input type="text" name="vendor_name" id="vendor_name" value="<?php echo $totalItems['vendor_name']?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="model_name">Model:</label>
                    </td>
                    <td>
                        <input type="text" name="model_name" id="model_name" value="<?php echo $totalItems['model_name']?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="price">Price:</label>
                    </td>
                    <td>
                        <input type="text" name="price" id="price" value="<?php echo $totalItems['price']?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="thumbnail">Upload thumbnail:</label>
                    </td>
                    <td>
                        <input type="file" name="thumbnail" id="thumbnail"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="full_image">Upload full image:</label>
                    </td>
                    <td>
                        <input type="file" name="full_image" id="full_image"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="description">Specification:</label>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea cols="50" rows="10"   name="description" id="description"><?php echo $totalItems['description'];?> </textarea>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit" class="button" value="Submit"/>
                    </td>
                    <td>
                        <input type="submit" name="cancel" class="button" value="Cancel"/>
                    </td>
                </tr>
            </table>
        </form>
        </div>
    <?php

require_once '../includes/footer.php';
?>
