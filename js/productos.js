$(document).ready(function () {
    const table = document.getElementById("table-producto");

    function load_tienda(){
        $.ajax({
            url: '../controller/tienda_controller.php?op=info',
            type: 'POST',
        })
        .done(function(res){
            $("#select_list").html(res);
            $("#tienda-anadir").html(res);
        })
    }

    function eliminar_producto(id){
        let parametros = {"sku": id};
        $.ajax({
            data: parametros,
            url: '../controller/producto_controller.php?op=eliminar',
            type: 'POST',
            success: function(){
                document.location.reload();
        }})
    }

    function crear_producto(){
        let nombre = document.getElementById('nombrepoducto').value;
        let sku = document.getElementById('skuPoducto').value;
        let descripcion = document.getElementById('descripcionProducto').value;
        let valor = document.getElementById('valorProducto').value;
        let tienda = document.getElementById('tienda-anadir').value;
        let imagen = document.getElementById('imagenProducto').value;

        let parametros = {"Nombre": nombre, "SKU": sku, "Descripcion": descripcion, "Valor": valor, "Tienda": tienda, "Imagen": imagen};
        $.ajax({
            data: parametros,
            url: '../controller/producto_controller.php?op=add',
            type: 'POST',
            success: function(res){
                document.location.reload();
        }})
    }  

    function mostrar_producto(){
        $.ajax({
            url: '../controller/producto_controller.php?op=listar',
            type: 'GET',
            dataType: 'json',
            success: function(res){
                const res_tienda = JSON.parse(JSON.stringify(res));
                res_tienda.forEach(function(response) {
                    const fila = table.insertRow();
                    fila.insertCell().innerText = response.Nombre;
                    fila.insertCell().innerText = response.SKU;
                    fila.insertCell().innerText = response.Descripcion;
                    fila.insertCell().innerText = response.Valor;
                    fila.insertCell().innerText = response.Tienda;
                    fila.insertCell().innerText = response.Imagen;


                    let eliminarBtn = document.createElement('button');
                    eliminarBtn.innerText = 'Eliminar';
                    eliminarBtn.setAttribute('class', 'btn btn-danger btn-sm');
                    eliminarBtn.addEventListener('click', async () => {
                        eliminar_producto(response.SKU);
                    });
                
                    fila.insertCell().appendChild(eliminarBtn);
                });
        }})
    } 

    function mostrar_producto_por_id(id){
        $.ajax({
            data: {"id": id},
            url: '../controller/producto_controller.php?op=listarTienda',
            type: 'POST',
            dataType: 'json',
            success: function(res){
                const res_tienda = JSON.parse(JSON.stringify(res));
                res_tienda.forEach(function(response) {
                    const fila = table.insertRow();
                    fila.insertCell().innerText = response.Nombre;
                    fila.insertCell().innerText = response.SKU;
                    fila.insertCell().innerText = response.Descripcion;
                    fila.insertCell().innerText = response.Valor;
                    fila.insertCell().innerText = response.Tienda;
                    fila.insertCell().innerText = response.Imagen;


                    let eliminarBtn = document.createElement('button');
                    eliminarBtn.innerText = 'Eliminar';
                    eliminarBtn.setAttribute('class', 'btn btn-danger btn-sm');
                    eliminarBtn.addEventListener('click', async () => {
                        eliminar_producto(response.SKU);
                    });
                
                    fila.insertCell().appendChild(eliminarBtn);
                });
        }})
    } 

    document.getElementById("select_list").addEventListener("change", (e) => {
        let idTienda = document.getElementById("select_list").value;
        // table.innerHTML = "";
        let rowCount = table.rows.length; 

        for (var i = rowCount - 1; i > 0; i--) {
            table.deleteRow(i); // Eliminar la fila actual
        }
        if(idTienda == "0"){
            return mostrar_producto();
        }

        mostrar_producto_por_id(idTienda);
    });

    document.getElementById("guardar-producto").addEventListener("click", (e)=> {
        e.preventDefault;
        console.log("Hola")
        crear_producto();
    });
    mostrar_producto();
    load_tienda();
});
