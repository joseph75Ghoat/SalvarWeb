<?php
 session_start();// toma la variable de la sesion uniciada
// auth.php esta clase es para estandarizar el valor de la variable id y reutilizarla
class Auth {
    //crear la variable del id del usario
    private $user_id;
    public function __construct() {
       
        if (isset($_SESSION["user_id"])) {//se toma el id del usuario
            $this->user_id = $_SESSION["user_id"];
        }
    }

    public function isLoggedIn() { 
        return isset($this->user_id);
    }
//se rescata el id del usaurio
    public function getUserId() {
        return $this->user_id;
    }   
// manda al login si no encuentra al usuario
    public function redirectToLogin() {
        header("Location: login.php");
        exit();

    }
    public function logoutUserById($userId) {
        // Destruye la sesión actual si el ID del usuario coincide
        if ($this->isLoggedIn() && $this->getUserId() === $userId) {
            session_destroy();
            // Puedes realizar otras acciones de limpieza si es necesario
            return true; // La sesión se cerró con éxito
        }

        return false; // La sesión no se cerró porque el usuario no coincide o no estaba conectado
    }
}



?>