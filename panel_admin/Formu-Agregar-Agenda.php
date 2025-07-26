<!-- Este id="agregarAgenda" es imporante para que el modal pueda ser llamado desde la pagina agenda y contactos -->
<div class="modal fade my-5" id="AgregarAgenda" tabindex="-1" aria-labelledby="AgregarAgenda" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content fondo-agregar">
            <div class="modal-header">
                <h5 class="modal-title titulo-modal-agregar">Guardar Agenda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Cosas importantes a tener en cuenta son : la ruta el metodo post que sirve para que no te cojan los datos por la url
                y el atributo enctype="multipart/form-data" sin esto el formulario no podrá subir los archivos al servidor -->
                    <form method="POST" action="../back_end/procesos/AgregarNuevaAgenda.php" enctype="multipart/form-data">

                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-mobile form-icons-modales" aria-hidden="true"></i>
                                    <input type="text" name="nombre" class="form-control custom-modal-agregar" placeholder="Nombre">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-mobile form-icons-modales" aria-hidden="true"></i>
                                    <input type="text" name="version" class="form-control custom-modal-agregar" placeholder="Versión">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-4">
                                    <i class="fa fa-mobile form-icons-modales" aria-hidden="true"></i>
                                    <input type="text" name="marca" class="form-control custom-modal-agregar" placeholder="Marca">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <span class="bajar-checks">
                                        <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                    </span>
                                    <select name="selectUsuarios" class="form-select-custom-usuario">
                                        <option value="" selected="selected">Selecciona un usuario</option>
                                        <!-- Esta consulta saca todos los usuarios de la tabla para asignar el dispositivo -->
                                        <?php
                                        $query_usuarios = $bd->query("SELECT * FROM usuarios");
                                        $usuarios = $query_usuarios->fetchAll();

                                        foreach ($usuarios as $fila_usuarios) {
                                        ?>
                                            <option value="<?= $fila_usuarios["id_usuarios"] ?>" <?php {
                                                                                                        echo ' selected="selected"';
                                                                                                    } ?>>
                                                <?= $fila_usuarios["nombre"] ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-10">
                                <div class="input-group input-group-dynamic mb-4 my-3">
                                    <i class="fa fa-picture-o form-icons-modales" aria-hidden="true"></i>
                                    <!-- Esta función lo que hace, es previsualizar la foto una vez que el usuario la carga en el formulario antes de subirla -->
                                    <input type="file" name="foto_dispositivo" class="custom-modal-dispositivo" onchange="agenda_agregar(event)">
                                </div>
                            </div>

                            <div class="col">
                                <img style="width: 40px;" id="imagen-agenda-agregar">
                            </div>

                            <script>
                                let agenda_agregar = (event) => {
                                    let leer_img = new FileReader();
                                    let id_imagen = document.getElementById('imagen-agenda-agregar');
                                    leer_img.onload = () => {
                                        if (leer_img.readyState == 2) {
                                            id_imagen.src = leer_img.result
                                        }
                                    }
                                    leer_img.readAsDataURL(event.target.files[0])
                                    // console.log(leer_img);
                                }
                            </script>
                        </div>

                        <div class="form-group row">
                            <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                <i class="fa fa-text-height form-icons-modales" aria-hidden="true"></i>
                                <textarea type="text" name="descripcion" placeholder="Descripción..." class="form-control custom-modal-agregar"></textarea>
                            </div>
                        </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="botones">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>
                    <button type="submit" name="guardar_agenda" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>