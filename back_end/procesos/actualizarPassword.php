<?php 
	session_start();
    require_once ('../conexion_de_bbdd/config_bd.php');
	if(isset($_POST['actualizar_pass'])){
		// print_r($_POST);
		try{
			$id_usuarios = $_POST['id_usuarios'];
			$password = $_POST['password'];

			$query_actualizar = $bd->prepare("UPDATE usuarios SET password = ? WHERE id_usuarios = ?");
			$resultado_perfil = $query_actualizar->execute([$password,$id_usuarios]);

			if($resultado_perfil == true){
				$_SESSION['message_password'] = 'Contraseña Actualizada';
			}else{
			   $_SESSION['message_password'] = 'No se ha actualizado la contraseña';
			}
		}
		catch(PDOException $e){
			echo "Algo ha salido mal ". $e->getMessage();
            echo "El error ha sido en : " . $e->getLine();
		}
	}

	header('Location: '.$_SERVER['HTTP_REFERER']);
?>
