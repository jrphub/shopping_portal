<?php

session_start();
session_destroy();
setcookie('siteAuth', '', time()-1);

header("Location:index.php");
die();
?>


