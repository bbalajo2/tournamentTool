<?php
include 'header.php';
include 'credentials.php';

if (isset($_SESSION['loggedIn'])) {
    //store the username of current logged in user
    $username = $_SESSION['username'];
    
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (!$connection)
    {
        die("Connection failed: " . $mysqli_connect_error);
    }

    // get the id of user who is currently logged in
    $query = "SELECT id FROM users WHERE username = '$username'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        //store user id
        $user_id = $row['id'];

        //get team name for current logged in user
        $query = "SELECT teams.name, role, status, join_date from team_members INNER JOIN teams ON team_members.team_id = teams.id WHERE team_members.user_id = '$user_id'";

        $result = mysqli_query($connection, $query);

        $n = mysqli_num_rows($result);

        //user joined a team
        if ($n > 0) {

            echo "<body>";
            echo "<br><br><br><div class=\"container\">";
            echo "<div class=\"col-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-6 mx-auto\">";
            echo "<table class=\"allTeams_table\">";
            echo "<th>Team Owner</th><th>Team Name</th><th>Role</th><th>Status</th><th>Join/Request Date</th>";
            for($i = 0; $i < $n; $i++){
                $row = mysqli_fetch_assoc($result);
                $team_name = $row['name'];
                $role = $row['role'];
                $join_date = $row['join_date'];
                $status = $row['status'];

                echo <<<_END
                 <tr><td>$username</td><td>$team_name</td><td>$role</td><td>$status</td><td>$join_date</td></tr>
_END;
            }

            echo "</table>";
            echo "</div>";
            echo "</div>";
            echo "</body>";
            echo "</html>";


        }
        //user has not joined any team
        else {
            echo "<br><br><br><h2 class=\"text-center\">You have not joined any teams</h2>";
        }
}

else {

  echo "<br><br><br><h2 class=\"text-center\">You must be signed in to view your teams</h2>";
    
}

include_once 'footer.php';
?>
