// alamacena el NISE del cliente logueado
var niseFactura = null;
// obtiene el correo del usuario logueado desde la base y consigue el NISE
$(document).ready(function(){
    obtenerNise();
    function obtenerNise(){
        $.get("http://localhost:8080/getClienteByCorreo?correo=" + usuarioCorreo, function(data){
            niseFactura = data.nise;
        });
    }
//boton buscar factura
    $("#btnBuscar").click(function(){
        
        let periodo = $("#periodo").val();
        if(!periodo){
            alert("Seleccione un periodo.");
            return;
        }
        $.get(`http://localhost:8080/getFactura?nise=${niseFactura}&periodo=${periodo}-01`, function(data){
// SI EXISTE FACTURA SE MUESTRA Y SINO MUESTRAB UN ERROR
            if(data.error){
                alert(data.error);
                $("#resultado").hide();
                return;
            }
// MUESTRA LA INFORMACION DE LA FACTURA Y DEL CLIENTE
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
            $("#estadoFactura").text(data.factura.estado)
                .removeClass()
                .addClass(`badge ${data.factura.estado === 'PAGADA' ? 'bg-success' : data.factura.estado === 'VENCIDA' ? 'bg-danger' : 'bg-warning'}`);
            $("#resultado").show();
        });
    });

});
