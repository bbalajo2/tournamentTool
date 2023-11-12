<?php
include 'header.php';
if (isset($_SESSION['loggedIn'])){
    unset($_SESSION['loggedIn']);
    header("Refresh:0");
}elseif (!isset($_SESSION['loggedIn'])){
    echo "<br><br><br><h2 class=\"text-center\">You have logged out <div class=\"spinner-border\" role=\"status\"><span class=\"sr-only\"></span></div></h2>";
    header("Refresh:2; URL=about.php");
    }
include 'footer.php';
?>
