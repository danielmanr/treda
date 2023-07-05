$(document).ready(function () {
    const table = document.getElementById("table-tienda");
    // Obtener el formulario por su ID
    const tiendaForm = document.getElementById("tienda_form");
    // Ocultar el formulario de guardar
    tiendaForm.style.display = "none";

    // Función que realiza una petición ajax y elimina una tienda por su ID
    function eliminar_tienda(id){
        let parametros = {"id": id};
        $.ajax({
            data: parametros,
            url: '../controller/TiendaController.php?op=eliminar',
            type: 'POST',
            success: function(){
                document.location.reload();
        }})
    }

    // Función que crea una tienda en la base de datos tomándo el valor de los input
    function crear_tienda(){
        let nombre = document.getElementById('nombreTienda').value;
        let fecha_aux = document.getElementById('fechaApertura').value.split("-");
        let fecha = `${fecha_aux[2]}-${fecha_aux[1]}-${fecha_aux[0]}`;
        let parametros = {"Nombre": nombre, "Fecha_de apertura": fecha};
        console.log(parametros)
        $.ajax({
            data: parametros,
            url: '../controller/TiendaController.php?op=add',
            type: 'POST',
            success: function(res){
                res = JSON.parse(res);
                if(res.success != true){
                    alert(res.message);
                } else {
                    document.location.reload();
                }

                

        }})
    }

    function obtener_tienda(id){
        let parametros = {"id": id}
        $.ajax({
            data: parametros,
            url: '../controller/TiendaController.php?op=obtener',
            type: 'POST',
            success: function(res){
                tiendaForm.style.display = "block";
                document.getElementById("guardar_tienda").value = "editar";
                document.getElementById("guardar_tienda").innerHTML = 'Editar';

                let response = JSON.parse(res);
                document.getElementById("nombreTienda").value = response.Nombre;
                document.getElementById("fechaApertura").value = response.Fecha_de_apertura;
                tiendaId = response.ID;
        }})

    }

    function editar_tienda(){
        id = tiendaId;
        let nombre = document.getElementById('nombreTienda').value;
        let fecha_aux = document.getElementById('fechaApertura').value.split("-");
        let fecha = `${fecha_aux[2]}-${fecha_aux[1]}-${fecha_aux[0]}`;
        let parametros = {"id": id,"Nombre": nombre, "Fecha_de apertura": fecha};
        $.ajax({
            data: parametros,
            url: '../controller/TiendaController.php?op=edit',
            type: 'POST',
            success: function(res){
                res = JSON.parse(res);
                if(res.success != true){
                    alert(res.message);
                } else {
                    document.location.reload();
                }
        }})
    }

    // Función que hace una petición al servidor donde obtiene todas las tiendas y genera una tabla a partir de los datos

    function mostrar_tiendas(){
        $.ajax({
            url: '../controller/TiendaController.php?op=listar',
            type: 'GET',
            dataType: 'json',
            success: function(res){
                const res_tienda = JSON.parse(JSON.stringify(res));
                res_tienda.forEach(function(response) {
                    const fila = table.insertRow();
                    
                    fila.insertCell().innerText = response.ID;
                    fila.insertCell().innerText = response.Nombre;
                    fila.insertCell().innerText = response.Fecha_de_apertura;
            

                    let editarBtn = document.createElement('button')
                    editarBtn.innerText = "Editar";
                    editarBtn.setAttribute('class', 'btn btn-warning btn-sm');
                    editarBtn.addEventListener('click', async () => {
                       obtener_tienda(response.ID);
                    });

                    let eliminarBtn = document.createElement('button');
                    eliminarBtn.innerText = 'Eliminar';
                    eliminarBtn.setAttribute('class', 'btn btn-danger btn-sm');
                    eliminarBtn.addEventListener('click', async () => {
                        eliminar_tienda(response.ID);
                    });
                
                    fila.insertCell().appendChild(eliminarBtn);
                    fila.insertCell().appendChild(editarBtn);
                });
        }})  
    }




    document.getElementById("guardar_tienda").addEventListener("click", (e)=> {
        e.preventDefault;
        let endpoint_boton = document.getElementById("guardar_tienda").value;
        if(endpoint_boton == "guardar"){
            return crear_tienda();
        } 
        return editar_tienda()

        
    });

    document.getElementById("abrir_tienda").addEventListener("click", (e) => {
        document.getElementById("nombreTienda").value = "";
        document.getElementById("fechaApertura").value = "";
        document.getElementById("guardar_tienda").value = "guardar";
        document.getElementById("guardar_tienda").innerHTML = 'Guardar';
        tiendaForm.style.display = "block";
    });

    mostrar_tiendas();
});

