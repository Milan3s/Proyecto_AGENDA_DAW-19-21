<?php

require_once('../../back_end/conexion_de_bbdd/config_bd.php');

//echo $_POST['title'];
if (isset($_POST['id_usuarios']) && isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color']) && isset($_POST['description'])){
	$id_usuarios = $_POST['id_usuarios'];
	$title = $_POST['title'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];
	$description = $_POST['description'];
	

	$sql = "INSERT INTO eventos(id_usuarios,title, start, end, color,description) values ('$id_usuarios','$title', '$start', '$end', '$color','$description')";
	//$req = $bdd->prepare($sql);
	//$req->execute();
	
	// echo $sql;
	
	$query = $bd->prepare( $sql );
	if ($query == false) {
	  print_r($bd->errorInfo());
	  die ('Error al insertar');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Error al insertar');
	}

}
header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>

