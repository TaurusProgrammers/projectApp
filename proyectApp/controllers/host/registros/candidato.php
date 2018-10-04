<?php
require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos

$name=$_POST['nombre'];
$last_name=$_POST['apellido'];
$user=$_POST['user'];
$pass=md5($_POST['password']);
$cargo=$_POST['cargo'];
$cedula=$_POST['cedula'];
$año=date ("Y");


$sql=mysqli_query($con,"INSERT INTO `candidatos`( `id_cand`, `name_cand`, `last_name_cand`, `id_cargo`, `ano_actual`) VALUES ('".$cedula."','".$name."','".$last_name."','".$cargo."','".$año."')");
if($sql){
		$insert=mysqli_query($con, "INSERT INTO `usuarios`(`cedula`, `apellidos`, `nombres`, `id_rol`, `usuario`, `password`) VALUES ('".$cedula."','".$last_name."','".$name."','3','".$user."','".$pass."')");
		if($insert){
			header('location: ../index.php?cand=Hex(aa2639koa)');
		}else{
			header('location: ../index.php?error=Hex(aa2639koa)');
		}
}else{
	printf("Error: %s\n", $con->error);
}

?>