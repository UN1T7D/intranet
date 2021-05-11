<?php
    $consulta = "SELECT * FROM tipo_publicacion";
    $prepare = $conexion->prepare($consulta);
    $prepare->execute();
    $resultado = $prepare->get_result();

?>

<div class="mainbar">
    <div class="article">
        <h2><span>Crea una nueva publicacion</span></h2>
        <div class="clr"></div>
        <div class="share_publication">
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="titulo" id="" placeholder="Titulo" required>
                <select name="id_tipo_publicacion" id="" required>
                    <option value="3">Seleccione una opcion</option>
                    <?php
                        while ($row = mysqli_fetch_array($resultado)) {
                            
                            ?>
                    <option value="<?=$row[" id_tipo_publicacion"]?>">
                        <?=$row["nombre"]?>
                    </option>
                    <?php
                        }
                    ?>
                </select>
                <div class="container-img">
                    <input type="file" name="foto" id="" required>
                </div>
                <textarea name="descripcion" id="" cols="30" rows="10" required></textarea>
                <input type="submit" value="Publicar" name="crear_publicacion">
            </form>
            <?php
                if (isset($_POST["crear_publicacion"])) {


                    
                    date_default_timezone_set('America/El_Salvador');
                    $fecha_creacion = date("Y-m-d H:i:s");
                    $titulo = $_POST["titulo"];
                    $descripcion = $_POST["descripcion"];
                    $id_usuario = $_COOKIE["id_usuario"];
                    $id_tipo_publicacion = $_POST["id_tipo_publicacion"];

                    $url_nombre = $_FILES["foto"]["name"];
                    $url_archivo = $_FILES["foto"]["tmp_name"];
                    $foto = "upload/".$url_nombre;
                    move_uploaded_file($url_archivo, $foto);
                     /*echo $ruta;
                    die(); */
                   
                    $consulta = "INSERT INTO publicacion(titulo, foto, descripcion, fecha_creacion, id_usuario, id_tipo_publicacion) VALUES(?,?,?,?,?,?)";
                    $prepare = $conexion->prepare($consulta);
                    $prepare->bind_param("ssssii",$titulo, $foto, $descripcion, $fecha_creacion, $id_usuario, $id_tipo_publicacion);
                    $prepare->execute();
                    $resultado = $prepare->get_result();
                    if ($resultado) {
                        header("location: index.php?action=publicar");
                        
                    }else{
                        header("location: index.php?action=inicio");
                        $mensaje = "<span>Dato ingresado correctamente</span>";
                    }

                }else {
                    
                    $mensaje = "<span>Aqui unicamente se pueden ingresar noticias generales</span>";
                }
            ?>
            <div class="alerta_resultado">
                <?=$mensaje?>
            </div>
        </div>
    </div>
    <div class="article">

        <div class="tabla-registro-publicaciones">
            <h2><span>Crea una nueva publicacion</span></h2>
            <table class="mostrar_registros" cellspacing=0>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Foto</th>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Creacion</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $consulta = "SELECT * FROM publicacion WHERE id_usuario = ?";
                        $prepare = $conexion->prepare($consulta);
                        $prepare->bind_param("i",$_COOKIE["id_usuario"]);
                        $prepare->execute();
                        $resultado = $prepare->get_result();
                        while ($row = mysqli_fetch_array($resultado)) {
                    ?>
                        <tr>
                            <td><?=$row["id_publicacion"]?></td>
                            <td><figure><img src="<?=$row["foto"]?>" alt="" width="80px" height="50px"></figure></td>
                            <td ><?=$row["titulo"]?></td>
                            <td ><textarea name="" id="" cols="30" rows="6"disabled><?=$row["descripcion"]?></textarea ></td>
                            <td><?=$row["fecha_creacion"]?></td>
                            <td><a href="index.php?action=publicar&eraser=<?=$row['id_publicacion']?>"><i class="fas fa-trash"></i></a></td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
