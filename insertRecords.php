<?php
session_start();

if (!isset($_SESSION['username'])) { //checks whether the admin has logged in
    header("Location: index.php"); 
    exit;
}

if (isset($_POST['submit'])) { 
    $_SESSION['name'] = $_POST['name'];
} 

echo $_SESSION['name'];

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Insert New Records</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>-->
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <style>
            html {
             height: 100%;
            }
            body {
                text-align: center;
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
        <!--<a href="admin.php"><button>Home</button></a>-->
        <div class="jumbotron">
            <h1>Insert New Records</h1>
        </div>
        <form onsubmit="return insert()" method="POST">
            <table>
                <tr>
                    <td>Insert Movie Name: </td><td><input type="text" id="name"><span id="nameError"></span></td>        
                </tr>
                <tr>
                    <td>Insert Movie Image URL: </td><td><input type="text" id="image"><span id="imageError"></span></td>        
                </tr>
                <tr>
                    <td>Insert Movie Description: </td><td><input type="text" id="description"><span id="descriptionError"></span></td>        
                </tr>
                <tr>
                    <td>Insert Movie Director: </td><td><input type="text" id="director"><span id="directorError"></span></td>
                </tr>
                <tr>
                    <td>Insert First Movie Genre ID: </td><td><div class='tooltip1'><input type="text" id="genre1"><span class='tooltiptext'>Comedy-1<br>Suspense-2<br>Action-3<br>Horror-4<br>Drama-5<br>War-6<br>Documentary-7<br>Fantasy-8<br>Biography-9<br>War-10<br>Animation-11<br>Mystery-12<br>Romance-13<br>Music-14<br>Thriller-15<br>Science<br>Fiction-16</span></div><span id="genre1Error"></span></td>
                </tr>
                <tr>
                    <td>Insert Second Movie Genre ID: </td><td><div class='tooltip1'><input type="text" id="genre2"><span class='tooltiptext'>Comedy-1<br>Suspense-2<br>Action-3<br>Horror-4<br>Drama-5<br>War-6<br>Documentary-7<br>Fantasy-8<br>Biography-9<br>War-10<br>Animation-11<br>Mystery-12<br>Romance-13<br>Music-14<br>Thriller-15<br>Science<br>Fiction-16</span></div><span id="genre2Error"></span></td>
                </tr>
                <tr>
                    <td>Insert Rating ID: </td><td><div class='tooltip1'><input type="text" id="rating"><span class='tooltiptext'>G-1<br>PG-2<br>(PG-13)-3<br>R-4<br>NR-5</span></div><span id="ratingError"></span></td>
                </tr>
            </table>
                    <br />
                    <button type="button" onclick="insert()">Submit</button>
                </form>
                <div id="added"></div>
        </div>
        </table>
    
    </body>
    <script>
        function insert() {
            var verified = true;
            var genre1Field = $("#genre1").val();
            $("#nameError").html("");
            $("#imageError").html("");
            $("#descriptionError").html("");
            $("#directorError").html("");
            $("#genre1Error").html("");
            $("#genre2Error").html("");
            $("#ratingError").html("");
            if ($("#name").val().trim().length == 0) {
                verified = false;
                $("#nameError").css("color", "red").html(" Name must not be blank...");
            }
            if ($("#image").val().trim().length == 0) {
                verified = false;
                $("#imageError").css("color", "red").html(" Image URL must not be blank...");
            }
            if ($("#description").val().trim().length == 0) {
                verified = false;
                $("#descriptionError").css("color", "red").html(" Description must not be blank...");
            }
            if ($("#director").val().trim().length == 0) {
                verified = false;
                $("#directorError").css("color", "red").html(" Description must not be blank...");
            }
            // console.log($.isNumeric($("#genre1").val()));
            if ($.isNumeric($("#genre1").val()) == false) {
                verified = false;
                $("#genre1Error").css("color", "red").html(" Genre1 must be a number...");
            }
            if ($.isNumeric($("#genre2").val()) == false) {
                verified = false;
                $("#genre2Error").css("color", "red").html(" Genre2 must be a number...");
            }
            if ($.isNumeric($("#rating").val()) == false) {
                verified = false;
                $("#ratingError").css("color", "red").html(" Rating must be a number...");
            }
            if (verified == true) {
                ajaxCall();
            }
            return verified;
        }
        
        function ajaxCall() {
            var name = $("#name").val();
            var image = $("#image").val();
            var description = $("#description").val();
            var director = $("#director").val();
            var genre1 = $("#genre1").val();
            var genre2 = $("#genre2").val();
            var rating = $("#rating").val();
            
            $.ajax({
                type: "GET",
                url: "calls/insertCall.php",
                data: {name: name,
                        image: image, 
                        description: description,
                        director: director,
                        genre1: genre1,
                        genre2: genre2,
                        rating: rating
                }
            })
            .done(function(data) {
                $("#added").append(data);
                // console.log(data);
            })
            .fail(function(xhr, status, errorThrown) {
                console.log("Sorry, there was a problem!");
            })
            .always(function(xhr, status) {
                console.log("The request is complete!");
            });
        }
    </script>
       

</html>
