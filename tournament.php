<?php
include 'header.php';
include 'credentials.php';
error_reporting(0);


if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (!$connection)
    {
        die("Connection failed: " . $mysqli_connect_error);
    }

    $query = "SELECT tournaments.title AS ttitle, creation_date, games.title, format, bracket_image, users.username FROM tournaments INNER JOIN games ON tournaments.game_id = games.id
    INNER JOIN users ON tournaments.creator_id = users.id WHERE tournaments.id = '$id'";

    $result = mysqli_query($connection, $query);

    $n = mysqli_num_rows($result);

    if ($n > 0){
        $row = mysqli_fetch_assoc($result);
        $title = $row['ttitle'];
        $start_date = $row['creation_date'];
        $game = $row['title'];
        $creator_name = $row['username'];
        $format = $row['format'];
        $bracket_image = $row['bracket_image'];


        $getMatch1TeamIdsQuery = "SELECT team1_id, team2_id, winner_id FROM matches WHERE tournament_id = '$id' AND id = 1";
        $getMatch1TeamIdsResult = mysqli_query($connection, $getMatch1TeamIdsQuery);
        $match1TeamIdRow = mysqli_fetch_assoc($getMatch1TeamIdsResult);
        
        
        if($match1TeamIdRow['team1_id']){
            $match1Team1Id = $match1TeamIdRow['team1_id'];
            $getMatch1Team1NameQuery = "SELECT name FROM teams WHERE id = '$match1Team1Id'";
            $getMatch1Team1NameResult = mysqli_query($connection, $getMatch1Team1NameQuery);
            $match1Team1NameRow = mysqli_fetch_assoc($getMatch1Team1NameResult);
            $match1Team1Name = $match1Team1NameRow['name'];
        }
        else{
            $match1Team1Name = "To be decided";
        }


        if($match1TeamIdRow['team2_id']){
            $match1Team2Id = $match1TeamIdRow['team2_id'];
            $getMatch1Team2NameQuery = "SELECT name FROM teams WHERE id = '$match1Team2Id'";
            $getMatch1Team2NameResult = mysqli_query($connection, $getMatch1Team2NameQuery);
            $match1Team2NameRow = mysqli_fetch_assoc($getMatch1Team2NameResult);
            $match1Team2Name = $match1Team2NameRow['name'];

        }
        else{
            $match1Team2Name = "To be decided";
        }


        if($match1TeamIdRow['winner_id']){
            $match1WinnerId = $match1TeamIdRow['winner_id'];
            $getMatch1WinnerNameQuery = "SELECT name FROM teams WHERE id = '$match1WinnerId'";
            $getMatch1WinnerNameResult = mysqli_query($connection, $getMatch1WinnerNameQuery);
            $match1WinnerNameRow = mysqli_fetch_assoc($getMatch1WinnerNameResult);
            $match1WinnerName = $match1WinnerNameRow['name'];

        }
        else{
            $match1WinnerName = "To be decided";
        }




        $getMatch2TeamIdsQuery = "SELECT team1_id, team2_id, winner_id FROM matches WHERE tournament_id = '$id' AND id = 2";
        $getMatch2TeamIdsResult = mysqli_query($connection, $getMatch2TeamIdsQuery);
        $match2TeamIdRow = mysqli_fetch_assoc($getMatch2TeamIdsResult);


        if($match2TeamIdRow['team1_id']){
            $match2Team1Id = $match2TeamIdRow['team1_id'];
            $getMatch2Team1NameQuery = "SELECT name FROM teams WHERE id = '$match2Team1Id'";
            $getMatch2Team1NameResult = mysqli_query($connection, $getMatch2Team1NameQuery);
            $match2Team1NameRow = mysqli_fetch_assoc($getMatch2Team1NameResult);
            $match2Team1Name = $match2Team1NameRow['name'];
        }
        else{
            $match2Team1Name = "To be decided";
        }

        if($match2TeamIdRow['team2_id']){
            $match2Team2Id = $match2TeamIdRow['team2_id'];
            $getMatch2Team2NameQuery = "SELECT name FROM teams WHERE id = '$match2Team2Id'";
            $getMatch2Team2NameResult = mysqli_query($connection, $getMatch2Team2NameQuery);
            $match2Team2NameRow = mysqli_fetch_assoc($getMatch2Team2NameResult);
            $match2Team2Name = $match2Team2NameRow['name'];

        }
        else{
            $match2Team2Name = "To be decided";
        }


        if($match2TeamIdRow['winner_id']){
            $match2WinnerId = $match2TeamIdRow['winner_id'];
            $getMatch2WinnerNameQuery = "SELECT name FROM teams WHERE id = '$match2WinnerId'";
            $getMatch2WinnerNameResult = mysqli_query($connection, $getMatch2WinnerNameQuery);
            $match2WinnerNameRow = mysqli_fetch_assoc($getMatch2WinnerNameResult);
            $match2WinnerName = $match2WinnerNameRow['name'];

        }
        else{
            $match2WinnerName = "To be decided";
        }

        
        $getMatch3TeamIdsQuery = "SELECT winner_id FROM matches WHERE tournament_id = '$id' AND id = 2";
        $getMatch3TeamIdsResult = mysqli_query($connection, $getMatch3TeamIdsQuery);
        $match3TeamIdRow = mysqli_fetch_assoc($getMatch3TeamIdsResult);
        
        if($match3TeamIdRow['winner_id']){
            $match3WinnerId = $match3TeamIdRow['winner_id'];
            $getMatch3WinnerNameQuery = "SELECT name FROM teams WHERE id = '$match3WinnerId'";
            $getMatch3WinnerNameResult = mysqli_query($connection, $getMatch3WinnerNameQuery);
            $match3WinnerNameRow = mysqli_fetch_assoc($getMatch3WinnerNameResult);
            $match3WinnerName = $match3WinnerNameRow['name'];

        }
        else{
            $match3WinnerName = "To be decided";
        }
        
       


        echo <<<_END
        <body>
            <br><br><br><div class="container">
            <div class="col-10 col-sm-10 col-md-6 col-lg-7 col-xl-8 col-xxl-10 mx-auto">
                <h1>{$title}</h1><br><br>
                <h3>Game: {$game} &emsp; Format: {$format}</h3>
                <h4>Created By: {$creator_name} &emsp; <br> {$start_date}</h4><br>
                <div class="container mx-auto d-block">
                <table class="bracket">
                    <tr>
                        <td><h2>$match1Team1Name</h2></td>
                        <td><h2>————</h2><td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><h2>|</h2></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><h2>|</h2></td>
                    </tr>
                    <tr text-align: right>
                        <td></td>
                        <td></td>
                        <td><h2>|——</h2></td>
                        <td><h2>$match1WinnerName</h2></td>
                        <td><h2>——</h2><td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><h2>|</h2></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><h2>|</h2></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><h2>|</h2></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><h2>|</h2></td>
                    </tr>
                    <tr>
                        <td><h2>$match1Team2Name</h2></td>
                        <td><h2>————</h2><td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><h2>|</h2></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><h2>——</h2></td>
                        <td><h2>$match3WinnerName</h2></td>
                    </tr>
                    <tr>
                        <td><h2>$match2Team1Name</h2></td> 
                        <td><h2>————</h2><td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><h2>|</h2></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><h2>|</h2></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><h2>|</h2></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><h2>|</h2></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><h2>|</h2></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><h2>|——</h2></td>
                        <td><h2>$match2WinnerName</h2></td>
                        <td><h2>——</h2><td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><h2>|</h2></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td></td>
                    <td><h2>|</h2></td>
                    </tr>
                    <tr>
                        <td><h2>$match2Team2Name</h2></td>
                        <td><h2>————</h2><td>
                    </tr>

                </table>
                </div>
                <button id="copyButton" class="mx-auto d-block">Share Tournament</button>
            </div>
            </div>
        </body>
    </html>
_END;
    }

    else {
        echo "<br><br><br><h2 class=\"text-center\">Tournament not found!</h2>";
    }

    mysqli_close($connection);   
}
else {
    echo "No data received!";
}

include_once 'footer.php';

?>
