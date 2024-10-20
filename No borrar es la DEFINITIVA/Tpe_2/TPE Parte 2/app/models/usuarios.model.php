<?php
require_once './app/models/model.php';


class usuariosmodel extends Model{
    
    public function getusuarios() {
        
        $query = $this->db->prepare('SELECT * FROM usuario');
        $query->execute();

        
        $usuarios = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $usuarios;
    }

    public function getusuario($id) {    
        $query = $this->db->prepare('SELECT * FROM usuario WHERE id_usuario = ?');
        $query->execute([$id]);   
    
        return $user = $query->fetch(PDO::FETCH_OBJ);
    
    }
    
    public function agregarusuario($name, $lastname, $genre) { 
        $query = $this->db->prepare('INSERT INTO usuario(Nombre, Apellido, Genero) VALUES (?, ?, ?)');
        $query->execute([$name, $lastname, $genre]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }

    public function borrar_user($id) {
        $query = $this->db->prepare('DELETE FROM usuario WHERE id_usuario = ?');
        $query->execute([$id]);

    }

    public function updateusuario($id, $nombre, $apellido, $genre) {        
        $query = $this->db->prepare('UPDATE usuario SET Nombre=?,Apellido=?,Genero= ? WHERE id_usuario = ?');
        $query->execute([$nombre, $apellido, $genre, $id]);
    }

}

?>