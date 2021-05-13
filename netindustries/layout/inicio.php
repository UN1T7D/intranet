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
                WHERE tp.nombre != 'Capacitaciones' AND tp.nombre != 'Ficheros' AND tp.id_tipo_publicacion <8";
    $prepare = $conexion->prepare($consulta);
    $prepare->execute();
    $resultado = $prepare->get_result();
?>

<div class="mainbar">
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
        <img src="<?=$row['foto']?>" width="613" height="193" alt="" />
            <textarea name="" id="" cols="30" rows="25" disabled>
                <?=$row["descripcion"]?>
            </textarea>
        <div class="clr"></div>
        <h2>Comentarios</h2>
        <div class="container-comment">
            <div class="container-comment-historial">
                <div class="article">
                    <div class="clr"></div>
                    <?php
                            $consulta2 = "SELECT 
                                            c.id_comentario, 
                                            u.usuario, 
                                            c.id_usuario,
                                            c.id_publicacion, 
                                            c.descripcion, 
                                            c.fecha_creacion 
                                        FROM comentario AS c
                                        INNER JOIN usuarios AS u
                                        ON
                                        c.id_usuario = u.id_usuario
                                        WHERE c.id_publicacion = ?
                                        ORDER BY fecha_creacion";
                            $prepare2 = $conexion->prepare($consulta2);
                            $prepare2->bind_param("i",$row["id_publicacion"]);
                            $prepare2->execute();
                            $resultado2 = $prepare2->get_result();
                            while ($row2 = mysqli_fetch_array($resultado2)) {

                                if ($row2["id_usuario"] == $_COOKIE["id_usuario"]) {
                                    ?>
                                        <div class="comment"> <a href="#"><img src="images/userpic.gif" width="40" height="40" alt=""class="userpic" /></a>
                                            <p><a > <small><?=$row2["usuario"]?></small></a><br /><?=$row2["fecha_creacion"]?><br>
                                                
                                            <form action="" method="post">
                                                <input type="hidden" name="id_comentario" value="<?=$row2["id_comentario"]?>"><br>
                                                <button type="submit" name="eliminar_comentario"><i class="fas fa-cog"></i>"Eliminar comentario"</button>
                                            </form>
                                            </p>
                                            <p><?=$row2["descripcion"]?>.</p>
                                        </div>
                                    <?php
                                }else {
                                    
                                    ?>
                                    <div class="comment"> 
                                        <a href="#"><img src="images/userpic.gif" width="40" height="40" alt="" class="userpic" /></a>
                                        <p><a href="#"><?=$row2["usuario"]?></a> Dice:<br /><?=$row2["fecha_creacion"]?></p>
                                        <p><?=$row2["descripcion"]?>.</p>
                                    </div>
                                    <?php
                                }    
                                    
                            }

                        ?>
                   
                </div>
            </div>

            <div class="container-comment-add">
                <form action="" method="post">
                    <input type="hidden" name="id_publicacion" value="<?=$row['id_publicacion']?>">
                    <textarea name="descripcion" id="" cols="100" rows="2" required></textarea><br><br>
                    <button type="submit" class="enviar" name="comentar">Comentar</button>
                </form>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
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