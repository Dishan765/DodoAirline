<?php
//CONNECTING TO DATABASE
$servername = "localhost";
$username = "root";
$password = "12345";
$databaseName = "dodo";

try {
    //CONNECTING TO DATABASE
    $conn = new PDO("mysql:host=$servername;dbname=$databaseName", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";

} catch (PDOException $e) {
    echo ($query) . "<br>" . $e->getMessage();
}