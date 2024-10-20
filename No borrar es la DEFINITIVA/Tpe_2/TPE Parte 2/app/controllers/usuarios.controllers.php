<?php
require_once './app/models/usuarios.model.php';
require_once './app/views/usuarios.view.php';

class usuarioscontrollers {
    private $models;
    private $views;

    public function __construct() {
        
        $this->models = new usuariosmodel();
        $this->views = new usuariosview();
    }

    public function showusuarios() {
        
        $usuarios = $this->models->getusuarios();


        return $this->views->showusuarios($usuarios);
    }

    public function showusuario($id) {
        $usuario = $this->models->getusuario($id);

        return $this->views->showusuario($usuario);
    }

    public function addusuario(){
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->views->showError('Falta completar el nombre');
        }
    
        if (!isset($_POST['apellido']) || empty($_POST['apellido'])) {
            return $this->views->showError('Falta completar el apellido');
        }
    
        $name = $_POST['nombre'];
        $lastname = $_POST['apellido'];
        $genre= $_POST['generos'];
    
        $id = $this->models->agregarusuario($name, $lastname, $genre);
    
        header('Location: ' . BASE_URL);
    }

    public function deleteusuario($id) {
    
        $usuario = $this->models->getusuario($id);

        if (!$usuario) {
            return $this->views->showError("No existe el usuario con el id=$id");
        } else {
            $this->models->borrar_user($id);
        }

        header('Location: ' . BASE_URL);
    }

    public function editaruser($id) {
        
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->views->showError('Falta completar el nombre');
        }
    
        if (!isset($_POST['apellido']) || empty($_POST['apellido'])) {
            return $this->views->showError('Falta completar el apellido');
        }

        if (!isset($_POST['generos']) || empty($_POST['generos'])) {
            return $this->views->showError('Falta completar el género');
        }
        
        $name = $_POST['nombre'];
        $lastname = $_POST['apellido'];
        $genre= $_POST['generos'];
    
        $usuario = $this->models->getusuario($id);

        if (!$usuario) {
            return $this->views->showError("No existe el usuario con el id=$id");
        } else {
            $this->models->updateusuario($id, $name, $lastname, $genre);
        }

        header('Location: ' . BASE_URL);
    }
}



?>