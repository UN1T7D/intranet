<?php
if (!isset($_COOKIE["acceso"])) {
    require_once("login.php");
    
}else {

    error_reporting(0);
    
    require_once ("config/conexion.php");
    require_once ("layout/header.php");
    require_once ("layout/main.php");
    require_once ("layout/sidebar.php");
    require_once ("layout/footer.php");

}