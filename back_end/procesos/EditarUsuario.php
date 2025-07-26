<?php
	session_start();
	include_once ('../conexion_de_bbdd/config_bd.php');
	print_r($_POST);
	if(isset($_POST['actualizar_usuarios'])){
		try{
			$rol = htmlentities($_POST['id_rol']);
			$id_usuarios = htmlspecialchars($_POST['id_usuarios']);
			$nombre = htmlspecialchars($_POST['nombre']);
			$apellidos = htmlspecialchars($_POST['apellidos']);
			$email = htmlspecialchars($_POST['email']);
			$password = htmlspecialchars($_POST["password"]);
			$descripcion = htmlspecialchars($_POST['descripcion']);
			$fijo = htmlspecialchars($_POST['fijo']);
			$movil = htmlspecialchars($_POST['movil']);
			$direccion = htmlspecialchars($_POST['direccion']);

			$nombre_imagen = $_FILES['foto_usuarios']['name'];
			$tipo_imagen = $_FILES['foto_usuarios']['type'];
			$tam_imagen = $_FILES['foto_usuarios']['size'];
			
			$path =  $_SERVER['DOCUMENT_ROOT'] . '/milanes_moreno_david/subida_de_archivos/'; //ruta del archivo en el servidor, nunca se inserta en la base de datos.
			move_uploaded_file($_FILES['foto_usuarios']['tmp_name'],$path.$nombre_imagen); //insertar el nombre de la imagen en la base de datos y no la ruta.
			
			$query_actualizar_usuarios = $bd->prepare("UPDATE `usuarios` SET `id_rol` = ?, `nombre` = ?,`apellidos` = ?, `email` = ?, `password` = ?, 
			`descripcion` = ?, `fijo` = ?, `movil` = ?, `foto_usuarios` = ?,`direccion` = ? WHERE `usuarios`.`id_usuarios` = ?;");			
			$resultado = $query_actualizar_usuarios->execute([$rol,$nombre,$apellidos,$email,$password,$descripcion,$fijo,$movil,$nombre_imagen,$direccion,$id_usuarios]);
			
            if($resultado == true){
                $_SESSION['message_usuario'] = 'Usuario actualizado correctamente';
            }else{
                $_SESSION['message_usuario'] = 'No se puso actualizar Usuario';
            }
		}
		catch(PDOException $e){
			$_SESSION['message_usuario'] = $e->getMessage();
		}
	}
	else{
		$_SESSION['message_usuario'] = 'Complete el formulario de edición';
	}
	
	header('Location: '.$_SERVER['HTTP_REFERER']);
?>

