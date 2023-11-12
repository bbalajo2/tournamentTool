<?php
include 'header.php';
include 'credentials.php';


$message = '';

echo<<<START
    <div class="container">
    <div class="col-10 col-sm-10 col-md-5 col-lg-7 col-xl-8 col-xxl-2 mx-auto"><br>
    <form action="createTournament.php" method="post">
  Title: <input type="text" name="title" id="tite">
  <br><br>
  <Label>Tournament format</label>
    <select name="format_options" id="format_options">
    <option value"single_elimination">Single Elimination</option>
    <option value"double_elimination">Double Elimination</option>
    <option value"round_robin">Round Robin</option>
    </select>
  <br><br>
  Number of teams: <input type="number_of_teams" name="number_of_teams" id="number_of_teams">
  <br><br>
  Players in team: <input type="players in_team" name="players_in_team" id="players_in_team">
  <br><br>
  Prize fund:<input type="prize_pool" name="prize_pool" id="prize_pool">
  <br><br>
  <Label>Game:</label>
  <select name="game" id="game">
    <option value"League Of Legends">League of Legends</option>
    <option value"Counter Strike Global Ofensive">Counter Strike Global Ofensive</option>
    <option value"World Of Warcraft">World Of Warcraft</option>
    <option value"Overwatch">Overwatch</option>
    <option value"Rocket League">Rocket League</option>
    <option value"Valorant">Valorant</option>
    <option value"StarCraft II">StarCraft II</option>
  </select>
  <br><br>
  <input type="submit" value="Submit" name="submit">
</form>
</div>
</div>
START;


$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$connection){
    die("Connection failed: " . $mysqli_connect_error);
}

if (isset($_SESSION['loggedIn'])) {

    $username = $_SESSION['username'];
    $getUIdQuery = "SELECT id FROM users WHERE username='$username'"; 
    $result = mysqli_query($connection, $getUIdQuery);
    $row = mysqli_fetch_assoc($result);
    $creator_id = $row['id'];


    if(isset($_POST['title'])){

        $title = $_POST['title'];
        $creation_date = date("Y-m-d");
        $format = $_POST['format_options'];
        $number_of_teams = $_POST['number_of_teams'];
        $players_in_team = $_POST['players_in_team'];
        $prize_pool = $_POST['prize_pool'];
        $game = $_POST['game'];

        //$bracket_image = $_POST['bracket_image'];
        //$organisation_id = $_POST['organisation_id'];
  
        $checkQuery = "SELECT * FROM tournaments WHERE title ='$title'";
        $checkResult = mysqli_query($connection, $checkQuery);
        $n = mysqli_num_rows($checkResult);

        if ($n > 0){
            $message = "There is already a tournament with the same name</a>";
        }

        else{
            
            $getGameIdQuery = "SELECT id FROM games WHERE title LIKE '$game'";
            $resultGameId = mysqli_query($connection, $getGameIdQuery);
            $rowGameID = mysqli_fetch_assoc($resultGameId);
            if($rowGameID){

                $game_id = $rowGameID['id'];

                $createTournamentQuery = "INSERT INTO tournaments (title, creation_date, format, number_of_teams, players_in_team, prize_pool, game_id, creator_id) 
                VALUES ('$title', '$creation_date', '$format', '4', '$players_in_team', '$prize_pool', '$game_id', '$creator_id')";
                $resultCreateTournament = mysqli_query($connection, $createTournamentQuery);

                if($resultCreateTournament){

                    $getTournamentIdQuery = "SELECT id FROM tournaments WHERE title='$title'";
                    $resultTournamentId = mysqli_query($connection, $getTournamentIdQuery);
                    $rowTournamentID = mysqli_fetch_assoc($resultTournamentId);
                    $tournament_id = $rowTournamentID['id'];

                    for ($x = 1; $x <= 3; $x++) {
                        $createMatchQuery = "INSERT INTO matches (id, tournament_id) VALUES ('$x', '$tournament_id')";
                        $resultCreateMatch = mysqli_query($connection, $createMatchQuery);

                        if ($resultCreateMatch){
                            if($x == 2){
                                $message = "<br><h2 class=\"text-center\">Tournament been created. <div class=\"spinner-border\" role=\"status\"><span class=\"sr-only\"></span></div></h2><br>";
                                header("Refresh:1; URL=viewmytournaments.php");
                            }
                        }
                        else{
                            $message = "Something went wrong with setting up the matches";
                            break;
                        }
                      }

                }

                else{
                    $message ="Something went wrong with creating the tournament";
                }
            }

            else{
                $message = "The game you have selected cannot be found. <br>";
            }
        }
    }
}
else{
    $message = "You are not logged in.<br>";
}
mysqli_close($connection);

echo "$message";




?>