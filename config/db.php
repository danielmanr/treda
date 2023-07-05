<?php

    class Conexion{
        
        protected $host = "localhost";
        protected $db = "tienda";
        protected $user = "root";
        protected $password = "";
        protected $conexion;

        public function conectar(){
            $conexionString = "mysql:host=$this->host;dbname=$this->db";
            try{
                $this->conexion = new PDO($conexionString,$this->user, $this->password);
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch( PDOException $e){
                echo "Conexión fallida" . $e;
                die();
            }
            return $this->conexion;
        }
    }

?> 