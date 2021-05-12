<?php
    $consulta = "SELECT * FROM tipo_publicacion WHERE nombre = 'Ficheros'";
    $prepare = $conexion->prepare($consulta);
    $prepare->execute();
    $resultado = $prepare->get_result();

?>

<div class="mainbar">
    <div class="article">
        <h2><span>Subir un nuevo fichero</span></h2>
        <div class="clr"></div>
        <div class="share_publication">
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="titulo" id="" placeholder="Titulo" required>
                <select name="id_tipo_publicacion" id="" readonly>
                    <?php
                        while ($row = mysqli_fetch_array($resultado)) {
                            
                            ?>
                    <option value="<?=$row["id_tipo_publicacion"]?>" selected>
                        <?=$row["nombre"]?>
                    </option>
                    <?php
                        }
                    ?>
                </select>
                <div class="container-img">
                    <input type="file" name="foto" id="" required>
                </div>
                <textarea name="descripcion" id="" cols="30" rows="3" required></textarea>
                <input type="submit" value="Publicar" name="crear_publicacion">
            </form>
            <?php
                if (isset($_POST["crear_publicacion"])) {


                    
                    date_default_timezone_set('America/El_Salvador');
                    $fecha_creacion = date("Y-m-d H:i:s");
                    $titulo = $_POST["titulo"];
                    $descripcion = $_POST["descripcion"];
                    $id_usuario = $_COOKIE["id_usuario"];
                    $id_tipo_publicacion = 8;

                    $url_nombre = $_FILES["foto"]["name"];
                    $url_archivo = $_FILES["foto"]["tmp_name"];
                    $foto = "upload/doc/".$url_nombre;
                    move_uploaded_file($url_archivo, $foto);
                     /*echo $ruta;
                    die(); */
                   
                    $consulta = "INSERT INTO publicacion(titulo, foto, descripcion, fecha_creacion, id_usuario, id_tipo_publicacion) VALUES(?,?,?,?,?,?)";
                    $prepare = $conexion->prepare($consulta);
                    $prepare->bind_param("ssssii",$titulo, $foto, $descripcion, $fecha_creacion, $id_usuario, $id_tipo_publicacion);
                    $prepare->execute();
                    $resultado = $prepare->get_result();
                    if ($resultado) {
                        header("location: index.php?action=upload");
                        
                    }else{
                        header("location: index.php?action=archivos");
                    }

                }else {
                    
                    $mensaje = "<span>Aqui unicamente se pueden ingresar ficheros generales</span>";
                }
            ?>
            <div class="alerta_resultado">
                <?=$mensaje?>
            </div>
        </div>
    </div>
    <div class="article">

        <div class="tabla-registro-publicaciones">
            <h2><span>Historial de archivos</span></h2>
            <table class="mostrar_registros" cellspacing=0>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Foto</th>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Creacion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $consulta = "SELECT * FROM publicacion WHERE id_usuario = ? AND id_tipo_publicacion  = 8";
                        $prepare = $conexion->prepare($consulta);
                        $prepare->bind_param("i",$_COOKIE["id_usuario"]);
                        $prepare->execute();
                        $resultado = $prepare->get_result();
                        while ($row = mysqli_fetch_array($resultado)) {
                    ?>
                        <tr>
                            <td><?=$row["id_publicacion"]?></td>
                            <td><figure><a href="<?=$row["foto"]?>"><i class="far fa-file-pdf"></i></a></figure></td>
                            <td ><?=$row["titulo"]?></td>
                            <td ><input name="" id="" value="<?=$row["descripcion"]?>" disabled></td>
                            <td><?=$row["fecha_creacion"]?></td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
