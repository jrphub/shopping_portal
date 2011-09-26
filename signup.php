<?php
ini_set("session.gc_maxlifetime", 20*60);
session_start();

require_once 'includes/config.php';
require_once 'class/sqlFunctions.php';
require_once 'class/Encryption.php';

$sqlObject = new SqlFunctions();
$encryptionObject = new Encryption();

if (isset($_POST['submit'])) {
    if (preg_match('/^[a-zA-Z0-9_\-\.@]+$/', $_POST['username'])) {
        $checkUsernameQuery = "SELECT COUNT(id) AS available_username FROM xyz_users WHERE username = '" . $_POST['username'] . "'";
        $isUsernameExists = $sqlObject -> executeQuery($checkUsernameQuery, 2);
        if ($isUsernameExists['available_username'] > 0)
            $usernameExistError = "This username already exists. Try with another";

        $emailIdExistQuery = "SELECT COUNT(id) AS available_email FROM xyz_users WHERE email_id ='" . $_POST['email'] . "'";
        $isEmailIdExist = $sqlObject -> executeQuery($emailIdExistQuery, 2);
        if ($isEmailIdExist['available_email'] > 0)
            $emailIdExistError = "This email id already exists. Try with another or Log in";

        if ($isUsernameExists['available_username'] == 0 && $isEmailIdExist['available_email'] == 0) {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['email'] = $_POST['email'];
            $userInsertValues = array('username'            => "'" . $_POST['username'] . "'",
                                      'email_id'            => "'" . $_POST['email'] . "'",
                                      'password'            => "'" . $encryptionObject -> encrypt($_POST['password']) . "'",
                                      'security_question'   => "'" . $_POST['sec_question'] . "'",
                                      'answer'              => "'" . $_POST['answer'] . "'",
                                      'created'             => 'NOW()',
                                      'modified'             => 'NOW()');
            $userInsertQuery = $sqlObject->createInsertQuery('xyz_users', $userInsertValues);
            $_SESSION['userId'] = $sqlObject->executeQuery($userInsertQuery, 5);
            $updateQuery = "UPDATE xyz_users SET
                            created_by = '" . $_SESSION['userId'] . "',
                            modified_by = '" . $_SESSION['userId'] . "'
                             WHERE id = '" . $_SESSION['userId'] . "'";
            $sqlObject->executeQuery($updateQuery);
            header("Location:index.php");
            die();
        }
        
    }
}
$title = 'Sign Up';
require_once('includes/header.php');
require_once('includes/left_sidebar.php');
require_once("includes/right_sidebar.php");
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
    border: 2px solid;
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
        <form action=""  method="POST" onsubmit="return validate();" >
            <?php if ($emailIdExistError) { ?>
            <p align ="center" class="error"><?php echo $emailIdExistError;?></p>
            <?php } ?>
            <?php if ($usernameExistError) { ?>
            <p align ="center" class="error"><?php echo $usernameExistError;?></p>
            <?php } ?>
            <table>
                <tr>
                    <td  colspan="2" align="center" id="heading">
                        Sign Up For FREE !
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="username">Username</label>
                    </td>
                    <td>
                        <input type="text" name="username" id="username" value="<?php echo $_POST['username']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email Address</label>
                    </td>
                    <td>
                        <input type="text" name="email" id="email" value="<?php echo $_POST['email']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password">Password</label>
                    </td>
                    <td>
                        <input type="password" name="password" id="password" value="<?php echo $_POST['password']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password_two">Repeat Password</label>
                    </td>
                    <td>
                        <input type="password" name="password_two" id="password_two" value="<?php echo $_POST['password_two']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="sec_question">Security Question</label>
                    </td>
                    <td>
                        <input type="text" name="sec_question" id="sec_question" value="<?php echo $_POST['sec_question']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="answer">Answer</label>
                    </td>
                    <td>
                        <input type="text" name="answer" id="answer" value="<?php echo $_POST['answer']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="2">
                        <input type="submit" name="submit" class="button" value="Sign up"/>
                    </td>
                </tr>
            </table>
        </form>
        Already have an account?&nbsp; Log in &nbsp;<a href="login.php" style="color: #333">here</a>
        </div>
        <script type="text/javascript">
        function validate()
        {
            if(document.getElementById("username").value == "")
            {
                alert("Username cannot be empty")
                document.getElementById("username").focus();
                return false;
            }
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
            if(document.getElementById("sec_question").value == "")
            {
                alert("Please enter security question.")
                document.getElementById("sec_question").focus();
                return false;
            }
            if(document.getElementById("answer").value == "")
            {
                alert("Please answer security question.")
                document.getElementById("answer").focus();
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

