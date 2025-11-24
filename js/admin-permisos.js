var accion = 1;
getListaPermisos();

$("#btnGuardar").click(function (e) {
    if (accion == 1) {
        Guardar();
    } else {
        Modificar();
        accion = 1;
        $("#modalProducto").modal('hide');
    }

    //limpiar campos
    $("#id").val("");
    $("#nombrePermiso").val("");
    $("#descripcion").val("");
    $("#habilitado").val(1);
});

$("#dataTable").on("click", ".btn-Eliminar", function () {
    const FILA = $(this).closest("tr"); //la fila del boton seleccionado
    const ID = FILA.find("td:nth-child(1)").text();
    Eliminar(ID);
});

$("#dataTable").on("click", ".btn-Editar", function () {
    const FILA = $(this).closest("tr"); //la fila del boton seleccionado
    accion = 2;

    $("#id").val(FILA.find("td:nth-child(1)").text());
    $("#nombrePermiso").val(FILA.find("td:nth-child(2)").text());
    $("#descripcion").val(FILA.find("td:nth-child(3)").text());
    let opt = FILA.find("td:nth-child(4)").text() == "Si" ? 1 : 2;
    $("#habilitado").val(opt);
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

function Modificar() {
    const PARAMS = $("#crudProducto").serialize();
    const URL = `http://localhost:8080/modificarPermiso?${PARAMS}`;

    $.ajax({
        type: "PUT",
        url: URL,
        beforeSend: function (params) {
            $("#loaderOverlay").css("display", "block");
        },
        success: function (res) {
            console.log(res);
            getListaPermisos();
            alert("Datos Modificados correctamente");
        },
        error: function (xhr) {
            //Codigo a ejecutar peticion con errores
        },
        complete: function (params) {
            $("#loaderOverlay").css("display", "none");
        }
    });
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

function getListaPermisos() {
    const URL = `http://localhost:8080/obtenertodosPermisos`;

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
            //Codigo a ejecutar peticion con errores
        },
        complete: function (params) {
            $("#loaderOverlay").css("display", "none");
        }
    });
}

function cargarDatos(res) {
    let filas = "";
    $.each(res, function (i, p) {
        filas += `
            <tr>
                <td>${p.id}</td>
                <td>${p.nombrePermiso}</td>
                <td>${p.descripcion}</td>
                <td>${p.habilitado == 1 ? "Si" : "No"}</td>
                <td>
                    <button data-bs-toggle="modal" data-bs-target="#modalProducto" class="btn-Editar btn btn-outline-warning" data-idPermiso="${p.id}">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button class="btn-Eliminar btn btn-outline-danger" data-idPermiso="${p.id}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
    });

    $("#dataTable").html(filas);
}
