<?php
    error_reporting (E_ALL ^ E_NOTICE);    
    include '../controller/conexion.php';
    //function eliminarCorreo(){
        $conexion = new Conexion();
        $con = $conexion->conectarDB();
        $id = $_GET["id"];
        $sql = "DELETE FROM TIPO_HABITACION WHERE id_tipo_habitacion =$id";
       
        if ($con->query($sql) == true) {
            
        }
        $con->close();
        $con = $conexion->conectarDB(); 
        $sql = "SELECT * FROM TIPO_HABITACION";
        $resultset = $con->query($sql);
        if($resultset->num_rows>0){
            while($fila = $resultset->fetch_assoc()){
                echo "<tr id='tabla'><td>".$fila["id_tipo_habitacion"]."</td><td>".$fila["tipo_habitacion"]."</td>
                <td><a class='btn btn-success' href='http://localhost/hotel/adminHabitaciones/actualizar_tipo.php?id=".$fila['id_tipo_habitacion']."' type='submit' id='btnActualizar' value='".$fila["id_tipo_habitacion"]."'><i class='bi bi-cloud-arrow-up-fill me-2'></i>Modificar</a></td>
                                    <td><button class='btn btn-danger' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_tipo_habitacion"]."'><i class='bi bi-trash-fill me-2'></i>Eliminar</button></td></tr>";
            }
        }
    
    //}

?>

