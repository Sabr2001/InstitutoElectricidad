// js/admin-lecturas.js
$(document).ready(function () {

    cargarLecturas();

    function cargarLecturas() {
        $.get("http://localhost:8080/getLecturas", function (data) {
            let filas = "";

            data.forEach(l => {
                filas += `
                <tr>
                    <td>${l.id}</td>
                    <td>${l.periodo}</td>
                    <td>${l.nise}</td>
                    <td>${l.consumo_kWh}</td>
                    <td>${l.fecha_lectura ?? "-"}</td>
                    <td>${l.fecha_corte ?? "-"}</td>
                    <td>${l.tarifa_nombre ?? l.tarifa_id ?? "-"}</td>
                    <td>${l.provincia ?? "-"}</td>
                    <td>${l.observaciones ?? "-"}</td>
                    <td class="text-nowrap">
                        <button class="btn btn-sm btn-warning btnEditarLectura" data-id="${l.id}">
                            Editar
                        </button>
                        <button class="btn btn-sm btn-danger btnEliminarLectura" data-id="${l.id}">
                            Eliminar
                        </button>
                    </td>
                </tr>`;
            });

            $("#tablaLecturas tbody").html(filas);
        });
    }

    $("#btnNuevoLectura").click(function () {
        $("#formLectura")[0].reset();
        $("#editId").val("");
        $("#modalLectura .modal-title").text("Agregar lectura");
        $("#modalLectura").modal("show");
    });

    $(document).on("click", ".btnEditarLectura", function () {
        const id = $(this).data("id");

        $.get(`http://localhost:8080/getLectura/${id}`, function (l) {

            if (!l) {
                alert("No se encontró la lectura.");
                return;
            }

            $("#editId").val(l.id);
            $("#periodo").val(l.periodo);
            $("#nise").val(l.nise);
            $("#consumo_kWh").val(l.consumo_kWh);
            if (l.fecha_lectura) {
                const d = new Date(l.fecha_lectura);
                const iso = d.toISOString().slice(0,16);
                $("#fecha_lectura").val(iso);
            } else {
                $("#fecha_lectura").val("");
            }
            $("#fecha_corte").val(l.fecha_corte);
            $("#tarifa_id").val(l.tarifa_id);
            $("#provincia_id").val(l.provincia_id);
            $("#observaciones").val(l.observaciones);

            $("#modalLectura .modal-title").text("Editar lectura");
            $("#modalLectura").modal("show");
        });
    });

    $("#guardarLectura").click(function () {

        let data = {
            periodo: $("#periodo").val(),
            nise: $("#nise").val(),
            consumo_kWh: $("#consumo_kWh").val(),
            fecha_lectura: $("#fecha_lectura").val(),
            fecha_corte: $("#fecha_corte").val() || null,
            tarifa_id: $("#tarifa_id").val(),
            provincia_id: $("#provincia_id").val() || null,
            observaciones: $("#observaciones").val()
        };

        if (!data.periodo || !data.nise || !data.consumo_kWh || !data.tarifa_id) {
            alert("Periodo, NISE, consumo y tarifa son obligatorios.");
            return;
        }

        const idEditar = $("#editId").val();
        let url, method;

        if (idEditar) {
            url = `http://localhost:8080/editarLectura/${idEditar}`;
            method = "PUT";
        } else {
            url = "http://localhost:8080/addLectura";
            method = "POST";
        }

        $.ajax({
            url: url,
            type: method,
            data: data,
            success: function (resp) {
                $("#modalLectura").modal("hide");
                cargarLecturas();
            },
            error: function (xhr) {
                console.error("Error guardando lectura", xhr.responseText);
                alert("Ocurrió un error al guardar la lectura.");
            }
        });
    });

    $(document).on("click", ".btnEliminarLectura", function () {
        const id = $(this).data("id");
        if (!confirm("¿Seguro que desea eliminar esta lectura?")) return;
        $.ajax({
            url: `http://localhost:8080/eliminarLectura/${id}`,
            type: "DELETE",
            success: function () {
                cargarLecturas();
            },
            error: function () {
                alert("Error al eliminar la lectura.");
            }
        });
    });

});
