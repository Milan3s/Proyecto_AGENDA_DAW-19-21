<!-- Modal Editar -->
<div class="modal fade" id="editar<?php echo $fila_contactos['id_contactos']; ?>" tabindex="-1" aria-labelledby="ActualizarContacto" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content fondo-editar-modal">
            <div class="modal-header">
                <h5 class="modal-title titulo-modal-agregar">Editando Contacto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../back_end/procesos/EditarContacto.php?id_contactos=<?php echo $fila_contactos['id_contactos']; ?>" enctype="multipart/form-data">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                <i class="fa fa-user form-icons-modales" aria-hidden="true"></i>
                                <input type="text" name="nombre" class="form-control custom-control" value="<?php echo $fila_contactos['nombre']; ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                <i class="fa fa-user-o form-icons-modales" aria-hidden="true"></i>
                                <input type="text" name="apellidos" class="form-control custom-control" value="<?php echo $fila_contactos['apellidos']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                <i class="fa fa-calendar form-icons-modales" aria-hidden="true"></i>
                                <input type="date" name="selectCumple" class="form-control" value="<?php echo $fila_contactos['cumple']; ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group input-group-dynamic mb-4 my-3">
                                <i class="fa fa-flag form-icons-modales" aria-hidden="true"></i>
                                <input type="file" name="idioma" class="custom-modal-imagenes" <?php echo $fila_contactos['idioma']; ?> onchange="vista_idioma(event)">
                                <div>
                                    <img  id="img-idioma" src="../subida_de_archivos/<?php echo $fila_contactos['idioma']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-6">
                            <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                <span class="input-group-text-general" id="addon-wrapping">
                                    <i class="fa fa-map-marker form-icons-modales" aria-hidden="true"></i>
                                </span>
                                <input type="text" name="ciudad" class="form-control" value="<?php echo $fila_contactos['ciudad']; ?>">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                <span class="input-group-text-general" id="addon-wrapping">
                                    <i class="fa fa-map-marker form-icons-modales" aria-hidden="true"></i>
                                </span>
                                <input type="text" name="pais" class="form-control" value="<?php echo $fila_contactos['pais']; ?>">
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-6">
                            <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                <span class="input-group-text-general" id="addon-wrapping">
                                    <i class="fa fa-phone-square form-icons-modales" aria-hidden="true"></i>
                                </span>
                                <input type="text" name="telefono" class="form-control  custom-control" value="<?php echo $fila_contactos['telefono']; ?>">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group input-group-dynamic mb-4 my-3">
                                <span class="input-group-text-general" id="addon-wrapping">
                                    <i class="fa fa-picture-o form-icons-modales" aria-hidden="true"></i>
                                </span>
                                <input type="file" name="foto_contacto" class="custom-modal-contacto" <?php echo $fila_contactos['foto']; ?> onchange="vista_contacto(event)">
                                <div>
                                    <img class="img-editar-contacto" id="img-contacto" src="../subida_de_archivos/<?php echo $fila_contactos['foto']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                <span class="input-group-text-general" id="addon-wrapping">
                                    <i class="fa fa-envelope-square form-icons-modales" aria-hidden="true"></i>
                                </span>
                                <input type="email" name="email" placeholder="Correo..." class="form-control custom-control" value="<?php echo $fila_contactos['email']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group input-group-dynamic mb-4 my-3">
                                <span class="input-group-text-desplegable" id="addon-wrapping">
                                    <i class="fa fa-mobile form-icons-modales" aria-hidden="true"></i>
                                </span>
                                <select name="selectDispositivo" class="form-select-custom-editar">
                                    <option value="" selected="selected">Selecciona un dispositivo</option>
                                    <?php
                                    $query_dispositivos = $bd->query("SELECT * FROM dispositivo");
                                    $dispositivos = $query_dispositivos->fetchAll();

                                    foreach ($dispositivos as $fila_dispositivos) {
                                    ?>
                                        <option value="<?= $fila_dispositivos["id_dispositivo"] ?>">
                                            <?= $fila_dispositivos["nombre"] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>
                <button type="submit" name="actualizar_contacto" class="btn btn-success">
                    <input type="hidden" name="id_contactos" value="<?php echo $fila_contactos['id_contactos']; ?>">
                    <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="id<?php echo $fila_contactos['id_contactos']; ?>" tabindex=" -1" aria-labelledby="eliminarContacto" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content fondo-borrar-modal">
            <div class="modal-header">
                <h6 class="modal-title titulo-modal-borrar">Borrar Contacto</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-3 text-center">
                    <i class="fa fa-exclamation-triangle tam-55" aria-hidden="true"></i>
                    <p class="parrafo-general-modal">¿Está seguro de Borrar el Contacto?</p>
                    <p class="parrafo-general-info">
                        <i class="fa fa-info-circle icono-info-borrar-modal" aria-hidden="true"></i> <span class="parrafo-general-modal">  Referencia : 
                        <?php echo $fila_contactos['nombre'] . ' ' . $fila_contactos['apellidos']; ?></span>
                    </p>
                    <p class="text-center">
                        <img class="foto_contacto" src="../subida_de_archivos/<?php echo $fila_contactos['foto']; ?>">
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <form action="../back_end/procesos/BorrarContacto.php" method="POST">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i> <span class="botones-modal"> Cerrar </span>
                    </button>

                    <button type="submit" name="id" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-trash" aria-hidden="true"></i> <span class="botones-modal"> Si </span>
                    </button>

                    <input type="hidden" name="id" value="<?php echo $fila_contactos['id_contactos']; ?>">
                </form>
            </div>
        </div>
    </div>