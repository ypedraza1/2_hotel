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
                    <h3>Habitaciones</h3>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-lg-10">
                            <form>
                                <input class="form-control" id="buscador" name="buscador" type="text" placeholder="Buscar...">
                            </form>
                        </div>
                        <div class="col-lg-2 ">
                            <a class='btn btn-success' href='http://localhost/hotel/adminHabitaciones/registrar.php' type='submit' id='btnActualizar' value='".$fila["id_habitacion"]."'><i class='bi bi-cloud-plus-fill me-2'></i>Añadir Habitación</a>
                        </div>
                    </div>
                    
                    <?php
                        include '../controller/conexion.php';
                        $conexion = new Conexion();
                        $con = $conexion->conectarDB();
                        $sql = "SELECT h.id_habitacion, h.nombre_habitacion, h.descripcion_habitacion, h.cantidad_personas, h.estado_habitacion, h.precio_habitacion , h.imagen_habitacion, t.tipo_habitacion
                        FROM habitacion h JOIN tipo_habitacion t
                        ON h.id_tipo_habitacion = t.id_tipo_habitacion";
                        $resultset = $con->query($sql);

                    ?>
                    <table class="table table-hover table-striped border" id="tabla" >
                        <tr><th>#</th><th>Tipo</th><th>Nombre</th><th>Descripcion</th><th>Personas</th><th>Estado</th><th>Precio</th><th>Imagen</th><th></th><th></th></tr>
                        <?php
                            if($resultset->num_rows>0){
                                while($fila = $resultset->fetch_assoc()){
                                    echo "<tr id='tabla' class='articulo'><td>".$fila["id_habitacion"]."</td><td>".$fila["tipo_habitacion"]."</td><td>".$fila["nombre_habitacion"]."</td><td>".$fila["descripcion_habitacion"]."</td><td>".$fila["cantidad_personas"]."</td><td>".$fila["estado_habitacion"]."</td><td>$".$fila["precio_habitacion"]."</td><td> <img src='".$fila["imagen_habitacion"]."' class='img-fluid'> </td>
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