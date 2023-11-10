<?php
require_once '../modelos/conexion.php';

class AgregarTenis
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    public function subir($userID)
    {
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $stock = $_POST["stock"];
        $categoria = $_POST["categoria"];
        $marca = $_POST["marca"];

        // Subir la imagen
        $imagen_producto = $_FILES["imagen_producto"]["name"];
        $imagen_temp = $_FILES["imagen_producto"]["tmp_name"];
        move_uploaded_file($imagen_temp, "../assets/img/" . $imagen_producto);

        // Preparar la consulta SQL e insertar los datos en la tabla
       // echo $nombre, $imagen_producto;

        
        $conn=$this->db;
        $sql="insert into producto(nombre, descripcion, precio, stock, 
        categoria, marca, imagen_producto) 
        value ('$nombre','$descripcion','$precio','$stock','$categoria','$marca','$imagen_producto')";

    
    $conn->query($sql)===TRUE;
    echo 'exito';
    }
}
