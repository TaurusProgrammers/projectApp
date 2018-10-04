<?php
require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos

$name=$_POST['nombre'];
$last_name=$_POST['apellido'];
$email=$_POST['correo'];
$id=$_POST['cedula'];
$zona=$_POST['zona'];
$mesa=$_POST['mesa'];
$ciudad=strtoupper($_POST['ciudad']);
$lider=$_POST['lider'];
$municipio=strtoupper($_POST['municipio']);
$dpto=$_POST['dpto'];
$mesa=$_POST['mesa'];
$dire=$_POST['dire'];
$movil=$_POST['movil'];
$senado=$_POST['senado'];
$camara=$_POST['camara'];
$lugar=$_POST['lugar'];

$sql=mysqli_query($con,"INSERT INTO `usuarios`(`cedula`, `apellidos`, `nombres`, `municipio`, `departamento`, `zona`, `lugar`, `mesa`, `direccion`, `celular`, `mail`, `lider`, `senado`, `camara`, `id_rol`) VALUES ('".$id."','".$name."','".$last_name."','".$municipio."','".$dpto."','".$zona."','".$lugar."','".$mesa."','".$dire."','".$movil."','".$email."','".$lider."','".$senado."','".$camara."','0')");
if($sql){
	header('location: ../index.php?cand=exia');
}else{
	$sqlx=mysqli_query($con, "SELECT lider FROM usuarios WHERE cedula='".$id."' LIMIT 1");
		if(mysqli_num_rows($sqlx)>0){
			$all=mysqli_fetch_assoc($sqlx);
			$querry=mysqli_query($con, "SELECT name, last_name FROM lideres WHERE cedula='".$all['lider']."' LIMIT 1");
			$all2=mysqli_fetch_assoc($querry);
			header('location: ../index.php?dup='.$all2['name'].' '.$all2['last_name']);
		}else{
			header('location: ../index.php?error=109xb658a');
		}
}

?>