<?php
  /* require_once("configurations/claseValidar.php");
  $usuario = new ValidarUsuario(); */
  /* require_once("config/buscar_usuario.php"); */
  
  $mensaje = "<div class='alert alert-light' role='alert'>Cumpla con ingresar los datos</div>";
  if (isset($_POST["login"])) {
    
    require_once("config/conexion.php");
    require_once("config/buscar_usuario.php");
    /* echo "le dio click"; */
  }
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RocaSoft :: Inicia Sesion </title>
    <link rel="icon" type="image/png"  href="view/layout/assets/img/hospital.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Estilos propieos de la pagina web -->
    <link rel="stylesheet" href="css/css/style.css">
</head>
<body>

    <div class="container ">
        <form class="form-signin shadow p-3 mb-5 bg-white rounded" method="POST">
            <div class="text-center mb-4">
              <img class="mb-4" src="images/cropped-Logo-Grupo-Guardado-180x85.jpg" alt="" width="162" height="72">
              <h1 class="h3 mb-3 font-weight-normal">Grupo Guardado</h1>
              <p>Te damos la bienvenida a nuestra intranet <code>empresarial</code> para que puedes ver la actividad interna de la empresa.</p>
            </div>
                    

            <div class="form-label-group">
              <input type="text" id="inputEmail" class="form-control" name="usuario" placeholder="Usuario" required autofocus>
              <label for="inputEmail">Usuario</label>
            </div>

            <div class="form-label-group">
              <input type="password" id="inputPassword" class="form-control" name="contrasenia" placeholder="Password" required>
              <label for="inputPassword">Contraseña</label>
            </div>

            <button class="btn btn-lg btn-primary btn-block" name="login" value="iniciar_sesion" type="submit">Ingresar</button>
            <div class="row mt-5">
              <div class="col-md-12">
                <div class="form-label-group">
                  <?php echo $mensaje; ?>
                </div> 
              </div>
            </div>
            <p class="mt-5 mb-3 text-muted text-center">&copy; Grupo Guardado -  Intranet Corporativa</p>
        </form>
    </div>

    <!-- Scrpt de los archivos de bootstrap 4 -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>