<?php 
// para utilizar las sesiones
  session_start();
  require 'database.php';

  if(!empty($_POST['dui']) && !empty($_POST['password'])){
    $records = $conn -> prepare('SELECT id, dui, password FROM users WHERE dui = :dui');
    $records -> bindParam(':dui' , $_POST['dui']);
    $records -> execute();
    $results = $records -> fetch(PDO::FETCH_ASSOC);

    $message = '';
    if($results !== null && is_countable($results)){
      if(count($results) > 0 && password_verify($_POST['password'], $results['password'])){
        $_SESSION['user_id'] = $results['id'];
        $_SESSION['message']  = 'All good';
        header('Location: /LOGIN-JORGEMENDEZ/');
        } else {
          // si no existe el usuario o no es correcta la contrasena
          $_SESSION['message']  = 'sorry, Those credentials do not match';
        }
      } else {
        $_SESSION['message']  = 'sorry, Those credentias do not exists';
      }
    }

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <title>Login practica II Jorge Méndez</title>
    <link rel="stylesheet" href="./assets/css/logstyle.css">
  </head>

  <body>
    <?php if(isset($_SESSION['message'])): ?>
      <script>
          alert('<?php echo $_SESSION['message']; ?>');
      </script>
      <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    
    <div class="container">
      <div class="login-container">
        <h1 class="login-title">Change with Guided Learning</h1>
        <img src="./assets/shared/Oracle-logo.png" alt="Logo" class="login-logo">
        
        <form action="login.php" method="POST">
          <input type="text" name="dui" autocomplete="off" placeholder="Usuario" class="login-input" required pattern="^\d{7}-\d$" 
            title="Se requiere que ingrese su DUI. Ejemplo: 0012345-0"/>
            <!-- Este pattern utiliza una expresión de búsqueda positiva, los primeros paréntesis indican este lookahead-->
          <input type="password" name="password" 
            placeholder="Contraseña" autocomplete="off" class="login-input" 
              required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$" 
              title="Su contraseña debe tener mínimo 8 caracteres, entre ellos minúsculas, mayúsculas y al menos 1 carácter especial."/>
          <button type="submit" value="Submit"> Iniciar sesión </button>

          <p class="generic-text">¿Olvido la
            <a href="#"> contraseña?</a>
          </p>
        </form>
      </div>

      <div class="signup-container">
        <p class="generic-text">¿No tienes una cuenta?</p>
        <button class="signup-button"> <a href="signup.php"> Crear cuenta </a> </button>
      </div>
    </div>
  </body>
</html>