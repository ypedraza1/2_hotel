<?php
    
    include '../controller/conexion.php';
    //function eliminarCorreo(){
        $conexion = new Conexion();
        $con = $conexion->conectarDB();
        $id = $_GET["id"];
        $sql = "DELETE FROM CATEGORIA_SERVICIO WHERE id_categoria_servicio ='$id'";
       
        if ($con->query($sql) == true) {
            
        }
        $con->close();
        $con = $conexion->conectarDB(); 
        $sql = "SELECT * FROM CATEGORIA_SERVICIO";
        $resultset = $con->query($sql);
        if($resultset->num_rows>0){
            while($fila = $resultset->fetch_assoc()){
                echo "<tr id='tabla'><td>".$fila["id_categoria_servicio"]."</td><td>".$fila["categoria_servicio"]."</td>
                <td><a class='btn btn-info' href='http://localhost/hotel/adminHabitaciones/actualizar.php' type='submit' id='btnActualizar' value='".$fila["id_categoria_servicio"]."'><i class='bi bi-person-x-fill me-2'></i>Modificar</a></td>
                <td><button class='btn btn-danger' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_categoria_servicio"]."'><i class='bi bi-person-x-fill me-2'></i>Eliminar</button></td></tr>";
            }
        }
    
    //}

?>

