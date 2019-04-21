<?php
session_start();

if (!isset($_SESSION['username'])) { //checks whether the admin has logged in
    header("Location: index.php"); 
    exit;
}

include "calls/db.php";
$conn = getDB("finalMovies");

function getnotKidFriendly(){
    global $conn;
    $sql = "SELECT * FROM `movieInfo`
            NATURAL JOIN movieRating
            NATURAL JOIN movieGenre
            WHERE ratingId > 2
            ORDER BY movieName";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $moviereports=$stmt->fetchAll(PDO::FETCH_ASSOC);
    if (isset($_GET['submit'])){
        if ($_GET['reportOption'] === "notKid"){
        echo "<tr>";
        echo "<td class='header'>" . "Title" . "</td>"; 
        echo "<td class='header'>" . "Director" . "</td>"; 
        echo "<td class='header'>" . "Rating" . "</td>"; 
        echo "<td class='header'>" . "Genre" . "</td>";
        echo "<td class='header'>" . "Image" . "</td>"; 
        echo "<td class='header'>" . "Description" . "</td>"; 
        echo "</tr>";

        foreach ($moviereports as $movie) {
        echo "<tr>";
        echo "<td>" . $movie['movieName'] . "</td>"; 
        echo "<td>" . $movie['movieDirector'] . "</td>"; 
        echo "<td>" . $movie['ratingName'] . "</td>";
        echo "<td>" . $movie['genreName'] . "</td>";
        echo "<td><img height='100' src='" . $movie['movieImage'] . "'/></td>"; 
        echo "<td>" . $movie['movieDesc'] . "</td>";
        echo "</tr>";
    }//end of foreach
    $sql = " SELECT Count(movieName) as count
            FROM movieInfo
            WHERE ratingId >2";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $moviereports=$stmt->fetch(PDO::FETCH_ASSOC);
    // print_r($moviereports);
    echo ($moviereports['count']);
    }
} //end of on submit

}//end of notKidFriendly


function getkidFriendly(){
    global $conn;
    $sql = "SELECT * FROM `movieInfo`
            NATURAL JOIN movieRating
            NATURAL JOIN movieGenre
            WHERE ratingId < 3
            ORDER BY movieName";
            
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $moviereports=$stmt->fetchAll(PDO::FETCH_ASSOC);
    if (isset($_GET['submit'])){
        if ($_GET['reportOption'] === "yesKid"){
        echo "<tr>";
        echo "<td class='header'>" . "Title" . "</td>"; 
        echo "<td class='header'>" . "Director" . "</td>"; 
        echo "<td class='header'>" . "Rating" . "</td>"; 
        echo "<td class='header'>" . "Genre" . "</td>";
        echo "<td class='header'>" . "Image" . "</td>"; 
        echo "<td class='header'>" . "Description" . "</td>"; 
        echo "</tr>";

        foreach ($moviereports as $movie) {
        echo "<tr>";
        echo "<td>" . $movie['movieName'] . "</td>"; 
        echo "<td>" . $movie['movieDirector'] . "</td>"; 
        echo "<td>" . $movie['ratingName'] . "</td>";
        echo "<td>" . $movie['genreName'] . "</td>";
        echo "<td><img height='100' src='" . $movie['movieImage'] . "'/></td>"; 
        echo "<td>" . $movie['movieDesc'] . "</td>";
        echo "</tr>";
    }//end of foreach
    $sql = " SELECT Count(movieName) as count
            FROM movieInfo
            WHERE ratingId < 3";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $moviereports=$stmt->fetch(PDO::FETCH_ASSOC);
    echo ($moviereports['count']);
    }
} //end of on submit

}//end of kidFriendly


function getfantasyMovies(){
    global $conn;
    $sql = "SELECT * FROM `movieInfo`
            NATURAL JOIN movieGenre 
            NATURAL JOIN movieRating
            WHERE genreId = 8
            ORDER BY movieName";

    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $moviereports=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //($moviereports);
    if (isset($_GET['submit'])){
        if ($_GET['reportOption'] === "fantasy"){
        echo "<tr>";
        echo "<td class='header'>" . "Title" . "</td>"; 
        echo "<td class='header'>" . "Director" . "</td>"; 
        echo "<td class='header'>" . "Rating" . "</td>"; 
        echo "<td class='header'>" . "Genre" . "</td>";
        echo "<td class='header'>" . "Image" . "</td>"; 
        echo "<td class='header'>" . "Description" . "</td>"; 
        echo "</tr>";

        foreach ($moviereports as $movie) {
        echo "<tr>";
        echo "<td>" . $movie['movieName'] . "</td>"; 
        echo "<td>" . $movie['movieDirector'] . "</td>"; 
        echo "<td>" . $movie['ratingName'] . "</td>";
        echo "<td>" . $movie['genreName'] . "</td>";
        echo "<td><img height='100' src='" . $movie['movieImage'] . "'/></td>"; 
        echo "<td>" . $movie['movieDesc'] . "</td>";
        echo "</tr>";
    }//end of foreach
    $sql = " SELECT Count(movieName) as count
            FROM movieInfo
            WHERE genreId = 8";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $moviereports=$stmt->fetch(PDO::FETCH_ASSOC);
    // print_r($moviereports);
    echo ($moviereports['count']);
    }
} //end of on submit

}//end of fantasyMovies


?>



<!DOCTYPE html>
<html>
    <head>
        <title>Generate Reports </title>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
    </head>
    <body>
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="admin.php">MovieDatabase</a>
              <!--<li class="active"><a href="/admin.php" class="btn btn-default" role="button"><span class="glyphicon glyphicon-home"></span></a></li>-->
            </div>
            <ul class="nav navbar-nav">
                <li><a href="admin.php" class="btn" role="button"><span class="glyphicon glyphicon-home"></span></a></li>
                <li><a href="phpmyadmin" class="btn" role="button">phpMyAdmin</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a class="btn" href="calls/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
            </ul>
          </div>
        </nav>
        <div style="margin-bottom: -30px;" class="jumbotron">
            <h1>Generate Reports</h1>
        </div>
        <h3>Choose the Type of Report You want to Generate:</h3>
        <form methdo="get">
        <div class="select-style">
            <select name="reportOption">
                <option disabled selected value>Select an Option</option>
                <option name="notKidFriendly" value="notKid" >Movies Rated PG-13 and Up</option>
                <option name="kidFriendly" value="yesKid" >Kid Friendly Movies (G & PG)</option>
                <option name="fantasyMovies" value="fantasy">Fantasy Movies</option>
            </select>
        </div>
        <br>
        <button id="submit" type="submit" name="submit"/>Submit</button>
        </form>
        <table>
            <br /><br />
        <?=getnotKidFriendly()?>
        <?=getkidFriendly()?>
        <?=getfantasyMovies()?>
        </table>
    </body>
    <script>
        $("#submit").click(function() {
            $("#count").html("")
            $("table").html("");
        })
    </script>
</html>
