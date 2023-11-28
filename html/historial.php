<?php
session_start();
if (isset($_SESSION["id_usuario"])) {
    //  header('location: vistas2.php');
    // You may want to remove this echo statement unless it's for debugging purposes
    // echo "sesion" . $_SESSION['id_usuario'];
} else {
    //echo "Sesión no iniciada";
    header('location: login.html');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Compras de Tenis</title>
    <!-- Agrega la referencia a Bootstrap (opcional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        #historial {
            margin-top: 30px;
        }
        .card {
            margin-bottom: 30px;
            border: 1px solid #ddd;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .title {
            text-align: center;
            color: #007bff;
            margin-bottom: 30px;
        }
        .green-text {
            color: #28a745 !important;
            font-weight: bold;
        }
        .error-text {
            color: #dc3545;
            font-weight: bold;
        }
        .btn-regresar {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn-regresar:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="title">Historial de Compras de Tenis</h1>
    <div id="historial" class="row"></div>
    <button class="btn btn-regresar" onclick="regresar()">Regresar</button>
</div>

<!-- Agrega la referencia a jQuery y Bootstrap (opcional) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-eaQ8W4sWAd8VtrEkjRQ/mZDxlzdZ9pioz5EYppM3aLq8R/ue8UqU8Z1xRYYufe" crossorigin="anonymous"></script>
<script>
    function MostrarHistorial() {
        $.ajax({
            url: "../controller/pdf/ctrlPDF.php?opc=1",
            type: "GET",
            success: function (response) {
                $("#historial").html(response);
                $(".green-text").css("color", "#28a745");
            },
            error: function () {
                $("#historial").html("<p class='error-text'>Error al cargar el historial de compras</p>");
            },
        });
    }

    function regresar() {
        window.location.href = 'catalogo.php';
    }

    $(document).ready(function () {
        MostrarHistorial();
    });
</script>

</body>
</html>
