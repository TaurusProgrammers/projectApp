<?php
session_start();
if($_SESSION['rol']==1){
	header('location: host/index.php');
}elseif ($_SESSION['rol']==2) {
	header('location: admin/index.php');
}elseif ($_SESSION['rol']==3) {
	header('location: candidato/index.php');
}elseif ($_SESSION['rol']==4) {
	header('location: lideres/index.php');
}elseif ($_SESSION['rol']==5) {
	header('location: vigias/index.php');
}else{
	session_destroy();
	header('location: ../index.php');
}
?>