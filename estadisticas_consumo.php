<?php include "shared/header.php" ?>

<link rel="stylesheet" href="css/graficos.css"> <!-- Archivo de estilos para esta página -->

<main>

    <section class="row mt-5 justify-content-center">
        <h1 class="text-center mb-4">Gráficos de Consumo Eléctrico por Provincia</h1>
        <p class="col-md-10 texto-justificado text-center">
            Visualización detallada del consumo energético por provincias,
            permitiendo comparar mes, trimestre, semestre y año.
        </p>
    </section>

    <div id="loaderOverlay">
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Cargando...</span>
        </div>
    </div>

    <!-- ============================
         SECCIÓN: MES
    ============================= -->
    <section class="row mt-5 justify-content-center">
        <h2 class="text-center mb-4">Consumo del Último Mes por Provincia</h2>
        <div class="col-md-10 card-grafico">
            <canvas id="chartMes"></canvas>
        </div>
    </section>

    <!-- ============================
         SECCIÓN: TRIMESTRE
    ============================= -->
    <section class="row mt-5 justify-content-center">
        <h2 class="text-center mb-4">Consumo del Último Trimestre</h2>
        <div class="col-md-10 card-grafico">
            <canvas id="chartTrimestre"></canvas>
        </div>
    </section>

    <!-- ============================
         SECCIÓN: SEMESTRE
    ============================= -->
    <section class="row mt-5 justify-content-center">
        <h2 class="text-center mb-4">Consumo del Último Semestre</h2>
        <div class="col-md-10 card-grafico">
            <canvas id="chartSemestre"></canvas>
        </div>
    </section>

    <!-- ============================
         SECCIÓN: AÑO
    ============================= -->
    <section class="row mt-5 justify-content-center">
        <h2 class="text-center mb-4">Consumo del Último Año</h2>
        <div class="col-md-10 card-grafico">
            <canvas id="chartAnual"></canvas>
        </div>
    </section>

</main>

<?php include "shared/footer.php" ?>