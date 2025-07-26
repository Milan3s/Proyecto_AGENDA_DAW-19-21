<div class="modal fade my-5" id="AgregarContactos" tabindex="-1" aria-labelledby="AgregarNuevoUsuario" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content fondo-agregar-modal">
            <div class="modal-header">
                <h5 class="modal-title titulo-modal-agregar">Guardar Contactos cc</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid col-sm-12">
                    <form action="../back_end/procesos/AgregarNuevoContacto.php" method="POST" enctype="multipart/form-data">
                        <!-- dos filas dos input -->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-user form-icons-modales" aria-hidden="true"></i>
                                    <input type="text" name="nombre" class="form-control custom-modal-agregar" placeholder="Nombre">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-user-o form-icons-modales" aria-hidden="true"></i>
                                    <input type="text" name="apellidos" class="form-control custom-modal-agregar" placeholder="Apellidos">
                                </div>
                            </div>
                        </div>
                        <!-- dos filas dos input -->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-calendar form-icons-modales" aria-hidden="true"></i>
                                    <input type="date" name="selectCumple" class="form-control custom-modal-calendario">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic mb-4 my-3">
                                    <i class="fa fa-flag form-icons-modales" aria-hidden="true"></i>
                                    <input type="file" name="idioma" class="custom-modal-imagenes" onchange="vista_idioma(event)">
                                    <div>
                                        <img id="img-idioma">
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
                                    <input type="text" name="ciudad" class="form-control custom-modal-agregar" placeholder="Ciudad">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <span class="input-group-text-general" id="addon-wrapping">
                                        <i class="fa fa-map-marker form-icons-modales" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" name="pais" class="form-control custom-modal-agregar" placeholder="País de Origen">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <span class="input-group-text-general" id="addon-wrapping">
                                        <i class="fa fa-phone-square form-icons-modales" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" name="telefono" class="form-control custom-modal-agregar" placeholder="Teléfono">
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="input-group input-group-dynamic mb-4 my-3">
                                    <span class="input-group-text-general" id="addon-wrapping">
                                        <i class="fa fa-picture-o form-icons-modales" aria-hidden="true"></i>
                                    </span>
                                    <input type="file" name="foto_contacto" class="custom-modal-imagenes" onchange="vista_contacto(event)">
                                    <div>
                                        <img style="width:40px;" id="img-contacto">
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
                                    <input type="email" name="email" placeholder="Correo..." class="form-control custom-modal-agregar">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group input-group-dynamic mb-4 my-3">
                                    <span class="input-group-text-desplegable" id="addon-wrapping">
                                        <i class="fa fa-mobile form-icons-modales" aria-hidden="true"></i>
                                    </span>
                                    <select name="selectDispositivo" class="col-sm-6 form-select-custom">
                                        <option class="" value="" selected="selected">Selecciona un dispositivo</option>
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
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>
                <button type="submit" name="nuevo_contacto" class="btn btn-primary">
                    <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar
                </button>
                </form>
            </div>
           
        </div>
    </div>