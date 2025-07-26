<div class="modal fade my-5" id="AgregarNuevoUsuario" tabindex="-1" aria-labelledby="AgregarNuevoUsuario" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content fondo-agregar">
            <div class="modal-header">
                <h5 class="modal-title titulo-modal-agregar">Crear Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="../back_end/procesos/AgregarNuevoUsuario.php" enctype="multipart/form-data">
                        <div class="form-group row">
                            <div class="col-md-10">
                                <div class="input-group input-group-dynamic mb-4 my-3">
                                    <i class="fa fa-picture-o form-icons-modales" aria-hidden="true"></i>
                                    <input type="file" name="foto_usuarios" id="imagen" class="custom-modal-dispositivo" onchange="admin_usuarios(event)">

                                </div>
                            </div>
                            <div class="col">
                                <img id="img-usus">
                            </div>
                            <script>
                                let admin_usuarios = (event) => {
                                    let leer_img = new FileReader();
                                    let id_imagen = document.getElementById('img-usus');
                                    leer_img.onload = () => {
                                        if (leer_img.readyState == 2) {
                                            id_imagen.src = leer_img.result
                                        }
                                    }
                                    leer_img.readAsDataURL(event.target.files[0])
                                    // console.log(leer_img);
                                }
                            </script>



                            <div class="col-md-12">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-info form-icons-modales" aria-hidden="true"></i>
                                    <input type="text" name="descripcion" class="form-control custom-modal-agregar" placeholder="Descripción">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-user-o form-icons-modales" aria-hidden="true"></i>
                                    <input type="text" name="nombre" class="form-control custom-modal-agregar" placeholder="Nombre">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-user form-icons-modales" aria-hidden="true"></i>
                                    <input type="text" name="apellidos" class="form-control custom-modal-agregar" placeholder="Apellidos">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-phone-square form-icons-modales" aria-hidden="true"></i>
                                    <input type="text" name="fijo" class="form-control custom-modal-agregar" placeholder="Fijo">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-phone-square form-icons-modales" aria-hidden="true"></i>
                                    <input type="text" name="movil" class="form-control custom-modal-agregar" placeholder="Móvil">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-envelope-o form-icons-modales" aria-hidden="true"></i>
                                    <input type="text" name="email" class="form-control custom-modal-agregar" placeholder="Email">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-key form-icons-modales" aria-hidden="true"></i>
                                    <input type="password" name="password" class="form-control custom-modal-agregar" placeholder="Contraseña">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="input-group input-group-dynamic input-group-custom mb-4 my-3">
                                    <i class="fa fa-address-book form-icons-modales" aria-hidden="true"></i>
                                    <input type="text" name="direccion" class="form-control custom-modal-agregar" placeholder="Dirección">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="input-group input-group-dynamic input-group-custom">
                                <i class="fa fa-cog form-icons-modales" aria-hidden="true"></i>
                                <select name="id_rol" class="form-select form-select-custom-acceder">
                                    <option class="" value="" selected="selected">Selecciona un rol</option>
                                    <?php
                                    // Esta consulta es importante, lo que hace es sacar solo los privilegios que se quiere mostrar en el formulario agregar usuario
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>
                    <button type="submit" name="guardar_usuario" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>