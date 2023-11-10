<?php
// ocupamos llamar perfil y autor
require_once '../modelos/carrito.php';
require_once '../modelos/auth.php';
require_once '../modelos/conexion.php';

$auth = new Auth();
$carrito = new Carrito(); // Asegúrate de que la clase se llama Carrito (con mayúscula inicial)
if ($auth->isLoggedIn()) {
    // Obtenemos el ID de usuario desde la clase Auth
    $userID = $auth->getUserId();

    // Llamamos a la función carritosContador de la clase Carrito
    $totalCarritos = $carrito->carritosContador($userID);
    echo "" . $totalCarritos;
} else {
    // El usuario no ha iniciado sesión, redirige a la página de inicio de sesión
    $auth->redirectToLogin();
}