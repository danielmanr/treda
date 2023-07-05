<?php
    require_once("../config/db.php");
    class Tienda extends Conexion{
        public function get_tienda(){
            parent::conectar();
            try{
                $sql = "SELECT * FROM tienda";
                $consulta = $this->conexion->prepare($sql);
                $consulta->execute();
                return $consulta->fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e){
                throw new Exception("Error al obtener las tiendas: " . $e->getMessage());
            }

        }

        public function delete_tienda($Id){
            parent::conectar();
            try{
                $sql = "DELETE FROM tienda WHERE ID = ?";
                $consulta = $this->conexion->prepare($sql);
                $consulta->bindValue(1, $Id);
                $consulta->execute();
                return $consulta->fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e){
                throw new Exception("Error al eliminar la tienda: " . $e->getMessage());
            }

        }

        public function insert_tienda($Nombre, $Fecha_de_apertura){
            parent::conectar();
            try{
                $fecha = date("Y-m-d", strtotime($Fecha_de_apertura));
                $sql = "INSERT INTO tienda (ID, Nombre, Fecha_de_apertura) VALUES (NULL, ?, ?);";
                $consulta = $this->conexion->prepare($sql);
                $consulta->bindValue(1, $Nombre);
                $consulta->bindValue(2, $fecha);
                $consulta->execute();
                return $consulta->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                throw new Exception("Error al insertar la tienda: " . $e->getMessage());
            }
           
        }

        public function update_tienda($Nombre, $Fecha_de_apertura){
            parent::conectar();
            try{
                $sql = "UPDATE tienda SET Nombre = ?, Fecha_de_apertura = ?
                WHERE Id = ?";
                $consulta = $this->conexion->prepare($sql);
                $consulta->bindValue(1, $Nombre);
                $consulta->bindValue(2, $Fecha_de_apertura);
                $consulta->execute();
                return $consulta->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                throw new Exception("Error al actualizar la tienda: " . $e->getMessage());
            }
        }


        public function obtener_tienda($Id){
            parent::conectar();
            try{
                $sql = "SELECT * FROM tienda WHERE ID = ? LIMIT 1";
                $consulta = $this->conexion->prepare($sql);
                $consulta->bindValue(1, $Id);
                $consulta->execute();
                return $consulta->fetchAll(PDO::FETCH_ASSOC)[0];
            } catch(PDOException $e){
                throw new Exception("Error al obtner la tienda: " . $e->getMessage());
            }

        }

    }

?>