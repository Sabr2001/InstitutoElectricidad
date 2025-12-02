let niseCliente = null;

$(document).ready(function () {

    console.log("Tipo usuario:", esAdmin ? "Administrador" : "Cliente");

    if (!esAdmin) {
// Si es cliente, obtener su NISE
        $.get(`http://localhost:8080/getClienteByCorreo?correo=${usuarioCorreo}`, function (data) {
            niseCliente = data.nise;
            console.log("NISE detectado automáticamente:", niseCliente);
        });
    }

    $("#btnBuscar").click(function () {

        let periodo = $("#periodo").val();
        if (!periodo) {
            alert("Debe seleccionar un período.");
            return;
        }
// el admin debe escribir el nise y el usuaruio cliente ya lo tiene asignado
        let niseBusqueda = esAdmin 
            ? $("#adminNise").val()        
            : niseCliente;                   

        if (!niseBusqueda) {
            alert("Debe ingresar el número NISE.");
            return;
        }

        $.get(`http://localhost:8080/getFactura?nise=${niseBusqueda}&periodo=${periodo}-01`, function (data) {

            if (data.error) {
                alert(data.error);
                $("#resultado").hide();
                return;
            }
            $("#infoCliente").html(`
                <strong>${data.cliente.nombre} ${data.cliente.apellido1} ${data.cliente.apellido2}</strong><br>
                NISE: ${data.cliente.nise}<br>
                Dirección: ${data.cliente.direccion}<br>
                Provincia: ${data.cliente.provincia}
            `);

            $("#detalleFactura").html(`
                <li>Consumo: <strong>${data.factura.consumo_kWh_facturado} kWh</strong></li>
                <li>Costo por kWh: <strong>${data.factura.costo_kWh_aplicado}</strong></li>
                <li>Subtotal: <strong>${data.factura.subtotal}</strong></li>
                <li>Impuestos: <strong>${data.factura.impuestos}</strong></li>
            `);

            $("#total").text(data.factura.total_pagar);
            $("#resultado").show();
        });

    });
});
