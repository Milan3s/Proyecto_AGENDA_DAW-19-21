<div class="modal fade my-5" id="actualizarPerfil_<?php echo $informacion['id_usuarios']; ?>" tabindex="-1" aria-labelledby="actualizarPerfil" aria-hidden="true">
    <form method="POST" action="../back_end/procesos/actualizarPerfil.php" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Actualizar Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="input-group input-group-dynamic">
                                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                                    <input type="file" class="input-perfil" name="foto_usuarios" onchange="admin_perfil(event)">
                                    <img id="img-perfil-contacto" src="../subida_de_archivos/<?php echo $informacion['foto_usuarios']; ?>">
                                </div>
                            </div>
                        </div>
                        <script>
                            let admin_perfil = (event) => {
                                let leer_img = new FileReader();
                                let id_imagen = document.getElementById('img-perfil-contacto');
                                leer_img.onload = () => {
                                    if (leer_img.readyState == 2) {
                                        id_imagen.src = leer_img.result
                                    }
                                }
                                leer_img.readAsDataURL(event.target.files[0])
                                // console.log(leer_img);
                            }
                        </script>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="input-group input-group-dynamic mb-2 my-2">
                                    <i class="fa fa-info icons-perfil" aria-hidden="true"></i>
                                    <input type="text" name="descripcion" class="form-control input-perfil" value="<?php echo $informacion['descripcion']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic mb-2 my-2">
                                    <i class="fa fa-user icons-perfil" aria-hidden="true"></i>
                                    <input type="text" name="nombre" class="form-control input-perfil" value="<?php echo $informacion['nombre']; ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic mb-2 my-2">
                                    <i class="fa fa-user-o icons-perfil" aria-hidden="true"></i>
                                    <input type="text" name="apellidos" class="form-control input-perfil" value="<?php echo $informacion['apellidos']; ?>">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic mb-2 my-2">
                                    <i class="fa fa-envelope-o icons-perfil" aria-hidden="true"></i>
                                    <input type="text" name="email" class="form-control input-perfil" value="<?php echo $informacion['email']; ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic mb-2 my-2">
                                    <i class="fa fa-info icons-perfil" aria-hidden="true"></i>
                                    <input type="text" name="fijo" class="form-control input-perfil" value="<?php echo $informacion['fijo']; ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic mb-2 my-2">
                                    <i class="fa fa-info icons-perfil" aria-hidden="true"></i>
                                    <input type="text" name="movil" class="form-control input-perfil" value="<?php echo $informacion['movil']; ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-dynamic mb-2 my-2">
                                    <i class="fa fa-address-book icons-perfil" aria-hidden="true"></i>
                                    <input type="text" name="direccion" class="form-control input-perfil" value="<?php echo $informacion['direccion']; ?>">
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="botones">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>
                        <input type="hidden" name="id_usuarios" value="<?php echo $informacion['id_usuarios']; ?>">
                        <button type="submit" name="actualiza_te" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>