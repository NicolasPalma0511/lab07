<?php
if (!isset($_GET['codigo'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("SELECT ven.producto, ven.cantidad , ven.precio, ven.id_persona, cli.nombre , cli.ap_materno , cli.ap_paterno, cli.celular
  FROM ventas ven 
  INNER JOIN clientes cli ON cli.id = ven.id_persona 
  WHERE ven.id = ?;");
$sentencia->execute([$codigo]);
$venta = $sentencia->fetch(PDO::FETCH_OBJ);

$url = 'https://api.green-api.com/waInstance1101817977/SendMessage/f165fb7eb670424695651f0f6c451c8e2a95d0003a274e768f';
//API Piero: 'https://api.green-api.com/waInstance1101816199/SendMessage/05614ce3d3f140bab0662d57352c466455d394009cc242c2b2';
//API Nicolas2: 'https://api.green-api.com/waInstance1101818629/SendMessage/5d45a4e29f5147bbbe5c85889e4badd3f0109099faac4113ae';
$data = [
    "chatId" => "51".$venta->celular."@c.us",   
    "message" => 'Su compra fue de *'.strtoupper($venta->cantidad).' '.strtoupper($venta->producto).'*(s) a *S/.'.strtoupper($venta->precio).'* c/u y el total a pagar es de *S/.'. strtoupper(($venta->cantidad)*($venta->precio)).'* nuevos soles'
];

$options = array(
    'http' => array(
        'method'  => 'POST',
        'content' => json_encode($data),
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