<?php
require_once("../config/db.php");
class Productos extends Conexion{

    public function get_productos(){
        try {
            parent::conectar();
            $sql = "SELECT producto.*, tienda.Nombre AS Tienda
                FROM producto
                JOIN tienda ON producto.Tienda = tienda.Id";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener los productos: " . $e->getMessage());
        }
    }

    public function get_productos_id($Id){
        try {
            parent::conectar();
            $sql = "SELECT producto.*, tienda.Nombre AS Tienda
            FROM producto
            JOIN tienda ON producto.Tienda = tienda.Id WHERE Tienda = ?";
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindValue(1, $Id);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener el producto: " . $e->getMessage());
        }
    }

    public function delete_producto($Id){
        try {
            parent::conectar();
            $sql = "DELETE FROM producto WHERE SKU = ?";
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindValue(1, $Id);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al eliminar el producto: " . $e->getMessage());
        }
    }

    public function insert_producto($Nombre, $descripcion, $valor, $tienda, $imagen){
        try {
            parent::conectar();
            $sql = "INSERT INTO producto (Nombre, Descripcion, Valor, Tienda, Imagen) VALUES (?, ?, ?, ?, ?);";
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindValue(1, $Nombre);
            $consulta->bindValue(2, $descripcion);
            $consulta->bindValue(3, $valor);
            $consulta->bindValue(4, $tienda);
            $consulta->bindValue(5, $imagen);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al insertar el producto: " . $e->getMessage());
        }
    }

    public function update_producto($Nombre, $SKU, $descripcion, $valor, $tienda, $imagen){
        try {
            parent::conectar();
            $sql = "UPDATE producto SET Nombre = ?, Descripcion = ?, Valor = ?, Tienda = ?, Imagen = ?
                    WHERE SKU = ?";
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindValue(1, $Nombre);
            $consulta->bindValue(2, $descripcion);
            $consulta->bindValue(3, $valor);
            $consulta->bindValue(4, $tienda);
            $consulta->bindValue(5, $imagen);
            $consulta->bindValue(6, $SKU);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al actualizar el producto: " . $e->getMessage());
        }
    }


    public function obtener_producto($SKU){
        try {
            parent::conectar();
            $sql = "SELECT * FROM producto WHERE SKU = ?";
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindValue(1, $SKU);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC)[0];
        } catch (PDOException $e) {
            throw new Exception("Error al obtener el producto: " . $e->getMessage());
        }
    }


    public static function StoreImage($photo){
        $target_dir = "../img/";
        $extarr = explode(".", $photo["name"]);
        $filename = $extarr[count($extarr) -2]; 
        $ext = $extarr[count($extarr) - 1];
        $hash = md5(date("Ymdgi") . $filename) . "." . $ext;
        $target_file = $target_dir . $hash;
        $uploadOk = 1;
        $check = getimagesize($photo["tmp_name"]);

        $check !== false ? $uploadOk = 1 : $uploadOk = 0;

        if($uploadOk == 0){
            return "";
        } else{
            if(move_uploaded_file($photo["tmp_name"], $target_file)){
                return $hash;
            } else {
                return "";
            }
        }

    }
}
?>
