<?php

require_once("../model/Tiendas.php");
$tiendas = new Tienda(); // Instancia de la clase Clientes

switch($_GET["op"]){
    case "listar":
        try {
            $datos = $tiendas->get_tienda();
            echo json_encode($datos);
        } catch (Exception $e) {
            echo json_encode(array("success" => false, "message" => $e));
        }
        break;
    
    case "info":
        try {
            $datos = $tiendas->get_tienda();
            $opciones = "<option value ='0' selected>Selecciona la tienda que deseas gestionar</option>";
            foreach($datos as $key){
                $opciones .= "<option value=".$key['ID'].">".$key['Nombre']."</option>";
            }
            echo $opciones;
        } catch (Exception $e) {
            echo json_encode(array("success" => false, "message" => $e));
        }
        break;

    case "eliminar":
        try {
            if(isset($_POST['id'])){
                $tiendas->delete_tienda($_POST['id']);
            }
        } catch (Exception $e) {
            echo json_encode(array("success" => false, "message" => $e));
        }
        break;
    
    case "add":
        try {
            if(isset($_POST['Nombre']) && isset($_POST['Fecha_de_apertura'])){
                $fecha = $_POST['Fecha_de_apertura'];
                $expresion = '/([3][0,1]|[0-2]\d)-([1][0-2]|[0]\d)-(\d\d\d\d)/';
                if(preg_match($expresion, $fecha)){
                    $response = $tiendas->insert_tienda($_POST['Nombre'], $fecha);
                    echo json_encode(array("success" => true, "message" => 'Se creo correctamente la tienda'));
                }else{
                    echo json_encode(array("success" => false, "message" => 'El formato de fecha es invalido'));
                }
            }
        } catch (Exception $e) {
            echo json_encode(array("success" => false, "message" => $e));
        }
        break;

    case "edit":
        try {
            if(isset($_POST['id']) && isset($_POST['Nombre']) && isset($_POST['Fecha_de_apertura'])){
                
                $fecha = $_POST['Fecha_de_apertura'];
                $expresion = '/([3][0,1]|[0-2]\d)-([1][0-2]|[0]\d)-(\d\d\d\d)/';
                if(preg_match($expresion, $fecha)){
                    $response = $tiendas->update_tienda($_POST['Nombre'], $fecha, $_POST['id']);
                    echo json_encode(array("success" => true, "message" => 'Se creo correctamente la tienda'));
                }else{
                    echo json_encode(array("success" => false, "message" => 'El formato de fecha es invalido'));
                }
                
                $tiendas->update_tienda($_POST['id'], $_POST['Nombre'], $_POST['Fecha_de_apertura']);

            }
        } catch (Exception $e) {
            echo json_encode(array("success" => false, "message" => $e));
        }
        break;
        
    case "obtener":
        try{
            if(isset($_POST['id'])){
                $datos = $tiendas->obtener_tienda($_POST['id']);
                echo json_encode($datos);
            }  
        }catch (Exception $e) {
            echo json_encode(array("success" => false, "message" => $e));
        }
        break;


    default:
        break;
}


?>