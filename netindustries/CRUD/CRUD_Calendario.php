<?php
//INSERT
if (isset($_REQUEST["Guardar"])) {

    $fecha_inicio = $_REQUEST['fecha_inicio'];
    $fecha_final = $_REQUEST['fecha_final'];
    $tipo_evento = $_REQUEST['tipo_evento'];
    $descripcion = $_REQUEST['descripcion'];
    $id_usuario = $_COOKIE["id_usuario"];

    $descripcion = $_REQUEST['descripcion'];
    $insert = "INSERT INTO evento (fecha_inicio, fecha_final, tipo_evento, descripcion, id_usuario) 
                VALUES (?,?,?,?,?)";

    $prepare = $conexion->prepare($insert);
    $prepare->bind_param("sssss",$fecha_inicio,$fecha_final,$tipo_evento,$descripcion,$id_usuario);


    if ($prepare->execute()) {
/*         Alert("El nuevo departamento a sido registrado", "primary");
 */    }else{
/*         Alert("Error al registrar el nuevo departamento", "danger");
 */    }    

}

//DELETE
if (isset($_REQUEST["Eliminar"])){
    
    $id_evento = $_REQUEST["id_evento"];

    $delete = "DELETE FROM evento WHERE id_evento = ?";
    $prepare = $conexion->prepare($delete);
    $prepare->bind_param("s",$id_evento);
    $prepare->execute();
}


//SELECT 

$consulta = "SELECT fecha_inicio, fecha_final, tipo_evento, descripcion, id_usuario, id_evento  from evento";
$obtenerDatos = mysqli_query($conexion, $consulta);




//UPDATE

if (isset($_REQUEST["Actualizar"])) {

    $fecha_inicio = $_REQUEST['fecha_inicio'];
    $fecha_final = $_REQUEST['fecha_final'];
    $tipo_evento = $_REQUEST['tipo_evento'];
    $descripcion = $_REQUEST['descripcion'];
    $id_usuario = $_COOKIE["id_usuario"];
    $id_evento = $_REQUEST["id_evento"];

    $descripcion = $_REQUEST['descripcion'];
    $update = "UPDATE evento SET fecha_inicio = ?, fecha_final = ?, tipo_evento = ?, descripcion = ?
                WHERE id_evento = ?";

    $prepare = $conexion->prepare($update);
    $prepare->bind_param("sssss",$fecha_inicio,$fecha_final,$tipo_evento,$descripcion,$id_evento);


    if ($prepare->execute()) {
/*         Alert("El nuevo departamento a sido registrado", "primary");
 */    }else{
/*         Alert("Error al registrar el nuevo departamento", "danger");
 */    }    

}





//EDIT
if ($_REQUEST["action"] == "evento" && $_REQUEST["id"] != 0){
    
    $id_evento = $_REQUEST["id"];

    $consulta = "SELECT fecha_inicio, fecha_final, tipo_evento, descripcion, 
                id_usuario, id_evento FROM evento WHERE id_evento = ?";
    $prepare = $conexion->prepare($consulta);
    $prepare->bind_param("s",$id_evento);
    $prepare->execute();
    $resultado = $prepare->get_result();
    $row = mysqli_fetch_array($resultado);

}
