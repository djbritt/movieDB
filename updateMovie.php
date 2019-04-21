<?php

session_start();

if (!isset($_SESSION['username'])) { //checks whether the admin has logged in
    header("Location: index.php");
    exit;
}

if(isset($_POST['submit'])){
    genre2();
    updateMovie();
    echo "Movie Updated!";
}

function genre2() {
    echo "<script>console.log('Entered genre2')</script>";
    // echo $dbConn;
    // global $dbConn;

    // $sql ="SELECT movieInfo.genreId2, genreName
    //       FROM movieInfo
    //       JOIN movieGenre on movieInfo.genreId2 = movieGenre.genreId
    //       WHERE movieName = :movieName";
    // $namedParameters = array();
    // $namedParameters[':movieName'] = $_POST['movieName'];
    // $stmt=$dbConn->prepare($sql);
    // $stmt->execute($namedParameters);
    // $genre2=$stmt->fetch(PDO::FETCH_ASSOC);
    // // echo "<script>console.log(".$genre2.")</script>";
    // echo $dbConn;
}

include 'calls/db.php';
$conn = getDB("finalMovies");
$sql = "SELECT * FROM movieInfo";
$statement = $conn->prepare($sql);
$statement->execute();  //ALWAYS PASS the named parameters,if any
$movies = $statement->fetchAll(PDO::FETCH_ASSOC);


function printMovieNames() {
    global $movies;
    echo "<select id='movieName'>";
    echo "    <option disabled selected value>Select a Movie</option>";
    foreach ($movies as $movie) {
        echo "<option>". $movie['movieName'] . "</option>";
    }
    echo "</select>";
}

function updateMovie() {
    // echo $_POST['movieName'];
    // echo $conn;
    // $movie = $_POST['movieName'];
    // echo $movie;
    $host = 'localhost';
    $dbname = 'finalMovies';
    $username = 'username';
    $password = 'password';

    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Setting Errorhandling to Exception
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE movieInfo
            SET movieImage       = :movieImage,
                movieDesc        = :movieDesc,
                movieDirector    = :movieDirector,
                genreId          = :movieGenre1,
                genreId2         = :movieGenre2,
                ratingId         = :ratingId
            WHERE movieName      = :movieName";                 //changed from '". $_POST['movieName'] . "
    $namedParameters = array();
    $namedParameters[':movieName'] = $_POST['movieName'];       //added this
    $namedParameters[':movieImage'] = $_POST['movieImage'];
    $namedParameters[':movieDesc'] = $_POST['movieDesc'];
    $namedParameters[':movieDirector'] = $_POST['movieDirector'];
    $namedParameters[':movieGenre1'] = $_POST['movieGenre1'];
    $namedParameters[':movieGenre2'] = $_POST['movieGenre2'];
    $namedParameters[':ratingId'] = $_POST['movieRating'];

    $stmt=$dbConn->prepare($sql);
    $stmt->execute($namedParameters);
}



