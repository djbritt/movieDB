<?php
session_start();
include 'db.php';
$conn = getDB("finalMovies");

$username = $_POST['username']; //Getting values sent through the Login Form
$password = sha1($_POST['password']); //encrypting the password using SHA1

//The following query does NOT prevent SQL Injection
$sql = "SELECT *
        FROM users
        WHERE username = :username 
          AND password = :password";

$namedParameters = array();
$namedParameters[':username'] = $username;
$namedParameters[':password'] = $password;


$statement = $conn->prepare($sql);
$statement->execute($namedParameters);  //ALWAYS PASS the named parameters,if any
$record = $statement->fetch(PDO::FETCH_ASSOC);

 if (empty($record)) {
    include('badLogin.php');
 } else {
     $_SESSION['username'] = $record['username'];
     $_SESSION['adminFullName'] = $record['firstName'] . " " .  $record['lastName'];
     header("Location: ../admin.php"); //Redirecting users to main admin page
 }


//print_r($record);
?>
