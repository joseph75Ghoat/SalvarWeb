<?php
// Conexión a la base de datos (debes proporcionar tus propios valores)


$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Recuperar datos del formulario
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$categoria = $_POST['categoria'];
$marca = $_POST['marca'];

// Subir imagen a la carpeta
$imagen = $_FILES['imagen']['name'];
$imagen_temp = $_FILES['imagen']['tmp_name'];
$carpeta_destino = '../assets/img/' . $imagen;
move_uploaded_file($imagen_temp, $carpeta_destino);

// Insertar datos en la base de datos
$sql = "INSERT INTO productos (nombre, descripcion, stock, categoria, marca, imagen) VALUES ('$nombre', '$descripcion', $stock, '$categoria', '$marca', '$carpeta_destino')";

if ($conn->query($sql) === TRUE) {
    echo "Producto agregado con éxito.";
} else {
    echo "Error al agregar el producto: " . $conn->error;
}

$conn->close();
?>
