// guarda el NISE obtenido de la API
let niseCliente = null;

$(document).ready(function(){

    $("#contactForm").on("submit", function(e){
        e.preventDefault();

        let payload = {
            nise: $("#nise").val(),
            correo: $("#correo").val(),
            telefono: $("#telefono").val(),
            periodo: $("#periodo").val() ? $("#periodo").val() + "-01" : null,
            tipo: $("#tipo").val(),
            asunto: $("#asunto").val(),
            descripcion: $("#descripcion").val()
        };

        if(!$("#nise").val()){
            alert("Debe ingresar un número NISE.");
            return;
        }

        console.log("Payload enviado:", payload);

        $.ajax({
            url: "http://localhost:8080/enviarContacto",
            method: "POST",
            data: payload,
            dataType: "json",
            success: function(response){
                alert("Solicitud enviada correctamente");
                $("#contactForm")[0].reset();
            },
            error: function(xhr){
                console.error("ERROR:", xhr.responseText);
                alert("Hubo un error enviando la solicitud");
            }
        });
    });

});
