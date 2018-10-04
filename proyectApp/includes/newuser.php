<?php
require_once 'conexion.class.php';
$conexion = Conexion::singleton_conexion();
$normalpass = $_POST['password'];
$hash = sha1($normalpass);
$sql = "INSERT INTO usuarios (name,password,email) VALUES (:name,:password,:email)";
$q = $conexion->prepare($sql);
$q->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
$q->bindParam(':password', $hash, PDO::PARAM_STR);
$q->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
$q->execute();
header("location: ../index.php")
?>