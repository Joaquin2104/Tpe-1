<?php

class librosview {
    private $user = null;

    public function __construct($user) {
        $this->user = $user;
    }



    public function showlibros($libros) {
        
        $count = count($libros);

       
        require 'templates/usuarios_y_libros/lista_libros.phtml';
    }

    public function showlibro($libro) {
        
        require 'templates/usuarios_y_libros/vermas_libro.phtml';
    }  

    public function showError($error) {
        require 'templates/error.phtml';
    }

}

?>