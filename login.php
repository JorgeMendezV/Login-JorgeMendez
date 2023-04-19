<?php 
// Iniciando la sesión
session_start();
// Incluyendo el archivo de conexión a la base de datos
require 'database.php';

// Comprobando si los campos de entrada del usuario no están vacíos
if(!empty($_POST['dui']) && !empty($_POST['password'])){
  // Preparando la consulta SQL para seleccionar los registros de la tabla "users" donde el campo "dui" es igual al valor ingresado por el usuario
  $records = $conn -> prepare('SELECT id, dui, contrasena FROM usuarios WHERE dui = :dui');
  // Vinculando el valor de "dui" con el valor ingresado por el usuario
  $records -> bindParam(':dui' , $_POST['dui']);
  // Ejecutando la consulta SQL
  $records -> execute();
  // Obteniendo el resultado de la consulta SQL
  $results = $records -> fetch(PDO::FETCH_ASSOC);

  // Verificando si se encontró un registro de usuario con el "dui" 
  if($results !== null && is_countable($results)){
    // Verificando si la contraseña ingresada por el usuario coincide en la bd
    if(password_verify($_POST['password'], $results['contrasena'])){
      // Si el usuario se autenticó correctamente, se establece el ID y nombre
      $_SESSION['user_id'] = $results['id'];
      header('Location: /LOGIN-JORGEMENDEZ/');
    } else {
      // Si el usuario no se autenticó correctamente, se establece un mensaje de error en la variable de sesión "message"
      $_SESSION['message']  = 'sorry, Those credentials do not match';
    }
  } else {
    // Si no se encontró un registro de usuario con el "dui" ingresado por el usuario, se establece un mensaje de error en la variable de sesión "message"
    $_SESSION['message']  = 'sorry, Those credentias do not exists';
  }
}
?>


<!-- Este es un documento HTML que contiene una página de inicio de sesión -->
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <title>Login practica II Jorge Méndez</title>
    <!-- Se enlaza la hoja de estilos que controla el estilo visual de la página -->
    <link rel="stylesheet" href="./assets/css/logstyle.css">
  </head>

  <body>
    <!-- Si existe una variable de sesión llamada 'message', se muestra un mensaje de alerta en JavaScript -->
    <?php if(isset($_SESSION['message'])): ?>
      <script>
          alert('<?php echo $_SESSION['message']; ?>');
      </script>
      <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    
    <!-- Se crea un contenedor para el contenido de la página -->
    <div class="container">
      <!-- Se crea un contenedor para el formulario de inicio de sesión -->
      <div class="login-container">
        <!-- Se crea un título para el formulario -->
        <h1 class="login-title">Change with Guided Learning</h1>
        <!-- Se agrega una imagen de Oracle como logo -->
        <img src="./assets/shared/Oracle-logo.png" alt="Logo" class="login-logo">
        
        <!-- Se crea un formulario para el inicio de sesión -->
        <form action="login.php" method="POST">
          <!-- Se agrega un campo de entrada de texto para el usuario con validación de patrón -->
          <input type="text" name="dui" autocomplete="off" placeholder="Documento único" class="login-input" required pattern="^\d{7}-\d$" 
            title="Se requiere que ingrese su DUI. Ejemplo: 0012345-0"/>
          <!-- Se agrega un campo de entrada de contraseña con validación de patrón -->
          <input type="password" name="password" 
            placeholder="Contraseña" autocomplete="off" class="login-input" 
              required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$" 
              title="Su contraseña debe tener mínimo 8 caracteres, entre ellos minúsculas, mayúsculas y al menos 1 carácter especial."/>
          <!-- Se agrega un botón para enviar el formulario -->
          <button type="submit" value="Submit"> Iniciar sesión </button>

          <!-- Se agrega un enlace para recuperar la contraseña -->
          <p class="generic-text">¿Olvido la
            <a href="#"> contraseña?</a>
          </p>
        </form>
      </div>

      <!-- Se crea un contenedor para el botón de registro -->
      <div class="signup-container">
        <!-- Se agrega un texto promocionando el registro -->
        <p class="generic-text">¿No tienes una cuenta?</p>
        <!-- Se agrega un botón para acceder a la página de registro -->
        <button class="signup-button"> <a href="signup.php"> Crear cuenta </a> </button>
      </div>
    </div>
  </body>
</html>
