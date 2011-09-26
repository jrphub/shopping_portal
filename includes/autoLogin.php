<?php
ini_set("session.gc_maxlifetime", 20*60);
session_start();

require_once 'includes/config.php';
require_once 'class/sqlFunctions.php';
$sqlObject = new SqlFunctions();

// Check if the cookie exists
if(isset($_COOKIE['siteAuth'])){

    parse_str($_COOKIE['siteAuth']);

    // Make a verification
    $userQuery = "SELECT id,username,email_id,password FROM xyz_users WHERE email_id ='" . $usr . "'";

    $userRow = $sqlObject-> executeQuery($userQuery, 2);

    if($hash == $userRow['username']){
        // Register the session
        $_SESSION["userId"] = $userRow['id'];
        $_SESSION["username"] = $userRow['username'];
        $_SESSION["email"] = $userRow['email_id'];
        header("Location:index.php");
        die();
    }
}
