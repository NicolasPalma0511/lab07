<?php include 'template/header.php' ?>
<?php
include_once "model/conexion.php";
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("SELECT ven.id, ven.producto, ven.cantidad , ven.precio, ven.id_persona, ven.url, cli.nombre , cli.ap_materno , cli.ap_paterno, cli.celular
  FROM ventas ven 
  INNER JOIN clientes cli ON cli.id = ven.id_persona 
  WHERE ven.id_persona = ?
  order by id desc;");
$sentencia->execute([$codigo]);
$venta = $sentencia->fetch(PDO::FETCH_OBJ);
?>  

<div class="container mt-5">
    <div class="row justify-content-center">

        <!--inicio formulario venta de productos -->
        <div class="col-4">
            <div class="card text-white bg-dark">

                <!--Inicio imprimir en la pagina web el nombre del usuario-->   
                <div class="card-header">
                    <strong>Cambiar Imagen:</strong> <br>
                </div>
                <form class="p-4" method="POST" action="cambiarImagenProceso.php">
                        <div class="mb-3">
                            <label class="form-label">Url de imagen: </label>
                            <input type="text" class="form-control" name="url" id="url" value="" autofocus required>
                        </div>
                        <div class="d-grid">
                            <input type="hidden" name="codigo" value="<?php echo $venta->id_persona; ?>"><P></P>
                            <input type="submit" class="btn btn-primary" value="Cambiar">
                        </div>
                </form>
                <p class="p-4">Imagen actual:</p>
                <img src="<?php echo $venta->url; ?>" width="400" height="341" class="card-img-top p-5" alt="No hay imagen disponible">
            </div>
        </div>
    </div>
</div>