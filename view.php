<?php
include 'header.php';

if (isset($_SESSION['loggedIn'])){
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (!$connection)
    {
        die("Connection failed: " . $mysqli_connect_error);
    }


    $query = "SELECT tournaments.id, tournaments.title AS ttitle, creation_date, games.title, format, bracket_image, users.username FROM tournaments INNER JOIN games ON games.id = tournaments.game_id
    INNER JOIN users ON tournaments.creator_id = users.id";

    $result = mysqli_query($connection, $query);

    $n = mysqli_num_rows($result);

    if ($n > 0){
        for($i = 0; $i < $n; $i++){
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $title = $row['ttitle'];
        $start_date = $row['creation_date'];
        $game = $row['title'];
        $creator_name = $row['username'];
        $format = $row['format'];
        $bracket_image = $row['bracket_image'];
        echo <<<_END
        <body>
        <div id="tournament_box">
        <table class="ms-5 mt-5">
        <tr><td>{$title}</td></tr>
        <tr><td>Game: {$game}</td></tr>  <tr><td>Format: {$format}</td></tr>  <tr><td>by: {$creator_name}</td></tr>
        <tr><td>{$start_date}</td>
        <form action="tournament.php" method="get">
            <tr><td><button name="id" type="submit" value="{$row['id']}">View Tournament</button></td></tr>
        </form>
        <tr>
        <td>
        <form action="view.php" method="post">
        <select name="team_select" class="form-select w-50">
_END;       
            $qquery = "SELECT name, id FROM teams WHERE creator_id ='{$_SESSION['id']}'";
            $rresult = mysqli_query($connection, $qquery);

            $nn = mysqli_num_rows($rresult);

            if ($nn > 0){

                for($j = 0; $j < $nn; $j++){
                    $rrow = mysqli_fetch_assoc($rresult);
                    
                    $team_name = $rrow['name'];
                    $team_id = $rrow['id'];

                    echo "<option value=$team_id>$team_name</option>";
                }


            }
            else {
                echo "<option>you are not the owner of any team and cannot send applicaton</option>";
            }
               
                echo <<<_END
            </select>
        </td>
        </tr>
            <tr><td><button type="submit" name="join" value="{$row['id']}">Send Application</button></td></tr>
        </form>
        </table>
        </div>
        </body>
    </html>
_END;

    }

    if(isset($_POST['join'])){
        $idd = $_SESSION['id'];
    
        $tid = $_POST['join'];

        $team_id = $_POST['team_select'];
        
        $query = "INSERT INTO tournament_teams (team_id, tournament_id, status, application_date) VALUES ('$team_id', '$tid', 'Pending', sysdate())";
      
        $result = mysqli_query($connection, $query);
                          //no data returned, we just test for true/false
                          //if success     
                          if ($result) {
                              // show a successful message:
                              echo "<br><br><h2 class=\"text-center\"><b>Application sent successfully<b><div class=\"spinner-border\" role=\"status\"><span class=\"sr-only\"></span></div></h2>";
                              //header ("Refresh: 2; URL=view.php");
                          }
                          //if failed
                          else {
                              // show an unsuccessful message:
                              echo "<br><br><h2 class=\"text-center\"><b>Failed to send application<b></h2>";
                          }
      }
}

    else {
        echo "<br><br><br><h1 class=\"text-center\">Tournament not found!</h1>";
    }
mysqli_close($connection);
}
elseif (!isset($_SESSION['loggedIn'])){
    echo"<br><br><br><h2 class=\"text-center\">You need to be signed in to view this page</h2>";
}

/*if(isset($_POST['join'])){
    $_SESSION['join'] = $_POST["join"];
    header('Location: application.php');
}*/



/* error "header already sent" / replaced and fixed now
if(isset($_POST['viewButton'])){
    $loc = $_POST["viewButton"];
    header("Location: tournament.php?id={$loc}");
}
*/
include_once 'footer.php';
?>