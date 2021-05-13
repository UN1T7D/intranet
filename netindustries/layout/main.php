<div class="content">
   <?php
        /* $contenido = $inicio; */
        
        if (isset($_GET["action"])) {
            $pagina = $_GET["action"];
            /* echo $pagina; */
    
            if ($pagina != "" || $pagina == NULL) {
                
                if ($pagina == "inicio") {
                    
                    require_once("inicio.php");
                }elseif ($pagina == "capacitaciones") {
                    require_once("capacitaciones.php");
                }elseif ($pagina == "calendario") {
                    require_once("CRUD/CRUD_Calendario.php");
                    require_once("calendario.php");
                }elseif ($pagina == "archivos") {
                    require_once("CRUD/CRUD_Archivos.php"); 
                    require_once("archivos.php");
                }elseif ($pagina == "extenciones") {
                    require_once("extenciones.php");
                }elseif ($pagina == "publicar") {
                    require_once("publicar.php");
                }elseif ($pagina == "evento") {
                    require_once("CRUD/CRUD_Calendario.php");
                    require_once("evento.php");
                }elseif($pagina == "upload"){
                    require_once("subir_fichero.php");
                }elseif($pagina == "new_user"){
                    require_once("usuario_nuevo.php");
                }
    
    
            }else{
                require_once("inicio.php");
            }
        }else{
            require_once("inicio.php");
        }
   ?>