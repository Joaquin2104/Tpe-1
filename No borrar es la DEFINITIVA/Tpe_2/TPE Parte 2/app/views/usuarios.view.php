<?php

class usuariosview {
        
    public function showusuarios($usuarios) {
        
        $count2 = count($usuarios);

       
        require 'templates/usuarios_y_libros/lista_usuarios.phtml';
    }

 public function showusuario($usuario) {
        
        require 'templates/usuarios_y_libros/vermas_usuario.phtml';
    }   

    public function showError($error) {
        require 'templates/error.phtml';
    }
}

?>