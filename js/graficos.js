  
  //----Gráfiico numero de permisos por estado
cargarDatos("http://localhost:8080/permisosPorDescripcion", function(res) {
    // const labels = res.map(d=> d.habilitado==1 ? "Habilitado" : "Deshabilitado");
    const labels = res.map(d=> {
        if(d.habilitado==1){
            return "Habilitado"
        }else{
            return "Deshabilitado"
        }
    });
    const valores= res.map(d=> d.total);

    new Chart(document.getElementById("chartEstado"),{
        type:"pie",
        data:{
            labels:labels,
            datasets:[{
                label:"Cantidad",
                data:valores
            }]
        }
    })

})


//-------------------------PETICIÓN AJAX
function cargarDatos(URL,callback) {
    $.ajax({
        type: "GET",
        url: URL,
        dataType: "JSON",
        beforeSend: function (params) {
            $("#loaderOverlay").css("display", "block");
        },
        success: function (res) {
            callback(res);
            
        },
        error: function (xhr) {
            //Codigo a ejecutar peticion con errores
        },
        complete: function (params) {
            $("#loaderOverlay").css("display", "none");

        },
    });
}
