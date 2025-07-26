<!-- Este id="editar_dispositivo -> aqui le añado el id del dispositivo a editar y lo recorro en la tabla para que pueda ser llamado,
 es imporante para que el modal pueda ser llamado desde la pagina agenda y contactos 
Después voy capturando los datos en el formulario recorriendo la fila y mostrandolos en su campo con $dispositivos_moviles , 
de esta manera quedan almacenados en el input y su valor puede ser editado.
-->
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
                                    <span class="bajar-checks-editar">
                                        <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                    </span>
                                    <select name="selectUsuarios" class="form-select-custom-usuario">
                                        <option value="mover-select-agenda-usu" selected="selected">Selecciona un usuario</option>
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
                                    <input type="file" name="foto_dispositivo" id="imagen" class="custom-modal-dispositivo" onchange="editar_imagen_del_admin(event)">
                                </div>
                            </div>
                            
                            <div class="col">
                                <img style="width:40px;" id="admin-editar-imagen" src="../subida_de_archivos/<?php echo $dispositivos_moviles['foto_dispositivo']; ?>">
                            </div>
                        </div>
                        <script>
                            let editar_imagen_del_admin = (event) => {
                                let leer_img = new FileReader();
                                let id_imagen = document.getElementById('admin-editar-imagen');
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


<!-- Modal delete -->

<div class="modal fade" id="borrar_dispositivo<?php echo $dispositivos_moviles['id_dispositivo']; ?>" tabindex=" -1" aria-labelledby="eliminarContacto" aria-hidden="true">
<div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
    <div class="modal-content fondo-borrar-modal">
        <div class="modal-header">
            <h6 class="modal-title titulo-modal-borrar">Borrar Agenda</h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
            </button>
        </div>
        <div class="modal-body">
            <div class="py-3 text-center">
                <i class="fa fa-exclamation-triangle tam-55" aria-hidden="true"></i>
                <p class="parrafo-general-modal">¿Esta seguro de Borrar la Agenda?</p>
                <p class="parrafo-general-modal">Borrará también todos sus contactos y los perderá !</p>
                <p class="parrafo-general-info">
                    <i class="fa fa-info-circle icono-info-borrar-modal" aria-hidden="true"></i> <span class="parrafo-general-modal"> Referencia :
                        <?php echo $dispositivos_moviles['nombre']; ?>
                </p>
                <p class="text-center">
                    <img style="width: 40px;" class="foto_dispositivo" src="../subida_de_archivos/<?php echo $dispositivos_moviles['foto_dispositivo']; ?>">
                </p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-cancelar mx-auto" data-bs-dismiss="modal">
                <i class="fa fa-times" aria-hidden="true"></i>
                Cancelar
            </button>

            <form action="../back_end/procesos/BorrarAgenda.php" method="POST">
                <button type="submit" name="id" class="btn btn-danger btn-borrar mx-auto" data-dismiss="modal"><i class="fa fa-trash" aria-hidden="true"></i> Si </button>
                <input type="hidden" name="id" value="<?php echo $dispositivos_moviles['id_dispositivo']; ?>">
            </form>
        </div>
    </div>

