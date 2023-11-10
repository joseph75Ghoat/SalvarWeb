

<?php
class Conexion {
    private $DBServer = '127.0.0.1'; //  nombre o dirección IP de tu servidor de base de datos
    private $DBUser = 'admin'; // nombre de usuario de la base de datos
    private $DBPass = '123'; //   tu contraseña de la base de datos
    private $DBName = 'tenis'; // nombre de base de datos

    public function __construct() {}

    public function conectar() {
        try {
            $conn = new PDO("mysql:host={$this->DBServer};dbname={$this->DBName}", $this->DBUser, $this->DBPass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}





// class Conexion {
//     private $DBServer = 'localhost'; // Cambia esto al nombre o dirección IP de tu servidor de base de datos
//     private $DBUser = 'id21265810_adminweb'; // Cambia esto a tu nombre de usuario de la base de datos
//     private $DBPass = 'Jcolesio7@'; // Cambia esto a tu contraseña de la base de datos
//     private $DBName = 'id21265810_tenis'; // Cambia esto a tu nombre de base de datos

//     public function __construct() {}

//     public function conectar() {
//         try {
//             $conn = new PDO("mysql:host={$this->DBServer};dbname={$this->DBName}", $this->DBUser, $this->DBPass);
//             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//             return $conn;
//         } catch (PDOException $e) {
//             die("Error de conexión: " . $e->getMessage());
//         }
//     }
// }