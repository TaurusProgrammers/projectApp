<?php
require_once 'includes/login.class.php';
if(isset($_SESSION["name"]) and $_SESSION["name"]!=''){ 
header ("Location: controllers/verificar.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceso</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
.alert-danger-alt { border-color: #B63E5A;background: #E26868;color: #fff; }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>


<div class="container" style="margin-top:5%;">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
          <div class="panel-heading">
        </div>
          <div class="panel-body">
          <?php
if (isset($_GET['error'])) {
    echo '
              <div class="alert alert-danger-alt alert-dismissable">
                <span class="glyphicon glyphicon-certificate"></span>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    ×</button><strong>Acceso Denegado</strong> Revise que sus datos de acceso al sistema sean correctos y vuelva a intentarlo.</div>   

    ';
} else {
    echo '';
}
?>          <center><img src="assets/images/loog.png" class="img-responsive"></center>
<br>
            <form accept-charset="UTF-8" role="form" method="POST" action="includes/login.php">
                    <fieldset>
                <div class="form-group">
                  <input class="form-control" placeholder="Digite nombre de usuario" name="email" id="email" type="text" required>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Contraseña" name="password" id="password" type="password" value="" required>
              </div>
              <input class="btn btn-lg btn-success btn-block" type="submit" value="Iniciar sesión">
               <input class="btn btn-lg btn-info btn-block" type="reset" value="Cancelar">
            </fieldset>
              </form>
          </div>
      </div>
    </div>
  </div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>