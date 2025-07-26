<?php
	session_start();
	include_once ('../conexion_de_bbdd/config_bd.php');
	if(isset($_POST['actualizar_dispositivo'])){
		try{
			$id_dispositivo = $_POST['id_dispositivo'];
			$nombre = $_POST['nombre'];
			$descripcion = $_POST['descripcion'];
			$marca = $_POST['marca'];
			$version = $_POST['version'];

			$nombre_imagen = $_FILES['foto_dispositivo']['name'];
			$tipo_imagen = $_FILES['foto_dispositivo']['type'];
			$tam_imagen = $_FILES['foto_dispositivo']['size'];
			
			$path =  $_SERVER['DOCUMENT_ROOT'] . '/milanes_moreno_david/subida_de_archivos/'; //ruta del archivo en el servidor, nunca se inserta en la base de datos.
			move_uploaded_file($_FILES['foto_dispositivo']['tmp_name'],$path.$nombre_imagen); //insertar el nombre de la imagen en la base de datos y no la ruta.

			$query_actualizar = $bd->prepare ("UPDATE dispositivo SET nombre = ?,descripcion = ?,version =?,marca = ?,foto_dispositivo = ? WHERE id_dispositivo = ?;");
			$resultado = $query_actualizar->execute([$nombre,$descripcion,$version,$marca,$nombre_imagen,$id_dispositivo]);

			//var_dump($path);
			//$query_actualizar->debugDumpParams();
        	//var_dump($resultado);

            if($query_actualizar){
                $_SESSION['message_agenda'] = 'Agenda actualizada correctamente';
            }else{
                $_SESSION['message_agenda'] = 'No se pudo actualizar la Agenda';
            }
		}
		catch(PDOException $e){
			$_SESSION['message_agenda'] = $e->getMessage();
		}
	}
	else{
		$_SESSION['message_agenda'] = 'Complete el formulario de edición';
	}

	header('Location: '.$_SERVER['HTTP_REFERER']);
?>

