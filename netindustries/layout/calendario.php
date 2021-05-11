
<div class="mainbar">
  <div class="article">
    <h2><span>Calendario de actividades</span></h2>
    <div class="clr"></div>

        
    <?php 
    if ($_COOKIE["departamento"] == "Recursos Humanos"): ?>



        <form action="index.php?action=calendario" method="POST">
          <label for=""> Fecha inicio  </label><input type="date" class="inputs" name="fecha_inicio" required>
          <label for=""> Fecha final </label> <input type="date" class="inputs" name="fecha_final" required>
          <label for=""> Tipo de evento </label> 
          <select name="tipo_evento" id="" class="inputs" required>
                <option value=""> Seleccione...</option>
                <option value="General"> General</option>
                <option value="Cumpleaños"> Cumpleaños</option>
                <option value="Capacitación">Capacitación</option>
          </select>
          <label for=""> Descripción </label> 
          <textarea name="descripcion" class="inputs" required></textarea>
          <input type="submit" value="Registrar evento" class="button" name="Guardar">
        </form>

   <?php endif; ?>





    <?php
    $monthNames = array(
      "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
      "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
    );

    if (!isset($_REQUEST["mes"])) $_REQUEST["mes"] = date("n");
    if (!isset($_REQUEST["anio"])) $_REQUEST["anio"] = date("Y");

    $cMonth = $_REQUEST["mes"];
    $cYear = $_REQUEST["anio"];

    $prev_year = $cYear;
    $next_year = $cYear;
    $prev_month = $cMonth - 1;
    $next_month = $cMonth + 1;

    if ($prev_month == 0) {
      $prev_month = 12;
      $prev_year = $cYear - 1;
    }
    if ($next_month == 13) {
      $next_month = 1;
      $next_year = $cYear + 1;
    }
    ?>




          <table width="100%" border="0" cellpadding="2" cellspacing="2">
            <tr>
              <td width="50%" align="left" colspan="3"><a href="<?php echo $_SERVER["PHP_SELF"] . "?action=calendario&mes=" . $prev_month . "&anio=" . $prev_year; ?>" style="color:gray">Anterior</a></td>
              <td colspan="1"></td>
              <td width="50%" align="right" colspan="3"><a href="<?php echo $_SERVER["PHP_SELF"] . "?action=calendario&mes=" . $next_month . "&anio=" . $next_year; ?>" style="color:gray">Siguiente</a></td>
            </tr>

            <tr align="center">
              <td colspan="7" bgcolor="#999999" style="color:#FFFFFF"><strong><?php echo $monthNames[$cMonth - 1] . ' ' . $cYear; ?></strong></td>
            </tr>
            <tr>
              <td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>Lunes</strong></td>
              <td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>Martes</strong></td>
              <td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>Miercoles</strong></td>
              <td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>Jueves</strong></td>
              <td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>Viernes</strong></td>
              <td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>Sabado</strong></td>
              <td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>Domingo</strong></td>
            </tr>
            <?php
            $timestamp = mktime(0, 0, 0, $cMonth, 1, $cYear);
            $maxday = date("t", $timestamp);
            $thismonth = getdate($timestamp);
            $startday = $thismonth['wday'];
            for ($i = 0; $i < ($maxday + $startday); $i++) {

              $bg = "white";
              $color = "gray";
              $id_evento = 0;

              if (($i % 7) == 0) echo "<tr>";

              if ($i < $startday) echo "<td></td>";

              else { ?>


                  
<?php 
                
                if (($i-$startday+1) < 10){
                  $day = $i-$startday+1;
                  $day = "0".$day;
                }else{
                  $day = $i-$startday+1;
                }

                if (!isset($_GET["mes"])){
                  $_GET["mes"] = $cMonth;
                }

                if (($_GET["mes"]) < 10){
                  $mes = "0".$_GET["mes"];
                }else{
                  $mes = $_GET["mes"];
                }

                $fecha = $cYear."-".$mes."-".$day;



                foreach ($obtenerDatos as $fechaEvento){
                
                  if ($fechaEvento["fecha_inicio"] == $fecha || $fechaEvento["fecha_final"] == $fecha){

                    $id_evento = $fechaEvento["id_evento"];

                     if ($fechaEvento["tipo_evento"] == "Cumpleaños"){
                       $bg = "green";
                       $color = "white";
                     }else if ($fechaEvento["tipo_evento"] == "Capacitación"){
                      $bg = "orange";
                      $color = "white";
                    }else if ($fechaEvento["tipo_evento"] == "General"){
                      $bg = "#20B2AA";
                      $color = "white";
                    }
                  }
                }


              ?>


                <td align="center" valign="middle" height="20px"  bgcolor="<?=$bg?>"  style="color:<?=$color?>"
                <?php if ((date("d") == $i - $startday + 1) && !isset($_GET['mes'])) { 
                  ?> bgcolor="#008000" <?php } ?>> 
                  <?php echo "<a href='index.php?action=evento&id=".$id_evento."' class='a' style='color:".$color."'>".($i - $startday + 1)."</a>"?> </td>
                

            <?php }
              
              if (($i % 7) == 6) echo "</tr>";

              
            }
            ?>
          </table>

  </div>
</div>

<?php
