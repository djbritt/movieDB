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
        <title>Delete Movies </title>
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
        <div style="margin-bottom: -30px;" class="jumbotron">
            <h1>Delete a Movie</h1>
        </div>
            <!--<form action="deletemovie.php" onsubmit="return deleteConfirm()" method="get">-->
            <form action="calls/deletemovie.php" method="get">
                <table id="movies">
                    <th>Delete?</th>
                    <th>Movie Name</th>
                    <th>Movie Director</th>
                    <th>Movie Description</th>
                    <th>Movie Image</th>
                    <th>Movie Genre ID</th>
                    <th>Movie Rating ID</th>
                </table>
                </div>
            </form>
            
            <script>
            var decoded;
            var currentMovie;
            function confirmDelete(name) {
                currentMovie = name;
                var value = confirm("Are you sure you want to delete " + name.value + "?");
                if (value) deleteMovie();
                location.reload();
            }
            
            function deleteMovie() {
                console.log("hello");
                $.ajax({
                    type: "POST",
                    url: "calls/deletemovie.php",
                    data: {name: currentMovie.value} 
                })
                .done(function() {
                    
                    // console.log(data)
                })
                .fail(function(xhr, status, errorThrown) {
                    console.log("Sorry, there was a problem!");
                })
                .always(function(xhr, status) {
                    console.log("AJAX call 1 is complete!");
                }); //end of AJAX call 1
            }
            
            $(document).ready(function() {
                
            $.ajax({
                type: "POST",
                url: "calls/displayMovies.php"
            })
            .done(function(data) {
                decoded = jQuery.parseJSON(data);
                console.log(decoded);
                console.log(decoded.length)
                for (decodedItem in decoded) {
                    var name = decoded[decodedItem].movieName;
                    // console.log(decodedItem)
                    $("#movies>tbody")
                                .append($("<tr>")
                                    .append($("<td>").html("<button id='delete' type='submit' value='"+name+"' onclick='confirmDelete(this)'>Delete</button>")
                                    // gotoNode(\'' + result.name + '\')
                                )
                                    .append($("<td class='name'>").html(decoded[decodedItem].movieName)
                                )
                                    .append($("<td>").html(decoded[decodedItem].movieDirector)
                                )
                                    .append($("<td>").html(decoded[decodedItem].movieDesc)
                                )
                                    .append($("<td>").html("<img height=100 src='" + decoded[decodedItem].movieImage + "'>")
                                )
                                    .append($("<td>").html(decoded[decodedItem].genreId)
                                )
                                    .append($("<td>").html(decoded[decodedItem].ratingId)
                                ))
                }
                
            })
            .fail(function(xhr, status, errorThrown) {
                console.log("Sorry, there was a problem!");
            })
            .always(function(xhr, status) {
                console.log("AJAX call 2 is complete!");
            }); //end of AJAX call 1
            })
            </script>
    </body>
</html>
