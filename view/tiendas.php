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
    <button id="abrir_tienda" type="button" class="btn btn-success">Crear tienda</button>
    <table class="table table-striped-columns text-center" id="table-tienda">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Fecha de apertura</th>
            </tr>
        </thead>
    </table>      
    <form id="tienda_form">
        <h4 id="description-table"></h4>
        <div class="mb-3">
            <label for="nombreTienda" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombreTienda" aria-describedby="emailHelp" required>
        </div>
        <div class="mb-3">
            <label for="fechaApertura" class="form-label">Fecha de apertura</label>
            <input type="date" class="form-control" id="fechaApertura" required>
        </div>
        <input type="submit" class="btn btn-success" id="guardar_tienda" value="Guardar">
    </form>

        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="../js/tiendas.js"></script>
</body>
</html>