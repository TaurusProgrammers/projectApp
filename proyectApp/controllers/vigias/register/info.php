<?php
require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos

$id=$_POST['cedula'];
$martha=$_POST['martha'];
$eduardo=$_POST['eduardo'];
$jose=$_POST['jose'];
$blanco=$_POST['blanco'];

$sql=mysqli_query($con,"UPDATE testigo SET martha='".$martha."', eduard='".$eduardo."', jose='".$jose."', blanco='".$blanco."' WHERE cedula='".$id."'");
if($sql){
	header('location: ../index.php?cand=exia');
}

?>