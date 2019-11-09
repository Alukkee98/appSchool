<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'app';


try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
  
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}

$link = mysqli_connect($server, $username, $password, $database);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
?>