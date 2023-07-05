$(document).ready(function () {
    const table = document.getElementById("table-tienda");

    function eliminar_tienda(id){
        let parametros = {"id": id};
        $.ajax({
            data: parametros,
            url: '../controller/tienda_controller.php?op=eliminar',
            type: 'POST',
            success: function(){
                document.location.reload();
        }})
    }

    function crear_tienda(){
        let nombre = document.getElementById('nombreTienda').value;
        let fecha = document.getElementById('fechaApertura').value;

        let parametros = {"Nombre": nombre, "Fecha_de apertura": fecha};
        $.ajax({
            data: parametros,
            url: '../controller/tienda_controller.php?op=add',
            type: 'POST',
            success: function(res){
                document.location.reload();
        }})
    }

    function mostrar_tiendas(){
        $.ajax({
            url: '../controller/tienda_controller.php?op=listar',
            type: 'GET',
            dataType: 'json',
            success: function(res){
                const res_tienda = JSON.parse(JSON.stringify(res));
                res_tienda.forEach(function(response) {
                    const fila = table.insertRow();
                    // fila.insertCell().innerText = response.Id;
                    fila.insertCell().innerText = response.Nombre;
                    fila.insertCell().innerText = response.Fechas_de_apertura;


                    let eliminarBtn = document.createElement('button');
                    eliminarBtn.innerText = 'Eliminar';
                    eliminarBtn.setAttribute('class', 'btn btn-danger btn-sm');
                    eliminarBtn.addEventListener('click', async () => {
                        eliminar_tienda(response.Id);
                    });
                
                    fila.insertCell().appendChild(eliminarBtn);
                });
        }})
    } 

    document.getElementById("guardar_tienda").addEventListener("click", (e)=> {
        e.preventDefault;
        console.log("Hola")
        crear_tienda();
    });
    mostrar_tiendas();
});

