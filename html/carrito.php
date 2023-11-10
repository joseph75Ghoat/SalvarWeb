<?php include '../controlador/ctrltotalCarrito.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="../css/caritto.css">

</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <div>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../html/catalogo.php">Catalogo</a>
                </li>
            </ul>
        </div>
        <div class="container-fluid d-flex justify-content-center align-items-center"> <!-- Agregamos clases d-flex, justify-content-center y align-items-center para centrar vertical y horizontalmente -->
            <label class="text-white" for="">Carrito de compras</label>

        </div>
    </nav>


    <?php include '../controlador/ctrlMostrarCarrito.php'; ?>
    <div class="product-container">
        <?php foreach ($productos as $producto) { ?>
            <div class="product">
                <img src="../assets/img/<?php echo $producto['imagen_producto']; ?>" alt="<?php echo $producto['nombre']; ?>">
                <h3><?php echo $producto['nombre']; ?></h3>
                <p>Precio: $<?php echo $producto['precio']; ?></p>
                <p>Cantidad: <?php echo $producto['cantidad']; ?></p>
                <p>Subtotal: $<?php echo $producto['subtotal']; ?></p>
                <p>id: <?php echo $producto['id_producto']; ?></p>
                <a href="../controlador/ctrlBorrarElementoCarrito.php?id=<?php echo $producto['id_producto']; ?>">eliminar</a>
            </div>
        <?php } ?>
    </div>

    <h2>Resumen del Carrito</h2>
    <ul id="cart-items">
        <!-- Aquí se mostrarán los elementos del carrito -->
    </ul>

    <h3>TOTAL A PAGAR: $<?php echo $totalCarrito; ?></h3>

    <button id="checkout"><a href="../controlador/ctrlComprarcarro.php">Realizar Compra</a></button>
   

</body>

</html>