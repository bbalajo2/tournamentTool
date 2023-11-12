<?php

// database connection details:
require_once "credentials.php";

//error_reporting(0);




//start session
session_start();

// use a HEREDOC to output some HTML
// the majority of the following becomes the 'top' of the pages
// that appear on our web site

$username = $_SESSION['username'];
date_default_timezone_set('Europe/London');

if($username == null){
    $username = "Not logged in";
}

echo <<< _END
<!DOCTYPE html>
<div class="logo_container d-inline">
<img class="logo" src="images/logo1.png" height="120">
</div>
<title>Tournament Project</title>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <h5 class="d-inline float-end">Time: <div class="d-inline" id="getTime"></div></h5>
    <h1 class="title">Tournament Project</h1><br>
</head>
<link id='colourTheme' rel='stylesheet' href='tournament.css'>     
<script src='header.js'></script>
_END;




if (isset($_SESSION['loggedIn']))
{
    $username = $_SESSION['username'];
    // THIS PERSON IS LOGGED IN

    if($username =='admin'){
    // show the admin menu options:
        echo <<<_END
        <div class="menu-container">
            <a class='options' href='about.php'>About</a>
            <a class='options' href='view.php'>View Tournaments</a>
            <a class='options' href='create.php'>Create Tournaments</a>
            <a class='options' href='signout.php'>Sign Out</a>
            <br><br>
        </div>
_END;
    }
    
    else{
    // show the logged in, user menu options:    
    echo <<<_END
        <div class="menu-container ms-5">
            <a class='options' href='about.php'>About</a>
            <a class='options' href='view.php'>View Tournaments</a>
            <a class='options' href='createTournament.php'>Create Tournaments</a>
            <a class='options' href='allTeams.php'>View Teams</a>
            <a class='options' href='myteam.php'>Your Teams</a>
            <a class='options' href='createTeam.php'>Create Teams</a>
            <a class='options' href='viewmytournaments.php'>Your Tournaments</a>

            <div class="menu-container d-inline float-end">
                <a class='options' href='signout.php'>Sign Out (<b>{$username}</b>)</a>
            </div>
            <br><br>
        </div>
_END;
    }
}
else
{
    // THIS PERSON IS NOT LOGGED IN
    // show the logged out menu options:
    echo <<<_END
    <div class="menu-container">
        <a class='options' href='about.php'>About</a>
        <a class='options' href='view.php'>View Tournaments</a>
        <a class='options' href='allTeams.php'>View Teams</a>
        <div class="menu-container d-inline float-end">
            <a class='options' href='signin.php'>Login</a>
            <a class='options' href='signup.php'>Sign Up</a>
        </div>
        <br><br>
    </div>
_END;
    }
echo'<body id="background" class="background">';
echo "</body></html>";
?>
