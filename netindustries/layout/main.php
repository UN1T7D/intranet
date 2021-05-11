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
                    require_once("calendario.php");
                }elseif ($pagina == "archivos") {
                    require_once("archivos.php");
                }elseif ($pagina == "extenciones") {
                    require_once("extenciones.php");
                }elseif ($pagina == "publicar") {
                    require_once("publicar.php");
                }
    
            }else{
                require_once("inicio.php");
            }
        }else{
            require_once("inicio.php");
        }
   ?>