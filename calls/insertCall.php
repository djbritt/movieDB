<?php
include 'db.php';
$conn = getDB("finalMovies");
$sql = "INSERT INTO movieInfo
            (movieName, movieImage, movieDesc, movieDirector, genreId, genreId2, ratingId) 
            VALUES (:name, :image, :description, :director, :genre1, :genre2, :rating)";
$namedParameters = array();
$namedParameters[":name"] = $_GET['name'];
$namedParameters[":image"] = $_GET['image'];
$namedParameters[":description"] = $_GET['description'];
$namedParameters[":director"] = $_GET['director'];
$namedParameters[":genre1"] = $_GET['genre1'];
$namedParameters[":genre2"] = $_GET['genre2'];
$namedParameters[":rating"] = $_GET['rating'];

$statement = $conn->prepare($sql);
$statement->execute($namedParameters);  //ALWAYS PASS the named parameters,if any
echo "Movie was added!";

// echo "<h1>Movies</h1>";
// echo "<table>";
// echo "<tr><td>".$_GET['name']."</td></tr>";
// echo "<tr><td>".$_GET['image']."</td></tr>";
// echo "<tr><td>".$_GET['description']."</td></tr>";
// echo "<tr><td>".$_GET['director']."</td></tr>";
// echo "<tr><td>".$_GET['genre1']."</td></tr>";
// echo "<tr><td>".$_GET['genre2']."</td></tr>";
// echo "<tr><td>".$_GET['rating']."</td></tr>";
// echo "</table>";
?>
