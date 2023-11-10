<?php
require('../modelos/login.php'); // Asegúrate de que login.php esté en la misma ubicación o proporciona la ruta correcta

class llamarLogin {
    public function __construct() {
        // Crea una instancia de la clase login
        $login = new login();
        // Llama al método login para iniciar sesión
        $login->login();
    }
}

// Crear una instancia de la clase OtraClase
$otraClase = new llamarLogin();
?>