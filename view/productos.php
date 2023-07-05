<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="crear_tienda.css">
    <link rel="stylesheet" href="index.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>

    <?php
    include_once("template/header.php");
    ?>
    <select class="form-select" name="tienda" id="select_list"></select>
    <table class="table table-striped-columns text-center" id="table-producto">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>SKU</th>
                <th>Descripcion</th>
                <th>Valor</th>
                <th>Tienda</th>
                <th>Imagen</th>
            </tr>
        </thead>
    </table>
    <form enctype="multipart/form-data" method="POST" id="form-product">
        <h4 Id="description-table">Crear producto</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombreproducto" aria-describedby="emailHelp" name="nombreproducto">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="descripcionProducto" name="descripcionProducto" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Valor</label>
            <input type="number" class="form-control" id="valorProducto" name="valorProducto" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tienda</label>
            <select class="form-select" id="tienda-anadir" name="tiendaAnadir"></select>

        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="imagenProducto" name="imagenProducto" aria-describedby="emailHelp">
        </div>
        <input type="button" class="btn btn-success" id="guardar-producto" value="Crear"></input>
    </form>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="../js/productos.js"></script>
</body>
</html>