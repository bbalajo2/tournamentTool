<?php
include ('header.php');
if (isset($_SESSION['loggedIn'])){
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$connection)
{
    die("Connection failed: " . $mysqli_connect_error);
}


$idd = $_SESSION['view_tournament_id'];



$query = "SELECT teams.id, teams.name, teams.creation_date, tournament_teams.application_date FROM tournament_teams INNER JOIN teams ON tournament_teams.team_id = teams.id WHERE tournament_teams.status LIKE 'Pending' AND tournament_teams.tournament_id = '$idd'";
$result = mysqli_query($connection, $query);

$n = mysqli_num_rows($result);

    if ($n > 0){
      for($i = 0; $i < $n; $i++){
        $row = mysqli_fetch_assoc($result);
        echo <<<_END
        <body>
        <table class="ms-5 mt-5">
        <tr><td>{$row['name']}</td></tr>
        <form action="application.php" method="post">
        <tr><td><button class="btn btn-secondary" id="table_btn" type=submit name="approve" value="{$row['id']}">Approve</button></td></tr>
        <tr><td><button class="btn btn-secondary" id="table_btn" type=submit name="deny">Deny</button></td></tr>
        </form>
      _END;
      }
}

else {
  echo"NO applicatoins found";
}


if(isset($_POST["approve"])){
  $ap = $_POST['approve'];
  $query = "UPDATE tournament_teams SET status = 'Approved' WHERE team_id = '$ap'";
  $result = mysqli_query($connection, $query);

  if($result){

    $updateMatchQuery = "UPDATE matches SET team1_id = '$ap' WHERE tournament_id = '$idd' AND id = 1";
    $updateMatchResult = mysqli_query($connection, $updateMatchQuery);

    if($updateMatchResult){
      echo"Approved";
      //header('Location: view.php');

    }
    
    else{
      echo"Something went wrong...";

    }
  }

  else{
    echo"Something went wrong";

  }
}
mysqli_close($connection);

}
  require_once 'footer.php';
  
// "UPDATE team_members SET status = 'Approved' FROM team_members INNER JOIN teams ON teams.creator_id = '$idd' WHERE user_id = '$ap'";
?>
