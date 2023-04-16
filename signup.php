<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['dui']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO Users (dui, password) VALUES (:dui, :password)";
    // para que usar prepare??
    $statement = $conn -> prepare($sql);

    $statement-> bindParam(':dui', $_POST['dui']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $statement-> bindParam(':password', $password);
   
    if($statement -> execute()){
        $message = 'Successfully created new user';
        header('Location: /LOGIN-JORGEMENDEZ/login.php');
    } else {
        $message = 'Sorry there must have been an issue creating your account';
    }
}


?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <title>Login practica II Jorge Méndez</title>
    <link rel="stylesheet" href="assets/css/logstyle.css">
    <style>
    </style>
  </head>

  <body>

    <?php if(!empty($message)): ?> 
        <p><?= $message ?> </p>
    <?php endif; ?>

    <div class="container">
      <div class="login-container">
        <h1 class="login-title">Your first step to a better life!</h1>
        <img src="./assets/shared/Oracle-logo.png" alt="Logo" class="login-logo">
        
        <form action="signup.php" method="POST">
          <input type="text" name="dui" autocomplete="off" placeholder="Usuario" class="login-input" required pattern="^\d{7}-\d$" 
            title="Se requiere que ingrese su DUI. Ejemplo: 0012345-0"/>
            <!-- Este pattern utiliza una expresión de búsqueda positiva, los primeros paréntesis indican este lookahead-->
            <!-- Ejemplo: ?=.* por si solo no significa nada y no está correcto, pero ^(?=.*[a-z]), se convierte en búsqueda positiva 
                        y verifica si la cadena contiene al menos una letra minúscula, pero solo busca, 
                        si se requiere que acepte esos campos, después del último ')' se agregaría la instrucción normal, 
                        en este caso [A-Za-z\d!@#$%^&*]{8,} -->
  
          <input type="password" name="password" autocomplete="off" placeholder="Contraseña" class="login-input" 
              required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$" 
              title="Su contraseña debe tener mínimo 8 caracteres, entre ellos minúsculas, mayúsculas y al menos 1 carácter especial."/>

          <input type="password" autocomplete="off" placeholder="Ingrese nuevamente su contrasena" class="login-input" 
              required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$" 
              title="Su contraseña debe tener mínimo 8 caracteres, entre ellos minúsculas, mayúsculas y al menos 1 carácter especial."/>

              <button type="submit" value="Submit"> create account </a></button>
        </form>
      </div>
    </div>

  </body>
</html>