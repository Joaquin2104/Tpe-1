<?php
require_once './app/models/model.php';

class UserModel extends Model {

    public function getUsuarioEmail($usuario) {    
        $query = $this->db->prepare("SELECT * FROM inicio_usuario WHERE Email = ?");
        $query->execute([$usuario]);
    
        $user = $query->fetch(PDO::FETCH_OBJ);
    
        return $user;
    }

}
