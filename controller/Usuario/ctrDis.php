<?php

require_once ("../../model/conexion.php");
require_once ("../../model/usuario.php");
require_once '../../adodb5/adodb.inc.php';


if (isset($_GET['opc'])) {
    $opc = $_GET['opc'];
    echo "rntro al opc";
    //echo ($opc);
    switch ($opc) {
        case '1':
            echo "opc1";
            echo "usuario=".$_SESSION["id_rol"];
            //Barra de navegacion $_SESSION["id_usuario"] 
            if (isset($_SESSION["id_usuario"])) {
                if (isset($_SESSION["id_usuario"]) == 1) {
                    echo ' <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <a class="navbar-brand" href="#"><img height="100" width="100" src="../imagenes/Nike-Logo-PNG-Photo-Image.png" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
            
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="../index.html">Cerrar Seccion <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="crud.html">Subir</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="../html/crea_cuenta.html">Crear Cuenta <span class="sr-only">(current)</span></a>
                            </li>
            
                            <li class="nav-item">
                                <!-- <a class="nav-link" href="../html/catalogo.html">Catalago</a> -->
                            <a class="nav-link" href="../html/carrito.php">carrito</a>
                            </li>
                        </ul>
            
                    </div>
            
                    <div>
                        <a class="nav-link" href="carrito.php" id="contador"> <img src="../assets/img/carrito.png" alt="" width="25px" height="auto">
                            <div class="carrito-container">
                                <!--el contador value se usa mas que nada el value para obtener los valores del id que se llama contador-->
                                <span id="contador-value"></span>
                            </div>
                           
                        </a>
                    </div>
            
                </nav>
            ';
                } else if (isset($_SESSION["id_usuario"]) == 2) {
                }
            }
    }
}
