<?php
$server = 'PMYSQL122.dns-servicio.com';
$username = 'app_admin';
$password = 'B@lseraPrados13!';
$database = '7303353_app';


try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
  
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}

$connexion = mysqli_connect($server, $username, $password, $database);

if (!$connexion) {
    die("Connection failed: " . mysqli_connect_error());
}

?>