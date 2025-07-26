<!-- editar -->
<div class="modal fade my-5" id="editar_dispositivo<?php echo $dispositivos_moviles['id_dispositivo']; ?>" tabindex="-1" aria-labelledby="AgregarAgenda" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content fondo-agregar">
            <div class="modal-header">
                <h5 class="modal-title titulo-modal-agregar">Actualizar Agenda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="../back_end/procesos/EditarAgenda.php?id_dispositivo=<?php echo $dispositivos_moviles['id_dispositivo']; ?>" enctype="multipart/form-data" method="POST">
                    
                    <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-mobile form-icons-modales" aria-hidden="true"></i>
                                    <input type="text" name="nombre" value="<?php echo $dispositivos_moviles['nombre']; ?>" class="form-control custom-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-mobile form-icons-modales" aria-hidden="true"></i>
                                    <input type="text" name="version" value="<?php echo $dispositivos_moviles['version']; ?>" class="form-control custom-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-mobile form-icons-modales" aria-hidden="true"></i>
                                    <input type="text" name="marca" value="<?php echo $dispositivos_moviles['marca']; ?>" class="form-control custom-control">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-user form-icons-user" aria-hidden="true"></i>
                                    <select name="selectUsuarios" class="form-select-custom-usuario">
                                        <option value="" selected="selected">Selecciona un usuario</option>
                                        <?php
                                        $query_usuarios = $bd->query("SELECT * FROM usuarios");
                                        $usuarios = $query_usuarios->fetchAll();

                                        foreach ($usuarios as $fila_usuarios) {
                                        ?>
                                            <option value="<?= $fila_usuarios["id_usuarios"] ?>">
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
                                    <input type="file" name="foto_dispositivo" id="imagen" class="custom-modal-dispositivo" onchange="agenda(event)">
                                </div>
                            </div>

                            <div class="col">
                                <img id="imagen-agenda" src="../subida_de_archivos/<?php echo $dispositivos_moviles['foto_dispositivo']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                <i class="fa fa-text-height form-icons-modales" aria-hidden="true"></i>
                                <textarea type="text" name="descripcion" class="form-control custom-control"><?php echo $dispositivos_moviles['descripcion']; ?></textarea>
                            </div>
                        </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="botones">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>
                    <button type="submit" name="actualizar_dispositivo" class="btn btn-success">
                        <input type="hidden" name="id_dispositivo" value="<?php echo $dispositivos_moviles['id_dispositivo']; ?>">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

