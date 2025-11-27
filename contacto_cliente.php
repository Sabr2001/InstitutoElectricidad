<?php
include "shared/header.php";
?>
<main class="flex-grow-1">
    <div class="row">
        <section class="col">
            <div class="container">
                <div class="m-4 text-center">
                    <h1>Bienvenidos al apartado de atencion al cliente</h1>
                </div>
                <p class="text-center">
                    En esta sección, nuestros valiosos clientes pueden presentar quejas, consultas y reclamos relacionados con los servicios proporcionados por el Instituto Costarricense de Electricidad (ICE). Nuestro compromiso es brindar una atención eficiente y resolver cualquier inquietud que pueda surgir.
                </p>
                <!-- Formulario de contacto -->
                <div class="card p-5 mt-5 text-center">
                    <h3>Formulario para Quejas, Consultas y Reclamos</h3>

                    <form id="contactForm" class="card p-4">
                        <label><strong>Número NISE:</strong></label>
                        <input type="number" id="nise" class="form-control mb-3" required>
                        <label><strong>Correo:</strong></label>
                        <input type="email" id="correo" class="form-control mb-3" required>
                        <label><strong>Teléfono:</strong></label>
                        <input type="text" id="telefono" class="form-control mb-3">
                        <label><strong>Periodo (opcional):</strong></label>
                        <input type="month" id="periodo" class="form-control mb-3">
                        <label><strong>Tipo Solicitud:</strong></label>

                        <select id="tipo" class="form-control mb-3">
                            <option value="CONSULTA">Consulta</option>
                            <option value="RECLAMO">Reclamo</option>
                            <option value="QUEJA">Queja</option>
                        </select>

                        <label><strong>Asunto:</strong></label>
                        <input type="text" id="asunto" class="form-control mb-3" required>
                        <label><strong>Descripción:</strong></label>
                        <textarea id="descripcion" class="form-control mb-3" rows="4" required></textarea>

                        <button class="btn btn-primary w-100">Enviar Solicitud</button>
                    </form>
                </div>
                <!-- Fin Formulario de contacto -->
            </div>
        </section>
    </div>
</main>
<?php include "shared/footer.php"; ?>
<!-- Pasar el correo del usuario a JavaScript -->
<script src="js/contacto_cliente.js"></script>