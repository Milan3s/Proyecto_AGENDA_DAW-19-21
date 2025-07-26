<?php

require_once('../../back_end/conexion_de_bbdd/config_bd.php');
// var_dump($_POST);
if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2]) && isset($_POST['Event'][3])){
	$id = $_POST['Event'][0];
	$start = $_POST['Event'][1];
	$end = $_POST['Event'][2];
	$id_usuarios = $_POST['Event'][3];

	$sql = "UPDATE eventos SET id_usuarios = '$id_usuarios',  start = '$start', end = '$end' WHERE id = $id ";

	
	$query = $bd->prepare( $sql );
	if ($query == false) {
	 print_r($bd->errorInfo());
	 die ('Error al modificar la fecha');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Error al modificar la fecha');
	}else{
		die ('OK');
	}

}
header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>
