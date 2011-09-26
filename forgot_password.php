<?php
ini_set("session.gc_maxlifetime", 20*60);
session_start();

require_once 'includes/config.php';
require_once 'class/sqlFunctions.php';

$sqlObject = new SqlFunctions();

if ($_POST['submit']) {
    $emailIdExistQuery = "SELECT COUNT(id) AS available_email FROM xyz_users WHERE email_id ='" . $_POST['email'] . "'";
    $isEmailIdExist = $sqlObject-> executeQuery($emailIdExistQuery, 2);
    if ($isEmailIdExist['available_email'] == 0)
        $emailIdExistError = "This email id is not registered. Please sign up.";
    else {
        $_SESSION['email'] = $_POST['email'];
        header("Location:fp_step_two.php");
        die();
    }
}
$title = 'Forget Password - Step 1';
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
        <?php if ($emailIdExistError) { ?>
        <p align ="center" class="error"><?php echo $emailIdExistError;?></p>
        <?php } ?>
        <form method="POST" onsubmit="return validate();" >
            <table>
                <tr>
                    <td  colspan="2" align="center" id="heading">
                        Step-1: Enter your email id
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Enter Email Address:</label>
                    </td>
                    <td>
                        <input type="text" name="email" id="email"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="submit" class="button" value="next"/>
                    </td>
                </tr>
            </table>
        </form>
        </div>
        <script type="text/javascript">
        function validate()
        {
            if(document.getElementById("email").value == "")
            {
                alert("Email ID cannot be empty")
                document.getElementById("email").focus();
                return false;
            }
            if(!validateEmail(document.getElementById("email").value))
            {
                alert("Invalid Email ID")
                document.getElementById("email").focus();
                return false;
            }
        }
        function validateEmail(elementValue)
        {
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            return emailPattern.test(elementValue);
        }
        </script>
    <?php

require_once 'includes/footer.php';
?>
