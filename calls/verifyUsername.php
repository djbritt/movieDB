<?php
include 'db.php';

$dbConn = getDB("finalMovies");
global $dbConn;


$sql = "SELECT username
         FROM  users
         WHERE username = :username";

$statement = $dbConn->prepare($sql);
$statement->execute(array(":username"=> $_GET['username']));

$result = $statement->fetch(PDO::FETCH_ASSOC);

// print_r($result);

echo json_encode($result);


?>
