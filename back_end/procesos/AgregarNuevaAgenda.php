<?php
session_start();
include_once ('../conexion_de_bbdd/config_bd.php');
if (isset($_POST['guardar_agenda'])) {
    try {
        $id_usuarios = $_POST['selectUsuarios'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $marca = $_POST['marca'];
        $version = $_POST['version'];

        $nombre_imagen = $_FILES['foto_dispositivo']['name'];
        $tipo_imagen = $_FILES['foto_dispositivo']['type'];
        $tam_imagen = $_FILES['foto_dispositivo']['size'];
        
        $path = $_SERVER['DOCUMENT_ROOT'] . '/milanes_moreno_david/subida_de_archivos/'; //ruta del archivo en el servidor, nunca se inserta en la base de datos.
        move_uploaded_file($_FILES['foto_dispositivo']['tmp_name'],$path.$nombre_imagen); //insertar el nombre de la imagen en la base de datos y no la ruta.

        $query_insertar_dispositivo = $bd->prepare("INSERT INTO dispositivo (id_usuarios,nombre,descripcion,marca,version,foto_dispositivo) VALUES (?,?,?,?,?,?)");
        $resultado_dispositivo = $query_insertar_dispositivo->execute([$id_usuarios,$nombre,$descripcion,$marca,$version,$nombre_imagen]);

        if($resultado_dispositivo == true){
            $_SESSION['message_agenda'] = 'Agenda creada ya puedes guardar los contactos !!!.';
        }else{
           $_SESSION['message_agenda'] = 'La Agenda no se ha podido guardar';
        }
        
        //Descomentar en caso de error
        //$query_insertar->debugDumpParams();
        //var_dump($resultado);
        
    } catch (PDOException $e) {
        $_SESSION['message_agenda'] = $e->getMessage();
    }
} else {
    $_SESSION['message_agenda'] = 'Llene el formulario';
}
    header('Location: '.$_SERVER['HTTP_REFERER']);

?>

