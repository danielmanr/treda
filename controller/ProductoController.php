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
            echo "Hola entrando";
            print_r($_POST);
            print_r($_FILES);
            if(isset($_POST['nombreproducto']) && isset($_POST['descripcionProducto']) && isset($_POST['valorProducto'])  && isset($_POST['tiendaAnadir']) && isset($_FILES['imagenProducto'])){
                $ruta = $producto::StoreImage($_FILES['imagenProducto']);
                echo $ruta;
                echo "Hola";

                $producto->insert_producto($_POST['nombreproducto'], $_POST['descripcionProducto'], $_POST['valorProducto'], $_POST['tiendaAnadir'], $ruta);
            }
            
            break;

        case "edit":
            if(isset($_POST['Id']) && isset($_POST['Nombre']) && isset($_POST['SKU']) && isset($_POST['descripcionProducto'])&& isset($_POST['tienda-anadir'])&& isset($_POST['imagenProducto'])&& isset($_POST['Imagen'])){
                $producto->update_producto($_POST['Id'], $_POST['Nombre'], $_POST['SKU'],$_POST['descripcionProducto'],$_POST['tienda-anadir'],$_POST['imagenProducto'],isset($_POST['Imagen']));
            }
            break;      

        default:
            break;
    }


?>