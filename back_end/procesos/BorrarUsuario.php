<?php
	session_start();
	include_once ('../conexion_de_bbdd/config_bd.php');
	//print_r($_POST);
	if(isset($_POST['borrar_usuarios'])){
		try{
			$id_usuarios = $_POST['id'];
			$query_borrar_usuarios = $bd->prepare("DELETE FROM usuarios WHERE id_usuarios = ?;");
			$resultado = $query_borrar_usuarios->execute([$id_usuarios]);
			
            if($query_borrar_usuarios == true){
                $_SESSION['message_usuario'] = 'Usuario borrado';
            }else{
                $_SESSION['message_usuario'] = 'No se pudo borrar el Usuario';
            }
		}
		catch(PDOException $e){
			$_SESSION['message_usuario'] = $e->getMessage();
		}
	}
	else{
		$_SESSION['message_usuario'] = 'No se ha podido actuar en la base de datos.';
	}

	header('Location: '.$_SERVER['HTTP_REFERER']);

?>
