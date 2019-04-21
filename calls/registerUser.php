<?php
include 'db.php';
$conn = getDB("finalMovies");
$sql = "INSERT INTO users
            (name, email, phone, zip, state, username, password) 
            VALUES (:name, :email, :phone, :zip, :state, :username, :password)";
$namedParameters = array();
$namedParameters[":name"] = $_POST['name'];
$namedParameters[":email"] = $_POST['email'];
$namedParameters[":phone"] = $_POST['phone'];
$namedParameters[":zip"] = $_POST['zip'];
$namedParameters[":state"] = $_POST['state'];
$namedParameters[":username"] = $_POST['username'];
$namedParameters[":password"] = sha1($_POST['password']);

$statement = $conn->prepare($sql);
$statement->execute($namedParameters);  //ALWAYS PASS the named parameters,if any
print_r("User Registered!");

?>
