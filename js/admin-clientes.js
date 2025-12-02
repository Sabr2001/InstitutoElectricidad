$(document).ready(function () {

    cargarClientes();

    function cargarClientes() {
        $.get("http://localhost:8080/getClientes", function (data) {
            let filas = "";

            data.forEach(c => {
                filas += `
                <tr>
                    <td>${c.nise}</td>
                    <td>${c.cedula}</td>
                    <td>${c.nombre} ${c.apellido1} ${c.apellido2}</td>
                    <td>${c.telefono ?? "-"}</td>
                    <td>${c.email ?? "-"}</td>
                    <td>${c.provincia}</td>
                    <td>${c.tipo_tarifa}</td>
                    <td class="text-nowrap">
                        <button class="btn btn-sm btn-warning btnEditar" data-id="${c.nise}">
                            Editar
                        </button>
                        <button class="btn btn-sm btn-danger btnEliminar" data-id="${c.nise}">
                            Eliminar
                        </button>
                    </td>
                </tr>`;
            });

            $("#tablaClientes tbody").html(filas);
        });
    }

    $("#btnNuevo").click(function () {
        $("#formCliente")[0].reset();
        $("#editNise").val("");
        $("#modalCliente .modal-title").text("Agregar cliente");
        $("#modalCliente").modal("show");
    });

    $(document).on("click", ".btnEditar", function () {
        const nise = $(this).data("id");

        $.get(`http://localhost:8080/getCliente/${nise}`, function (c) {

            if (!c) {
                alert("No se encontró el cliente.");
                return;
            }

            $("#editNise").val(c.nise);
            $("#cedula").val(c.cedula);
            $("#nombre").val(c.nombre);
            $("#apellido1").val(c.apellido1);
            $("#apellido2").val(c.apellido2);
            $("#telefono").val(c.telefono);
            $("#email").val(c.email);
            $("#provincia_id").val(c.provincia_id);
            $("#tipo_tarifa").val(c.tipo_tarifa);

            $("#modalCliente .modal-title").text("Editar cliente");
            $("#modalCliente").modal("show");
        });
    });

    $("#guardarCliente").click(function () {

        let data = {
            cedula: $("#cedula").val(),
            nombre: $("#nombre").val(),
            apellido1: $("#apellido1").val(),
            apellido2: $("#apellido2").val(),
            telefono: $("#telefono").val(),
            email: $("#email").val(),
            provincia_id: $("#provincia_id").val(),
            tipo_tarifa: $("#tipo_tarifa").val()
        };

        if (!data.cedula || !data.nombre || !data.apellido1 || !data.apellido2) {
            alert("Cédula, nombre y apellidos son obligatorios.");
            return;
        }

        const niseEditar = $("#editNise").val();
        let url, method;

        if (niseEditar) {
            url = `http://localhost:8080/editarCliente/${niseEditar}`;
            method = "PUT";
        } else {
            url = "http://localhost:8080/addCliente";
            method = "POST";
        }

        $.ajax({
            url: url,
            type: method,
            data: data,
            success: function (resp) {
                $("#modalCliente").modal("hide");
                cargarClientes();
            },
            error: function (xhr) {
                console.error("Error guardando cliente", xhr.responseText);
                alert("Ocurrió un error al guardar el cliente.");
            }
        });
    });

    $(document).on("click", ".btnEliminar", function () {
        const nise = $(this).data("id");
        if (!confirm("¿Seguro que desea eliminar este cliente?")) return;
        $.ajax({
            url: `http://localhost:8080/eliminarCliente/${nise}`,
            type: "DELETE",
            success: function () {
                cargarClientes();
            },
            error: function () {
                alert("Error al eliminar el cliente.");
            }
        });
    });

});
