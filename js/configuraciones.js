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

// Abrir modal en modo "nuevo"
$('#btnNuevo').on('click', function () {
    // Resetear formulario
    $('#crudConfig')[0].reset();
    $('#id').val('');               // por si luego agregas editar
    $('#crudModalLabel').text('Nueva Configuración');
});

function Guardar() {
    const PARAMS = $("#crudProducto").serialize();
    const URL = `http://localhost:8080/guardarPermiso?${PARAMS}`;

    $.ajax({
        type: "POST",
        url: URL,
        beforeSend: function (params) {
            $("#loaderOverlay").css("display", "block");
        },
        success: function (res) {
            console.log(res);
            getListaPermisos();
            alert("Datos Guardados correctamente");
        },
        error: function (xhr) {
            //Codigo a ejecutar peticion con errores
        },
        complete: function (params) {
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