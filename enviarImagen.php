<?php
if (!isset($_GET['codigo'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("SELECT ven.producto, ven.cantidad , ven.precio, ven.id_persona, ven.url, cli.nombre , cli.ap_materno , cli.ap_paterno, cli.celular
  FROM ventas ven 
  INNER JOIN clientes cli ON cli.id = ven.id_persona 
  WHERE ven.id = ?;");
$sentencia->execute([$codigo]);
$venta = $sentencia->fetch(PDO::FETCH_OBJ);

$url = 'https://api.green-api.com/waInstance1101817977/SendFileByUrl/f165fb7eb670424695651f0f6c451c8e2a95d0003a274e768f';
//API Piero: 'https://api.green-api.com/waInstance1101816199/SendFileByUrl/05614ce3d3f140bab0662d57352c466455d394009cc242c2b2';
//API Nicolas2: 'https://api.green-api.com/waInstance1101817977/SendFileByUrl/f165fb7eb670424695651f0f6c451c8e2a95d0003a274e768f';

$image = [
    "chatId" => "51".$venta->celular."@c.us",
    "urlFile" => $venta->url,
    "fileName" => "verificado.png",
    // Opcion para ingresar un mensaje junto con la imagen
    "caption" => "*Exito en la compra*"
];

// Imagenes de prueba
// https://upload.wikimedia.org/wikipedia/commons/thumb/5/5a/Red_check.svg/1200px-Red_check.svg.png
// https://upload.wikimedia.org/wikipedia/commons/thumb/e/e9/Check_mark.svg/800px-Check_mark.svg.png
// https://upload.wikimedia.org/wikipedia/commons/thumb/5/50/Yes_Check_Circle.svg/1024px-Yes_Check_Circle.svg.png

$options = array(
    'http' => array(
        'method'  => 'POST',
        'content' => json_encode($image),
        'header' =>  "Content-Type: application/json\r\n" .
            "Accept: application/json\r\n"
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$response = json_decode($result);

if (!empty($sentencia)) {
    header('Location: index.php?mensaje=registrado');
} else {
    header('Location: index.php?mensaje=error');
    exit();
}
?>
