<?php
require_once '../../model/conexion.php';
require_once '../../model/mostrar.php';
require_once '../../model/carrito.php';
require_once '../../model/cerrarSesion.php';
require_once '../../model/enviarCorreo.php';
require_once '../../model/crearUsuario.php';

$graficas = new crearUsuario();
$mostrarT = new mostrar();
$agregar = new carrito();
$cerrarSesion = new cerrarSesion();


if (isset($_GET['opc'])) {
    $opc = $_GET['opc'];
    //echo ($opc);
    switch ($opc) {
        case '1': //mostrar productos
            if (isset($_SESSION["id_usuario"])) {
                $catalogo = $mostrarT->mostrarCatalogo();

                echo '
                <div class="container">
                <div class="row">';
                foreach ($catalogo as $producto) {
                    echo '    <div class="col-md-3 col-sm-6">
                            <div class="product-grid2">
                                <div class="product-image2">
                                    <a href="#">
                                        <img src="../assets/img/' . $producto['imagen_producto'] . '" class="img opacity" width="200px" height="200px" alt="' . $producto['nombre'] . '" loading="lazy">
                                    </a>
                                    <ul class="social">
                                    </ul>
        
                                    <input type="button" class="btn btn-danger" value="AGREGAR" onclick="actualizarCarrito(' . $producto['id_producto'] . ')">
                                    <div id="contador-' . $producto['id_producto'] . '">0</div>
                                    <button onclick="aumentarContador(' . $producto['id_producto'] . ')">+</button>
                                    <button onclick="disminuirContador(' . $producto['id_producto'] . ')">-</button>
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><a href="#">' . $producto['nombre'] . '</a></h3>
                                    <span class="price">$' . $producto['precio'] . '</span>
                                    <p>' . $producto['descripcion'] . '</p>
                                    <p>Marca:' . $producto['marca'] . '</p>
                                    <p>Categoría:' . $producto['categoria'] . '</p>
                                    <p>Stock: ' . $producto['stock'] . '</p>
                                </div>
                            </div>
                        </div>';
                }
                echo '</div>
            </div> ';

                echo '
                    </div>
                </div>';
            } else {
                echo 'inicia Sesion';
            }
            break;
        case 2: //agregar a carrito
            $contador = $_GET['contador'];
            $id_p = $_GET['id_producto'];
            $contador = intval($contador);
            $id_p = intval($id_p);
            echo "El valor del contador es: " . $contador . "  producto=" . $id_p;
            $agregar->agregarCarrito($_SESSION['id_usuario'], $id_p, $contador);

            break;
            
            case "12":

                $totalCarrito = $agregar->TotalCarrito($_SESSION["id_usuario"]);
                echo json_encode(array('total' => $totalCarrito));

                break;

        case 3:
            if (isset($_SESSION["id_usuario"])) {
                $carro = $agregar->obtenerCarrito($_SESSION["id_usuario"]);
                $totalCarrito = $agregar->TotalCarrito($_SESSION["id_usuario"]);
                echo '
                        <div class="product-container">';

                foreach ($carro as $producto) {
                    echo '
                                <div class="product">
                                    <img src="../assets/img/' . $producto['imagen_producto'] . '" alt="' . $producto['nombre'] . '">
                                    <h3><' . $producto['nombre'] . '</h3>
                                    <p>Precio: $' . $producto['precio'] . '</p>
                                    <p>Cantidad:' . $producto['cantidad'] . '</p>
                                    <p>Subtotal: $' . $producto['subtotal'] . '</p>
                                    <p>id: ' . $producto['id_producto'] . '</p>
                                    <input type="button" class="btn btn-danger" value="ELIMINAR" onclick="borrarDeCarrito(' . $producto['id_producto'] . ')">
                                
                                
                                    </div>';
                }
                echo '</div>
                    
                        <h2>Resumen del Carrito</h2>
                        <ul id="cart-items">
                            <!-- Aquí se mostrarán los elementos del carrito -->
                        </ul>
                    
                        <h3>TOTAL A PAGAR: $' . $totalCarrito . '</h3>
                         

                         
                         <div id="paypal-button-container"></div>
                        ';
            } else {
                echo 'inicia sesion';
                // <input type="button" class="btn btn-danger" value="Comprar" onclick="comprarCarrito()">
            }
            break;
        case 4: //borrar de carrito

            if (isset($_SESSION["id_usuario"])) {
                $producto = $_POST['id_producto'];
                $idUser = $_SESSION["id_usuario"];
                $agregar->eliminarElementoDelCarrito($idUser, $producto);
            } else {
                echo "El usuario no está definido";
            }
            break;
        case 5: ////comprar carrito
            if (isset($_SESSION["id_usuario"])) {

                $id = $_POST['id'];
                $ticket = '';
                $ultimoUsuario = '';
                $productos = $agregar->obtenerCarrito($_SESSION['id_usuario']);

                $ticket .= '<html>
                    <head>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                            }
                    
                            #ticket {
                                width: 300px;
                                margin: 20px auto;
                                padding: 10px;
                                border: 1px solid #ccc;
                                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                            }
                    
                            h1 {
                                text-align: center;
                                color: #333;
                            }
                    
                            .product-info {
                                border-bottom: 1px solid #ccc;
                                padding: 10px 0;
                                margin-bottom: 10px;
                            }
                    
                            .product {
                                display: flex;
                                align-items: center;
                                margin-bottom: 10px;
                            }
                    
                            .product img {
                                width: 50px;
                                height: 50px;
                                margin-right: 10px;
                            }
                    
                            .box {
                                flex: 1;
                            }
                    
                            p {
                                margin: 5px 0;
                            }
                    
                            #total {
                                text-align: right;
                                font-size: 18px;
                                font-weight: bold;
                                margin-top: 10px;
                            }
                        </style>
                    </head>
                    <body>
                        <div id="ticket">
                            <h1>RECIBO DE COMPRA</h1>';

                foreach ($productos as $producto) {
                    $ultimoUsuario = $producto['correo'];
                    $ticket .= '
                            <div class="product-info">
                                <div class="product">
                                    <img src="../assets/img/' . $producto['imagen_producto'] . '" alt="">
                                    <div class="box">
                                        <h3>' . $producto['nombre'] . '</h3>
                                        <p>PRECIO $' . $producto['precio'] . '</p>
                                        <p>SUBTOTAL $' . $producto['subtotal'] . '</p>
                                        <p>CANTIDAD ' . $producto['cantidad'] . '</p>
                                    </div>
                                </div>
                            </div>';
                }
                $totalCarrito = $agregar->TotalCarrito($_SESSION["id_usuario"]);

            
                    $ticket .= ' <h3>TOTAL A PAGAR: $' . $totalCarrito . '</h3>';
                

                $ticket .= '</div>
                    </body>
                    </html>';


                $correo = new MailerService();
                ///envia correo
                $correo->sendMailTicket($ultimoUsuario, $ticket);
                //comprar carro 
                 $agregar->comprarCarrito($_SESSION["id_usuario"],$id);
                echo "    id   ".$id;
            } else {
                echo "inicia sesion";
            }
            break;
        case 7:
            $cerrarSesion->logoutUserById($_SESSION['id_usuario']);
            header('Location: ../../index.php');
            break;
        case "8":
            $contador = $agregar->carritosContador($_SESSION['id_usuario']);
            echo $contador;
            break;
    
            case 9:
                if (isset($_POST['fechaInicio']) && isset($_POST['fechaFinal'])) {
                    $fechaInicio = $_POST['fechaInicio'];
                    $fechaFinal = $_POST['fechaFinal'];
                    $datos =   $graficas -> graficaVentaPeriodo($fechaInicio, $fechaFinal);
                    //echo $fechaInicio,$fechaFinal;
                    // // Llama a tu función para obtener los datos
                     //$datos = $adminPanel->graficaVentaPeriodo($fechaInicio, $fechaFinal);
    
                    // Devuelve los datos en formato JSON
                  header('Content-Type: application/json');
                    echo json_encode($datos);
                    exit;
                } else {
                    // Manejo de error si las fechas no están presentes en la solicitud
                    echo json_encode(['error' => 'Fechas no proporcionadas']);
                    exit;
                }
                
            break;
    
        }




}
