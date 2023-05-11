<?php
if (empty($_POST["textNombre"]) || empty($_POST["doubleCantidad"]) || empty($_POST["doublePrecio"])) {
    header('Location: index.php');
    exit();
}

include_once 'model/conexion.php';
$NProducto = $_POST["textNombre"];
$Cantidad = $_POST["doubleCantidad"];
$Precio = $_POST["doublePrecio"];
$codigo = $_POST["codigo"];


$sentencia = $bd->prepare("INSERT INTO ventas(producto,cantidad,precio,id_persona,fecha_venta) VALUES (?,?,?,?,current_timestamp());");
$resultado = $sentencia->execute([$NProducto,$Cantidad, $Precio, $codigo ]);

if ($resultado === TRUE) {
    header('Location: agregarVenta.php?codigo='.$codigo);
} 
