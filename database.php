<?php 
// Variables con parametros para una nueva PDO
  $server = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'php_login_db';

try {
  //PDO(PHP Data Objects)
    // Tratamos de conectarnos pasando los parámetros anteriores.
    $conn = new PDO("mysql:host=$server; dbname=$database;", $username, $password);
} catch (PDOException $e){
    // Punto es para concatenar en php, en este caso se concatenará el error
    die('Connected failed: '.$e -> getMessage());// die similar a la función exit(), finaliza la ejecución.
}
?>