<?php
    require_once("../config/db.php");
    class Productos extends Conexion{

        public function get_productos(){
            parent::conectar();
            $sql = "SELECT producto.*, tienda.Nombre AS Tienda
                FROM producto
                JOIN tienda ON producto.Tienda = tienda.Id";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
            //echo json_encode($resultado);
            //var_dump($resultado); // Mostramos el array de la consulta en pantalla
        }


        public function get_productos_id($Id){
            parent::conectar();
            $sql = "SELECT producto.*, tienda.Nombre AS Tienda
            FROM producto
            JOIN tienda ON producto.Tienda = tienda.Id WHERE Tienda = ?";
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindValue(1, $Id);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
            //echo json_encode($resultado);
            //var_dump($resultado); // Mostramos el array de la consulta en pantalla
        }


        public function delete_producto($Id){
            parent::conectar();
            $sql = "DELETE FROM producto WHERE SKU = ?";
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindValue(1, $Id);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }


        public function insert_producto($Nombre, $SKU,$descripcion,$valor,$tienda,$imagen){
            parent::conectar();
            $sql = "INSERT INTO producto (Nombre,SKU,Descripcion,Valor,Tienda,Imagen) VALUES ( ?, ?, ?, ?, ?, ?);";
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindValue(1, $Nombre);
            $consulta->bindValue(2, $SKU);
            $consulta->bindValue(3, $descripcion);
            $consulta->bindValue(4, $valor);
            $consulta->bindValue(5, $tienda);
            $consulta->bindValue(6, $imagen);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }


        public function update_producto($Nombre, $SKU,$descripcion,$valor,$tienda,$imagen){
            parent::conectar();
            $sql = "UPDATE producto SET Nombre = ?, SKU = ?, descripcion = ?, valor = ?, tienda = ?, imagen = ?
                    WHERE Id = ?";
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindValue(1, $Nombre);
            $consulta->bindValue(2, $SKU);
            $consulta->bindValue(3, $descripcion);
            $consulta->bindValue(4, $valor);
            $consulta->bindValue(5, $tienda);
            $consulta->bindValue(6, $imagen);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }

        
        public function count_producto(){
            parent::conectar();
            $sql = "SELECT * FROM producto";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->rowCount();
            //return $resultado;

        }

    }

?>