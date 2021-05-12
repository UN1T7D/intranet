<?php

    
setcookie("acceso","intranet",time()-3600);
setcookie("id_usuario",$row["id_usuario"],time()-3600);
setcookie("usuario",$row["usuario"],time()-3600);
setcookie("edad",$row["edad"],time()-3600);
setcookie("rol",$row["id_rol"],time()-3600);
setcookie("departamento",$row["departamento"],time()-3600);
    /* if (empty($_COOKIE["acceso"]) && empty($_COOKIE["usario"])) { */
        
        header("location: index.php");
        /* ob_enf_fluch(); */
   /*  }
    else{
        echo "<div class='alert alert-danger' role='alert'>Cookies NO eliminada correctamente</div>";
        var_dump($_COOKIE["acceso"]);
        var_dump($_COOKIE["usuario"]);
        var_dump($_COOKIE["id"]);
    } */
    /* header("location:../index.php");
    ob_enf_fluch(); */

?>