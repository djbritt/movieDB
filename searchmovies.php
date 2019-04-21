<?php
include "calls/db.php";
$conn = getDB("finalMovies");

function getMovieGenres() {
    global $conn;
    $sql = "SELECT genreName FROM movieGenre";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $genres=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($genres as $genre) {
        echo "<option>".$genre['genreName']."</option>";
    }
}

function getMovieDirectors(){
    global $conn;
    $sql = "SELECT movieDirector FROM movieInfo";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $directors=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($directors as $director) {
        echo "<option>".$director['movieDirector']."</option>";
    }
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
        <a href="index.php"><button>Home</button></a>
    <h1>Movie Finder</h1>
        <form method="get">
            Movie Title Keyword:
                <input type="text" name="content">
                <br /><br>
            Movie Rating:
                <br>
                <input type="radio" name="ratingId" value="1" id="G">
                <label for="ratingChoice">G</label>
                <input type="radio" name="ratingId" value="2" id="PG">
                <label for="ratingChoice">PG</label>
                <input type="radio" name="ratingId" value="3" id="PG-13">
                <label for="ratingChoice">PG-13</label>
                <input type="radio" name="ratingId" value="4" id="R">
                <label for="ratingChoice">R</label>
                <input type="radio" name="ratingId" value="5" id="NR">
                <label for="ratingChoice">NR</label>
                <br><br>
            Movie Director: 
            <div class="select-style">
                <select name="movieDirector">
                    <option disabled selected value> -- select an option -- </option>
                    <?=getMovieDirectors()?>
                </select>
            </div>
                <br><br><br>
                <button type="submit" onclick="erase()" name="submit">Find Your Movie Now!</button>
        </form>
        <br>
        <script>
            function erase() {
                $("#movies").html("");
            }
        </script>
    <div id="movies">
        <?php
            if (isset($_GET['submit'])){
                global $conn;
                
                $sql = "SELECT *
                        FROM movieInfo
                        NATURAL JOIN movieGenre
                        NATURAL JOIN movieRating
                        WHERE 1";
                
                $namedParameters = array();
                
                if(!empty($_GET['content'])){ //checks whether user typed something into the Quote Content textbox
                    //Following SQL works BUT doesn't prevent SQL INJECTION
                    //$sql=$sql." AND quote LIKE '% ".$_GET['content']." %'";   
                      $sql=$sql." AND movieName LIKE :content "; //using named parameters to prevent SQL Injection
                    //   $str = strtolower($_GET['content']);
                      $namedParameters[':content'] = "%".$_GET['content']."%";
                }
                if(!empty($_GET['ratingId'])){
                    // echo $_GET['genreName'];
                      $sql=$sql." AND ratingId = :ratingId "; //using named parameters to prevent SQL Injection
                      $namedParameters[':ratingId'] = $_GET['ratingId'];
                }
                if(!empty($_GET['movieDirector'])){
                    // echo $_GET['genreName'];
                      $sql=$sql." AND movieDirector = :movieDirector "; //using named parameters to prevent SQL Injection
                      $namedParameters[':movieDirector'] = $_GET['movieDirector'];
                }
                
                $stmt=$conn->prepare($sql);
                $stmt->execute($namedParameters);
                $movies=$stmt->fetchAll(PDO::FETCH_ASSOC);
                
                foreach ($movies as $movie){
                    echo $movie['movieName'] . "<br>";  
                } 
            }
        ?>
    </div>
    <script>
        
    </script>
    </body>
</html>
