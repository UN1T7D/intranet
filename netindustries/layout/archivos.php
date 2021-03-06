<?php
    $consulta = "SELECT 
                    p.id_publicacion, 
                    p.titulo, 
                    p.foto, 
                    p.descripcion, 
                    p.fecha_creacion, 
                    u.usuario,
                    tp.nombre,
                    tp.id_tipo_publicacion
                FROM publicacion AS p 
                INNER JOIN usuarios AS u 
                ON
                p.id_usuario = u.id_usuario
                INNER JOIN tipo_publicacion AS tp
                ON
                p.id_tipo_publicacion = tp.id_tipo_publicacion
                WHERE tp.id_tipo_publicacion > 7
                ORDER BY  p.id_publicacion DESC";
    $prepare = $conexion->prepare($consulta);
    $prepare->execute();
    $resultado = $prepare->get_result();
?>

<div class="mainbar">
    <h2><span>FICHEROS DE LA INTRANET</span></h2>
            <div class="clr"></div>
    <div class="container-file">
    <?php
        while ($row = mysqli_fetch_array($resultado)) {
    ?>

        <div class="article">
            <h2><span>
                    <?=$row["titulo"]?>
                </span></h2>
            <div class="clr"></div>
            &nbsp;|&nbsp; Posteado por <a href="#">
                <?=$row["usuario"]?>
            </a> &nbsp;|&nbsp; Hora <a href="#">
                <?=$row["fecha_creacion"]?>
            </a>, <a href="#">
                <?=$row["nombre"]?>
            </a></p>
            <a href="<?=$row['foto']?>">
                <button><img src="images/upload.png" width="140" height="100" alt="" /><br><br><?=$row["descripcion"]?>.</button>
            </a>
            <div class="clr"></div>
            
        </div>
        <?php
        }
        ?>
        </div>
</div>

<?php

        if (isset($_POST["comentar"])) {
            
            date_default_timezone_set('America/El_Salvador');
            $fecha_creacion = date("Y-m-d H:i:s");
            $descripcion = $_POST["descripcion"];
            $id_publicacion = $_POST["id_publicacion"];

            $consulta = "INSERT INTO comentario (
                                                id_usuario, 
                                                id_publicacion, 
                                                descripcion, 
                                                fecha_creacion) 
                                        VALUES (
                                                ?,
                                                ?,
                                                ?,
                                                ?
                                                )";
            $prepare = $conexion->prepare($consulta);
            $prepare->bind_param("iiss",$_COOKIE["id_usuario"], $id_publicacion, $descripcion, $fecha_creacion);
            $prepare->execute();
            $resultado = $prepare->get_result();
            if ($resultado) {
                echo "<script>alert('Datos ingresados erroneamente')</script>";
                
            }else{
                echo "<script>alert('Datos ingresados correctamente')</script>";
            }


        }

        if (isset($_POST["eliminar_comentario"])) {
            $id_comentario = $_POST["id_comentario"];
            echo "esta adentro";
            echo $id_comentario;

            $consulta = "DELETE FROM comentario WHERE id_comentario = ?";
            $prepare = $conexion->prepare($consulta);
            $prepare->bind_param("i",$id_comentario);
            $prepare->execute();
            $resultado = $prepare->get_result();
            if ($resultado) {
                echo "<script>alert('Datos Eliminar erroneamente')</script>";
                
            }else{
                echo "<script>alert('Datos Eliminar correctamente')</script>";
            }
        }
    ?>