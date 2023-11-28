<?php

require_once("../../model/conexion.php");
require_once("../../model/usuario.php");
require_once '../../adodb5/adodb.inc.php';


if (isset($_GET['opc'])) {
    $opc = $_GET['opc'];
    //echo "rntro al opc";
    //echo ($opc);
    switch ($opc) {
        case '1':
            //echo "opc1";
          //  echo "rol=" . $_SESSION["id_rol"];
            //Barra de navegacion $_SESSION["id_usuario"] 
            if (isset($_SESSION["id_usuario"])) {
                if (($_SESSION["id_rol"]) == 1) {
                    echo ' 
                    PANEL DE ADMINISTRADOR "DIOS"
                    
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <a class="navbar-brand" href="#"><img height="100" width="100" src="../imagenes/Nike-Logo-PNG-Photo-Image.png" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
            
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">

                            <li class="nav-item">
                                <a class="nav-link" href="../controller/Usuario/ctrusuario.php?opc=7">close</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="crud.php">Subir</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="grafica.php">Grafica</a>
                    </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="../html/carro.php">ir a carrito <span class="sr-only">(current)</span></a>
                            </li>
            
                            <li class="nav-item">
                                <!-- <a class="nav-link" href="../html/catalogo.php">Catalago</a> -->
                            </li>
                        </ul>
            
                    </div>
            
                    <div>
                        <a class="nav-link" href="../html/carro.php" id="contador"> <img src="../assets/img/carrito.png" alt="" width="25px" height="auto">
                            <div class="carrito-container">
                                <!--el contador value se usa mas que nada el value para obtener los valores del id que se llama contador-->
                                <span id="contador-value"></span>
                            </div>
                           
                        </a>
                    </div>
            
                </nav>
            ';
                } else if (($_SESSION["id_rol"]) == 2) {
                    echo ' 
                    PANEL USUARIO ORDINARIO
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <a class="navbar-brand" href="#"><img height="100" width="100" src="../imagenes/Nike-Logo-PNG-Photo-Image.png" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
            
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="../controller/Usuario/ctrusuario.php?opc=7">Cerrar Sesion <span class="sr-only">(current)</span></a>
                            </li>
      
                            <li class="nav-item active">
                            <a class="nav-link" href="../html/carro.php">ir a carrito <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                        <a class="nav-link" href="../html/historial.php">historial de compra <span class="sr-only">(current)</span></a>
                    </li>
            
 
                        </ul>
            
                    </div>
            
                    <div>
                        <a class="nav-link" href="../html/carro.php" id="contador"> <img src="../assets/img/carrito.png" alt="" width="25px" height="auto">
                            <div class="carrito-container">
                                <!--el contador value se usa mas que nada el value para obtener los valores del id que se llama contador-->
                                <span id="contador-value"></span>
                            </div>
                           
                        </a>
                    </div>
            
                </nav>
            ';
                }
            }else{
                echo  'inicia sesion';
            }
    }
}
