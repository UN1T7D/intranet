<?php

    $host = "den1.mysql1.gear.host";
    $user = "dbintranet";
    $password = "Fw00P~onD1~S";
    $database = "dbintranet";

    $conexion = new mysqli($host,$user,$password,$database);

    if ($conexion->connect_error) {
        echo "<div class='alert alert-danger' role='alert'>Al parecer tenemos un problema con el servidor, intentelo mas tarde. Error: ". $conexion->connect_error ."</div>";
        /* echo "<p> Error al conectarse a la base de datos :". $conexion->connect_error ."</p>" ; */
        exit;
    }
    $conexion->query("SET NAMES UTf8");
?>