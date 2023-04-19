<?php 
  // Se inicia la sesión de PHP
  session_start();

  // Se eliminan todas las variables de sesión
  session_unset();

  // Se destruye la sesión actual
  session_destroy();

  // Se redirige al usuario a la página de inicio de sesión
  header('Location: /LOGIN-JORGEMENDEZ/login.php');
?>