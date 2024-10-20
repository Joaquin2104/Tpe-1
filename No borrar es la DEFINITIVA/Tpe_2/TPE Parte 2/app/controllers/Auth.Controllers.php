<?php
require_once './app/models/auth.model.php';
require_once './app/views/auth.view.php';

class AuthControllers {
    private $models;
    private $views;

    public function __construct() {
        $this->models = new UserModel();
        $this->views = new AuthView();
    }

    public function showLogin() {
        return $this->views->showLogin();
    }

    public function login() {
        if (!isset($_POST['usuario']) || empty($_POST['usuario'])) {
            return $this->views->showLogin('Falta completar el nombre de usuario');
        }
    
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            return $this->views->showLogin('Falta completar la contraseña');
        }
    
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
    
        $userFromDB = $this->models->getUsuarioEmail($usuario);


        if($userFromDB && password_verify($password, $userFromDB->Contraseña)){
            session_start();
            $_SESSION['ID_USER'] = $userFromDB->Id_user;
            $_SESSION['EMAIL_USER'] = $userFromDB->Email;
            $_SESSION['LAST_ACTIVITY'] = time();
    
            header('Location: ' . BASE_URL);
        } else {
            return $this->views->showLogin('Credenciales incorrectas');
        }
    }

    public function logout() {
        session_start(); 
        session_destroy(); 
        header('Location: ' . BASE_URL);
    }
}
