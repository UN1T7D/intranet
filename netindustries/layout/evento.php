

<div class="mainbar">
      <div class="article">
      <?php

        if(isset($_GET["action"]) && $_GET["id"] == 0){
            echo "<h2> No hay eventos para este día</h2>";
        }else{

        ?>
            <?php 
    
        $fecha_inicio = date("Y-m-d", strtotime($row["fecha_inicio"]));
        $fecha_final = date("Y-m-d", strtotime($row["fecha_final"]));
        $edit = "";
        if (!$_COOKIE["departamento"] == "Recursos Humanos"){
          $edit = "disabled";
        }


    ?>



        <form action="index.php?action=calendario" method="POST" >
          <input type="hidden" name="id_evento" value="<?=$id_evento?>">
          <label for=""> Fecha inicio  </label><input type="date" class="inputs" name="fecha_inicio" value="<?=$fecha_inicio?>" <?=$edit?>>
          <label for=""> Fecha final </label> <input type="date" class="inputs" name="fecha_final" value="<?=$fecha_final?>"  <?=$edit?>>
          <label for=""> Tipo de evento </label> 
          <select name="tipo_evento" id="" class="inputs" <?=$edit?>>
                <option value="<?=$row["tipo_evento"]?>"><?=$row["tipo_evento"]?></option>
                <option value="General"> General</option>
                <option value="Cumpleaños"> Cumpleaños</option>
                <option value="Capacitación">Capacitación</option>
          </select>
          <label for=""> Descripción </label> 
          <textarea class="inputs" name="descripcion" <?=$edit?>>
             <?=$row["descripcion"]?>
          </textarea>
          <?php  if (!$edit == "disabled"):?>
          <input type="submit" value="Actualizar" class="button" name="Actualizar">
          <input type="submit" value="Eliminar evento" class="buttonDelete" name="Eliminar">
          <?php  endif;?>
        </form>

       <?php  }?>


      </div>
    </div>