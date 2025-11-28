


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
                <?php if ($_SESSION["correo"] == 'admin@ice.go.cr'): ?>
                    <button data-bs-toggle="modal" data-bs-target="#modalEditLectura" class="btn-Editar btn btn-outline-warning" data-idLectura="${lectura.id}">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                <?php endif; ?>   
                </td>
            </tr>
        `;
    });
    console.log
    $("#indexLectura").html(filas);
}