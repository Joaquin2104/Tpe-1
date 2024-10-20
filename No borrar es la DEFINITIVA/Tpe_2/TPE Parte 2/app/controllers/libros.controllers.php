<?php 
require_once './app/models/libros.model.php';
require_once './app/views/libros.view.php';


class libroscontrollers {
    private $models;
    private $views;

    public function __construct($res) {
        
        $this->models = new librosmodel();
        $this->views = new librosview($res->user);
    }

    public function showlibros() {
        
        $libros = $this->models->getlibros();


        return $this->views->showlibros($libros);
    }

    public function showlibro($id) {
        $libro = $this->models->getlibro($id);

        return $this->views->showlibro($libro);
    }

    public function deletelibro($id) {
    
        $libro = $this->models->getlibro($id);

        if (!$libro) {
            return $this->views->showError("No existe el usuario con el id=$id");
        } else {
            $this->models->borrar_libro($id);
        }

        header('Location: ' . BASE_URL);
    }

    public function addlibro(){
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->views->showError('Falta completar el nombre');
        }
    
        if (!isset($_POST['generos']) || empty($_POST['generos'])) {
            return $this->views->showError('Falta completar los generos');
        }

        if (!isset($_POST['precio']) || empty($_POST['precio'])) {
            return $this->views->showError('Falta completar el precio');
        }

        if (!isset($_POST['id_usuario']) || empty($_POST['id_usuario'])) {
            return $this->views->showError('Falta completar los id de usuario');
        }
    
        $nombre = $_POST['nombre'];
        $generos = $_POST['generos'];
        $precio= $_POST['precio'];
        $id_usuario= $_POST['id_usuario'];
    
        $id = $this->models->agregarlibro($nombre, $generos, $precio, $id_usuario);
    
        header('Location: ' . BASE_URL);
    }

    public function editarlibro($id) {
        
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->views->showError('Falta completar el nombre');
        }
    
        if (!isset($_POST['generos']) || empty($_POST['generos'])) {
            return $this->views->showError('Falta completar los generos');
        }

        if (!isset($_POST['precio']) || empty($_POST['precio'])) {
            return $this->views->showError('Falta completar el precio');
        }

        if (!isset($_POST['id_usuario']) || empty($_POST['id_usuario'])) {
            return $this->views->showError('Falta completar los id de usuario');
        }
    
        $nombre = $_POST['nombre'];
        $generos = $_POST['generos'];
        $precio= $_POST['precio'];
        $id_usuario= $_POST['id_usuario'];
    
        $usuario = $this->models->getlibro($id);

        if (!$usuario) {
            return $this->views->showError("No existe el usuario con el id=$id");
        } else {
            $this->models->updatelibro($id, $nombre, $generos, $precio, $id_usuario);
        }

        header('Location: ' . BASE_URL);
    }

}

?>