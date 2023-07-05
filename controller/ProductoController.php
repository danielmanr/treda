<?php

require_once("../model/Productos.php");
$producto = new Productos(); // Instancia de la clase Clientes

    switch($_GET["op"]){
        case "listar":
            $datos = $producto->get_productos();
            echo json_encode($datos);
            break;
        case "listarTienda":

            if(isset($_POST['id'])){
                $datos = $producto->get_productos_id($_POST['id']);
                echo json_encode($datos);
            }
            
        break;
        
        case "eliminar":
            if(isset($_POST['sku'])){
                $producto->delete_producto($_POST['sku']);
            }
            break;
        
        case "add":

            if(isset($_POST['Nombre']) & isset($_POST['SKU']) & isset($_POST['Descripcion'])& isset($_POST['Valor'])& isset($_POST['Tienda']) & isset($_FILES['imagenProducto'])){
                echo($_FILES['imagenProducto']);
                // $producto->insert_producto($_POST['Nombre'], $_POST['SKU'], $_POST['Descripcion'],$_POST['Valor'],$_POST['Tienda'],$_POST['Imagen']);
            }
            
            break;

        case "edit":
            if(isset($_POST['Id']) & isset($_POST['Nombre']) & isset($_POST['SKU']) & isset($_POST['Descripcion'])& isset($_POST['Valor'])& isset($_POST['Tienda'])& isset($_POST['Imagen'])){
                $producto->update_producto($_POST['Id'], $_POST['Nombre'], $_POST['SKU'],$_POST['Descripcion'],$_POST['Valor'],$_POST['Tienda'],isset($_POST['Imagen']));
            }
            break;      

        default:
            break;
    }


?>