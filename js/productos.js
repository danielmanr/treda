$(document).ready(function () {
    const table = document.getElementById("table-producto");
    const productoForm = document.getElementById("form-product");
    // Ocultar el formulario de guardar
    productoForm.style.display = "none";

    function load_tienda(){
        $.ajax({
            url: '../controller/TiendaController.php?op=info',
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
            url: '../controller/ProductoController.php?op=eliminar',
            type: 'POST',
            success: function(){
                document.location.reload();
        }})
    }

    function crear_producto() {
        let formData = new FormData(document.getElementById('form-product'));

        let nombre = formData.get('nombreproducto');
        let description = formData.get('descripcionProducto');
        let valor = formData.get('valorProducto');
        let tienda = document.getElementById("tienda-anadir").value;
        let imagen = formData.get('imagenProducto');

        if(nombre.trim() === '' || description.trim() === '' || valor.trim() === ''
        || tienda.trim() === '' || tienda === "0" || !imagen){
            alert('Todos los Campos son Obligatorios');
            return;
        }else{
            $.ajax({
                data: formData,
                url: '../controller/ProductoController.php?op=add',
                type: 'POST',
                processData: false,
                contentType: false,
                success: function(res) {
                  document.location.reload();
                }
              });
        }

        
    }
    
    function mostrar_producto(){
        $.ajax({
            url: '../controller/ProductoController.php?op=listar',
            type: 'GET',
            dataType: 'json',
            success: function(res){
                const res_tienda = JSON.parse(JSON.stringify(res));
                res_tienda.forEach(function(response) {
                    let imagen = "../img/"+response.Imagen
                    const fila = table.insertRow();
                    fila.insertCell().innerText = response.Nombre;
                    fila.insertCell().innerText = response.SKU;
                    fila.insertCell().innerText = response.Descripcion;
                    fila.insertCell().innerText = response.Valor;
                    fila.insertCell().innerText = response.Tienda;
                    let newimg = document.createElement("img");
                     newimg.setAttribute("src", imagen); 
                     newimg.setAttribute('class', 'w-50 h-auto');
                     let editarBtn = document.createElement('button');
                     editarBtn.innerText = 'Editar';
                     editarBtn.setAttribute('class', 'btn btn-warning btn-sm');
                     editarBtn.addEventListener('click', async () => {
                         obtener_producto(response.SKU);
                     });

                    let eliminarBtn = document.createElement('button');
                    eliminarBtn.innerText = 'Eliminar';
                    eliminarBtn.setAttribute('class', 'btn btn-danger btn-sm');
                    eliminarBtn.addEventListener('click', async () => {
                        eliminar_producto(response.SKU);
                    });
                    fila.insertCell().appendChild(newimg);
                    fila.insertCell().appendChild(editarBtn);
                    fila.insertCell().appendChild(eliminarBtn);
                });
        }})
    } 


    function obtener_producto(SKU){
        let parametros = {"SKU": SKU}
        $.ajax({
            data: parametros,
            url: '../controller/ProductoController.php?op=obtener',
            type: 'POST',
            success: function(res){
                productoForm.style.display = "block";
                document.getElementById("description-table").textContent = "Editar Producto"
                document.getElementById("guardar-producto").value = "editar";
                document.getElementById("guardar-producto").innerHTML = 'Editar';

                let response = JSON.parse(res);
                document.getElementById("nombreproducto").value = response.Nombre;
                document.getElementById("descripcionProducto").value = response.Descripcion;
                document.getElementById("valorProducto").value = response.Valor;
                document.getElementById("tienda-anadir").value = response.Tienda;
                tiendaSku = response.SKU;
        }})

    }


    function editar_producto(){
        sku = tiendaSku;
        let formData = new FormData(document.getElementById('form-product'));
        formData.append('sku', sku);

        let nombre = formData.get('nombreproducto');
        let description = formData.get('descripcionProducto');
        let valor = formData.get('valorProducto');
        let tienda = document.getElementById("tienda-anadir").value;
        let imagen = formData.get('imagenProducto');

        if(nombre.trim() === '' || description.trim() === '' || valor.trim() === ''
        || tienda.trim() === '' || tienda === "0" || !imagen){
            alert('Todos los Campos son Obligatorios');
            return;
        }else{
            $.ajax({
                data: formData,
                url: '../controller/ProductoController.php?op=edit',
                type: 'POST',
                processData: false,  
                contentType: false,  
                success: function(res) {
                    res = JSON.parse(res);
                    if (res.success !== true) {
                        alert(res.message);
                    } else {
                        document.location.reload();
                    }
                }
            });
        }
    }


    function mostrar_producto_por_id(id){
        $.ajax({
            data: {"id": id},
            url: '../controller/ProductoController.php?op=listarTienda',
            type: 'POST',
            dataType: 'json',
            success: function(res){
                const res_tienda = JSON.parse(JSON.stringify(res));
                res_tienda.forEach(function(response) {
                    let imagen = "../img/"+response.Imagen
                    const fila = table.insertRow();
                    fila.insertCell().innerText = response.Nombre;
                    fila.insertCell().innerText = response.SKU;
                    fila.insertCell().innerText = response.Descripcion;
                    fila.insertCell().innerText = response.Valor;
                    fila.insertCell().innerText = response.Tienda;


                    let newimg = document.createElement("img");
                     newimg.setAttribute("src", imagen); 
                     newimg.setAttribute('class', 'w-30 h-auto');
                    
                     let editarBtn = document.createElement('button');
                     editarBtn.innerText = 'Editar';
                     editarBtn.setAttribute('class', 'btn btn-warning btn-sm');
                     editarBtn.addEventListener('click', async () => {
                         console.log("editar");
                         obtener_producto(response.SKU);
                     });

                    let eliminarBtn = document.createElement('button');
                    eliminarBtn.innerText = 'Eliminar';
                    eliminarBtn.setAttribute('class', 'btn btn-danger btn-sm');
                    eliminarBtn.addEventListener('click', async () => {
                        eliminar_producto(response.SKU);
                    });
                    fila.insertCell().appendChild(newimg);
                    fila.insertCell().appendChild(editarBtn);
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

    document.getElementById("abrir_producto").addEventListener("click", (e) => {
        document.getElementById("nombreproducto").value = "";
        document.getElementById("descripcionProducto").value = "";
        document.getElementById("valorProducto").value = "";
        document.getElementById("tienda-anadir").value = "";
        document.getElementById("imagenProducto").value = "";
        document.getElementById("guardar-producto").innerHTML = 'Guardar';
        document.getElementById("guardar-producto").value = "guardar";
        productoForm.style.display = "block";
    });


    document.getElementById("guardar-producto").addEventListener("click", (e)=> {
        e.preventDefault;
        let endpoint_boton = document.getElementById("guardar-producto").value;
        if(endpoint_boton == "guardar"){
            return crear_producto()
        }
        return editar_producto()

    });
    mostrar_producto();
    load_tienda();
});
