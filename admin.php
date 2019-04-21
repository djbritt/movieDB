<?php
session_start();

if (!isset($_SESSION['username'])) { //checks whether the admin has logged in
    header("Location: index.php"); 
    exit;
}

?>

<!DOCTYPE html>
<html>
    <head>
    <title>Admin </title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <style>
        html {
         height: 100%;
        }
        
    </style>
    
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
                
        <div class="jumbotron">
            <h1>Admin Page</h1>
        </div>       
       </header>
    </div>
    <div class="buttons">
        <a href="updateMovie.php" class="button">Update a Movie</a>
        <a href="insertRecords.php" class="button orange">Insert a Movie</a>
        <a href="deleterecords.php" class="button purple">Delete a Movie</a>
        <a href="reports.php" class="button turquoise">Movie Reports</a>
        <a href="searchmovies.php" class="button red">Search Movies</a>
    </div>
    </body>
</html>
