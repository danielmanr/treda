<?php

require_once("../model/Productos.php");
$producto = new Productos(); // Instancia de la clase Clientes

    switch($_GET["op"]){
        case "listar":
            try{ 
                $datos = $producto->get_productos();
                echo json_encode($datos);
                break;
            }catch (Exception $e) {
                echo json_encode(array("success" => false, "message" => $e));
            }
        break;


        case "listarTienda":
            try{ 
                if(isset($_POST['id'])){
                    $datos = $producto->get_productos_id($_POST['id']);
                    echo json_encode($datos);
                }
            }catch (Exception $e) {
                echo json_encode(array("success" => false, "message" => $e));
            }
        break;
        

        case "eliminar":
            try{
                if(isset($_POST['sku'])){
                    $producto->delete_producto($_POST['sku']);
                }
            }catch (Exception $e) {
                echo json_encode(array("success" => false, "message" => $e));
            }
            break;
        
        case "add":
            try{

                if(isset($_POST['nombreproducto']) && isset($_POST['descripcionProducto']) && isset($_POST['valorProducto'])  && isset($_POST['tiendaAnadir']) && isset($_FILES['imagenProducto'])){
                    $ruta = $producto::StoreImage($_FILES['imagenProducto']);
                    $producto->insert_producto($_POST['nombreproducto'], $_POST['descripcionProducto'], $_POST['valorProducto'], $_POST['tiendaAnadir'], $ruta);
                }
            }catch (Exception $e) {
                echo json_encode(array("success" => false, "message" => $e));
            }
            break;

        case "edit":
            try{   
                if(isset($_POST['nombreproducto']) && isset($_POST['sku']) && isset($_POST['descripcionProducto']) && isset($_POST['valorProducto'])&& isset($_POST['tiendaAnadir'])&& isset($_FILES['imagenProducto'])){
                    $ruta = $producto::StoreImage($_FILES['imagenProducto']);
                    $datos = $producto->update_producto($_POST['nombreproducto'], $_POST['sku'], $_POST['descripcionProducto'],$_POST['valorProducto'],$_POST['tiendaAnadir'],$ruta);
                    echo json_encode(array("success" => true, "message" => 'Se creo correctamente la tienda'));
                }
                
             }catch (Exception $e) {
                echo json_encode(array("success" => false, "message" => $e));
            }
            break;


            
        case "obtener":
            try{

                if(isset($_POST['SKU'])){
                    $datos = $producto->obtener_producto($_POST['SKU']);
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