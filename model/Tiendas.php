<?php
    require_once("../config/db.php");
    class Tienda extends Conexion{
        public function get_tienda(){
            parent::conectar();
            $sql = "SELECT * FROM tienda";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
            //echo json_encode($resultado);
            //var_dump($resultado); // Mostramos el array de la consulta en pantalla
        }

        public function delete_tienda($Id){
            parent::conectar();
            $sql = "DELETE FROM tienda WHERE Id = ?";
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindValue(1, $Id);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_tienda($Nombre, $Fecha_de_apertura){
            parent::conectar();
            $sql = "INSERT INTO tienda (Id, Nombre, Fechas_de_apertura) VALUES (NULL, ?, ?);";
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindValue(1, $Nombre);
            $consulta->bindValue(2, $Fecha_de_apertura);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_tienda($Nombre, $Fecha_de_apertura){
            parent::conectar();
            $sql = "UPDATE tienda SET Nombre = ?, Fecha_de_apertura = ?
                    WHERE Id = ?";
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindValue(1, $Nombre);
            $consulta->bindValue(2, $Fecha_de_apertura);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }

        public function count_tienda(){
            parent::conectar();
            $sql = "SELECT * FROM tienda";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->rowCount();
            //return $resultado;

        }

    }

?>