


$("#buscarNise").validate({
    rules: {
        nise: {
            required: true,
        },
    },
    messages: {
        nombrePermiso: {
            required: "Ingrse un NISE valido",
        },
    }
});


$('#buscarNise').on('submit',function(e){
    e.preventDefault();

    const nise = $('#nise').val().trim();

    if(!nise){
        alert('Ingrese un Nise válido')
        return;
    }

    const boton = e.originalEvent.submitter;
    const tipo = $(boton).data('tipo')

    if(tipo == 'read'){
        getLectura(nise);
    }else if(tipo == 'add'){
        addLectura(nise)
    }
})

function addLectura(nise){
    $('#niseAddLectura').val(nise);

    const hoy = new Date().toISOString().slice(0, 10); 
    $('#periodo').val(hoy);
    $('#fecha_lectura').val(hoy);
    $('#fecha_corte').val('');
    $('#consumo_kWh').val(0);
    $('#tarifa_id').val('1');
    $('#observaciones').val('');
    $('#id').val('');

    const modal = new bootstrap.Modal(document.getElementById('modalAddLectura'));
    modal.show();
}

$('#btnGuardarAddLectura').on('click', function(){
    const nise = $('#niseAddLectura').val().trim(); 
    const PARAMS = $("#crudLectura").serialize();
    const URL = `http://localhost:8080/guardarLectura/${nise}?${PARAMS}`;

    $.ajax({
        type: "POST",
        url: URL,
        beforeSend: function (params) {
            $("#loaderOverlay").css("display", "block");
        },
        success: function (res) {
            console.log(res);
            alert("Datos Guardados correctamente");
            const modalElement = document.getElementById('modalAddLectura');
            const modal = bootstrap.Modal.getInstance(modalElement);
            modal.hide();
        },
        error: function (xhr) {
            //Codigo a ejecutar peticion con errores
        },
        complete: function (params) {
            $("#loaderOverlay").css("display", "none");
        }
    });
})


$(document).on('click', '.btn-edit-lectura', function (e) {
    e.preventDefault();
    const boton = $(this);
    const id = $(boton).data('id');
    const tr = boton.closest('tr');
    if(!id){
        alert('Denegado')
        return;
    }
    editLectura(id ,tr)

})

function editLectura(id, tr){
    const PARAMS = id
    const URL = `http://localhost:8080/obtenerLecturasById/${PARAMS}`;

    $.ajax({
        type: "GET",
        url: URL,
        dataType: "JSON",
        beforeSend: function (params) {
            $("#loaderOverlay").css("display", "block");
        },
        success: function (res) {
            console.log('LOGUEO DE RES: ',res);
            console.log(res[0].nise);


            const modal = new bootstrap.Modal(document.getElementById('modalEditLectura'));
            $('#id').val(res[0].id);
            $('#nise').val(res[0].nise);
            
            $('#periodo').val(res[0].periodo);
            $('#consumo_kWh').val(res[0].consumo_kWh);
            $('#fecha_lectura').val(res[0].fecha_lectura);
            $('#fecha_corte').val(res[0].fecha_corte);
            $('#tarifa_id').val('1');
            $('#observaciones').val(res[0].observaciones);
            modal.show();
        },
        error: function (xhr) {
            //Codigo a ejecutar peticion con errores
        },
        complete: function (params) {
            $("#loaderOverlay").css("display", "none");
        }
    });

}

function getLectura(nise) {
    const PARAMS = nise
    const URL = `http://localhost:8080/obtenerLecturasByNise/${PARAMS}`;

    $.ajax({
        type: "GET",
        url: URL,
        dataType: "JSON",
        beforeSend: function (params) {
            $("#loaderOverlay").css("display", "block");
        },
        success: function (res) {
            console.log('LOGUEO DE RES: ',res);
            cargarDatos(res);
            const modal = new bootstrap.Modal(document.getElementById('modalIndexLectura'));
            modal.show();
        },
        error: function (xhr) {
            //Codigo a ejecutar peticion con errores
        },
        complete: function (params) {
            $("#loaderOverlay").css("display", "none");
        }
    });
}

$('#btnGuardarEditLectura').on('click', function(){
    console.log('ENTRE');
    const id = $('#id').val().trim(); 
    const PARAMS = $("#crudEditLectura").serialize();
    const URL = `http://localhost:8080/editLectura/${id}?${PARAMS}`;

    $.ajax({
        type: "PUT",
        url: URL,
        beforeSend: function (params) {
            $("#loaderOverlay").css("display", "block");
        },
        success: function (res) {
            console.log(res);
            alert("Datos Editados correctamente");
            const modalElement = document.getElementById('modalEditLectura');
            const modal = bootstrap.Modal.getInstance(modalElement);
            modal.hide();
            location.reload;
        },
        error: function (xhr) {
            //Codigo a ejecutar peticion con errores
        },
        complete: function (params) {
            $("#loaderOverlay").css("display", "none");
        }
    });
})

function cargarDatos(res) {
    let filas = "";
    $.each(res, function (i, lectura) {
        filas += `
            <tr>
                <td>${lectura.periodo}</td>
                <td>${lectura.nise}</td>
                <td>${lectura.consumo_kWh} KW</td>
                <td>${lectura.fecha_lectura}</td>
                <td>${lectura.fecha_corte}</td>
                <td class="text-break">${lectura.observaciones}</td>
                <td>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalEditLectura" class="btn-edit-lectura btn btn-outline-warning"
                    data-id="${lectura.id}">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>   
                </td>
            </tr>
        `;
    });
    console.log
    $("#indexLectura").html(filas);
}