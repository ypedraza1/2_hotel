<?php
    
    include '../controller/conexion.php';
    //function eliminarCorreo(){
        $conexion = new Conexion();
        $con = $conexion->conectarDB();
        $id = $_GET["id"];
        $sql = "DELETE FROM HABITACION WHERE id_habitacion ='$id'";
       
        if ($con->query($sql) == true) {
            
        }
        $con->close();
        $con = $conexion->conectarDB(); 
        $sql = "SELECT * FROM HABITACION";
        $resultset = $con->query($sql);
        if($resultset->num_rows>0){
            while($fila = $resultset->fetch_assoc()){
                echo "<tr id='tabla'><td>".$fila["id_habitacion"]."</td><td>".$fila["id_tipo_habitacion"]."</td><td>".$fila["nombre_habitacion"]."</td><td>".$fila["descripcio_habitacion"]."</td><td>".$fila["cantidad_personas"]."</td><td>".$fila["estado_habitacion"]."</td><td>".$fila["precio_habitacion"]."</td><td> <img src='".$fila["imagen_habitacion"]."' class='img-fluid'> </td>
                <td><a class='btn btn-success' href='http://localhost/hotel/adminHabitaciones/actualizar.php?id=".$fila['id_habitacion']."' type='submit' id='btnActualizar' value='".$fila["id_habitacion"]."'><i class='bi bi-cloud-arrow-up-fill'></i> Actualizar</a></td>
                <td><button class='btn btn-danger' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_habitacion"]."'><i class='bi bi-trash-fill'></i> Eliminar  </button></td></tr>";
            }
        }
    
    //}

?>

