<?php
    session_start();
    if(!isset($_SESSION["Usuario"])){
        header('Location: login.php');
    }
    $usuario = $_SESSION["Usuario"];
    
    include '../controller/conexion2.php';  
    $conectar = new Conectar();
    $conex = $conectar->conectarDb();
    $consult = "SELECT * FROM usuarios WHERE id_usuario='".$usuario."'";
    $result = $conex->query($consult);
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pagina Hotel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/custom.css">
        <link rel="stylesheet" href="../libs/bootstrap-icons/bootstrap-icons.css">
        <script src="../js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php
            include '../modules/menu.php';
        ?>
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <?php
                    include '../modules/sidebar_user.php';
                ?>
                <div class="col-lg-10 col-sm-8 col-md-9 py-3">
                    <div class="container">
                        <div class="my-3    ">
                            <h4>Mis Reservaciones</h4>
                            <hr>
                        </div> 
                        <?php                            
                            $con = $conectar->conectarDb();
                            $sql = "SELECT * FROM RESERVACION WHERE id_usuario='".$usuario."'";
                            $resultset = $con->query($sql);

                        ?>
                        <table class="table table-hover table-striped text-center border" id="tabla" >
                            <tr><th>#</th><th>Habitacion</th><th>Servicio</th><th>Fecha ingreso</th><th>fecha salida</th><th>Estado</th><th>Personas</th><th>Pago Total</th><th></th></tr>
                            <?php
                                if($resultset->num_rows>0){
                                    while($fila = $resultset->fetch_assoc()){
                                        echo "<tr id='tabla'><td>".$fila["id_reservacion"]."</td><td>".$fila["id_habitacion"]."</td><td>".$fila["id_servicio"]."</td><td>".$fila["fecha_ingreso"]."</td><td>".$fila["fecha_salida"]."</td><td>".$fila["estado_reservacion"]."</td><td>".$fila['cantidad_personas']."</td><td>".$fila['total_pago']."</td>
                                        <td><button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#modal' value='".$fila['id_reservacion']."'>Cancelar Reservacion</button></td>
                                        </tr>";
                                    }
                                }
                                ?>
                        </table>
                        <form action="cancelar_reserva.php" method="POST">
                            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cancelar Reservación</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">                                        
                                            <div class="mb-3">
                                                <?php
                                                    $con3 = $conectar->conectarDb();
                                                    $sql3 = "SELECT * FROM RESERVACION WHERE id_usuario='".$usuario."'";
                                                    $resultset3 = $con3->query($sql);
                                                    if($fila3 = $resultset3->fetch_assoc()){
                                                ?>
                                                <input type="hidden" name="id" id="id" value="<?php echo $fila3['id_reservacion'];?>">
                                                <label for="motivo" class="col-form-label">Motivo de cancelamiento:</label>
                                                <select type="text" class="form-select" id="motivo" name="motivo">
                                                    <option option selected hidden>--Elija el motivo de la cancelación--</option>
                                                    <option value="">Error ingreso de fechas</option>
                                                    <option value="">Viaje cancelado</option>                                        
                                                    <option value="">Otro</option>
                                                </select>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="descripcion" class="col-form-label">Descripcion:</label>
                                                <label for=""><i class="bi bi-exclamation-circle-fill float-end"></i>Opcional</label>
                                                <textarea class="form-control" id="descripcion"></textarea>
                                            </div>                                        
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                                            <button type="submit" class="btn btn-primary" value="<?php $fila3['id_reservacion']?>">Cancelar</button>
                                        </div>
                                        <?php
                                            }   
                                            ?>
                                    </div>
                                </div>
                            </div>   
                        </form>                                                 
                    </div>
                </div>            
            </div>
        </div>
    </body>
</html>