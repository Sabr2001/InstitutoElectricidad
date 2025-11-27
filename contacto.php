<?php include "shared/header.php"; ?>

<main>
    <section class="row mt-5 justify-content-center">
        <div class="col-sm-12 text-center mb-4">
            <h2>Solicitud de Usuario</h2>
        </div>

        <div class="card col-sm-10 col-md-6 col-lg-4 p-4 shadow">
            <form action="send_mail.php" method="POST">

                <label for="cedula" class="form-label fw-bold">Cédula del Cliente</label>
                <input 
                    type="text" 
                    id="cedula" 
                    name="cedula" 
                    class="form-control mb-3" 
                    placeholder="Ingrese su cédula" 
                    required
                >

                <button type="submit" class="btn bgColorPrimario textColorNeutro1 w-100">
                    Enviar Solicitud
                </button>

            </form>
        </div>
    </section>
</main>

<?php include "shared/footer.php"; ?>
