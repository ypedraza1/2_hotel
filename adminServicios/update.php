<?php
    error_reporting (E_ALL ^ E_NOTICE);
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $id=$_POST["id_servicio"];
    $nombre=$_POST['nombre'];
    $tipo=$_POST['categoria'];
    $descripcion=$_POST['descripcion'];
    $imagen=$_POST["imagen"];
    $imagen=$_POST["tarifa"];
    $estado=0;

    $fileName = basename($_FILES["imagen"]["name"]); 
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
 
    $allowTypes = array('jpg','png','jpeg','gif'); 
    if(in_array($fileType, $allowTypes)){ 
        if($_FILES["imagen"]["name"]>100000000){
            $estado=1;
            echo "<br>El peso del archivo excede el tamaño permitido";
        } else {
            $directorio = "../imgServicios/";
            $archivo = $directorio . basename($_FILES["imagen"]["name"]);
        }      
    } else{
        $estado=1;
        $error = "Tipo de archivo no es el adecuado";
        header ("Location: actualizar.php?id=" . $id . ""."&error=" . $error . ""); 
    }
    
    $sql = "UPDATE SERVICIO SET nombre_servicio='$nombre', id_categoria_servicio='$tipo', descripcion_servicio='$descripcion',
    imagen_servicio='$archivo'  WHERE id_servicio=$id";
    
    if($estado == 0 && $con->query($sql) === TRUE) {
        header ("Location: actualizar.php?id=" . $id . "&mensaje=correcto"); 
    }else{
        header ("Location: actualizar.php?id=" . $id . "&mensaje=error"); 
    }

?>