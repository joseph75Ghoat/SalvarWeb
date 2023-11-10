<?php

use PhpParser\Node\Stmt\Echo_;

require_once '../modelos/carrito.php';
require_once '../modelos/auth.php';
require_once '../modelos/mostrar.php';


// Verifica si se ha enviado el ID del curso por la URL
if (isset($_GET['id']) && isset($_GET['cantidad'])) {
    // Recibe el ID del curso y la cantidad
    $tenisID = $_GET['id'];
    $cantidad = $_GET['cantidad'];

    // echo $tenisID.$cantidad;

    // Resto del código para agregar el producto al carrito
    $auth = new Auth();
    if ($auth->isLoggedIn()) {
        $userID = $auth->getUserId();
        $carrito = new carrito();
        $carrito->agregarCarrito($userID, $tenisID, $cantidad);
    }


}
?>