<?php
include '../controlador/ctrlMostrar.php';
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

<link rel="stylesheet" href="../css/contador.css">
<script>
    
    $(document).ready(function() {
        $.ajax({
            url: "../Controlador/contador_carrito.php", // Ruta al archivo de servidor
            type: "GET",
            success: function(data) {
                $("#contador-value").text("" + data); // Muestra el valor en la barra de navegación
            }
        });
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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