<?php include 'template/header.php' ?>

<?php
    include_once "model/conexion.php";
    $sentencia = $bd -> query("select * from clientes");
    $clientes = $sentencia->fetchAll(PDO::FETCH_OBJ);
    //print_r($persona);
?>

<div class="container mt-2">
    <div class="row justify-content-md-center">
        <div class="col-sm-12">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header">
                        <strong>Ingresar datos del cliente:</strong>
                    </div>
                    <form class="p-4" method="POST" action="registrar.php">
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Nombre: </label>
                                <input type="text" class="form-control" name="nombre" autofocus required>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Apellido Paterno: </label>
                                <input type="text" class="form-control" name="ap_paterno" autofocus required>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Apellido Materno: </label>
                                <input type="double" class="form-control" name="ap_materno" autofocus required>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label">Celular: </label>
                                    <input type="double" class="form-control" name="celular" autofocus required>
                                </div>
                                <div class="col mb-3">
                                    <label class="form-label">Fecha de nacimiento: </label>
                                    <input type="date" class="form-control" name="FNacimiento" autofocus required>
                                </div>
                                <div class="d-grid">
                                    <input type="hidden" name="oculto" value="1">
                                    <input type="submit" class="btn btn-primary" value="Registrar cliente :D">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        <div class="col-sm-10">
            <!-- inicio alerta -->
            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
                <strong>Error!</strong> Rellena todos los campos.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show m-4" role="alert">
                <strong>Registrado!</strong> Se agregaron los datos.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   
            
            

            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
                <strong>Error!</strong> Vuelve a intentar.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   



            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show m-4" role="alert">
                <strong>Cambiado!</strong> Los datos fueron actualizados.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show m-4" role="alert">
                <strong>Eliminado!</strong> Los datos fueron borrados.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 

            <!-- fin alerta -->
        <div class="card text-white bg-dark mb-3">
            <div class="card-header">
                <strong>Lista de cliente</strong>
            </div>
                <div class="p-4">
                    <table class="table align-middle text-white">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido Paterno</th>
                                <th scope="col">Apellido Materno</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Fecha de nacimiento</th>
                                <th scope="col" colspan="2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php 
                                foreach($clientes as $dato){ 
                            ?>

                                    
                            <tr>
                                <td scope="row"><?php echo $dato->id; ?></td>
                                <td><?php echo $dato->nombre; ?></td>
                                <td><?php echo $dato->ap_paterno; ?></td>
                                <td><?php echo $dato->ap_materno; ?></td>
                                <td><?php echo $dato->celular; ?></td>
                                <td><?php echo $dato->FNacimiento; ?></td>
                                <td><a class="text-success" href="editar.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-pencil-square"></i></a></td>
                                <td><a class="text-success" href="agregarVenta.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-basket2"></i></a></td>
                                <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="eliminar.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-trash"></i></a></td>
                            </tr>

                            <?php 
                                }
                            ?>

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>     
    </div> 
</div>
