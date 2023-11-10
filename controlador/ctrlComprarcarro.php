<?php
// ocupamos llamar perfil y autor
require_once '../modelos/carrito.php';
require_once '../modelos/auth.php';
require_once '../modelos/conexion.php';

$auth = new Auth(); 
$carrito= new carrito();
if ($auth->isLoggedIn()) {
    //mandamos llamar de la clse auth, lo que es el id
    $userID = $auth->getUserId();
    // nos enlazamos a perfil, para despues poder tomar el valor del id de la sesion, que esta en auth
  
    // mandamos llamar la clase de obtener de la variable perfil que es la clase perfil
    $carritoComprado=$carrito->comprarCarrito($userID);
    //$usuariosCarrito = $carrito->obtenerCursosCarrito($userID);
} else {
    // El usuario no ha iniciado sesión, redirige a la página de inicio de sesión
    $auth->redirectToLogin();
}