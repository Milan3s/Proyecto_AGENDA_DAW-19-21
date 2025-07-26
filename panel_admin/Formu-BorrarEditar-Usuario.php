<!-- editar -->
<div class="modal fade my-5" id="editar_usuarios<?php echo $fila_usuarios['id_usuarios']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content fondo-agregar">
            <div class="modal-header">
                <h5 class="modal-title titulo-modal-agregar">Actualizar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="../back_end/procesos/EditarUsuario.php?id_usuarios=<?php echo $fila_usuarios['id_usuarios']; ?>" enctype="multipart/form-data">
                        <div class="form-group row">
                            <div class="col-md-9">
                                <div class="input-group input-group-dynamic mb-4 my-3">
                                    <i class="fa fa-picture-o form-icons-modales" aria-hidden="true"></i>
                                    <input type="file" name="foto_usuarios" id="imagen" class="custom-modal-dispositivo" onchange="usuarios_admin(event)">
                                </div>
                            </div>

                            <div class="col">
                                <img id="imagen-usuarios" src="../subida_de_archivos/<?php echo $fila_usuarios['foto_usuarios']; ?>">
                            </div>

                            <div class="col-md-12">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-info form-icons-modales" aria-hidden="true"></i>
                                    <input type="text" name="descripcion" class="form-control custom-modal-agregar" value="<?php echo $fila_usuarios['descripcion']; ?>">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-user form-icons-modales" aria-hidden="true"></i>
                                    <input type="text" name="nombre" class="form-control custom-modal-agregar" value="<?php echo $fila_usuarios['nombre']; ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-user-o form-icons-modales" aria-hidden="true"></i>
                                    <input type="text" name="apellidos" class="form-control custom-modal-agregar" value="<?php echo $fila_usuarios['apellidos']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-envelope-o form-icons-modales" aria-hidden="true"></i>
                                    <input type="text" name="email" class="form-control custom-modal-agregar" value="<?php echo $fila_usuarios['email']; ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-key form-icons-modales" aria-hidden="true"></i>
                                    <input type="password" name="password" class="form-control custom-modal-agregar" placeholder="Nueva Contraseña..." value="<?php echo $fila_usuarios['password']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-mobile form-icons-modales" aria-hidden="true"></i>
                                    <input type="text" name="fijo" class="form-control custom-modal-agregar" value="<?php echo $fila_usuarios['fijo']; ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-mobile form-icons-modales" aria-hidden="true"></i>
                                    <input type="text" name="movil" class="form-control custom-modal-agregar" value="<?php echo $fila_usuarios['movil']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-address-book form-icons-modales" aria-hidden="true"></i>
                                    <input type="text" name="direccion" class="form-control custom-modal-agregar" value="<?php echo $fila_usuarios['direccion']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="input-group input-group-dynamic input-group-custom">
                                <i class="fa fa-cog form-icons-modales" aria-hidden="true"></i>
                                <select name="id_rol" class="form-select form-select-custom-acceder">
                                    <option class="" value="" selected="selected">Selecciona un rol</option>
                                    <?php
                                    $query_rol = $bd->query("SELECT id_rol,privilegios FROM rol AS rol WHERE rol.privilegios = 'Administrador' OR rol.privilegios = 'Colaborador' OR rol.privilegios = 'Normal' ORDER BY id_rol ASC;");
                                    $resultado_tipo_rol = $query_rol->fetchAll();

                                    foreach ($resultado_tipo_rol as $roles) {
                                    ?>
                                        <option value="<?= $roles["id_rol"] ?>">
                                            <?= $roles["privilegios"] ?>
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
                <div class="botones">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>
                    <button type="submit" name="actualizar_usuarios" class="btn btn-success">
                        <input type="hidden" name="id_usuarios" value="<?php echo $fila_usuarios['id_usuarios']; ?>">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->

<div class="modal fade" id="id_borrar_usuarios<?php echo $fila_usuarios['id_usuarios']; ?>" tabindex=" -1" aria-labelledby="borrar_usuarios" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content fondo-borrar-modal">
            <div class="modal-header">
                <h6 class="modal-title titulo-modal-borrar">Borrar Usuario</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-3 text-center">
                    <i class="fa fa-exclamation-triangle tam-55" aria-hidden="true"></i>
                    <p class="parrafo-general-modal">¿Está seguro de Borrar el Contacto?</p>
                    <p class="parrafo-general-info">
                        <span class="parrafo-general-modal">
                            <?php echo 'Con el nombre ' . $fila_usuarios['nombre'] . ' y email ' . $fila_usuarios['email']; ?>
                        </span>
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <form action="../back_end/procesos/BorrarUsuario.php" method="POST">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i> <span class="botones-modal"> Cerrar </span>
                    </button>

                    <button type="submit" name="borrar_usuarios" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-trash" aria-hidden="true"></i> <span class="botones-modal"> Si </span>
                    </button>

                    <input type="hidden" name="id" value="<?php echo $fila_usuarios['id_usuarios']; ?>">
                </form>
            </div>
        </div>
    </div>