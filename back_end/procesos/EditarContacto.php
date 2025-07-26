<?php
	session_start();
	include_once ('../conexion_de_bbdd/config_bd.php');
	if(isset($_POST['actualizar_contacto'])){
		try{
			$id_contactos = $_POST['id_contactos'];
			$selectDispositivo = $_POST['selectDispositivo'];
			$nombre = $_POST['nombre'];
			$apellidos = $_POST['apellidos'];
			$selectCumple = $_POST['selectCumple'];
			$telefono = $_POST['telefono'];
			$ciudad = $_POST['ciudad'];
			$pais = $_POST['pais'];
		
			$nombre_foto_idioma = $_FILES['idioma']['name'];
			$tipo_imagen = $_FILES['idioma']['type'];
			$tam_imagen = $_FILES['idioma']['size'];
			
			$path = $_SERVER['DOCUMENT_ROOT'] . '/milanes_moreno_david/subida_de_archivos/'; 
			move_uploaded_file($_FILES['idioma']['tmp_name'],$path.$nombre_foto_idioma);

			$email = $_POST['email'];

			$nombre_foto_contacto = $_FILES['foto_contacto']['name'];
			$tipo_imagen = $_FILES['foto_contacto']['type'];
			$tam_imagen = $_FILES['foto_contacto']['size'];
			
			$path = $_SERVER['DOCUMENT_ROOT'] . '/milanes_moreno_david/subida_de_archivos/'; //ruta del archivo en el servidor, nunca se inserta en la base de datos.
			move_uploaded_file($_FILES['foto_contacto']['tmp_name'],$path.$nombre_foto_contacto); //insertar el nombre de la imagen en la base de datos y no la ruta.

			$query_actualizar = $bd->prepare ("UPDATE contactos SET id_dispositivo = ?, nombre = ?,apellidos = ?,cumple = ?,telefono = ?,ciudad = ?,pais = ?, idioma = ?,email = ?, foto = ? WHERE id_contactos = ?;");
			$resultado = $query_actualizar->execute([$selectDispositivo,$nombre,$apellidos,$selectCumple,$telefono,$ciudad,$pais,$nombre_foto_idioma,$email,$nombre_foto_contacto,$id_contactos]);

			var_dump($path);
			print_r($_POST);
			//$query_actualizar->debugDumpParams();
        	var_dump($resultado);

            if($query_actualizar){
                $_SESSION['message'] = 'Contacto actualizado correctamente';
            }else{
                $_SESSION['message'] = 'No se pudo actualizar el contacto';
            }
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}
	}
	else{
		$_SESSION['message'] = 'Complete el formulario de edición';
	}

	header('Location: '.$_SERVER['HTTP_REFERER']);
?>
