<?php
require_once '../modelos/subir.php';
require_once '../modelos/conexion.php';
require_once '../modelos/auth.php'; // Asegúrate de que esta línea incluye auth.php

$conexion = new Conexion();
$agregarTenis= new AgregarTenis($conexion->conectar());

$auth = new Auth(); // Asegúrate de instanciar la clase Auth

if ($auth->isLoggedIn()) {
    $userID = $auth->getUserId();
    $agregarTenis->subir($userID);
} else {
    echo "El usuario no está autenticado."; // Maneja la lógica para usuarios no autenticados
}