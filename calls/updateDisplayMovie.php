<?php
include "db.php";
$conn = getDB("finalMovies");
// $sql = "SELECT movieName name,  FROM movieInfo WHERE movieName = '".$_GET['name']."'";
// $sql = "SELECT * FROM movieInfo WHERE movieName = 'Bridge of Spies'";
$sql = "SELECT movieName name, movieImage image, movieDirector director, movieDesc description, movieInfo.genreId genre1, genreId2 genre2, genreName genre1Name, movieInfo.ratingId ratingId, ratingName
        FROM movieInfo 
        JOIN movieGenre on movieInfo.genreId = movieGenre.genreId
        JOIN movieRating on movieInfo.ratingId = movieRating.ratingId
        WHERE movieName =  :movieName";
$namedParameters = array();
$namedParameters[':movieName'] = $_POST['name'];
// $sql = "SELECT movieName name, movieImage image, movieDirector director, movieDesc description, genreId genre1, genreId2 genre2, ratingId rating FROM movieInfo WHERE movieName = 'Bridge of Spies'";
$stmt=$conn->prepare($sql);
$stmt->execute($namedParameters);
$movies=$stmt->fetch(PDO::FETCH_ASSOC);
// echo $movies;
echo json_encode($movies);
// foreach ($movies as $movie)
//     echo $movie;
?>
