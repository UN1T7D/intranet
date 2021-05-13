<?php

if ($_COOKIE["rol"] == 1) {
    

    $consulta = "SELECT * FROM rol";
    $prepare = $conexion->prepare($consulta);
    $prepare->execute();
    $resultado = $prepare->get_result();


    ?>

    <div class="mainbar">
        <div class="article">
            <h2><span>Crea una nueva publicacion</span></h2>
            <div class="clr"></div>
            <div class="share_publication">
            <form method="post" >
                <input type="text" name="nombre" id="" placeholder="Nombre " required>
                <input type="text" name="apellido" id="" placeholder="Apellido" required>
                <input type="text" name="dui" id="" placeholder="DUI" required>
                <input type="number" max="60" min="18"  name="edad" id="" placeholder="Edad" required>
                <select name="rol" id="" required>
                    <option value="3">Seleccione una opcion</option>
                    <?php
                        while ($row = mysqli_fetch_array($resultado)) {
                            
                            ?>
                    <option value="<?=$row["id_rol"]?>">
                        <?=$row["departamento"]?>
                    </option>
                    <?php
                        }
                    ?>
                </select>
                
                <input type="submit" value="Agregar" name="crear_usuario">
            </form>
            

            <?php
                if (isset($_POST["crear_usuario"])) {


                    $nombre = $_POST["nombre"];
                    $apellido = $_POST["apellido"];
                    $dui = md5($_POST["dui"]);
                    $rol = $_POST["rol"];
                    $usuario = $nombre.".".$apellido;
                    $edad = $_POST["edad"];
                    $estado = 1;
                   
                    $consulta = "INSERT INTO usuarios(
                                                        nombre, 
                                                        apellido, 
                                                        dui, 
                                                        id_rol, 
                                                        usuario, 
                                                        edad, 
                                                        estado
                                                    ) 
                                                VALUES(
                                                        ?,
                                                        ?,
                                                        ?,
                                                        ?,
                                                        ?,
                                                        ?,
                                                        ?
                                                        )";

                    $prepare = $conexion->prepare($consulta);
                    $prepare->bind_param("sssisii",$nombre, $apellido, $dui, $rol, $usuario, $edad, $estado);
                    $prepare->execute();
                    $resultado = $prepare->get_result();
                    if ($resultado) {
                        header("location: index.php?action=inicio");
                        
                    }else{
                        header("location: index.php?action=new_user");
                        echo "<script>alert('Datos ingresados correctamente')</script>";
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
            <h2><span>Historial de archivos</span></h2>
            <table class="mostrar_registros" cellspacing=0>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Usuario</th>
                        <th>Estado</th>
                        <th>Usuarios Activos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $consulta = "SELECT * FROM usuarios";
                        $prepare = $conexion->prepare($consulta);
                        $prepare->execute();
                        $resultado = $prepare->get_result();
                        while ($row = mysqli_fetch_array($resultado)) {
                    ?>
                        <tr>
                            <td><?=$row["id_usuario"]?></td>
                            <td><?=$row["nombre"]?></td>
                            <td ><?=$row["apellido"]?></td>
                            <td ><?=$row["usuario"]?></td>
                            <td><?=$row["estado"]?></td>
                            <td>
                                
                                    <?php
                                        if ($row["estado"] == 1) {
                                            
                                            ?>  
                                                <form action="" method="post">
                                                    <input type="hidden" name="usuario" id="" value="<?=$row['id_usuario']?>">
                                                    <input type="checkbox" name="" checked id="">
                                                    <input type="submit" value="desabilitar" name="usuario_desabilitar">
                                                </form>
                                            <?php
                                        }else {
                                            ?>
                                                <form action="" method="post">
                                                    <input type="hidden" name="usuario" id="" value="<?=$row['id_usuario']?>">
                                                    <input type="checkbox" name=""  id="">
                                                    <input type="submit" value="habilitar" name="usuario_habilitar">
                                                </form>
                                                
                                                
                                            <?php
                                        }
                                    ?>
                                
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    

    <?php

    if (isset($_POST["usuario_desabilitar"])) {
       
        $usuario = $_POST["usuario"];
        $consulta = "UPDATE usuarios SET estado = 0 WHERE id_usuario = ?";
        $prepare = $conexion->prepare($consulta);
        $prepare->bind_param("i", $usuario);
        $prepare->execute();
        $resultado = $prepare->get_result();
        if ($resultado) {
            header("location: index.php?action=new_user");
            
        }else{
            header("location: index.php?action=inicio");
        }
    }

    if (isset($_POST["usuario_habilitar"])) {
       
        $usuario = $_POST["usuario"];
        $consulta = "UPDATE usuarios SET estado = 1 WHERE id_usuario = ?";
        $prepare = $conexion->prepare($consulta);
        $prepare->bind_param("i", $usuario);
        $prepare->execute();
        $resultado = $prepare->get_result();
        if ($resultado) {
            header("location: index.php?action=new_user");
            
        }else{
            header("location: index.php?action=inicio");
        }
    }

}else {
    header("Location: index.php");
}