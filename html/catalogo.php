<?php
 include '../controlador/ctrlMostrar.php';
//include_once '../model/usuario.php';
//include_once '../model/conexion.php';

//$rol = $_SESSION ['id_rol'];
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
        cargarBarraDeNavegacion();
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
    <div id="nav">
        <script>
            function cargarBarraDeNavegacion() {
                $.ajax({
                    url: '../controller/Usuario/ctrDis.php?opc=1',
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        $('#nav').html(response);
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
    <div class="container">
        <div class="row">
            <?php foreach ($catalogo as $producto) { ?>
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid2">
                        <div class="product-image2">
                            <a href="#">
                                <img src="../assets/img/<?php echo $producto['imagen_producto']; ?>" class="img opacity" width="200px" height="200px" alt="<?php echo $producto['nombre']; ?>" loading="lazy">
                            </a>
                            <ul class="social">
                                <!--  <li><a href="#" data-tip="Quick View"><i class="fa fa-eye"></i></a></li>
                            <li><a href="#" data-tip="Add to Wishlist"><i class="fa fa-shopping-bag"></i></a></li>
                            <li><a href="#" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                        -->
                            </ul>
                            <a class="add-to-cart" href="../controlador/ctrlAgregarCarrito.php?id=<?php if (isset($producto['id_producto'])) echo $producto['id_producto']; ?>&cantidad=" id="add-to-cart-link-<?php echo $producto['id_producto']; ?>">Add to cart</a>

                            <div id="contador-<?php echo $producto['id_producto']; ?>">0</div>
                            <button onclick="aumentarContador(<?php echo $producto['id_producto']; ?>)">+</button>

                            <button onclick="disminuirContador(<?php echo $producto['id_producto']; ?>)">-</button>
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="#"><?php echo $producto['nombre']; ?></a></h3>
                            <span class="price">$<?php echo $producto['precio']; ?></span>
                            <p><?php echo $producto['descripcion']; ?></p>
                            <p>Marca: <?php echo $producto['marca']; ?></p>
                            <p>Categoría: <?php echo $producto['categoria']; ?></p>
                            <p>Stock: <?php echo $producto['stock']; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>


    <script>
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
            link.href = `../controlador/ctrlAgregarCarrito.php?id=${idProducto}&cantidad=${cantidad}`;
        }
    </script>


</body>

</html>