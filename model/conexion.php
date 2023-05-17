<?php 
$contrasena = "AVNS_buYfvSI_3kSnky7-6RL";
$usuario = "doadmin";
$nombre_bd = "lab07";

try {
	$bd = new PDO (
		'mysql:host=db-mysql-nyc1-41357-do-user-14090352-0.b.db.ondigitalocean.com;
		dbname='.$nombre_bd,
		$usuario,
		$contrasena,
		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
	);
} catch (Exception $e) {
	echo "Problema con la conexion: ".$e->getMessage();
}
?>
