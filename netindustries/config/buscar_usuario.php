<?php 
    $mensaje = "";
    
    /* if (isset($_POST["ingresar"])) { *//* 
        require_once("config/conexion.php"); */
        
        $usuario = $_POST["usuario"];
        $contrasenia = $_POST["contrasenia"];
        $encontrado = 0;
        
        $consulta = "SELECT 
                            u.usuario, 
                            u.dui, 
                            u.edad,
                            r.departamento,
                            u.id_usuario
                    FROM usuarios AS u 
                    INNER JOIN rol AS r 
                    ON
                        u.id_rol = r.id_rol 
                    WHERE u.usuario =  ?";
        $prepare = $conexion->prepare($consulta);
        $prepare->bind_param("s",$usuario);
        $prepare->execute();
        $resultado = $prepare->get_result();

        
        while ($row = mysqli_fetch_array($resultado)) {
            
            if (md5($contrasenia) == $row["dui"]) {
                /* echo $usuario;
                echo $contrasenia;
                die(); */
                $encontrado = 1;
                setcookie("acceso","intranet",time()+3600);
                setcookie("usuario",$row["usuario"],time()+3600);
                setcookie("edad",$row["edad"],time()+3600);
                setcookie("departamento",$row["departamento"],time()+3600);
                setcookie("id_usuario",$row["id_usuario"],time()+3600);

              /*   echo "se encontro un registro"; */
                
            }
        }

        if ($encontrado == 1) {
            header("location:index.php");
            /* ob_enf_fluch(); */
        }else {
            $mensaje = "<div class='alert alert-danger' role='alert'>Al parecer necesitas crear una cuenta para poder ingresar <a href='crear_cuenta.php'> Has clik aqui para iniciar sesion.</a> </div>";
        }
    /* } */
?>