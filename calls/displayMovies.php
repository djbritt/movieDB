<?php
include "db.php";
$conn = getDB("finalMovies");
$sql = "SELECT *
        FROM movieInfo 
        JOIN movieGenre on movieInfo.genreId = movieGenre.genreId
        JOIN movieRating on movieInfo.ratingId = movieRating.ratingId";
$stmt=$conn->prepare($sql);
$stmt->execute();
$movies=$stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($movies);
?>
