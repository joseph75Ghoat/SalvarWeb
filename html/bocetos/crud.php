<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];
    $categoria = $_POST["categoria"];
    $marca = $_POST["marca"];
    
    // Procesar la imagen subida
    $imagen = $_FILES["imagen"]["name"];
    $ruta_imagen = "carpeta_de_imagenes/" . $imagen; // Define la carpeta de destino
    move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_imagen);
    
    // Realizar la inserción en la base de datos
    $conn = new mysqli("localhost", "usuario", "contraseña", "basededatos");
    
    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }
    
    $sql = "INSERT INTO producto (nombre, descripcion, precio, stock, categoria, marca, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdiss", $nombre, $descripcion, $precio, $stock, $categoria, $marca, $ruta_imagen);
    
    if ($stmt->execute()) {
        echo "Producto agregado correctamente.";
    } else {
        echo "Error al agregar el producto: " . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>