?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style>
        /*html {*/
        /*    height: 100%;*/
        /*}*/
            table {
                text-align: center;
            }
            td {
                max-width: 500px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="admin.php">MovieDatabase</a>
              <!--<li class="active"><a href="admin.php" class="btn btn-default" role="button"><span class="glyphicon glyphicon-home"></span></a></li>-->
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
        <h1>Choose a Movie to Update</h1>
        <div class="select-style">
        <?=printMovieNames()?>
        </div>
        <br><br>

        <form method="post">

        <div id="return"></div>
        <br>
        <button type="submit" name="submit" />Update Movie</button>
        </form>

        <script>
        $(document).ready(function() {
            var genre2;
            var decodedGenre2;

            $("#movieName").change(function() {
                // var name = $("movieName").val();
                // var returnValue = ?=displayMovies(name)?>
                // console.log(returnValue);
                $.ajax({
                    type: "POST",
                    url: "calls/updateGenre2.php",
                    data: {name: $("#movieName").val()}
                })
                .done(function(data) {
                    console.log(data);
                    decodedGenre2 = jQuery.parseJSON(data);
                    console.log(decodedGenre2.genreName);
                    console.log(decodedGenre2.genreId2);
                    genre2 = decodedGenre2.genreName;
                })
                .fail(function(xhr, status, errorThrown) {
                    console.log("Sorry, there was a problem!");
                })
                .always(function(xhr, status) {
                    console.log("AJAX call 1 is complete!");
                }); //end of AJAX call 1
        // --------------------------------------------------------------------
                $.ajax({
                    type: "POST",
                    url: "calls/updateDisplayMovie.php",
                    data: {name: $("#movieName").val()}
                })
                .done(function(data) {
                    var decoded = jQuery.parseJSON(data);
                    console.log(decoded);
                    $("#return").html("");
                    $("#return").append($("<table border=1>")
                            .append($("<tr>")
                                .append($("<td>").html("Movie Name").css("font-weight", "bold"))
                                .append($("<td>").html(decoded.name))
                                .append($("<td>").html("<input type='text' name='movieName' readonly value='"+decoded.name+"' >"))
                            )
                            .append($("<tr>")
                                .append($("<td>").html("Movie Director").css("font-weight", "bold"))
                                .append($("<td>").html(decoded.director))
                                .append($("<td>").html("<input type='text' name='movieDirector' value='"+decoded.director+"'>"))
                            )
                            .append($("<tr>")
                                .append($("<td>").html("Movie Image").css("font-weight", "bold"))
                                .append($("<td>").html("<img height=100 src='" + decoded.image + "'>"))
                                .append($("<td>").html("<input type='text' name='movieImage' value='"+decoded.image+"'>"))
                            )
                            .append($("<tr>")
                                .append($("<td>").html("Movie Description").css("font-weight", "bold"))
                                .append($("<td>").html(decoded.description))
                                .append($("<td>").html("<input type='text' name='movieDesc' value='"+decoded.description+"'>"))
                            )
                            .append($("<tr>")
                                .append($("<td>").html("Movie Genre1").css("font-weight", "bold"))
                                .append($("<td>").html(decoded.genre1Name +": ID#"+decoded.genre1))
                                .append($("<td>").html("<div class='tooltip1'><input type='text' name='movieGenre1' value='"+decoded.genre1+"'><span class='tooltiptext'>Comedy-1<br>Suspense-2<br>Action-3<br>Horror-4<br>Drama-5<br>War-6<br>Documentary-7<br>Fantasy-8<br>Biography-9<br>War-10<br>Animation-11<br>Mystery-12<br>Romance-13<br>Music-14<br>Thriller-15<br>Science<br>Fiction-16</span></div>"))
                            )
                            .append($("<tr>")
                                .append($("<td>").html("Movie Genre2").css("font-weight", "bold"))
                                .append($("<td>").html(genre2 + ": ID#" + decodedGenre2.genreId2))
                                .append($("<td>").html("<div class='tooltip1'><input type='text' name='movieGenre2' value='"+decoded.genre2+"'><span class='tooltiptext'>Comedy-1<br>Suspense-2<br>Action-3<br>Horror-4<br>Drama-5<br>War-6<br>Documentary-7<br>Fantasy-8<br>Biography-9<br>War-10<br>Animation-11<br>Mystery-12<br>Romance-13<br>Music-14<br>Thriller-15<br>Science<br>Fiction-16</span></div>"))
                            )
                            .append($("<tr>")
                                .append($("<td>").html("Movie Rating").css("font-weight", "bold"))
                                .append($("<td>").html(decoded.ratingName +": ID#"+ decoded.ratingId))
                                .append($("<td>").html("<div class='tooltip1'><input type='text' name='movieRating' value='"+decoded.ratingId+"'><span class='tooltiptext'>G-1<br>PG-2<br>(PG-13)-3<br>R-4<br>NR-5</span></div>"))
                            )
                        )
                })
                .fail(function(xhr, status, errorThrown) {
                    console.log("Sorry, there was a problem!");
                })
                .always(function(xhr, status) {
                    console.log("AJAX call 2 is complete!");
                });
                }) //end of form.change
        })


        </script>

    </body>
</html>
