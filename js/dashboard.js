


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
        alert('Ingrese un Nise para Realizar la busqueda')
    }
    getLectura(nise);
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
                <td>${lectura.fecha_lectura   }</td>
                <td>${lectura.fecha_corte}</td>
                <td class="text-break">${lectura.observaciones}</td>
                <td>
                    <button data-bs-toggle="modal" data-bs-target="#modalEditLectura" class="btn-Editar btn btn-outline-warning" data-idLectura="${lectura.id}">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </td>
            </tr>
        `;
    });

    $("#indexLectura").html(filas);
}