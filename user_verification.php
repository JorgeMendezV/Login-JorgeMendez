<?php
function verificar_login() {
    // Verificar si el usuario ha iniciado sesión
    if(!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}
?>