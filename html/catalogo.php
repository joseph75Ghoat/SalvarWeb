<?php
include '../controlador/ctrlMostrar.php';
//include_once '../model/usuario.php';
//include_once '../model/conexion.php';

//$rol = $_SESSION ['id_rol'];
?>

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

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

<link rel="stylesheet" href="../css/contador.css">
<script>
    $(document).ready(function() {
        carritoContador();
        cargarBarraDeNavegacion();
        producto();
    });
</script>
<link rel="stylesheet" href="../css/Muestra.css">


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }

        #contador {
            font-size: 36px;
            margin: 20px;
        }

        button {
            font-size: 24px;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div id=""></div>
    <div id="nav">
        <script>
            function carritoContador() {
                $.ajax({
                    url: '../controller/Usuario/ctrusuario.php?opc=8',
                    type: 'GET',
                    success: function(response) {
                        $('#contador-value').html(response);
                    },
                    error: function() {
                        // Maneja errores si la solicitud AJAX falla
                        $('#contador').html('Error al cargar la barra de navegación');
                    }
                });
            }

            function cargarBarraDeNavegacion() {
                $.ajax({
                    url: '../controller/Usuario/ctrDis.php?opc=1',
                    type: 'GET',
                    success: function(response) {
                        // console.log(response);
                        $('#nav').html(response);
                    },
                    error: function() {
                        // Maneja errores si la solicitud AJAX falla
                        $('#nav').html('Error al cargar la barra de navegación');
                    }
                });
                carritoContador();

            }
        </script>
    </div>


    <div id="productos">
        <script>
            function producto() {
                $.ajax({
                    url: '../controller/Usuario/ctrusuario.php?opc=1',
                    type: 'GET',
                    success: function(response) {
                        //console.log(response);
                        $('#productos').html(response);
                    },
                    error: function() {
                        // Maneja errores si la solicitud AJAX falla
                        $('#nav').html('Error al cargar la barra de navegación');
                    }
                });
            }
        </script>
    </div>
    <!-- //aqui esta el 1ro carril de sudaderas -->



    <script>
        let contador = 0;

        function aumentarContador(idProducto) {
            var contador = document.getElementById('contador-' + idProducto);
            var valorActual = parseInt(contador.textContent);
            contador.textContent = valorActual + 1;
            actualizarURLCarrito(idProducto, valorActual + 1);
        }

        function disminuirContador(idProducto) {
            var contador = document.getElementById('contador-' + idProducto);
            var valorActual = parseInt(contador.textContent);
            if (valorActual > 0) {
                contador.textContent = valorActual - 1;
                actualizarURLCarrito(idProducto, valorActual - 1);
            }
        }

        function actualizarURLCarrito(idProducto, cantidad) {
            var link = document.getElementById('add-to-cart-link-' + idProducto);
            //  link.href = ../controller/user/ctrlUser.php?opc=2&id=${idProducto}&cantidad=${cantidad};
            contador = cantidad;
            console.log("contador= " + contador);
        }

        function actualizarCarrito(id_producto, cantidad) {
            // ctrlMostrarP();
            cantidad = contador;
            console.log("cantidad", cantidad);

            $.ajax({
                url: `../controller/Usuario/ctrusuario.php?opc=2&id_producto=${id_producto}&contador=${contador}`,
                type: 'GET',
                success: function(response) {
                    $('#mostrar').html(response);
                    contador = 0;
                    alert('¡se agrego a carrito con éxito!', 'success');
                },
                error: function() {
                    // Maneja errores si la solicitud AJAX falla
                    $('#mostrar').html('Error al cargar la barra de navegación');
                }
            });
            producto();
            carritoContador();
        }
    </script>


</body>

</html>