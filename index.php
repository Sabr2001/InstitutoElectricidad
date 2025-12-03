<?php include "shared/header.php" ?>

<!-- Contenido principal -->
<main>
    <!-- Seccion de mi main -->
    <section class="row borderBottonRojo">
        <!-- Carrusel -->
        <div id="carruselPrincipal" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carruselPrincipal" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Proyecto hidroeléctrico"></button>
                <button type="button" data-bs-target="#carruselPrincipal" data-bs-slide-to="1" aria-label="imagen 2"></button>
                <button type="button" data-bs-target="#carruselPrincipal" data-bs-slide-to="2" aria-label="imagen 3"></button>
                <button type="button" data-bs-target="#carruselPrincipal" data-bs-slide-to="3" aria-label="imagen 4"></button>
                <button type="button" data-bs-target="#carruselPrincipal" data-bs-slide-to="4" aria-label="imagen 5"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/electricidad-1.png" class="d-block w-100" alt="imagen ilustratica-1">
                </div>
                <div class="carousel-item">
                    <img src="img/red-electrica.jpg" class="d-block w-100" alt="imagen ilustratica-2">
                </div>
                <div class="carousel-item">
                    <img src="img/electricidad-2.png" class="d-block w-100" alt="imagen ilustratica-3">
                </div>
                <div class="carousel-item">
                    <img src="img/telecomunicaciones.jpg" class="d-block w-100" alt="imagen ilustratica-4">
                </div>
                <div class="carousel-item">
                    <img src="img/colaboracion.jpeg" class="d-block w-100" alt="imagen ilustratica-5">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carruselPrincipal" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carruselPrincipal" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
        <!-- Fin Carrusel -->
    </section>

    <section class="row mt-5 justify-content-evenly align-items-center">
        <h2 class="col-sm-12 mt-5 text-center">Historia</h2>
        <img class="col-md-2 mt-3" height="230" src="img/historia.jpg" alt="logo ICE">
        <p class="col-md-9 mt-3">
            El Instituto Costarricense de Electricidad (ICE) fue fundado en 1949 con el objetivo de impulsar el desarrollo eléctrico y de telecomunicaciones en Costa Rica. Desde entonces, ha liderado proyectos hidroeléctricos, geotérmicos y de energía renovable, además de expandir servicios de telecomunicaciones bajo la marca kölbi.

            A lo largo de su historia, el ICE ha sido un motor clave para la modernización del país, garantizando el acceso a la energía y conectividad en zonas urbanas y rurales. Su compromiso con la sostenibilidad ha permitido que Costa Rica se posicione como líder mundial en el uso de energías limpias, con una matriz eléctrica que depende mayoritariamente de fuentes renovables.

            En el ámbito de las telecomunicaciones, el ICE ha impulsado la transformación digital mediante servicios de telefonía móvil, internet de alta velocidad y soluciones tecnológicas para empresas y hogares. Además, ha desarrollado infraestructura estratégica que conecta comunidades y fomenta la inclusión digital.

            El ICE también se ha caracterizado por su enfoque social, ofreciendo programas de electrificación rural, proyectos comunitarios y servicios accesibles para todos los costarricenses. Su visión integral combina innovación tecnológica, responsabilidad ambiental y compromiso con el bienestar nacional, consolidándose como una institución fundamental para el desarrollo de Costa Rica.
        </p>
    </section>

    <section class="row mt-5 justify-content-evenly">
        <h2 class="col-sm-12 mb-3 text-center">Noticias</h2>

        <!-- Noticia 1 -->
        <div class="card col-sm-12 col-md-6 col-lg-3 me-3 mt-3 p-4">
            <img src="img\ice_ini1.jpeg" class="card-img-top" alt="noticia electricidad">
            <div class="card-body text-center">
                <h5 class="card-title">Expansión de Energía Renovable</h5>
                <p class="card-text">El ICE inauguró nuevas plantas solares y eólicas para fortalecer la matriz eléctrica nacional.</p>
                <a href="#" class="btn bgColorPrimario textColorNeutro1">Leer más</a>
            </div>
        </div>

        <!-- Noticia 2 -->
        <div class="card col-sm-12 col-md-6 col-lg-3 me-3 mt-3 p-4">
            <img src="img/ice_ini2.jpg" class="card-img-top" alt="noticia telecomunicaciones">
            <div class="card-body text-center">
                <h5 class="card-title">Avances en Telecomunicaciones</h5>
                <p class="card-text">Se amplió la cobertura de internet de alta velocidad en comunidades rurales bajo la marca kölbi.</p>
                <a href="#" class="btn bgColorPrimario textColorNeutro1">Leer más</a>
            </div>
        </div>

        <!-- Noticia 3 -->
        <div class="card col-sm-12 col-md-6 col-lg-3 me-3 mt-3 p-4">
            <img src="img/ice_ini3.jpg" class="card-img-top" alt="noticia agencia virtual">
            <div class="card-body text-center">
                <h5 class="card-title">Agencia Virtual Renovada</h5>
                <p class="card-text">El ICE lanzó mejoras en su plataforma digital para facilitar trámites y pagos en línea.</p>
                <a href="#" class="btn bgColorPrimario textColorNeutro1">Leer más</a>
            </div>
        </div>

        <!-- Noticia 4 -->
        <div class="card col-sm-12 col-md-6 col-lg-3 me-3 mt-3 p-4">
            <img src="img/ice_ini4.jpg" class="card-img-top" alt="noticia sostenibilidad">
            <div class="card-body text-center">
                <h5 class="card-title">Compromiso Ambiental</h5>
                <p class="card-text">El ICE impulsa proyectos de electrificación rural y sostenibilidad para reducir la huella de carbono.</p>
                <a href="#" class="btn bgColorPrimario textColorNeutro1">Leer más</a>
            </div>
        </div>
    </section>


</main>

<?php include "shared/footer.php" ?>