<?php
require_once '../modelos/mostrar.php';
require_once '../modelos/conexion.php';
    $mostrar = new mostrar();
    $catalogo = $mostrar->mostrarCatalogo(); // Obtiene la lista de cursos
?> 