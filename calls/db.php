<?php
function getDB($db) {
    $host = 'localhost';
    $dbname = $db;
    $username = 'username';
    $password = 'pass!';

    $dbConn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    // Setting Errorhandling to Exception
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbConn;
    // return $db;
}

?>
