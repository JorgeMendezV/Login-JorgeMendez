<?php

  session_start();
  require 'database.php';
  include('verification.php');

  verificar_login();

  $message = '';

  if (isset($_SESSION['user_id'])){
    $records = $conn -> prepare('SELECT id, dui, password FROM users WHERE id = :id');
    $records -> bindParam(':id', $_SESSION['user_id']);
    $records -> execute();
    $results = $records -> fetch(PDO::FETCH_ASSOC);

    $user = null;

    if(count($results) > 0){
      $user = $results;
    }
  }

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <!--Recomendable poner para definir como se ajustara la página web
          y con esto se establece que se mostrara en la escala inicial sin Zoom-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Archivos CSS de Bootstrap 5 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">

  <!-- Script de jQuery (dependencia de Bootstrap) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Archivos JavaScript de Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


  <title>MAIN PAGE</title>
  <!--Estilo en cascada externo-->
  <link rel="stylesheet" href="./assets/css/mainstyle.css" />
</head>

<body>
  <header class="content-container">
    <section>
      <div class="header-container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
          <div class="container-fluid">
            <a class="navbar-brand" href="#"
              style="font-family: Garamond, serif; font-weight: bold; font-size: 24px; letter-spacing: 5px;">ORACLE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav me-auto">
                <li class="nav-item">
                  <a class="nav-link" href=".">INICIO</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#Nosotros">NOSOTROS</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#Servicios">SERVICIO</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#Contactanos">CONTACTO</a>
                </li>
              </ul>
              <?php if(!empty($user)) : ?>
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <?php echo $user['dui']; ?>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="logout.php">Cerrar sesión</a>
                </li>
              </ul>
              <?php else : ?>
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="login.php">LOG IN</a>
                </li>
              </ul>
              <?php endif; ?>
            </div>
          </div>
        </nav>
        <div class="nav-img-container">
          <img src="./assets/image/oracle-office2.jpg" alt="Imagen de fondo" />
        </div>
        <div class="text-center mt-3">
          <h3> About Oracle</h3>
          <h4>Our mission is to help people see data in new ways,
            <br> discover insights, unlock endless possibilities.
          </h4>
        </div>
      </div>
    </section>
  </header>

  <main>
    <section id="Nosotros">
      <div class="container">
        <h1 class="text-center mb-5">CONOCE A NUESTRO EQUIPO DE ILUSTRADORES</h1>
        <div class="row g-4">
          <div class="col-md-4">
            <div class="card h-100">
              <img src="./assets/image/pexels-hannah-nelson-1085517.jpg" class="card-img-top" alt="i1">
              <div class="card-body">
                <h3 class="card-title">Hanna Roz</h3>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                  incididunt ut labore et dolore magna aliqua.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card h-100">
              <img src="./assets/image/pexels-key-notez-1334945.jpg" class="card-img-top" alt="i1">
              <div class="card-body">
                <h3 class="card-title">Rodrigo Hernández</h3>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                  incididunt ut labore et dolore magna aliqua.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card h-100">
              <img src="./assets/image/pexels-kelly-3030332.jpg" class="card-img-top" alt="i1">
              <div class="card-body">
                <h3 class="card-title">Kell Anderson</h3>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                  incididunt ut labore et dolore magna aliqua.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="Servicios">
      <h1 class="text-center mb-5">NUESTROS SERVICIOS</h1>
      <div id="Servicios" class="row g-4 justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">
          <div class="box-items-services text-center">
            <img src="./assets/image/art-book.png" alt="i1" />
            <h3>Ilustraciones para libros</h3>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua.
            </p>
          </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
          <div class="box-items-services text-center">
            <img src="./assets/image/drawing.png" alt="i1" />
            <h3>Animación de personajes</h3>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua.
            </p>
          </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
          <div class="box-items-services text-center">
            <img src="./assets/image/social-media.png" alt="i1" />
            <h3>Ilustraciones publicitarias</h3>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua.
            </p>
          </div>
        </div>
      </div>
    </section>


    <section id="Contactanos">
      <h1>CONTÁCTANOS</h1>
      <div class="contact-container">
        <img src="./assets/image/R.png" alt="mapa" class="img-fluid">
        <p class="mt-3">456 Park Avenue, Suite 789, New York, NY, 10022, Estados Unidos.</p>
      </div>
    </section>

  </main>
  <footer class="footer py-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <p class="text-center">Todos los derechos reservados ®<br>Jorge Mendez</p>
        </div>
      </div>
    </div>
  </footer>

</body>

</html>