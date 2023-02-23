<?php
    session_start();
    if(!isset($_SESSION["Admin"])){
        header('Location: ../admin/login.php');
    }
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
        <style>
            .filtro{
                display:none;
            }
        </style>
    </head>
    <body>
        <?php        
            include '../modules/menu.php';
        ?>
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <?php
                    include '../modules/sidebar_admin.php';
                ?>
                <div class="col-xl-10 col-sm-8 col-md-9 py-3">
                    <h3>Empleados</h3>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-lg-10">
                            <form>
                                <input class="form-control" id="buscador" name="buscador" type="text" placeholder="Buscar...">
                            </form>
                        </div>
                        <div class="col-lg-2 ">
                            <a class='btn btn-success' href='http://localhost/hotel/adminHabitaciones/registrar.php' type='submit' id='btnActualizar' value='".$fila["id_habitacion"]."'><i class='bi bi-cloud-plus-fill me-2'></i>Añadir Empleado</a>
                        </div>
                    </div>
                    
                    <?php
                        include '../controller/conexion.php';
                        $conexion = new Conexion();
                        $con = $conexion->conectarDB();
                        $sql = "SELECT e.id_empleado, e.nombre_empleado, e.apellido_empleado, e.documento, e.telefono, e.correo, c.id_cargo_empleado, c.cargo_empleado
                        FROM empleado e JOIN cargo_empleado c
                        ON e.id_cargo_empleado = c.id_cargo_empleado";
                        $resultset = $con->query($sql);

                    ?>
                    <table class="table table-hover table-striped border" id="tabla" >
                        <tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Documento</th><th>Telefono</th><th>Correo</th><th>Cargo</th><th></th><th></th></tr>
                        <?php
                            if($resultset->num_rows>0){
                                while($fila = $resultset->fetch_assoc()){
                                    echo "<tr id='tabla' class='articulo'><td>".$fila["id_empleado"]."</td><td>".$fila["nombre_empleado"]."</td><td>".$fila["apellido_empleado"]."</td><td>".$fila["documento"]."</td><td>".$fila["telefono"]."</td><td>$".$fila["correo"]."</td>
                                    <td><a class='btn btn-success' href='http://localhost/hotel/adminHabitaciones/actualizar.php?id=".$fila['id_habitacion']."' type='submit' id='btnActualizar' value='".$fila["id_habitacion"]."'><i class='bi bi-cloud-arrow-up-fill'></i> Actualizar</a></td>
                                    <td><button class='btn btn-danger' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_habitacion"]."'><i class='bi bi-trash-fill'></i> Eliminar  </button></td></tr>";
                                }
                            }
                            ?>
                    </table>
                    
                </div>
            </div>
        </div>
        <script>
             function confirmar(id){
                var mensaje;
                if(confirm("¿Desea eliminar la habitación")){
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function(){
                    document.getElementById("tabla").innerHTML = this.responseText;
                    alert("Habitación eliminada exitosamente");
                };
                xhttp.open("GET","eliminar_habitacion.php?id="+id);
                xhttp.send();
                }
            }   

        </script>
        <script src="script.js"></script>
    </body>
</html>