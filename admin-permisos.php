<?php 
    include "shared/auth.php";
    include "shared/header.php";
?>

<div class="row">
<?php include "shared/aside.php";?>
    <main class="col">
        <h1 class="text-center mt-4 mb-4">Cátalogo Permisos</h1>
        <div class="container-fluid">
            <!-- Botón para agregar nuevo registro -->
            <div class="d-flex justify-content-end mb-3">
                <button id="btnNuevo" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPermiso">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>

            <!-- Tabla -->
            
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Id</th>
                        <th>Nombre Permiso</th>
                        <th>Descripción</th>
                        <th>Habilitado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="dataTable">

                </tbody>
            </table>
        </div>
    </main>
</div>
<!-- Modal -->
<div class="modal fade" id="modalPermiso" tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crudModalLabel">Nuevo Permiso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="crudProducto">
                    <input type="hidden" id="id" name="id" value="">
                    <div class="mb-3">
                        <label for="nombrePermiso" class="form-label">Nombre Permiso</label>
                        <input name="nombrePermiso" type="text" class="form-control" id="nombrePermiso" placeholder="Ingrese Nombre del Permiso">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input name="descripcion" type="text" class="form-control" id="descripcion" placeholder="Ingrese descripción">
                    </div>
                    <div class="mb-3">
                        <label for="habilitado" class="form-label">Habilitado</label>
                        <select name="habilitado" id="habilitado" class="form-select">
                            <option value="1">Si</option>
                            <option value="2">No</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnGuardar" type="button" class="btn btn-primary">Guardar</button>
                <button id="cancelar" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div id="loaderOverlay">
    <div class="spinner-border text-light" role="status">
        <span class="visually-hidden">Cargando...</span>
    </div>
</div>

<?php include "shared/footer.php" ?>