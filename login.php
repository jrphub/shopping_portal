<?php
ini_set("session.gc_maxlifetime", 24*60*60);
session_start();

require_once 'includes/config.php';
require_once 'class/sqlFunctions.php';
require_once 'class/Encryption.php';

$sqlObject = new SqlFunctions();
$encryptionObject = new Encryption();
if ($_POST['submit']) {
    $userExistQuery = "SELECT id, username FROM xyz_users WHERE email_id ='" . $_POST[email] . "'
                        AND password = '" . $encryptionObject -> encrypt($_POST['password']) . "'";
    $isUserExist = $sqlObject -> executeQuery($userExistQuery, 2);
    if ($isUserExist['id'] == NULL)
        $displayError = "Invalid log in credentials";
    else {
        $_SESSION['userId'] = $isUserExist['id'];
        $_SESSION['username'] = $isUserExist['username'];
        if($_POST['chkRemember'] == 1){
            $cookie_name = 'siteAuth';
            $cookie_time = (3600);
            setcookie ($cookie_name, 'usr='.$_POST['email'].'&hash='. $isUserExist['username'], time() + $cookie_time);
	}
        if ($_POST['email'] == 'admin123@xyz.com' && $_POST['password'] == 'admin123') {
            header("Location:admin/dashboard.php");
            die();
        } else {
            if ($_GET['targetUri']) {
                header("Location:" . $_GET['targetUri']);
                die();
            } else {
            header("Location:index.php");
            die();
            }
        }
    }
}
$title = 'Log in';
require_once 'includes/autoLogin.php';
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
        <form action="" method="POST" onsubmit="return validate();">
            
            <table width="800px;">
                <tr>
                    <?php if ($displayError) { ?>
                <div align ="center" class="error"><?php echo $displayError;?></div>
                <?php } ?>
                </tr>
                <tr>
                    <td colspan="2" align="center" id="heading" >Please Log in here</td>
                </tr>
                <tr><td></td></tr>
                <tr>
                    <td width="45%" align="right">
                        <label for="email">Email Address</label>
                    </td>
                    <td width="55%">
                        <input type="text" name="email" id="email"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="password">Password</label>
                    </td>
                    <td>
                        <input type="password" name="password" id="password"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="checkbox" id="chkRemember" name="chkRemember" value="1"/>
                        <label for="chkRemember"> Remember my Log in</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="submit" class="button" value="Log in"/>
                    </td>
                    
                </tr>
                <tr>
                    <td colspan="2" align="center">

                        <a href="forgot_password.php" style="color: #333">Forgot your Password?</a>

                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        Don't have an Account? Sign up&nbsp;<a href="signup.php" style="color: #333">Here</a>
                    </td>
                </tr>
            </table>
           
        </form>
         </div>
        <script type="text/javascript" >
    function validate()
    {
        if(document.getElementById("email").value == "")
            {
                alert("Enter your Email ID")
                document.getElementById("email").focus();
                return false;
            }

         if(document.getElementById("password").value == "")
            {
                alert("Enter your password")
                document.getElementById("password").focus();
                return false;
            }
      }


        </script>
<?php

require_once 'includes/footer.php';
?>
