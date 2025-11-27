<?php include "shared/header.php" ?>

    <main>
    
        <h1>Visualización de Permisos</h1>
        <div id="loaderOverlay">
            <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>
        
        <h2>Permisos por Estado (habilitado)</h2>
        <canvas id="chartEstado">
        <div id="loaderOverlay">
            <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>
        </canvas>
        
        <h2>Permisos por Nombre</h2>
        <canvas id="chartNombre"></canvas>
        <div id="loaderOverlay">
            <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>
        

        <h2>Permisos por Descripción</h2>
        <canvas id="chartDescripcion">
        <div id="loaderOverlay">
            <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>
        </canvas>
        
    </main>
<?php include "shared/footer.php" ?>