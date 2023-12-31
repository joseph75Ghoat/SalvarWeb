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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos - Nike Tenis</title>
    <style>
        body {
            background-color: #1a1a1a;
            font-family: Arial, sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        
        /* Estilo para el fondo blanco */
        .navbar {
            background-color: #fff;
            padding: 10px;
        }
        /* Estilo para los enlaces de navegación */
        .navbar a {
            text-decoration: none;
            color: #000; /* Color del texto */
            margin: 10px;
        }
   

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            font-size: 28px;
        }

        form {
            background-color: #333;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 18px;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: none;
            background-color: #444;
            color: #fff;
        }

        label[for="image"] {
            margin-top: 20px;
        }

        input[type="file"] {
            margin-top: 5px;
        }

        button {
            background-color: #f33;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        button:hover {
            background-color: #f00;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <!-- Enlace a la pestaña o sección 1 -->
        <a href="../html/carro.php">Carrito</a>
        <!-- Enlace a la pestaña o sección 2 -->
        <a href="../html/catalogo.php">Catalogo </a>
      
    </nav>
    
    <div class="container">
        <!-- Agregar Producto Formulario -->
        <form action="../controlador/ctrsubirtenis.php" method="post" enctype="multipart/form-data">
            <h1>Agrega un producto</h1>
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" id="nombre" name="nombre" required>
        
            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" required>
        
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" required>
        
            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" required>
        
            <label for="">categoria</label>
            <input type="text" id="categoria" name="categoria" required>
        

            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" required>
        
            <label for="imagen_producto">Imagen del Producto:</label>
            <input type="file" id="imagen_producto" name="imagen_producto" accept="image/*" required>
        
            <button type="submit">Subir Producto</button>
        </form>
        
        <!-- Actualizar Producto Formulario -->
        <form action="procesar_actualizacion.php" method="post">
            <h1>Actualizar Producto - Nike Tenis</h1>
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" id="nombre" name="nombre" required>
        
            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" required>
        
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" required>
        
            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" required>
        
            <label for="">categoria</label>
            <input type="text" id="categoria" name="categoria" required>
        

            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" required>
        
            <label for="imagen_producto">Imagen del Producto:</label>
            <input type="file" id="imagen_producto" name="imagen_producto" accept="image/*" required>
        
            <button type="submit">Subir Producto</button>
        </form>
    </div>
</body>
</html>
