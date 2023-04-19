<?php
  // Se requiere el archivo database.php, que contiene la conexión a la base de datos
  require 'database.php';

  // Se inicializa la variable $message
  $message = '';

  // Si se ha enviado un formulario con el campo "dui" y el campo "password" no está vacío
  if (!empty($_POST['dui']) && !empty($_POST['password'])) {

    // Se crea una consulta SQL para insertar un nuevo usuario en la tabla "usuarios"
    $sql = "INSERT INTO usuarios (nombre, dui, contrasena, tipo_usuario_id) VALUES (:nombre, :dui, :password, :tipo_usuario)";

    // Se prepara la consulta para ser ejecutada, esto ayuda a prevenir ataques de inyección SQL
    $statement = $conn -> prepare($sql);

    // Se asignan los valores a los parámetros de la consulta SQL, se usa bindParam para evitar la inyección de SQL
    $statement -> bindParam(':nombre', $_POST['name']);
    $statement -> bindParam(':dui', $_POST['dui']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $statement -> bindParam(':password', $password);
    $statement -> bindValue(':tipo_usuario', 1);

    // Se ejecuta la consulta preparada, si la ejecución es exitosa, se redirige al usuario a la página de inicio de sesión
    if($statement -> execute()){
        $message = 'Successfully created new user';
        header('Location: /LOGIN-JORGEMENDEZ/login.php');
    } else { // Si no se pudo ejecutar la consulta, se muestra un mensaje de error
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

    <!-- Si existe una variable de sesión llamada 'message', se muestra un mensaje de alerta en JavaScript -->
    <?php if(isset($_SESSION['message'])): ?>
      <script>
          alert('<?php echo $_SESSION['message']; ?>');
      </script>
      <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <div class="container">
      <div class="login-container">
        <h1 class="login-title">Your first step to a better life!</h1>
        <img src="./assets/shared/Oracle-logo.png" alt="Logo" class="login-logo">
        
        <form action="signup.php" method="POST">
        <input type="text" name="name" autocomplete="off" placeholder="Nombre de usuario" class="login-input" required pattern="^[a-z|A-Z| ]{5,20}$" 
            title="Se requiere solo letras minúsculas o mayúsculas. Ejemplo: Jairo Orantes"/>
          <input type="text" name="dui" autocomplete="off" placeholder="Documento único" class="login-input" required pattern="^\d{7}-\d$" 
            title="Se requiere que ingrese su DUI. Ejemplo: 0012345-0"/>
            <!-- Este pattern utiliza una expresión de búsqueda positiva, los primeros paréntesis indican este lookahead-->
            <!-- Ejemplo: ?=.* por si solo no significa nada y no está correcto, pero ^(?=.*[a-z]), se convierte en búsqueda positiva 
                        y verifica si la cadena contiene al menos una letra minúscula, pero solo busca, 
                        si se requiere que acepte esos campos, después del último ')' se agregaría la instrucción normal, 
                        en este caso [A-Za-z\d!@#$%^&*]{8,} -->
  
          <input type="password" name="password" autocomplete="off" placeholder="Contraseña" class="login-input" 
              required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$" 
              title="Su contraseña debe tener mínimo 8 caracteres, entre ellos minúsculas, mayúsculas y al menos 1 carácter especial."/>
              <button type="submit" value="Submit"> create account </a></button>
              <button type="submit"><a href="./login.php">Back to login </a></button>
        </form>
      </div>
    </div>

  </body>
</html>