<?php
    error_reporting(0);

    $id = "";
    $nombre = "";
    $nota = "";


//INSERT
if (isset($_REQUEST["Compartir"])) {


    $nombre = $_POST['nombre'];
    $id_usuario = $_COOKIE["id_usuario"];
    $nota = $_POST['nota'];
    $fecha_creacion = date("Y-m-d H:i:s"); 

    $url_nombre = $_FILES['archivo']['name'];
    $url_archivo = $_FILES['archivo']['tmp_name'];
    $departamento = str_replace(" ", "_", strtolower($_COOKIE["departamento"])); 

    $extension = substr($url_nombre, -4, 1) == "." ? substr($url_nombre, -3) : substr($url_nombre, -4);
    
    $ruta = "files/".$departamento."/".$nombre.".".$extension;
    rename($url_nombre, $ruta);
    
    move_uploaded_file($url_archivo,$ruta);

    $insert = "INSERT INTO ficheros (nombre, direccion, fecha_creacion, id_usuario,nota) 
                VALUES (?,?,?,?,?)";

    $prepare = $conexion->prepare($insert);
    $prepare->bind_param("sssss",$nombre,$ruta,$fecha_creacion,$id_usuario,$nota);


    if ($prepare->execute()) {
        echo "<script> alert('Los datos han sido ingresados correctamente');</script>";
    }else{
        echo "<scripts> alert('Error al ingresar los datos');</script>";
    }    

}



//DELETE
if (isset($_REQUEST["Eliminar"])){
    
    $id_fichero = $_REQUEST["id_fichero"];

    $delete = "DELETE FROM ficheros WHERE id_fichero = ?";
    $prepare = $conexion->prepare($delete);
    $prepare->bind_param("s",$id_fichero);

    
    if ($prepare->execute()) {
        echo "<script> alert('Archivo eliminado correctamente');</script>";
    }else{
        echo "<script> alert('Ocurrrio un error al eliminar el archivo');</script>";
    }    

}


//UPDATE

if (isset($_REQUEST["Actualizar"])) {

    $nombre = $_POST['nombre'];
    $id_fichero = $_REQUEST["id_fichero"];
    $nota = $_POST['nota'];

    $url_nombre = $_FILES['archivo']['name'];
    $url_archivo = $_FILES['archivo']['tmp_name'];
    $departamento = str_replace(" ", "_", strtolower($_COOKIE["departamento"])); 

    $extension = substr($url_nombre, -4, 1) == "." ? substr($url_nombre, -3) : substr($url_nombre, -4);
    
    $ruta = "files/".$departamento."/".$nombre.".".$extension;
    rename($url_nombre, $ruta);
    
    move_uploaded_file($url_archivo,$ruta);

    $update = "UPDATE ficheros SET nombre = ?, direccion = ?, nota = ? WHERE id_fichero = ?";

    $prepare = $conexion->prepare($update);
    $prepare->bind_param("ssss", $nombre, $ruta, $nota, $id_fichero);



    if ($prepare->execute()) {
        echo "<script> alert('Los datos han sido actualizados correctamente');</script>";
    }else{
        echo "<script> alert('Error al actualizar los datos');</script>";
    }    
    

}




//EDIT
if (($_REQUEST["action"] == "archivos") && (isset($_REQUEST["Editar"]) || isset($_REQUEST["Ver"]))){
    
    $id_fichero = $_REQUEST["id_fichero"];
    
    $consulta = "SELECT id_fichero, fecha_creacion, nota, ficheros.nombre, direccion, usuarios.id_usuario, usuarios.usuario
    FROM ficheros INNER JOIN usuarios on ficheros.id_usuario = usuarios.id_usuario 
    WHERE id_fichero = ? ";
    $prepare = $conexion->prepare($consulta);
    $prepare->bind_param("s",$id_fichero);
    $prepare->execute();
    $resultado = $prepare->get_result();
    $row = mysqli_fetch_array($resultado);
    $id = $row["id"];
    $nombre = $row["nombre"];
    $nota = $row["nota"];
}
