<?php
    print_r($_POST);
    if(!isset($_POST['codigo'])){
        header('Location: index.php?mensaje=error');
    }

    include 'model/conexion.php';
    $codigo = $_POST["codigo"];
    $nombre = $_POST["nombre"];
    $ap_paterno = $_POST["ap_paterno"];
    $ap_materno = $_POST["ap_materno"];
    $celular = $_POST["celular"];
    $FNacimiento = $_POST["FNacimiento"];

    $sentencia = $bd->prepare("UPDATE clientes SET nombre = ?, ap_paterno = ?, ap_materno = ?, celular = ?, FNacimiento = ? where id = ?;");
    $resultado = $sentencia->execute([$nombre, $ap_paterno, $ap_materno, $celular, $FNacimiento, $codigo]);

    if ($resultado === TRUE) {
        header('Location: index.php?mensaje=editado');
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }
