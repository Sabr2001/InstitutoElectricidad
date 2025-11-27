// guarda el NISE obtenido de la API
let niseCliente = null;

$(document).ready(function(){
// Obtiene el NISE del cliente y carga las solicitudes al iniciar
    obtenerNise();
    cargarSolicitudes();

// Obtiene el NISE del cliente usando su correo
    function obtenerNise(){
        $.get("http://localhost:8080/getClienteByCorreo?correo=" + usuarioCorreo, function(data){
            console.log("NISE encontrado:", data);
            niseCliente = data.nise;
        });
    }

    $("#contactForm").on("submit", function(e){
        e.preventDefault();
// Construye el payload con los datos del formulario
        let payload = {
            nise: niseCliente,
            correo: usuarioCorreo,
            periodo: $("#periodo").val() + "-01",
            tipo: $("#tipo").val(),
            asunto: $("#asunto").val(),
            descripcion: $("#descripcion").val()
        };
        console.log("Payload enviado:", payload);
// mensaje de la solicitud AJAX
        $.ajax({
            url: "http://localhost:8080/enviarContacto",
            method: "POST",
            data: payload,
            dataType: "json",
            success: function(response){
                alert("Solicitud enviada correctamente");
                $("#contactForm")[0].reset();
                cargarSolicitudes();
            },
            error: function(xhr){
                console.error("ERROR:", xhr.responseText);
                alert("Hubo un error enviando la solicitud");
            }
        });
    });
// Carga las solicitudes del cliente y las muestra en la tabla
    function cargarSolicitudes(){
        $.get("http://localhost:8080/getSolicitudesCliente?correo=" + usuarioCorreo, function(data){
            console.log("Solicitudes:", data);
            
            let filas = "";
            data.forEach(s => {
                filas += `
                <tr>
                    <td>${s.id}</td>
                    <td>${s.periodo_consultado}</td>
                    <td>${s.tipo}</td>
                    <td>${s.asunto}</td>
                    <td>
                        <span class="badge bg-${s.estado === 'ATENDIDA' ? 'success' : s.estado === 'EN_PROCESO' ? 'warning' : 'secondary'}">
                        ${s.estado}
                        </span>
                    </td>
                    <td>${s.respuesta ?? "—"}</td>
                </tr>`;
            });
            $("#tablaContacto tbody").html(filas);
        });
    }

});
