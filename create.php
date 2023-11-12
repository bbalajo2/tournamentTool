<?php


require_once "credentials.php";


$connection = mysqli_connect($dbhost, $dbuser, $dbpass);


if (!$connection)
{
    die("Connection failed: " . $mysqli_connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS " . $dbname;


if (mysqli_query($connection, $sql))
{
    echo "Database created successfully, or already exists<br>";
}
else
{
    die("Error creating database: " . mysqli_error($connection));
}


mysqli_select_db($connection, $dbname);


//--------------------------- GAMES TABLE-------------------------------------------------

$sql = "DROP TABLE IF EXISTS games";

if (mysqli_query($connection, $sql))
{
    echo "Dropped existing table: users<br>";
}
else
{
    die("Error checking for existing table: " . mysqli_error($connection));
}

$sql = "CREATE TABLE games (id INT NOT NULL AUTO_INCREMENT, title VARCHAR(255), release_date DATE, logo VARCHAR(255), PRIMARY KEY(id))";

if (mysqli_query($connection, $sql))
{
    echo "Table created successfully: games<br>";
}
else
{
    die("Error creating table: " . mysqli_error($connection));
}


$game_title[] = 'League Of Legends'; $release_date[] ='2009-04-14'; $logo[] = 'LINK OF IMAGE';
$game_title[] = 'Counter Strike Global Ofensive'; $release_date[] ='2013-05-30'; $logo[] = 'LINK OF IMAGE';
$game_title[] = 'World Of Warcraft'; $release_date[] ='2005-04-23'; $logo[] = 'LINK OF IMAGE';



for ($i=0; $i<count($game_title); $i++)
{
    $sql = "INSERT INTO games (title, release_date, logo) VALUES ('$game_title[$i]', '$release_date[$i]', '$logo[$i]')";
    print_r($sql);

    // no data returned, we just test for true(success)/false(failure):
    if (mysqli_query($connection, $sql))
    {
        echo "row inserted<br>";
    }
    else
    {
        die("Error inserting row: " . mysqli_error($connection));
    }
}



//--------------------------- Tournaments TABLE-------------------------------------------------


$sql = "DROP TABLE IF EXISTS tournaments";

if (mysqli_query($connection, $sql))
{
    echo "Dropped existing table: users<br>";
}
else
{
    die("Error checking for existing table: " . mysqli_error($connection));
}

$sql = "CREATE TABLE tournaments (id INT NOT NULL AUTO_INCREMENT, title VARCHAR(16), creation_date DATE, format VARCHAR(10), bracket_image VARCHAR(100), number_of_teams INT, players_in_team INT, prize_pool DECIMAL(10,2), game_id INT, organisation_id INT, creator_id INT, PRIMARY KEY(id))";

if (mysqli_query($connection, $sql))
{
    echo "Table created successfully: tournaments<br>";
}
else
{
    die("Error creating table: " . mysqli_error($connection));
}


$title[] = 'Tournament1'; $tournament_creation_date[] ='2022-04-14';  $format[] = 'SWISS'; $bracket_image[] = 'LINK OF IMAGE'; $number_of_teams[] = '8'; $players_in_team[] = '5'; $prize_pool[] = '1200.00'; $game_id[] = '1'; $organisation_id[] = '1'; $creator_id[] = '1';
$title[] = 'Tournament2'; $tournament_creation_date[] ='2021-03-11';  $format[] = 'Round Robin'; $bracket_image[] = 'LINK OF IMAGE'; $number_of_teams[] = '4'; $players_in_team[] = '5'; $prize_pool[] = '20000.00'; $game_id[] = '2'; $organisation_id[] = '1'; $creator_id[] = '1';
$title[] = 'Tournament3'; $tournament_creation_date[] ='2013-02-21';  $format[] = 'Single Elimination Bracket'; $bracket_image[] = 'LINK OF IMAGE'; $number_of_teams[] = '16'; $players_in_team[] = '3'; $prize_pool[] = '100.00'; $game_id[] = '3'; $organisation_id[] = '1'; $creator_id[] = '1';
$title[] = 'Tournament4'; $tournament_creation_date[] ='2019-07-24';  $format[] = 'Double Elimination Bracket'; $bracket_image[] = 'LINK OF IMAGE'; $number_of_teams[] = '24'; $players_in_team[] = '1'; $prize_pool[] = '500.00'; $game_id[] = '1'; $organisation_id[] = '1'; $creator_id[] = '1';


// loop through the arrays above and add rows to the table:
for ($i=0; $i<count($title); $i++)
{
    $sql = "INSERT INTO tournaments (title, creation_date, format, bracket_image, number_of_teams, players_in_team, prize_pool, game_id, organisation_id, creator_id) VALUES ('$title[$i]', '$tournament_creation_date[$i]', '$format[$i]', '$bracket_image[$i]', '$number_of_teams[$i]', '$players_in_team[$i]', '$prize_pool[$i]', '$game_id[$i]', '$organisation_id[$i]', '$creator_id[$i]')";
    print_r($sql);

    // no data returned, we just test for true(success)/false(failure):
    if (mysqli_query($connection, $sql))
    {
        echo "row inserted<br>";
    }
    else
    {
        die("Error inserting row: " . mysqli_error($connection));
    }
}


//--------------------------- Users TABLE-------------------------------------------------

$sql = "DROP TABLE IF EXISTS users";

if (mysqli_query($connection, $sql))
{
    echo "Dropped existing table: users<br>";
}
else
{
    die("Error checking for existing table: " . mysqli_error($connection));
}

$sql = "CREATE TABLE users (id INT NOT NULL AUTO_INCREMENT, username VARCHAR(255), password VARCHAR(210), firstname VARCHAR(100), lastname VARCHAR(100), email VARCHAR(255), date_of_birth DATE, PRIMARY KEY(id))";


if (mysqli_query($connection, $sql))
{
    echo "Table created successfully: users<br>";
}
else
{
    die("Error creating table: " . mysqli_error($connection));
}

$username[] = 'Tom'; $password[] ='2022-04-14'; $firsname[] = 'Thomas'; $lastname[] = 'Shelby'; $email[] = 't.shelby@peaky_fucking_blinders.com'; $date_of_birth[] = '1920-03-15';
$username[] = 'baco'; $password[] ='paco'; $firsname[] = 'Plamen'; $lastname[] = 'Bukov'; $email[] = 'plamen_bukov@gmail.com'; $date_of_birth[] = '2001-01-27';
$username[] = 'Hylissang'; $password[] ='coinflip'; $firsname[] = 'Zdravets '; $lastname[] = 'Galabov '; $email[] = 'hyli@gmail.com'; $date_of_birth[] = '1995-04-30';
$username[] = 'test1'; $password[] ='test1'; $firsname[] = 'test1'; $lastname[] = 'test1'; $email[] = 'test1@gmail.com'; $date_of_birth[] = '2001-01-01';
$username[] = 'test2'; $password[] ='test2'; $firsname[] = 'test2'; $lastname[] = 'test2'; $email[] = 'test2@gmail.com'; $date_of_birth[] = '2001-01-01';
$username[] = 'test3'; $password[] ='test3'; $firsname[] = 'test3'; $lastname[] = 'test3'; $email[] = 'test3@gmail.com'; $date_of_birth[] = '2001-01-01';
$username[] = 'test4'; $password[] ='test4'; $firsname[] = 'test4'; $lastname[] = 'test4'; $email[] = 'test4@gmail.com'; $date_of_birth[] = '2001-01-01';
$username[] = 'test5'; $password[] ='test5'; $firsname[] = 'test5'; $lastname[] = 'test5'; $email[] = 'test5@gmail.com'; $date_of_birth[] = '2001-01-01';
$username[] = 'test6'; $password[] ='test6'; $firsname[] = 'test6'; $lastname[] = 'test6'; $email[] = 'test6@gmail.com'; $date_of_birth[] = '2001-01-01';
$username[] = 'test7'; $password[] ='test7'; $firsname[] = 'test7'; $lastname[] = 'test7'; $email[] = 'test7@gmail.com'; $date_of_birth[] = '2001-01-01';
$username[] = 'test8'; $password[] ='test8'; $firsname[] = 'test8'; $lastname[] = 'test8'; $email[] = 'test8@gmail.com'; $date_of_birth[] = '2001-01-01';
$username[] = 'test9'; $password[] ='test9'; $firsname[] = 'test9'; $lastname[] = 'test9'; $email[] = 'test9@gmail.com'; $date_of_birth[] = '2001-01-01';
$username[] = 'test10'; $password[] ='test10'; $firsname[] = 'test10'; $lastname[] = 'test10'; $email[] = 'test10@gmail.com'; $date_of_birth[] = '2001-01-01';
$username[] = 'test11'; $password[] ='test11'; $firsname[] = 'test11'; $lastname[] = 'test11'; $email[] = 'test11@gmail.com'; $date_of_birth[] = '2001-01-01';


for ($i=0; $i<count($username); $i++)
{
    $sql = "INSERT INTO users (username, password, firstname, lastname, email, date_of_birth) VALUES ('$username[$i]', '$password[$i]', '$firsname[$i]', '$lastname[$i]', '$email[$i]', '$date_of_birth[$i]')";
    print_r($sql);

    // no data returned, we just test for true(success)/false(failure):
    if (mysqli_query($connection, $sql))
    {
        echo "row inserted<br>";
    }
    else
    {
        die("Error inserting row: " . mysqli_error($connection));
    }
}

//--------------------------- Teams TABLE-------------------------------------------------
$sql = "DROP TABLE IF EXISTS teams";

if (mysqli_query($connection, $sql))
{
    echo "Dropped existing table: users<br>";
}
else
{
    die("Error checking for existing table: " . mysqli_error($connection));
}

$sql = "CREATE TABLE teams (id INT NOT NULL AUTO_INCREMENT, name VARCHAR(255), creation_date DATE, creator_id INT, PRIMARY KEY(id))";


if (mysqli_query($connection, $sql))
{
    echo "Table created successfully: teams<br>";
}
else
{
    die("Error creating table: " . mysqli_error($connection));
}

$name[] = 'TSM';  $creation_date[] = '2012-03-15'; $team_creator_id[] = '1';
$name[] = 'FNC';  $creation_date[] = '2008-05-21'; $team_creator_id[] = '3';
$name[] = 'G2';  $creation_date[] = '2013-08-07'; $team_creator_id[] = '4';
$name[] = 'T1';  $creation_date[] = '2011-11-23'; $team_creator_id[] = '2';

for ($i=0; $i<count($name); $i++)
{
    $sql = "INSERT INTO teams (name, creation_date, creator_id) VALUES ('$name[$i]', '$creation_date[$i]', '$team_creator_id[$i]')";
    print_r($sql);

    // no data returned, we just test for true(success)/false(failure):
    if (mysqli_query($connection, $sql))
    {
        echo "row inserted<br>";
    }
    else
    {
        die("Error inserting row: " . mysqli_error($connection));
    }
}


//--------------------------- Organisations TABLE-------------------------------------------------

$sql = "DROP TABLE IF EXISTS organisations";

if (mysqli_query($connection, $sql))
{
    echo "Dropped existing table: organisations<br>";
}
else
{
    die("Error checking for existing table: " . mysqli_error($connection));
}

$sql = "CREATE TABLE organisations (id INT NOT NULL AUTO_INCREMENT, name VARCHAR(255), logo VARCHAR(255), creation_date DATE, creator_id INT, PRIMARY KEY(id))";


if (mysqli_query($connection, $sql))
{
    echo "Table created successfully: organisations<br>";
}
else
{
    die("Error creating table: " . mysqli_error($connection));
}

$organisation_name[] = 'LEC';  $organisation_creation_date[] = '2012-03-15'; $organisation_logo[] = 'LINK'; $organisation_creator_id[] = '1';
$organisation_name[] = 'LCS';  $organisation_creation_date[] = '2008-05-21'; $organisation_logo[] = 'LINK'; $organisation_creator_id[] = '3';
$organisation_name[] = 'LPL';  $organisation_creation_date[] = '2013-08-07'; $organisation_logo[] = 'LINK'; $organisation_creator_id[] = '4';
$organisation_name[] = 'LCK';  $organisation_creation_date[] = '2011-11-23'; $organisation_logo[] = 'LINK'; $organisation_creator_id[] = '2';

for ($i=0; $i<count($name); $i++)
{
    $sql = "INSERT INTO organisations (name, logo, creation_date, creator_id) VALUES ('$organisation_name[$i]', '$organisation_logo[$i]', '$organisation_creation_date[$i]', '$organisation_creator_id[$i]')";
    print_r($sql);

    // no data returned, we just test for true(success)/false(failure):
    if (mysqli_query($connection, $sql))
    {
        echo "row inserted<br>";
    }
    else
    {
        die("Error inserting row: " . mysqli_error($connection));
    }
}


//--------------------------- tournament_teams TABLE-------------------------------------------------
$sql = "DROP TABLE IF EXISTS tournament_teams";

if (mysqli_query($connection, $sql))
{
    echo "Dropped existing table: tournament_teams<br>";
}
else
{
    die("Error checking for existing table: " . mysqli_error($connection));
}

$sql = "CREATE TABLE tournament_teams (team_id INT, tournament_id INT, status VARCHAR(255), aplication_date DATE, PRIMARY KEY(team_id, tournament_id))";


if (mysqli_query($connection, $sql))
{
    echo "Table created successfully: tournament_teams<br>";
}
else
{
    die("Error creating table: " . mysqli_error($connection));
}



$team_id[] = '1';  $tournament_id[] = '1'; $status[] = 'Aproved'; $aplication_date[] = '2012-03-15';
$team_id[] = '2';  $tournament_id[] = '1'; $status[] = 'Aproved'; $aplication_date[] = '2012-03-15';
$team_id[] = '3';  $tournament_id[] = '1'; $status[] = 'Aproved'; $aplication_date[] = '2012-03-15';


for ($i=0; $i<count($team_id); $i++)
{
    $sql = "INSERT INTO tournament_teams (team_id, tournament_id, status, aplication_date) VALUES ('$team_id[$i]', '$tournament_id[$i]', '$status[$i]', '$aplication_date[$i]')";
    print_r($sql);

    // no data returned, we just test for true(success)/false(failure):
    if (mysqli_query($connection, $sql))
    {
        echo "row inserted<br>";
    }
    else
    {
        die("Error inserting row: " . mysqli_error($connection));
    }
}

//--------------------------- Matches TABLE-------------------------------------------------
$sql = "DROP TABLE IF EXISTS matches";

if (mysqli_query($connection, $sql))
{
    echo "Dropped existing table: matches<br>";
}
else
{
    die("Error checking for existing table: " . mysqli_error($connection));
}

$sql = "CREATE TABLE matches (id INT NOT NULL AUTO_INCREMENT, team1_id INT, team2_id INT, tournament_id INT, type VARCHAR(255), score VARCHAR(255), winner_id INT, playing_date DATE, PRIMARY KEY(id))";


if (mysqli_query($connection, $sql))
{
    echo "Table created successfully: matches<br>";
}
else
{
    die("Error creating table: " . mysqli_error($connection));
}


$team1_id[] = '1';  $team2_id[] = '2'; $tournament_match_id[] = '1'; $type[] = 'Semi-finals'; $score[] = '3-2'; $winner_id[] = '1'; $playing_date[] = '2022-05-21';
$team1_id[] = '3';  $team2_id[] = '4'; $tournament_match_id[] = '1'; $type[] = 'Semi-finals'; $score[] = '2-3'; $winner_id[] = '4'; $playing_date[] = '2022-05-21';
$team1_id[] = '1';  $team2_id[] = '4'; $tournament_match_id[] = '1'; $type[] = 'Finals'; $score[] = '1-3'; $winner_id[] = '4'; $playing_date[] = '2022-05-22';

for ($i=0; $i<count($team1_id); $i++)
{
    $sql = "INSERT INTO matches (team1_id, team2_id, tournament_id, type, score, winner_id, playing_date) VALUES ('$team1_id[$i]', '$team2_id[$i]', '$tournament_match_id[$i]', '$type[$i]', '$score[$i]', '$winner_id[$i]', '$playing_date[$i]')";
    print_r($sql);

    // no data returned, we just test for true(success)/false(failure):
    if (mysqli_query($connection, $sql))
    {
        echo "row inserted<br>";
    }
    else
    {
        die("Error inserting row: " . mysqli_error($connection));
    }
}

//--------------------------- team_members TABLE-------------------------------------------------
$sql = "DROP TABLE IF EXISTS team_members";

if (mysqli_query($connection, $sql))
{
    echo "Dropped existing table: team_members<br>";
}
else
{
    die("Error checking for existing table: " . mysqli_error($connection));
}

$sql = "CREATE TABLE team_members (team_id INT, user_id INT, role VARCHAR(255), status VARCHAR(255), join_date DATE, resign_date DATE, PRIMARY KEY(team_id, user_id))";


if (mysqli_query($connection, $sql))
{
    echo "Table created successfully: team_members<br>";
}
else
{
    die("Error creating table: " . mysqli_error($connection));
}



$team_m_id[] = '2';  $user_member_id[] = '3'; $role_member[] = 'Player'; $status_member[] = 'Aproved'; $join_date[] = '2012-03-15'; $resign_date[] = '';
$team_m_id[] = '2';  $user_member_id[] = '2'; $role_member[] = 'Coach'; $status_member[] = 'Aproved'; $join_date[] = '2012-03-15'; $resign_date[] = '';
$team_m_id[] = '1';  $user_member_id[] = '1'; $role_member[] = 'Player'; $status_member[] = 'Aproved'; $join_date[] = '2012-03-15'; $resign_date[] = '';
$team_m_id[] = '3';  $user_member_id[] = '4'; $role_member[] = 'Player'; $status_member[] = 'Aproved'; $join_date[] = '2012-03-15'; $resign_date[] = '';
$team_m_id[] = '3';  $user_member_id[] = '1'; $role_member[] = 'Player'; $status_member[] = 'Aproved'; $join_date[] = '2012-03-15'; $resign_date[] = '';



for ($i=0; $i<count($team_id); $i++)
{
    $sql = "INSERT INTO team_members (team_id, user_id, role, status, join_date, resign_date) VALUES ('$team_m_id[$i]', '$user_member_id[$i]', '$role_member[$i]', '$status[$i]', '$join_date[$i]', '$resign_date[$i]')";
    print_r($sql);

    // no data returned, we just test for true(success)/false(failure):
    if (mysqli_query($connection, $sql))
    {
        echo "row inserted<br>";
    }
    else
    {
        die("Error inserting row: " . mysqli_error($connection));
    }
}


mysqli_close($connection);

?>

