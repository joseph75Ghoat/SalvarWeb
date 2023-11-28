<?php
class historialCompras

{
    private $db;
    private $user_id;
    public function __construct()
    {
        $con = new Conexion();
        $this->db = $con->conectar();
    }
    public function MostrarCompras($user_id)
    {
        $query = "SELECT id_compras,primer_apellido,segundo_apellido,fecha from compras c 
        join tenis.usuario u on u.id_usuario = c.id_usuario
        join producto p on c.id_producto = p.id_producto
        join tenis.cliente c2 on u.id_usuario = c2.id_usuario
        where c.id_usuario = :user_id
        group by fecha
        ";
        /*
      
        */
        /*
        SELECT id_venta,nombre,primer_apellido,segundo_apellido,fecha from cliente c
        join deco.usuario u on u.id_usuario = c.id_usuario
        join deco.venta v on u.id_usuario = v.id_usuario
        WHERE c.id_usuario = :user_id
        group by fecha */

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        $cursos = array(); // Inicializa un array para almacenar los cursos

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cursos[] = $row;
        }
        return $cursos; // Devuelve el array de cursos
    }
    public function MostrarICompras($user_id, $fecha)
    {
        $query = "SELECT 
        u.id_usuario,
               id_compras,
               cantidad,
               segundo_apellido,
               subtotal,
               fecha,
               p.nombre,precio
        from compras c
                 join producto p on c.id_producto = p.id_producto
                 join usuario u on c.id_usuario = u.id_usuario
                 join cliente c2 on u.id_usuario = c2.id_usuario
        WHERE c.id_usuario = :user_id
          and fecha = :fecha
        order by fecha desc
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $fecha_formateada = date('Y-m-d', strtotime($fecha));
        $stmt->bindParam(':fecha', $fecha_formateada, PDO::PARAM_STR);
        $stmt->execute();

        $cursos = array(); // Inicializa un array para almacenar los cursos

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cursos[] = $row;
        }
        return $cursos; // Devuelve el array de cursos
    }
}
