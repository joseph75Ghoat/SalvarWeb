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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gráfico de Ventas por Período</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #1c1c1c;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #ffffff;
        }

        nav {
            background-color: #333;
            padding: 10px;
            color: white;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        form {
            background-color: #2c2c2c;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #ffffff;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #ff6347; /* Coral color */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #d84315; /* Darken the color on hover */
        }

        #columnchart_material {
            width: 800px;
            height: 500px;
            margin-top: 20px;
        }

        /* Estilos para el botón de regreso */
        #backButton {
            position: absolute;
            left: 10px;
            top: 10px;
        }

        #backButton button {
            background-color: #ff6347; /* Cambiar a rojo */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #backButton button:hover {
            background-color: #d84315; /* Darken the color on hover */
        }
    </style>
</head>

<body>
    <!-- Botón de Regreso -->
    <a id="backButton" href="javascript:history.back()">
        <button>
            Regresar
        </button>
    </a>

    <form id="fechaForm">
        <label for="fechaInicio">Fecha Inicio:</label>
        <input type="date" id="fechaInicio" name="fechaInicio" required>

        <label for="fechaFinal">Fecha Final:</label>
        <input type="date" id="fechaFinal" name="fechaFinal" required>

        <button type="button" onclick="obtenerDatos()">Generar Gráfico</button>
    </form>

    <div id="columnchart_material"></div>

    <script type="text/javascript">
        function obtenerDatos() {
            var fechaInicio = $('#fechaInicio').val();
            var fechaFinal = $('#fechaFinal').val();

            // Realiza la petición AJAX al controlador
            $.ajax({
                url: '../controller/Usuario/ctrusuario.php?opc=9',
                type: 'POST',
                data: { fechaInicio: fechaInicio, fechaFinal: fechaFinal },
                dataType: 'json',
                success: function (data) {
                    // Llama a la función para dibujar el gráfico con los datos recibidos
                    dibujarGrafico(data);
                },
                error: function (error) {
                    console.error('Error en la petición AJAX:', error);
                }
            });
        }

        function dibujarGrafico(data) {
            google.charts.load('current', { 'packages': ['corechart'] });
            google.charts.setOnLoadCallback(function () {
                var chartData = new google.visualization.DataTable();
                chartData.addColumn('string', 'Fecha');
                chartData.addColumn('number', 'Cantidad');

                for (var i = 0; i < data.length; i++) {
                    chartData.addRow([data[i].fecha, data[i].cantidad]);
                }

                var options = {
                    chart: {
                        title: 'Ventas por Período',
                        subtitle: 'Cantidad de Ventas por Fecha',
                        backgroundColor: '#2c2c2c',
                    },
                    hAxis: {
                        title: 'Fecha',
                        titleTextStyle: { color: '#ffffff' },
                        textStyle: { color: 'black' },
                    },
                    vAxis: {
                        title: 'Cantidad',
                        titleTextStyle: { color: '#ffffff' },
                        textStyle: { color: 'black' },
                    },
                    legend: {
                        textStyle: { color: '#ffffff' },
                    },
                    colors: ['#ff6347'], // Color Coral
                };

                var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_material'));
                chart.draw(chartData, options);
            });
        }
    </script>

    <script>
        cargarBarraDeNavegacion();

        function cargarBarraDeNavegacion() {
            $.ajax({
                url: '../controller/Usuario/ctrDis.php?opc=1',
                type: 'GET',
                success: function (response) {
                    $('#nav').html(response);
                },
                error: function () {
                    $('#nav').html('Error al cargar la barra de navegación');
                }
            });
            carritoContador();
        }
    </script>

</body>

</html>
