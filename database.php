<?php 
  $server = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'php_login_database';

try {
    // tratamos de conectarnos pasando los parametros anteriores.
    $conn = new PDO("mysql:host=$server; dbname=$database;", $username, $password);
} catch (PDOException $e){
    // punto es para concatenar en php, en este caso se concatenara el error
    die('Connected failed: '.$e -> getMessage());
}
?>