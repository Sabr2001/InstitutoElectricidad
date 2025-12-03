getConfigs();


$(document).on('click', '.activar-config', function () {
    const id = $(this).data('id');
    const activoActual = parseInt($(this).data('activo'), 10);
    const estadoNuevo = activoActual === 1 ? 0 : 1;

    const URL = `http://localhost:8080/cambiarEstatusConfig/${id}/${estadoNuevo}`;

    $.ajax({
        type: "PUT",
        url: URL,
        beforeSend: function () {
            $("#loaderOverlay").css("display", "block");
        },
        success: function (res) {
            if (res == 1) {
                getConfigs();
            }
        },
        error: function () {
            alert('Error al cambiar el estado de la configuración');
        },
        complete: function () {
            $("#loaderOverlay").css("display", "none");
        }
    });
});

$('#btnNuevo').on('click', function () {

    $('#crudConfig')[0].reset();   
    $('#id').val('');              
    $('#crudModalLabel').text('Nueva Configuración');
});

$('#btnGuardar').on('click', function () {
    const var_name  = $('#var_name').val().trim();
    const valor_num = $('#valor_num').val().trim();
    if (!var_name || !valor_num) {
        alert('Ingrese al menos nombre de variable y valor numérico');
        return;
    }
    Guardar();
});

function Guardar() {
    const PARAMS = $("#crudConfig").serialize();  
    const URL = `http://localhost:8080/addConfig?${PARAMS}`;

    $.ajax({
        type: "POST",
        url: URL,
        beforeSend: function () {
            $("#loaderOverlay").css("display", "block");
        },
        success: function (res) {

            alert("Configuración creada correctamente");

            // Cerrar modal
            const modalElement = document.getElementById('modalConfig');
            const modal = bootstrap.Modal.getInstance(modalElement);
            modal.hide();

            // Recargar lista
            getConfigs();
        },
        error: function () {
            alert("Error al crear la configuración");
        },
        complete: function () {
            $("#loaderOverlay").css("display", "none");
        }
    });
}


function getConfigs() {
    const URL = `http://localhost:8080/getConfigs`;

    $.ajax({
        type: "GET",
        url: URL,
        dataType: "JSON",
        beforeSend: function (params) {
            $("#loaderOverlay").css("display", "block");
        },
        success: function (res) {
            cargarDatos(res);
        },
        error: function (xhr) {
            alert('No se pudieron Obtener Permisos')
        },
        complete: function (params) {
            $("#loaderOverlay").css("display", "none");
        }
    });
}

function cargarDatos(res) {
    let filas = "";
    $.each(res, function (i, config) {
        const activo = config.activo == 1 ? 'Activo' : 'Inactivo';
        const badgeClass = config.activo == 1 ? 'bg-success' : 'bg-secondary';
        filas += `
        
            <tr>
                <td>${config.var_name}</td>
                <td>${config.valor_num}</td>
                <td>${config.unidad} KW</td>
                <td>
                    <span class="badge ${badgeClass}">${activo}</span>
                </td>
                <td class="text-center">
                    <button type="button" 
                            class="activar-config btn btn-outline-info btn-sm" data-id="${config.id}"
                            data-activo="${config.activo}">
                        <i class="fa-solid fa-power-off"></i>
                    </button>
                    <button type="button" class="btn-delete-config btn btn-outline-warning" data-id="${config.id}">
                        <i class="fa-solid fa-trash"></i>
                    </button>   
                </td>
            </tr>
        `;
    });
    console.log
    $("#indexConfigs").html(filas);
}


$("#tabla-config").on("click", ".btn-delete-config", function () {
    const id = $(this).data("id");
    eliminar(id);
});

function eliminar(id) {
    const URL = `http://localhost:8080/eliminarConfig/${id}`;

    $.ajax({
        type: "DELETE",
        url: URL,
        beforeSend: function (params) {
            $("#loaderOverlay").css("display", "block");
        },
        success: function (res) {
            console.log(res);
            getConfigs();
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