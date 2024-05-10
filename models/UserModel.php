<?php

class UserModel {

    public function getUsers(){
        $conexion = new ConexionModel();
        $conn = $conexion->getConexion();
        $stmt = $conn->prepare("SELECT * FROM usuarios");
        
        if($stmt->execute()){
            $conexion->closeConexion();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $conexion->closeConexion();
            return false;
        }
    }

    public function getUser($id){
        $conexion = new ConexionModel();
        $conn = $conexion->getConexion();
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id_usuario = :ID");
        $stmt->bindParam(':ID', $id, PDO::PARAM_INT);
        if($stmt->execute()){
            $conexion->closeConexion();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            $conexion->closeConexion();
            return false;
        }
    }

    public function createUser($data){
        $nombre = $data['nombre'];
        $apellido = $data['apellido'];
        $email = $data['email'];
        $telefono = $data['telefono'];

        $conexion = new ConexionModel();
        $conn = $conexion->getConexion();
        $stmt = $conn->prepare("INSERT INTO usuarios (nombres, apellidos, email, telefono) VALUES (:NOMBRE, :APELLIDO, :EMAIL, :TELEFONO)
        ");
        $stmt->bindParam(':NOMBRE', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':APELLIDO', $apellido, PDO::PARAM_STR);
        $stmt->bindParam(':EMAIL', $email, PDO::PARAM_STR);
        $stmt->bindParam(':TELEFONO', $telefono, PDO::PARAM_STR);

        if($stmt->execute()){
            $conexion->closeConexion();
            return true;
        }else{
            $conexion->closeConexion();
            return false;
        }
    }

    public function updateUser($data){
        $nombre = $data['e_nombre'];
        $apellido = $data['e_apellido'];
        $email = $data['e_email'];
        $telefono = $data['e_telefono'];
        $id = $data['e_id_usuario'];

        $conexion = new ConexionModel();
        $conn = $conexion->getConexion();
        $stmt = $conn->prepare("UPDATE usuarios SET nombres = :NOMBRE, apellidos = :APELLIDO, email = :EMAIL, telefono = :TELEFONO WHERE id_usuario = :ID");
        
        $stmt->bindParam(':NOMBRE', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':APELLIDO', $apellido, PDO::PARAM_STR);
        $stmt->bindParam(':EMAIL', $email, PDO::PARAM_STR);
        $stmt->bindParam(':TELEFONO', $telefono, PDO::PARAM_STR);
        $stmt->bindParam(':ID', $id , PDO::PARAM_INT);

        if($stmt->execute()){
            $conexion->closeConexion();
            return true;
        }else{
            $conexion->closeConexion();
            return false;
        }
    }

    public function deleteUser($id){
        $idUsuario = $id;

        $conexion = new ConexionModel();
        $conn = $conexion->getConexion();
        $stmt = $conn->prepare("DELETE FROM usuarios WHERE id_usuario = :ID");
        $stmt->bindParam(':ID', $idUsuario, PDO::PARAM_INT);

        if($stmt->execute()){
            $conexion->closeConexion();
            return true;
        }else{
            $conexion->closeConexion();
            return false;
        }
    }

}