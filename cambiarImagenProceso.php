<?php
    print_r($_POST);
    if(!isset($_POST['codigo'])){
        header('Location: index.php?mensaje=error');
    }

    include 'model/conexion.php';
    $codigo = $_POST['codigo'];
    $url = $_POST['url'];
    $sentencia = $bd->prepare("ALTER TABLE ventas ALTER COLUMN url SET DEFAULT ?;");
    $resultado = $sentencia->execute([$url]);

    if ($resultado === TRUE) {
        header('Location: agregarVenta.php?codigo='.$codigo);
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }
