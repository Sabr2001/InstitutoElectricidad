<?php include "shared/header.php" ?>

<main class="row justify-content-evenly pb-5 mb-5">
    <h1 class="col-sm-12 text-center">Preguntas frecuentes - ICE</h1>
    <!-- acordeon -->
    <div class="accordion col-sm-8" id="acordionFaq">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#pregunta1" 
                        aria-expanded="true" 
                        aria-controls="pregunta1">
                    ¿Cómo puedo pagar mi recibo de electricidad?
                </button>
            </h2>
            <div id="pregunta1" 
                class="accordion-collapse collapse show" 
                data-bs-parent="#acordionFaq">
                <div class="accordion-body">
                    <strong>El ICE ofrece múltiples opciones de pago.</strong> Puedes realizar el pago en línea mediante la Agencia Virtual, en bancos autorizados, o directamente en las oficinas del ICE. También está disponible el pago automático con tarjeta o cuenta bancaria.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#pregunta2" 
                    aria-expanded="false" 
                    aria-controls="pregunta2">
                    ¿Qué servicios de telecomunicaciones brinda kölbi?
                </button>
            </h2>
            <div id="pregunta2" class="accordion-collapse collapse" data-bs-parent="#acordionFaq">
                <div class="accordion-body">
                    <strong>kölbi es la marca de telecomunicaciones del ICE.</strong> Ofrece telefonía móvil, internet de alta velocidad, televisión digital y soluciones empresariales. Los planes están diseñados para clientes residenciales y corporativos.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#pregunta3" aria-expanded="false" aria-controls="pregunta3">
                    ¿Cómo reporto una avería eléctrica?
                </button>
            </h2>
            <div id="pregunta3" class="accordion-collapse collapse" data-bs-parent="#acordionFaq">
                <div class="accordion-body">
                    <strong>El ICE dispone de canales oficiales para reportes.</strong> Puedes llamar al 800-ICE-2000, ingresar a la Agencia Virtual o acudir a las oficinas más cercanas. El sistema de atención coordina cuadrillas para resolver la incidencia lo antes posible.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pregunta4" aria-expanded="false" aria-controls="pregunta4">
                    ¿Qué proyectos de energía renovable desarrolla el ICE?
                </button>
            </h2>
            <div id="pregunta4" class="accordion-collapse collapse" data-bs-parent="#acordionFaq">
                <div class="accordion-body">
                    <strong>El ICE lidera iniciativas de energía limpia.</strong> Entre ellas destacan proyectos hidroeléctricos, geotérmicos, solares y eólicos. Gracias a estas inversiones, Costa Rica mantiene una matriz energética mayoritariamente renovable.
                </div>
            </div>
        </div>
    </div>
</main>

<?php include "shared/footer.php" ?>
