

$("#buscarNise").validate({
    rules: {
        nise: {
            required: true,
        },
    },
    messages: {
        nise: {
            required: "Ingrese un NISE valido",
        },
    }
});


$('#buscarNise').on('submit',function(e){
    e.preventDefault();

    const nise = $('#nise').val().trim();

    if(!nise){
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
    $('#prov').val('');
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
            console.log(res.nise);


            const modal = new bootstrap.Modal(document.getElementById('modalEditLectura'));
            $('#edit-id').val(res.id);
            $('#edit-nise').val(res.nise);
            
            $('#edit-periodo').val(res.periodo);
            $('#edit-consumo_kWh').val(res.consumo_kWh);
            $('#edit-fecha_lectura').val(res.fecha_lectura);
            $('#edit-fecha_corte').val(res.fecha_corte);
            $('#edit-tarifa_id').val('1');
            $('#edit-observaciones').val(res.observaciones);
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
    const id = $('#edit-id').val().trim(); 
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
            if (modalElement) {
                const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
                modal.hide();
            }
        },
        error: function (xhr) {
            console.error('Error al editar lectura', xhr);
            alert('Ocurrió un error al editar la lectura');
            },
        complete: function (params) {
            $("#loaderOverlay").css("display", "none");
        }
    });
})

function cargarDatos(res) {
    let filas = "";
    $.each(res, function (i, lectura) {
        
        const provincia = getProvinciaNombre(lectura.provincia_id);
        filas += `
        
        pro
            <tr>
                <td>${lectura.periodo}</td>
                <td>${lectura.nise}</td>
                <td>${lectura.consumo_kWh} KW</td>
                <td>${lectura.fecha_lectura}</td>
                <td>${lectura.fecha_corte}</td>
                <td class="text-break">${lectura.observaciones}</td>
                <td>${provincia}</td>
                <td>
                    <button type="button" class="btn-edit-lectura btn btn-outline-warning"
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

function getProvinciaNombre(id) {
    switch (parseInt(id)) {
        case 1: return "San José";
        case 2: return "Alajuela";
        case 3: return "Cartago";
        case 4: return "Heredia";
        case 5: return "Guanacaste";
        case 6: return "Puntarenas";
        case 7: return "Limón";
        default: return "-";
    }
}

function Eliminar(id) {
    const URL = `http://localhost:8080/borrarPermiso/${id}`;

    $.ajax({
        type: "DELETE",
        url: URL,
        beforeSend: function (params) {
            $("#loaderOverlay").css("display", "block");
        },
        success: function (res) {
            console.log(res);
            getListaPermisos();
            alert("Datos Datos eliminados correctamente");
        },
        error: function (xhr) {
            //Codigo a ejecutar peticion con errores
        },
        complete: function (params) {
            $("#loaderOverlay").css("display", "none");
        }
    });
}
