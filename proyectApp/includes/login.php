<?php
require_once 'login.class.php';
//accedemos al método singleton que es quién crea la instancia
//de nuestra clase y así podemos acceder sin necesidad de
//crear nuevas instancias, lo que ahorra consumo de recursos
$nuevoSingleton = Login::singleton_login();
 
if(isset($_POST['email']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    //accedemos al método usuarios y los mostramos
    $usuario = $nuevoSingleton->login_users($email,$password);
    
    if($usuario == TRUE)
    {
        header("Location: ../controllers/verificar.php");
    }
    if($usuario == FALSE)
    {
    	header("Location: ../index.php?error");
    }
}
?>