<div class="sidebar">
        <div class="gadget">
          <figure>
            <img src="images/cropped-Logo-Grupo-Guardado-180x85.jpg" alt="">
          </figure>
          <?php
            if ($_COOKIE["rol"] <= 4) {
             ?>
                <a href="index.php?action=publicar" class="new_publiser_tag">
                  <div class="new_publisher">
                    Crear una nueva publicacion <i class="fas fa-plus"></i>
                  </div>
                </a>
              <?php
            }
          ?>
        </div>
      <div class="gadget">
        <a href="#">
          <h2><span>Perfil personal </span><small><i class="fas fa-wrench"></i></small></h2>
        </a>
        <div class="clr"></div>

        <div class="container-profile">
          <div class="picture">
            <figure>
              <img src="images/avatar/R6ae74c5f86466ef4f6fc6253c767381a.png" alt="">
            </figure>
          </div>
          <div class="description">
            <ul class="sb_menu2">
              <li class="active"><a href="#">Nombre: <?=$_COOKIE["usuario"]?></a></li>
              <li><a href="#">Departamento <?=$_COOKIE["departamento"]?></a></li>
              <li><a href="#">Edad: <?=$_COOKIE["edad"]?></a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="gadget">
        <a href="#">
          <h2><span>Usuarios de la red </span><small><i class="fas fa-users"></i></small></h2>
        </a>
        <div class="clr"></div>
        <div class="container-active">
          <div class="profile-active">
            <ul class="sb_menu2">
              <?php

                $consulta = "SELECT u.nombre, u.apellido,u.edad, r.departamento  FROM usuarios AS u 
                INNER JOIN rol AS r ON u.id_rol = r.id_rol";
                $prepare = $conexion->prepare($consulta);
                $prepare->execute();
                $resultado = $prepare->get_result();
                while ($row = mysqli_fetch_array($resultado)) {
                  

                
              ?>
              <div class="comment"> <a href="#"><img src="images/userpic.gif" width="40" height="40" alt=""
                                    class="userpic" /></a>
                            <p><a href="#"><?=$row["departamento"]?></a><br />
                                <?=$row["nombre"]." ".$row["apellido"]." Edad: ".$row["edad"]?></p>
                        </div>
              <?php
                }
              ?>
              
            </ul>
          </div>
        </div>
      </div>
      <div class="gadget">
        <h2 class="grey"><span>Mision</span></h2>
        <div class="clr"></div>
        <div class="testi">
          <p><span class="q"><img src="images/quote_1.gif" width="16" height="14" alt="" /></span> Fabricar y
            comercializar productos farmacéuticos de calidad certificada que contribuyan a conservar, mejorar la salud y
            la condición de vida en la gente de nuestra región. <span class="q"><img src="images/quote_2.gif" width="16"
                height="14" alt="" /></span></p>
          <p class="title"><strong>Gerencia General</strong></p>
        </div>
      </div>
      <div class="gadget">
        <h2 class="grey"><span>Vision</span></h2>
        <div class="clr"></div>
        <div class="testi">
          <p><span class="q"><img src="images/quote_1.gif" width="16" height="14" alt="" /></span> Ser una empresa lider
            reconocida en el mercado farmacéutico regional por su calidad, alta competitividad y en constante búsqueda
            de nuevos mercados. <span class="q"><img src="images/quote_2.gif" width="16" height="14" alt="" /></span>
          </p>
          <p class="title"><strong>Gerencia General</strong></p>
        </div>
      </div>
    </div>
    <div class="clr"></div>
  </div>
  <div class="clr"></div>