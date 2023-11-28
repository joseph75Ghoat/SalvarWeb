



<?php
use Dompdf\Dompdf;
use Dompdf\Options;
use Dompdf\Autoloader;

require_once '../../model/historialCompra.php';
require_once("../../vendor/autoload.php");
require_once '../../adodb5/adodb.inc.php';
require_once '../../model/imprimirPDF.php';
require_once '../../model/conexion.php';

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$imprimir = new imprimirPDF($_SESSION["id_usuario"]);

$dompdf = new Dompdf($options);

$mostrarVenta = new historialCompras();

if (isset($_GET['opc'])) {
    $opc = $_GET['opc'];

    switch ($opc) {
        case '1': ///mostrar historial de compras
            if (isset($_SESSION["id_usuario"])) {
                $venta = $mostrarVenta->MostrarCompras($_SESSION["id_usuario"]);

                foreach ($venta as $curso) {
                    echo '
                    <style>
                        .curso-card {
                            border: 1px solid #ccc;
                            border-radius: 8px;
                            padding: 15px;
                            margin-bottom: 20px;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        }

                        .display-1 {
                            font-size: 1.5em;
                            margin-bottom: 10px;
                        }

                        .cat-origen {
                            font-size: 1.2em;
                            margin-bottom: 5px;
                        }

                        .imprimir-link {
                            background-color: #007bff;
                            color: #fff;
                            padding: 10px 20px;
                            border-radius: 8px;
                            font-size: 16px;
                            text-decoration: none;
                            display: inline-block;
                            margin-top: 10px;
                        }

                        .imprimir-link:hover {
                            background-color: #0056b3;
                        }
                    </style>
                    
                    <div class="curso-card">
                        <p class="display-1 pt-2 nombre-pro">Compra del usuario= ' . $curso['primer_apellido'] . ' ' . $curso['segundo_apellido'] . '</p>
                        <p class="cat-origen pb-1">Compra del día=' . $curso['fecha'] . '</p>
                        <p class="cat-origen pb-1">ID de compra=' . $curso['id_compras'] . '</p>
                        <a class="imprimir-link" href="../controller/pdf/ctrlPDF.php?opc=2&id_compras=' . $curso['id_compras'] . '&fecha=' . $curso['fecha'] . '" target="_blank">Imprimir</a>
                    </div>';
                }
            } else {
                echo "El usuario no está definido";
            }
            break;

        case '2': //imprimir pdf
            $id_compras = isset($_GET['id_compras']) && isset($_GET['fecha']) ? $_GET['id_compras'] : NULL;
            $fecha = isset($_GET['fecha']) ? $_GET['fecha'] : NULL;

            $fecha = $_GET['fecha'];
            echo $fecha . "  " . $_SESSION["id_usuario"] . " " . $id_compras;

            $imprimir->crearPDF($_SESSION["id_usuario"], $fecha);
            exit;
    }
}
