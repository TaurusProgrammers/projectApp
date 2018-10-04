<?php
require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos

$name=$_POST['nombre'];
$last_name=$_POST['apellido'];
$email=$_POST['correo'];
$id=$_POST['cedula'];
$user=$_POST['user'];
$pass=md5($_POST['password']);

$sql=mysqli_query($con,"INSERT INTO `usuarios`(`cedula`, `apellidos`, `nombres`, `mail`, `id_rol`, `usuario`, `password`) VALUES ('".$id."','".$last_name."','".$name."','".$email."','2','".$user."','".$pass."')");
if($sql){
	header('location: ../index.php?cand=Hex(aa2639koa)');
}else{
	header('location: ../index.php?error=Hex(aa2639koa)');
}

?>

