
<?php

require_once('../../back_end/conexion_de_bbdd/config_bd.php');

// var_dump($_POST);


if (isset($_POST['borrar_eventos']) && isset($_POST['id'])){
	
	
	$id = $_POST['id'];
	
	$sql = "DELETE FROM eventos WHERE id = $id";
	$query = $bd->prepare( $sql );
	if ($query == false) {
	 print_r($bd->errorInfo());
	 die ('Error al borrar el evento.');
	}
	$res = $query->execute();
	if ($res == false) {
	 print_r($query->errorInfo());
	 die ('Error al borrar el evento.');
	}
	
}elseif (isset($_POST['cambiar_usuarios']) && isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) 
		&& isset($_POST['color']) && isset($_POST['description'])  && isset($_POST['id'])){
	
	$id = $_POST['id'];
	$cambiar_usuarios = $_POST['cambiar_usuarios'];
	$title = $_POST['title'];
	$color = $_POST['color'];
	$description = $_POST['description'];
	$start = $_POST['start'];
	$end = $_POST['end'];

	$sql = "UPDATE eventos SET id_usuarios = '$cambiar_usuarios',title = '$title',start = '$start',end = '$end', color = '$color' , 
	description = '$description'  WHERE id = $id ";

	
	$query = $bd->prepare( $sql );
	if ($query == false) {
	 print_r($bd->errorInfo());
	 die ('Error al actualizar los datos del evento.');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	var_dump($query);
	 die ('Error al actualizar los datos del evento.');
	}

}
header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>
