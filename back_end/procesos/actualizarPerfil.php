<?php 
	session_start();
    require_once ('../conexion_de_bbdd/config_bd.php');
	if(isset($_POST['actualiza_te'])){
		// print_r($_POST);
		try{
			$id_usuarios = $_POST['id_usuarios'];
			$nombre = $_POST['nombre'];
			$apellidos = $_POST['apellidos'];
			$email = $_POST['email'];
			$descripcion = $_POST['descripcion'];
			$fijo = $_POST['fijo'];
			$movil = $_POST['movil'];
			
			
			$foto_usuarios = $_FILES['foto_usuarios']['name'];
			$tipo_imagen = $_FILES['foto_usuarios']['type'];
			$tam_imagen = $_FILES['foto_usuarios']['size'];
			
			$path = $_SERVER['DOCUMENT_ROOT'] . '/milanes_moreno_david/subida_de_archivos/'; 
			move_uploaded_file($_FILES['foto_usuarios']['tmp_name'],$path.$foto_usuarios);

			$direccion = $_POST['direccion'];
			
			$query_actualizar = $bd->prepare("UPDATE usuarios SET nombre = ?, apellidos = ?, email = ?, descripcion = ?, fijo = ?,
			movil = ?, foto_usuarios = ?, direccion = ? WHERE id_usuarios = ?");
			$resultado_perfil = $query_actualizar->execute([$nombre,$apellidos,$email,$descripcion,$fijo,$movil,$foto_usuarios,$direccion,$id_usuarios]);

			if($resultado_perfil == true){
				$_SESSION['message_perfil'] = 'Perfil Actualizado';
			}else{
			   $_SESSION['message_perfil'] = 'No se ha actualizado';
			}
		}
		catch(PDOException $e){
			echo "algo ha salido mal ". $e->getMessage();
		}
	}

	header('Location: '.$_SERVER['HTTP_REFERER']);
?>

