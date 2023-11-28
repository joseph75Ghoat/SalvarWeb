<?php

use Dompdf\Dompdf;
use Dompdf\Options;
use Dompdf\Autoloader;

require_once "../../vendor/autoload.php";
require_once '../../model/historialCompra.php';
ob_start();

class imprimirPDF
{
    private $userId; // Asegúrate de obtener este ID de alguna manera
    private $db;

    public function __construct($userId)
    {
        $this->userId = $userId;
        $con = new Conexion();
        $this->db = $con->conectar();
    }

    public function crearPDF($user, $fecha)
    {
        $mostrarVenta = new historialCompras();

        $venta = $mostrarVenta->MostrarICompras($user, $fecha);
        $dompdf = new Dompdf();
        $html = '
        <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Ticket de Compra</title>
    <style>
        body {
            font-family: "Press Start 2P", cursive;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
           
            color: #ffffff; /* White text */
        }

        .ticket {
            background-color: #2c2c2c; /* Darker background for the ticket */
            border: 2px solid #4caf50; /* Accent color */
            padding: 20px;
            width: 300px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .header {
            text-align: center;
            border-bottom: 1px solid #4caf50; /* Accent color for the header border */
            margin-bottom: 10px;
            color: #e44d26; /* Orange color characteristic of Soriana */
        }

        .header h1 {
            margin: 0;
        }

        .details p {
            margin: 5px 0;
        }

        .footer {
            text-align: center;
            margin-top: 10px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="header">
            <h1>NIKE CHEX</h1>
            <p>Ticket de Compra</p>
        </div>';

        foreach ($venta as $curso) {
            $html .= '
        
            <div class="details">
            <p><strong>Producto:</strong>' . $curso['nombre'] . '</p>
            <p><strong>Precio:</strong>' . $curso['precio'] . '</p>
            <p><strong>Cantidad:</strong> ' . $curso['cantidad'] . '</p>
            <p><strong>Subtotal:</strong> ' . $curso['subtotal'] . '</p>
            <p><strong>Fecha:</strong> ' . $curso['fecha'] . '</p>
        </div>';
        }

        $html .= '
            </div>
        </body>
        </html>';

        $dompdf->loadHtml($html);
        $dompdf->render();

        // Especifica el nombre del archivo y permite mostrarlo en el navegador
        $dompdf->stream("documento.'.$fecha.'.pdf", array('Attachment' => '0'));
        ob_end_flush();
        exit; // Importante para evitar la salida adicional que puede afectar al PDF

    }
}
