<?php
require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
$cedula=$_GET['ced'];
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('H:i:s',time() - 3600*date('I'));
$fecha_hoy = date("Y-m-d").' '.$hora;
$sql=mysqli_query($con, "UPDATE usuarios SET voto_pre='".$fecha_hoy."' WHERE cedula='".$cedula."'");
if($sql){
	header('location: search.php?ced='.$cedula);
}
?>