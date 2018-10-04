<?php
require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos

$name=$_POST['nombre'];
$last_name=$_POST['apellido'];
$id=$_POST['cedula'];
$user=$_POST['user'];
$pass=md5($_POST['password']);
$zona=$_POST['zona'];
$lugar=$_POST['lugar'];
$mesa=$_POST['mesa'];



$sql=mysqli_query($con,"INSERT INTO `testigo`(`cedula`, `name`, `last_name`, `zona`, `lugar`, `mesa`) VALUES ('".$id."','".$name."','".$last_name."','".$zona."','".$lugar."','".$mesa."')");
if($sql){
	$sqlx=mysqli_query($con,"INSERT INTO `usuarios`(`cedula`, `apellidos`, `nombres`, `id_rol`, `usuario`, `password`) VALUES ('".$id."','".$last_name."','".$name."','5','".$user."','".$pass."')");

	if($sqlx){
		header('location: ../index.php?cand=Hex(aa2639koa)');
	}else{
		header('location: ../index.php?error=Hex(aa2639koa)');
	}
}else{
	header('location: ../index.php?error=Hex(aa2639koa)');
}

?>