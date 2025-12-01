// ================================
// 1. CONSUMO ÚLTIMO MES
// ================================
cargarDatos("http://localhost:8080/consumoMes", function(res) {

    const labels = res.map(d => d.provincia);
    const valores = res.map(d => Number(d.total_consumo));

    new Chart(document.getElementById("chartMes"), {
        type: "bar",
    data: {
        labels: res.map(d => d.provincia),
        datasets: [{
            label: "Consumo por provincia",
            data: res.map(d => Number(d.total_consumo)),
            backgroundColor: [
                "rgba(255, 99, 132, 0.6)",
                "rgba(54, 162, 235, 0.6)",
                "rgba(255, 206, 86, 0.6)",
                "rgba(75, 192, 192, 0.6)",
                "rgba(153, 102, 255, 0.6)",
                "rgba(255, 159, 64, 0.6)",
                "rgba(199, 199, 199, 0.6)"
            ]
        }]
    }, options: {
    maintainAspectRatio: false,
    scales: {
        x: {
            ticks: { maxRotation: 0, minRotation: 0 },
        }
    },
    plugins: {},
    datasets: {
        bar: {
            barThickness: 40,   // ancho fijo de cada barra
            maxBarThickness: 40
        }
    }
}

    });

});


// ================================
// 2. CONSUMO ÚLTIMO TRIMESTRE
// ================================
cargarDatos("http://localhost:8080/consumoTrimestre", function(res) {

    const labels = res.map(d => d.provincia);
    const valores = res.map(d => Number(d.total_consumo));

    new Chart(document.getElementById("chartTrimestre"), {
        type: "bar",
    data: {
        labels: res.map(d => d.provincia),
        datasets: [{
            label: "Consumo por provincia",
            data: res.map(d => Number(d.total_consumo)),
            backgroundColor: [
                "rgba(255, 99, 132, 0.6)",
                "rgba(54, 162, 235, 0.6)",
                "rgba(255, 206, 86, 0.6)",
                "rgba(75, 192, 192, 0.6)",
                "rgba(153, 102, 255, 0.6)",
                "rgba(255, 159, 64, 0.6)",
                "rgba(199, 199, 199, 0.6)"
            ]
        }]
    }, options: {
    maintainAspectRatio: false,
    scales: {
        x: {
            ticks: { maxRotation: 0, minRotation: 0 },
        }
    },
    plugins: {},
    datasets: {
        bar: {
            barThickness: 40,   // ancho fijo de cada barra
            maxBarThickness: 40
        }
    }
}
    });
});


// ================================
// 3. CONSUMO ÚLTIMO SEMESTRE
// ================================
cargarDatos("http://localhost:8080/consumoSemestre", function(res) {

    const labels = res.map(d => d.provincia);
    const valores = res.map(d => Number(d.total_consumo));

    new Chart(document.getElementById("chartSemestre"), {
        type: "bar",
    data: {
        labels: res.map(d => d.provincia),
        datasets: [{
            label: "Consumo por provincia",
            data: res.map(d => Number(d.total_consumo)),
            backgroundColor: [
                "rgba(255, 99, 132, 0.6)",
                "rgba(54, 162, 235, 0.6)",
                "rgba(255, 206, 86, 0.6)",
                "rgba(75, 192, 192, 0.6)",
                "rgba(153, 102, 255, 0.6)",
                "rgba(255, 159, 64, 0.6)",
                "rgba(199, 199, 199, 0.6)"
            ]
        }]
        }, options: {
    maintainAspectRatio: false,
    scales: {
        x: {
            ticks: { maxRotation: 0, minRotation: 0 },
        }
    },
    plugins: {},
    datasets: {
        bar: {
            barThickness: 40,   // ancho fijo de cada barra
            maxBarThickness: 40
        }
    }
}
    });
});


// ================================
// 4. CONSUMO ÚLTIMO AÑO
// ================================
cargarDatos("http://localhost:8080/consumoAnual", function(res) {

    const labels = res.map(d => d.provincia);
    const valores = res.map(d => Number(d.total_consumo));

    new Chart(document.getElementById("chartAnual"), {
        type: "bar",
    data: {
        labels: res.map(d => d.provincia),
        datasets: [{
            label: "Consumo por provincia",
            data: res.map(d => Number(d.total_consumo)),
            backgroundColor: [
                "rgba(255, 99, 132, 0.6)",
                "rgba(54, 162, 235, 0.6)",
                "rgba(255, 206, 86, 0.6)",
                "rgba(75, 192, 192, 0.6)",
                "rgba(153, 102, 255, 0.6)",
                "rgba(255, 159, 64, 0.6)",
                "rgba(199, 199, 199, 0.6)"
            ]
        }]
        }, options: {
    maintainAspectRatio: false,
    scales: {
        x: {
            ticks: { maxRotation: 0, minRotation: 0 },
        }
    },
    plugins: {},
    datasets: {
        bar: {
            barThickness: 40,   // ancho fijo de cada barra
            maxBarThickness: 40
        }
    }
}
    });
});


// ================================
// FUNCIÓN AJAX
// ================================
function cargarDatos(URL, callback) {
    $.ajax({
        type: "GET",
        url: URL,
        dataType: "JSON",
        beforeSend: function () {
            $("#loaderOverlay").css("display", "block");
        },
        success: function (res) {
            callback(res);
        },
        error: function (xhr) {
            console.error("ERROR:", xhr.responseText);
        },
        complete: function () {
            $("#loaderOverlay").css("display", "none");
        },
    });
}
