<?php include 'template/header.php' ?>

<?php
include_once "model/conexion.php";
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("select * from clientes where id = ?;");
$sentencia->execute([$codigo]);
$cliente = $sentencia->fetch(PDO::FETCH_OBJ);

$sentencia_venta = $bd->prepare("select * from ventas where id_persona = ?;");
$sentencia_venta->execute([$codigo]);
$venta = $sentencia_venta->fetchAll(PDO::FETCH_OBJ); 
?>  

<div class="container mt-5">
    <div class="row justify-content-center">

        <!--inicio formulario venta de productos -->
        <div class="col-4">
            <div class="card text-white bg-dark">

                <!--Inicio imprimir en la pagina web el nombre del usuario-->   
                <div class="card-header">
                    <strong>Ingresar datos para la venta a:</strong> <br><?php echo $cliente->nombre.' '.$cliente->ap_paterno.' '.$cliente->ap_materno; ?>
                </div>
                <!--Fin imprimir en la pagina web el nombre del usuario-->

                <!--Inicio Formulario del ingreso de la venta-->
                <form class="p-4" method="POST" action="registrarVenta.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre del producto: </label>
                        <input type="text" class="form-control" name="textNombre" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cantidad del producto: </label>
                        <input type="double" class="form-control" name="doubleCantidad" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio del producto: </label>
                        <input type="double" class="form-control" name="doublePrecio" autofocus required>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $cliente->id; ?>"><P></P>              
                        <input type="submit" class="btn btn-primary" value="Registrar">
                    </div>
                </form>
                <?php if ($venta == null): ?>
                    <form class="p-4" method="POST" action="cambiarImagen.php">
                        <div class="d-grid">
                            <input type="hidden" name="codigo" value="<?php echo $cliente->id; ?>"><P></P>
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='cambiarImagen.php?codigo=<?php echo $cliente->id; ?>" disabled>Cambiar Imagen</button>
                        </div>
                    </form>
                <?php else: ?>
                    <form class="p-4" method="POST" action="cambiarImagen.php">
                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $cliente->id; ?>"><P></P> 
                        <a href="cambiarImagen.php?codigo=<?php echo $cliente->id; ?>" class="btn btn-primary">Cambiar Imagen</a>
                    </div>
                    </form>
                <?php endif ?>
                <!--//Fin Formulario del ingreso de la venta-->
            </div>
        </div>

        <!--Inicio tabla que muestra las ventas por cada usuario-->
        <div class="col-8 mb-3">
            <div class="card text-white bg-dark">
                <div class="card-header">
                    <strong>Ventas realizadas a los usuarios:</strong>
                </div>
                <div class="col-12 p-4">
                    <table class="table align-middle table-dark">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre del producto</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio </th>
                                <th scope="col">Fecha de venta</th>
                                <th scope="col" colspan="3">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($venta as $dato) {
                            ?>
                                <tr>
                                    <td scope="row"><?php echo $dato->id; ?></td>
                                    <td><?php echo $dato->producto; ?></td>
                                    <td><?php echo $dato->cantidad; ?></td>
                                    <td><?php echo $dato->precio;?></td>
                                    <td><?php echo $dato->fecha_venta;?></td>
                                    <td><a class="text-primary" href="enviarMensaje.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-whatsapp" style="color: green;"></i></a></td>
                                    <td><a class="text-primary" href="enviarImagen.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-card-image" style="color: blue;"></i></a></td>
                                    <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="eliminarVenta.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-trash"></i></a></td>

                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--Fin tabla que muestra las ventas por cada usuario-->

    </div>
</div>