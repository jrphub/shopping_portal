<?php
ini_set("session.gc_maxlifetime", 20*60);
session_start();

require_once 'includes/config.php';
require_once 'class/sqlFunctions.php';
require_once 'class/Encryption.php';

$sqlObject = new SqlFunctions();
$encryptionObject = new Encryption();

if ($_POST['submit']) {
    if ($_POST['answer']) {
        $answerQuery = "SELECT answer FROM xyz_users WHERE security_question ='" . $_SESSION['sec_question'] . "'";
        $answerResult = $sqlObject->executeQuery($answerQuery, 2);
        if ($answerResult['answer'] == $_POST['answer']) {
            $passwordQuery = "SELECT password FROM xyz_users WHERE email_id='" . $_SESSION['email'] . "'";
            $passwordResult = $sqlObject->executeQuery($passwordQuery, 2);
            $password = $encryptionObject->decrypt($passwordResult['password']);
        } else {
            $displayError = "Invalid answer";
        }
    } else {
        $displayError = "Please answer the security question";
    }
}
$title = 'Forget Password - Step 2';
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
        <?php if ($displayError) { ?>
        <p align ="center" class="error"><?php echo $displayError;?></p>
        <?php } ?>
        <?php if (!$password) {?>
        <form action="" method="POST">
            <table>
                <tr>
                    <td  colspan="2" align="center" id="heading">
                        Step-2: Answer your security question
                    </td>
                </tr>
                <tr>
                    <td>
                        Security Question:
                    </td>
                    <td>
                        <?php
                        $questionQuery = "SELECT security_question FROM xyz_users WHERE email_id = '" . $_SESSION['email'] . "'";
                        $questionResult = $sqlObject -> executeQuery($questionQuery, 2);
                        echo $questionResult['security_question'];
                        $_SESSION['sec_question'] = $questionResult['security_question'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="answer">Answer:</label>
                    </td>
                    <td>
                        <input type="text" name="answer" id="answer"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="submit" class="button" value="submit"/>
                    </td>
                </tr>
            </table>
        </form>
        <?php } else { ?>
        <table>
            <tr>
                <td  colspan="2" align="center" id="heading">
                    
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center" style="font-size: 20px;">
                    Your Password is &nbsp; <b><?php echo $password; ?></b>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center" style="font-size: 20px;">
                    Now you can Log in &nbsp;<a href="login.php">here</a>
                </td>
            </tr>
        </table>
        <?php } ?>
        </div>
     <?php

require_once 'includes/footer.php';
?>