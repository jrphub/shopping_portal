<?php
ini_set("session.gc_maxlifetime", 20*60);
session_start();
require_once '../includes/config.php';
require_once '../class/sqlFunctions.php';
$sqlObject = new SqlFunctions();

if ($_SESSION['userId'] != '7') {
    header("Location:../login.php");
    die();
}
if (!$_GET['order_id']) {
    header("Location:dashboard.php");
    die();
}
$itemQuery = "SELECT name, address, city, state, pincode, phone, status FROM xyz_orders WHERE id = " . $_GET['order_id'];
$item = $sqlObject->executeQuery($itemQuery, 2);
if ($_POST['submit']) {
    if ($_POST['name']
        && $_POST['address']
        && $_POST['city']
        && $_POST['state']
        && $_POST['pincode']
        && $_POST['status']
        && $_POST['phone']) {
        $updateQuery = "UPDATE xyz_orders SET
                        name = '" . $_POST['name'] . "',
                        address = '" . $_POST['address'] . "',
                        city = '" . $_POST['city'] . "',
                        state = '" . $_POST['state'] . "',
                        pincode = '" . $_POST['pincode'] . "',
                        phone = '" . $_POST['phone'] . "',
                        status = '" . $_POST['status'] . "',
                        modified_by = '" . $_SESSION['userId'] . "',
                        modified = NOW()
                    WHERE id = '" . $_GET['order_id'] . "'";
        $sqlObject->executeQuery($updateQuery);
        header("Location:dashboard.php");
        die();

    } else {
        $error = "Please fill up the form";
    }
}
$title = 'ADMIN: Edit Order';
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
</style>

    <body>
        <div align="center" id="container">
        <div style="font-size: 20px; padding-top: 10px;">Shipping Address</div>
            <div style="color: RED;"><?php if ($error) echo $error;?></div>
            <form action="" method="post">
            <table>
                <tr>
                    <td><label for="name">Name:</label></td>
                    <td><input type="text" name="name" id="name" value="<?php if ($item['name']) echo $item['name']; ?>"/></td>
                </tr>
                <tr>
                    <td><label for="address">Address:</label></td>
                    <td><textarea cols="17" style="height: 100px;" name="address" id="address"><?php if ($item['address']) echo $item['address']; ?></textarea></td>
                </tr>
                <tr>
                    <td><label for="city">City:</label></td>
                    <td><input type="text" name="city" id="city" value="<?php if ($item['city']) echo $item['city']; ?>"></td>
                </tr>
                <tr>
                    <td>
                        <label for="state">State:</label>
                    </td>
                    <td>
                        <select id="state" name="state">
                            <option value="0">--Select State--</option>
                            <option value="Andaman and Nicobar Islands" <?php if ($item['state']=='Andaman and Nicobar Islands') echo 'selected="selected"'; ?>>Andaman and Nicobar</option>
                            <option value="Andhra Pradesh" <?php if ($item['state']=='Andhra Pradesh') echo 'selected="selected"'; ?>>Andhra Pradesh</option>
                            <option value="Arunachal Pradesh"<?php if ($item['state']=='Arunachal Pradesh') echo 'selected="selected"'; ?>>Arunachal Pradesh</option>
                            <option value="Assam"<?php if ($item['state']=='Assam') echo 'selected="selected"'; ?>>Assam</option>
                            <option value="Bihar"<?php if ($item['state']=='Bihar') echo 'selected="selected"'; ?>>Bihar</option>
                            <option value="Chandigarh"<?php if ($item['state']=='Chandigarh') echo 'selected="selected"'; ?>>Chandigarh</option>
                            <option value="Chhattisgarh"<?php if ($item['state']=='Chhattisgarh') echo 'selected="selected"'; ?>>Chhattisgarh</option>
                            <option value="Dadra and Nagar Haveli"<?php if ($item['state']=='Dadra and Nagar Haveli') echo 'selected="selected"'; ?>>Dadra and Nagar Haveli</option>
                            <option value="Daman and Diu"<?php if ($item['state']=='Daman and Diu') echo 'selected="selected"'; ?>>Daman and Diu</option>
                            <option value="Delhi"<?php if ($item['state']=='Delhi') echo 'selected="selected"'; ?>>Delhi</option>
                            <option value="Goa"<?php if ($item['state']=='Goa') echo 'selected="selected"'; ?>>Goa</option>
                            <option value="Gujarat"<?php if ($item['state']=='Gujarat') echo 'selected="selected"'; ?>>Gujarat</option>
                            <option value="Haryana"<?php if ($item['state']=='Haryana') echo 'selected="selected"'; ?>>Haryana</option>
                            <option value="Himachal Pradesh"<?php if ($item['state']=='Himachal Pradesh') echo 'selected="selected"'; ?>>Himachal Pradesh</option>
                            <option value="Jammu and Kashmir"<?php if ($item['state']=='Jammu and Kashmir') echo 'selected="selected"'; ?>>Jammu and Kashmir</option>
                            <option value="Jharkhand"<?php if ($item['state']=='Jharkhand') echo 'selected="selected"'; ?>>Jharkhand</option>
                            <option value="Karnataka"<?php if ($item['state']=='Karnataka') echo 'selected="selected"'; ?>>Karnataka</option>
                            <option value="Kerala"<?php if ($item['state']=='Kerala') echo 'selected="selected"'; ?>>Kerala</option>
                            <option value="Lakshadweep"<?php if ($item['state']=='Lakshadweep') echo 'selected="selected"'; ?>>Lakshadweep</option>
                            <option value="Madhya Pradesh"<?php if ($item['state']=='Madhya Pradesh') echo 'selected="selected"'; ?>>Madhya Pradesh</option>
                            <option value="Maharashtra"<?php if ($item['state']=='Maharashtra') echo 'selected="selected"'; ?>>Maharashtra</option>
                            <option value="Manipur"<?php if ($item['state']=='Manipur') echo 'selected="selected"'; ?>>Manipur</option>
                            <option value="Meghalaya"<?php if ($item['state']=='Meghalaya') echo 'selected="selected"'; ?>>Meghalaya</option>
                            <option value="Mizoram"<?php if ($item['state']=='Mizoram') echo 'selected="selected"'; ?>>Mizoram</option>
                            <option value="Nagaland"<?php if ($item['state']=='Nagaland') echo 'selected="selected"'; ?>>Nagaland</option>
                            <option value="Orissa"<?php if ($item['state']=='Orissa') echo 'selected="selected"'; ?>>Orissa</option>
                            <option value="Pondicherry"<?php if ($item['state']=='Assam') echo 'selected="selected"'; ?>>Pondicherry</option>
                            <option value="Punjab"<?php if ($item['state']=='Punjab') echo 'selected="selected"'; ?>>Punjab</option>
                            <option value="Rajasthan"<?php if ($item['state']=='Rajasthan') echo 'selected="selected"'; ?>>Rajasthan</option>
                            <option value="Sikkim"<?php if ($item['state']=='Sikkim') echo 'selected="selected"'; ?>>Sikkim</option>
                            <option value="Tamil Nadu"<?php if ($item['state']=='Tamil Nadu') echo 'selected="selected"'; ?>>Tamil Nadu</option>
                            <option value="Tripura"<?php if ($item['state']=='Tripura') echo 'selected="selected"'; ?>>Tripura</option>
                            <option value="Uttar Pradesh"<?php if ($item['state']=='Uttar Pradesh') echo 'selected="selected"'; ?>>Uttar Pradesh</option>
                            <option value="Uttrakhand"<?php if ($item['state']=='Uttrakhand') echo 'selected="selected"'; ?>>Uttrakhand</option>
                            <option value="West Bengal"<?php if ($item['state']=='West Bengal') echo 'selected="selected"'; ?>>West Bengal</option>
                            <option value="Army Post Office"<?php if ($item['state']=='Army Post Office') echo 'selected="selected"'; ?>>Army Post Office</option>							</select>
                    </td>
                </tr>
                <tr>
                    <td>Country:</td>
                    <td>India&nbsp;(We only ship within India)</td>
                </tr>
                <tr>
                    <td><label for="pincode">Pincode:</label></td>
                    <td><input type="text" name="pincode" id="pincode" maxlength="6" value="<?php if ($item['pincode']) echo $item['pincode']; ?>"></td>
                </tr>
                <tr>
                    <td><label for="phone">Phone:</label></td>
                    <td>+91-<input type="text" name="phone" id="phone" value="<?php if ($item['phone']) echo $item['phone']; ?>"/></td>
                </tr>
                <tr>
                    <td><label for="status">Status:</label></td>
                    <td>
                        <select id="status" name="status">
                            <option value="processing"<?php if ($item['status'] == 'processing') echo 'selected="selected"'; ?>>processing</option>
                            <option value="shipping"<?php if ($item['status'] == 'shipping') echo 'selected="selected"'; ?>>shipping</option>
                            <option value="delivered"<?php if ($item['status'] == 'delivered') echo 'selected="selected"'; ?>>delivered</option>
                            <option value="error"<?php if ($item['status'] == 'error') echo 'selected="selected"'; ?>>error</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="submit" class="button" value="Save"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">*All fields are mandatory</td>
                </tr>
            </table>
        </form>
        </div>
    <?php

require_once '../includes/footer.php';
?>

