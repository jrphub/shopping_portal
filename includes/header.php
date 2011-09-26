<style type="text/css">
#header
{
 background-color: #463E41;
 background-repeat: repeat-x;
 width: 100%;
 height: 15%;
 color: floralwhite;
 padding-left: 50px;
 padding-top: 20px;
 border: solid 1px;
}

#header #navigation
{
  float: right;
  padding-right: 20px;
  color: floralwhite;
  padding-top: 50px;
}

#header a
{
    color: #F9B7FF;
    float: right;
    padding-right: 30px;
    color: floralwhite;
    text-decoration: none;

}


</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $title;?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></meta>
        <link rel="shortcut icon" href="/xyz/images/favicon.ico"/>
         <div id="header">
             <?php if ($_SESSION['userId'] == '7') {?>
                 <span style="font-size: 46px;">XYZ.</span><span style="font-size: 42px;">com : ADMIN</span>
                 <div id="navigation"><a href="/xyz/logout.php">Log out</a>
                 <a href="/xyz/admin/dashboard.php">Dashboard</a></div>
             <?php } else if ($_SESSION['userId']) {?>
                    <div id="navigation"><a href="logout.php">Log out</a>
                    <a href="account.php">Account</a></div>
             <?php } else { ?>
                    <div id="navigation"><a href="signup.php">Sign Up</a>
                    <a href="login.php">Login</a></div>
             <?php }
             if ($_SESSION['userId'] != '7') {?>
                 <span style="font-size: 46px;">XYZ.</span><span style="font-size: 42px;">com</span>
                <div id="navigation"><a href="index.php">Home</a></div>
            <?php } ?>    
         </div>
    </head>

