<?php
require_once './app/models/model.php';


class librosmodel extends Model {

    public function getlibros() {
        
        $query = $this->db->prepare('SELECT * FROM libros');
        $query->execute();

        
        $libros = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $libros;
    }

    public function getlibro($id) {    
        $query = $this->db->prepare('SELECT * FROM libros WHERE Id = ?');
        $query->execute([$id]);   
    
        return $user = $query->fetch(PDO::FETCH_OBJ);
    
    }

    public function borrar_libro($id) {
        $query = $this->db->prepare('DELETE FROM libros WHERE Id = ?');
        $query->execute([$id]);

    }

    public function agregarlibro($nombre, $generos, $precio, $id_usuario) { 
        $query = $this->db->prepare('INSERT INTO libros(Nombre, Genero, Precio, id_usuario) VALUES (?, ?, ?, ?)');
        $query->execute([$nombre, $generos, $precio, $id_usuario]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }

    public function updatelibro($id, $nombre, $generos, $precio, $id_usuario) {        
        $query = $this->db->prepare('UPDATE libros SET Nombre=?, Genero=?, Precio=?, id_usuario=? WHERE Id=?');
        $query->execute([$nombre, $generos, $precio, $id_usuario, $id]);
    }
    

}

?>