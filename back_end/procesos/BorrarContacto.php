<?php
	session_start();
	include_once ('../conexion_de_bbdd/config_bd.php');
	//print_r($_POST);
	if(isset($_POST['id'])){
		try{
			$id_contacto = $_POST['id'];
			$query_borrar = $bd->prepare("DELETE FROM contactos WHERE id_contactos = ?;");
			$resultado = $query_borrar->execute([$id_contacto]);
			
            if($query_borrar == true){
                $_SESSION['message_contacto'] = 'Contacto eliminado';
            }else{
                $_SESSION['message_contacto'] = 'No se pudo eliminar el contacto';
            }
		}
		catch(PDOException $e){
			$_SESSION['message_contacto'] = $e->getMessage();
		}
	}
	else{
		$_SESSION['message_contacto'] = 'No se ha podido actuar en la base de datos.';
	}

	header('Location: '.$_SERVER['HTTP_REFERER']);
?>
