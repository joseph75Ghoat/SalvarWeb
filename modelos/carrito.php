<?php

class carrito
{
    private $db;
    public function __construct()
    {
        $con = new Conexion();
        $this->db = $con->conectar();
    }

    public function obtenerCarrito($user_id)
    {
        /* select p.nombre, c.cantidad,p.precio, cantidad*precio as subtotal, sum(cantidad*precio) as total from carrito c
        inner join tenis.producto p on c.id_producto = p.id_producto
        where id_usuario=2; */
        $query = "SELECT c.id_producto,p.imagen_producto,p.nombre, c.cantidad,p.precio, cantidad*precio as subtotal from carrito c
            inner join tenis.producto p on c.id_producto = p.id_producto
                      WHERE c.id_usuario = :user_id GROUP BY p.nombre";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        $p = array(); // Inicializa un array para almacenar los cursos

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $p[] = $row;
        }
        return $p; // Devuelve el array de cursos
    }
    public function TotalCarrito($user_id)
    {
        $query = "SELECT sum(cantidad*precio) as total from carrito c
                      inner join tenis.producto p on c.id_producto = p.id_producto
                      WHERE c.id_usuario = :user_id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && isset($result['total'])) {
            return $result['total'];
        } else {
            return 0; // Valor predeterminado si no se encuentra el total
        }
    }

    public function comprarCarrito($id_usuario)
    {
        // Verificar si hay cursos en el carrito
        $carritoCursos = $this->obtenerCarrito($id_usuario); // Asegúrate de pasar el ID del usuario
        if (empty($carritoCursos)) {
            echo "No hay Tenis en el carrito. Agregue Tenis antes de comprar.";
            return;
        }

        
        foreach ($carritoCursos as $curso) {
            $id_producto = $curso['id_producto'];
            $cantidad = $curso['cantidad'];
            $subtotal = $curso['subtotal'];
            //$query = "INSERT INTO cursos_comprados (id_usuario, id_lista_cursos) VALUES (:id_usuario, :id_curso)";
            $query = "insert into compras (id_usuario, id_producto, cantidad, subtotal)value (:id_usuario, :id_producto, :cantidad, :subtotal)";
                      $rs = $this->db->prepare($query);
            $rs->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $rs->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
            $rs->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            $rs->bindParam(':subtotal', $subtotal, PDO::PARAM_INT);

            if ($rs->execute()) {
                // La compra se ha registrado correctamente en la base de datos
                // echo "¡Compra registrada en la base de datos!";
               header("Location: ../html/catalogo.php");
                $this->eliminarCarrito($id_usuario);
            } else {
                // Hubo un error al registrar la compra
                // echo "Error al registrar la compra.";
            }
        }
    }


    public function eliminarCarrito($id_usuario)
    {
        // Luego, eliminar los cursos del carrito
        $query = "DELETE FROM carrito WHERE id_usuario = :user_id";
        $rs = $this->db->prepare($query);
        $rs->bindParam(':user_id', $id_usuario, PDO::PARAM_INT);
        if ($rs->execute()) {
            // del carrito se han eliminado correctamente
            // echo "¡ del carrito eliminados!";
        } else {
            // Hubo un error al eliminar los cursos del carrito
            // echo "Error al eliminar los tenis del carrito.";
        }

        
    }
    public function carritosContador($id_usuario)
    {   //select  count(cantidad) from carrito where id_usuario=2;
        $query = "SELECT sum(cantidad) AS total FROM carrito WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $fila = $stmt->fetch(PDO::FETCH_ASSOC);
            $total = $fila["total"];
            return $total; // Devuelve el valor en lugar de imprimirlo
        } else {
            return 0; // Devuelve 0 en caso de error
        }
    }

    public function agregarCarrito($id_usuario, $producto_id, $cantidad)
{
    // Verificamos que la cantidad solicitada no sea cero o menor
    if ($cantidad <= 0) {
        echo "La cantidad debe ser mayor que cero.";
        return; // Salimos de la función si la cantidad no es válida
    }

    // Consultamos la cantidad en stock desde la base de datos
    $stockDisponible = $this->obtenerStockDelProducto($producto_id);

    // Verificamos si hay suficiente stock
    if ($stockDisponible >= $cantidad) {
        // La cantidad es válida y hay suficiente stock
        $query = "INSERT INTO carrito(id_usuario, id_producto, cantidad) VALUES (:id_usuario, :id_producto, :cantidad)";
        $rs = $this->db->prepare($query);
        $rs->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $rs->bindParam(':id_producto', $producto_id, PDO::PARAM_INT);
        $rs->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);

        if ($rs->execute()) {
            // La compra se ha registrado correctamente en la base de datos
            $this->actualizarStock($producto_id, $cantidad); // Llamamos a la función para actualizar el stock
            echo "¡Se agregó a su carrito! Siga comprando.";
            header("Location: ../html/catalogo.php");
        } else {
            // Hubo un error al registrar la compra
            echo "Error al registrar la compra.";
        }
    } else {
        echo "No hay suficiente stock disponible para esta cantidad.";
    }
}

public function obtenerStockDelProducto($producto_id)
{
    $query = "SELECT stock FROM producto WHERE id_producto = :producto_id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
    $stmt->execute();
    $stockDisponible = $stmt->fetchColumn();

    return $stockDisponible; // Solo devolvemos el valor del stock
}



    // Función para actualizar el stock
    private function actualizarStock($producto_id, $cantidad)
    {
        $query = "UPDATE producto SET stock = stock - :cantidad WHERE id_producto = :id_producto";
        $rs = $this->db->prepare($query);
        $rs->bindParam(':id_producto', $producto_id, PDO::PARAM_INT);
        $rs->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);

        if ($rs->execute()) {
            // El stock se ha actualizado correctamente
            // echo "Stock actualizado exitosamente.";
        } else {
            // Hubo un error al actualizar el stock
            // echo "Error al actualizar el stock.";
        }
    }
    public function eliminarElementoDelCarrito($id_usuario, $producto_id)
{
    // Elimina un elemento del carrito
    $query = "DELETE FROM carrito WHERE id_usuario = :id_usuario AND id_producto = :id_producto";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->bindParam(':id_producto', $producto_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // El elemento se ha eliminado correctamente del carrito
        // 12
        header("Location: ../html/carrito.php");
    } else {
        // Hubo un error al eliminar el elemento del carrito
        // echo "Error al eliminar el elemento del carrito.";
    }
}


}