<?php
include 'header.php';
include 'credentials.php';
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$connection)
{
    die("Connection failed: " . $mysqli_connect_error);
}
echo<<<_START
<br><br><br><br>
<div class="container">
    <div class="col-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mx-auto">
        <form action="signIn.php" method="post">
            Please enter a username and password<br><br>
            Username: <input type="text" name="username" id="username">
            <br><br>
            Password: <input type="password" name="password" id="password">
            <br><br>
                <input id="login_signup_button" type="submit" value="Submit" name="submit" class="w-25">
        </form>
    </div>
</div>
_START;

    if(isset($_POST['username'])){
    $username = $_POST['username'];
    $password = $_POST['password'] ;

    if($username == ""){
        echo"Missing Username";
    }
    elseif ($password == "") {
        echo"Missing Password";
    }
    else{
    $query = "SELECT * FROM users WHERE username= '$username' AND password = '$password'";
    $result = mysqli_query($connection, $query);

    $q = "SELECT id FROM users WHERE username= '$username' AND password = '$password'";
    $r = mysqli_query($connection, $q);

    $n = mysqli_num_rows($result);

    if ($n > 0)
    {
        $_SESSION['loggedIn'] = 1;

        for($i = 0; $i < $n; $i++)  {
            $row = mysqli_fetch_assoc($r);
            $_SESSION['id'] = $row['id'];
        }

        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;

        $getId = mysqli_fetch_assoc($result);

        echo "<br><h2 class=\"text-center\"> Hi, $username, you have successfully logged in <div class=\"spinner-border\" role=\"status\"><span class=\"sr-only\"></span></div></h2><br>";
        header("Refresh:1; URL=about.php");

        }

        else {
            echo "<br><h2 class=\"text-center\"> Your logggin details are incorrect!</h2>";
        }

        
    }
}
?>
