<?php
ini_set("session.gc_maxlifetime", 20*60);
session_start();
require_once 'includes/config.php';
require_once 'class/sqlFunctions.php';
require_once 'class/Encryption.php';
$sqlObject = new SqlFunctions();
$encryptionObject = new Encryption();
if (!$_SESSION['userId']) {
    header("Location:index.php");
    die();
}

if(isset($_POST['submit'])) {
    $updateQuery = "UPDATE xyz_users SET password = '" . $encryptionObject -> encrypt($_POST['password']) . "'
                        WHERE id = " . $_SESSION['userId'];
    $sqlObject->executeQuery($updateQuery);
    header("Location:account.php");
    die();
}
$title = 'Change Password';
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
    background: lightgrey;
    height: 490px;
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
        <form method="POST">
            <table>
                <tr>
                    <td  colspan="2" align="center" id="heading">
                        Change your password here
                    </td>
                </tr>
                <tr>
                    <td height="15px;"></td>
                </tr>
                <tr>
                    <td><label for="password">New Password</label></td>
                    <td><input type="password" name="password" id="password"/></td>
                </tr>
                <tr>
                    <td><label for="password_two">Confirm Password</label></td>
                    <td><input type="password" name="password_two" id="password_two"/></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="submit" class="button save" value="Change" onclick="return validation();"/>
                    </td>
                </tr>
            </table>
        </form>
        </div>
    <script type="text/javascript">
        function validation() {
            if(document.getElementById("password").value == "")
            {
                alert("Password cannot be empty.")
                document.getElementById("password").focus();
                return false;
            }
            if(document.getElementById("password_two").value == "")
            {
                alert("Please repeat password.")
                document.getElementById("password_two").focus();
                return false;
            }
            if(document.getElementById("password").value !=document.getElementById("password_two").value)
            {
                alert("Password mismatch.")
                document.getElementById("password").focus();
                return false;
            }
        }
    </script>
    <?php

require_once 'includes/footer.php';
?>
