<?php
	session_start();
	include_once ('../conexion_de_bbdd/config_bd.php');
	//print_r($_POST);
	if(isset($_POST['id'])){
		try{
			$id_dispositivo = $_POST['id'];
			$query_borrar = $bd->prepare("DELETE FROM dispositivo WHERE id_dispositivo = ?;");
			$resultado = $query_borrar->execute([$id_dispositivo]);
			
            if($query_borrar == true){
                $_SESSION['message_agenda'] = 'Agenda y contactos borrados';
            }else{
                $_SESSION['message_agenda'] = 'No se pudieron borrar Agenda y contactos';
            }
		}
		catch(PDOException $e){
			$_SESSION['message_agenda'] = $e->getMessage();
		}
	}
	else{
		$_SESSION['message_agenda'] = 'No se ha podido actuar en la base de datos.';
	}

	header('Location: '.$_SERVER['HTTP_REFERER']);
?>