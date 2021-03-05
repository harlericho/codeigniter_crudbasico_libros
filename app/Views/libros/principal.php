<?= $header ?>
<!-- --------------------------- -->
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <h1><img src="<?= base_url('assets/images/books.ico') ?>" width="50" height="50"> Libros</h1>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="limpiar()" >
                Agregar
            </button>
            <div id="tabla" class="table table-responsive mt-5">
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Libros</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="principal" method="POST">
                        <input type="hidden" id="id" name="id">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>
                            <div class="mb-3">
                                <label for="des" class="form-label">Descripcion</label>
                                <input type="text" class="form-control" id="des" name="des">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $footer ?>