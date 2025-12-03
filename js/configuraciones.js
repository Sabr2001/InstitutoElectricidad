getConfigs();


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
        let activo = config.activo == 1? 'SI':'NO';
        filas += `
        
            <tr>
                <td>${config.var_name}</td>
                <td>${config.valor_num}</td>
                <td>${config.unidad} KW</td>
                <td>${activo}</td>
                <td>
                    <button type="button" class="btn-delete-config btn btn-outline-warning"
                    data-id="${config.id}">
                        <i class="fa-solid fa-trash"></i>
                    </button>   
                </td>
            </tr>
        `;
    });
    console.log
    $("#indexConfigs").html(filas);
}