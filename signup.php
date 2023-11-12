<?php
include 'header.php';
include 'credentials.php';
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$connection)
{
    die("Connection failed: " . $mysqli_connect_error);
}
echo<<<START
<br><br><br>
<div class="container">
    <div class="col-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mx-auto">
        <form action="signup.php" method="post">
            Username: <input type="text" name="user" id="user">
            <br><br>
            Password: <input type="password" name="pass" id="pass">
            <br><br>
            First Name: <input type="text" name="firstname" id="firstname">
            <br><br>
            Last Name: <input type="text" name="lastname" id="lastname">
            <br><br>
            Email: <input type="email" name="email" id="email">
            <br><br>
            Date of Birth <input type="date" name="dob" id="dob">
            <br><br>
            <input id="login_signup_button"type="submit" value="Submit" name="submit" class="w-25">
        </form>
    </div>
</div>
START;

if(isset($_POST['user'])){
$user = $_POST['user'];
$pass = $_POST['pass'];
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$email = $_POST['email'];
$dob = $_POST['dob'];

$query = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
$results = mysqli_query($connection, $query);

$num = mysqli_num_rows($results);
if ($num == 0)
{
    $q  = "INSERT INTO users(username, password, firstname, lastname, email, date_of_birth) VALUES('$user','$pass','$firstName','$lastName','$email','$dob')";
mysqli_query($connection, $q);

    echo "<br><h2 class=\"text-center\"> Sign up successful<div class=\"spinner-border\" role=\"status\"><span class=\"sr-only\"></span></div></h2><br>";
    header("Refresh:1; URL=signin.php");



}elseif ($num > 0){
    echo "<br><br><br><h2 class=\"text-center\">Account already exists</h2>";
}
}
?>
