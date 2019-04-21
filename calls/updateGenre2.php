<?php
include "db.php";
$conn = getDB("finalMovies");
$sql = "SELECT genreId2, genreName
        FROM movieInfo
        JOIN movieGenre ON genreId2 = movieGenre.genreId
        WHERE movieName = :movieName";
// $sql = "SELECT movieName name, movieImage image, movieDirector director, movieDesc description, genreId genre1, genreId2 genre2, ratingId rating FROM movieInfo WHERE movieName = '" .$_POST['name']. "'";
// $sql = "SELECT movieName name, movieImage image, movieDirector director, movieDesc description, genreId genre1, genreId2 genre2, ratingId rating FROM movieInfo WHERE movieName = 'Bridge of Spies'";
$namedParameters = array();
$namedParameters[':movieName'] = $_POST['name'];
$stmt=$conn->prepare($sql);
$stmt->execute($namedParameters);
$genre=$stmt->fetch(PDO::FETCH_ASSOC);
// echo $movies;
echo json_encode($genre);
// foreach ($movies as $movie)
//     echo $movie;
?>
