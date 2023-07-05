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
<header>
    <nav class="navegador">
        <ul>
            <a href="productos.php">Productos</a>
            <a href="tiendas.php">Tiendas</a>
        </ul>
    </nav>
</header>

<body>
    <select class="form-select" name="tienda" id="select_list"></select>
    <br>
    <br>
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
    <br>
    <br>
    <br>
    <br>
    <br>

    <form>
        <h4 Id="description-table">Crear producto</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombrepoducto" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">SKU</label>
            <input type="text" class="form-control" id="skuPoducto"> 
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="descripcionProducto" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Valor</label>
            <input type="text" class="form-control" id="valorProducto" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tienda</label>
            <select class="form-select" name="tienda" id="tienda-anadir"></select>

        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Imagen</label>
            <input type="text" class="form-control" id="imagenProducto" aria-describedby="emailHelp">
        </div>
        <input type="button" class="btn btn-success" id="guardar-producto" value="Crear"></input>
    </form>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="../js/productos.js"></script>
</body>
</html>