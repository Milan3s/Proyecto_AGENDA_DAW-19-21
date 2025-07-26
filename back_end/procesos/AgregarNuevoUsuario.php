<?php
session_start();
include_once ('../conexion_de_bbdd/config_bd.php');
if (isset($_POST['guardar_usuario'])) {
    try {
        $rol = htmlspecialchars($_POST['id_rol']);
        $nombre = htmlspecialchars($_POST['nombre']);
        $apellidos = htmlspecialchars($_POST['apellidos']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST["password"]);
        $descripcion = htmlspecialchars($_POST['descripcion']);
        $fijo = htmlspecialchars($_POST["fijo"]);
        $movil = htmlspecialchars($_POST["movil"]);

        $nombre_imagen = $_FILES['foto_usuarios']['name'];
		$tipo_imagen = $_FILES['foto_usuarios']['type'];
		$tam_imagen = $_FILES['foto_usuarios']['size'];
			
		$path =  $_SERVER['DOCUMENT_ROOT'] . '/milanes_moreno_david/subida_de_archivos/'; //ruta del archivo en el servidor, nunca se inserta en la base de datos.
		move_uploaded_file($_FILES['foto_usuarios']['tmp_name'],$path.$nombre_imagen); //insertar el nombre de la imagen en la base de datos y no la ruta.
        $direccion = htmlspecialchars($_POST["direccion"]);

        $query_insertar = $bd->prepare("INSERT INTO usuarios (id_rol,nombre,apellidos,email,password,descripcion,fijo,movil,foto_usuarios,direccion)
         VALUES (?,?,?,?,?,?,?,?,?,?);");
        $resultado_usuario = $query_insertar->execute([$rol,$nombre,$apellidos,$email,$password,$descripcion,$fijo,$movil,$nombre_imagen,$direccion]);

        if($resultado_usuario == true){
            $_SESSION['message_usuario'] = 'Usuario guardado correctamente.';
       }else{
           $_SESSION['message_usuario'] = 'El Usuario no se ha podido guardar';
           $_SESSION['message_linea'] = 'El Usuario no se ha podido guardar';
       }
        
    } catch (PDOException $err_agregar_usuarios) {
        $_SESSION['message_usuario'] = $err_agregar_usuarios->getMessage();
        $_SESSION['message_linea'] = $err_agregar_usuarios->getLine();
    }
} else {
    $_SESSION['message_usuario'] = 'Llene el formulario';
}

header('Location: '.$_SERVER['HTTP_REFERER']);
?>


