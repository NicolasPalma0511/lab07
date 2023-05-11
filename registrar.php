<?php
if (empty($_POST["oculto"]) || empty($_POST["nombre"]) || empty($_POST["ap_paterno"]) || empty($_POST["ap_materno"]) || empty($_POST["celular"]) || empty($_POST["FNacimiento"])) {
    header('Location: index.php?mensaje=falta');
    exit();
}

include_once 'model/conexion.php';
$nombre = $_POST["nombre"];
$ap_paterno = $_POST["ap_paterno"];
$ap_materno = $_POST["ap_materno"];
$celular = $_POST["celular"];
$FNacimiento = $_POST["FNacimiento"];

$sentencia = $bd->prepare("INSERT INTO clientes(nombre,ap_paterno,ap_materno,celular,FNacimiento) VALUES (?,?,?,?,?);");
$resultado = $sentencia->execute([$nombre, $ap_paterno, $ap_materno, $celular, $FNacimiento]);

if ($resultado === TRUE) {
    header('Location: index.php?mensaje=registrado');
} else {
    header('Location: index.php?mensaje=error');
    exit();
}
