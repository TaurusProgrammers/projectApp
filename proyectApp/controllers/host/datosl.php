<?php
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
session_start();
if($_SESSION['name']!=''){
}else{
	header('location: ../verificar.php');
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>PoliticApp</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
		<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="../../assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="../../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="../../assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="../../assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="../../assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="../../assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="../../assets/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="../../assets/js/html5shiv.min.js"></script>
		<script src="../../assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
	
		<?php include 'vistas/header.php';?>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<?php include 'vistas/menu.php';?>

			<div class="main-content">
				<div class="main-content-inner">
					

					<div class="page-content">

						<div class="page-header">
							<center><h1>Estadisticas</h1></center>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<button style="font-size: 16px;" type="submit" class="btn btn-danger" id="guardar_datos" onclick="mostrar();"> <i class="ace-icon fa fa-search bigger-130"></i>Buscar</button><br><br>
								<?php if(isset($_POST['cedula'])){
									?>
									<table id="simple-table" class="table  table-bordered table-hover">
											<thead>
												<tr>
													<th class="detail-col">No.</th>
													<th class="detail-col">Votante</th>
													<th>Cedula</th>
													<th>Municipio</th>
													<th>Celular</th>
													<th>Cumplimiento</th>
												</tr>
											</thead>

											<tbody>
												<?php
													$cont=0;
													$sql=mysqli_query($con, "SELECT nombres, apellidos, cedula, confirm, celular, municipio FROM usuarios WHERE cedula='".$_POST['cedula']."' and lider='".$_GET['lider']."' and id_rol='0'");
													while($sr=mysqli_fetch_assoc($sql)){
														$cont++;
														if($sr['confirm']==1){
															$checked='<td style="color: green;"><center><i class="ace-icon fas fa-check bigger-180"></i></center></td>';
														}else{
															$checked='<td style="color: red;"><center><i class="ace-icon fas fa-times bigger-180"></i></center></td>';
														}
														echo '<tr>';
														echo '<td>'.$cont.'</td>';
														echo '<td>'.$sr['nombres'].' '.$sr['apellidos'].'</td>';
														echo '<td>'.$sr['cedula'].'</td>';
														echo '<td>'.$sr['municipio'].'</td>';
														echo '<td>'.$sr['celular'].'</td>';
														echo $checked;
														echo '</tr>';
													}
												?>
											</tbody>
										</table>
								<?php }else{
									?>
									<table id="simple-table" class="table  table-bordered table-hover">
											<thead>
												<tr>
													<th class="detail-col">No.</th>
													<th class="detail-col">Votante</th>
													<th>Cedula</th>
													<th>Municipio</th>
													<th>Celular</th>
													<th>Cumplimiento</th>
												</tr>
											</thead>

											<tbody>
												<?php
													$cont=0;
													$sql=mysqli_query($con, "SELECT nombres, apellidos, cedula, confirm, celular, municipio FROM usuarios WHERE lider='".$_GET['lider']."' and id_rol='0'");
													while($sr=mysqli_fetch_assoc($sql)){
														$cont++;
														if($sr['confirm']==1){
															$checked='<td style="color: green;"><center><i class="ace-icon fas fa-check bigger-180"></i></center></td>';
														}else{
															$checked='<td style="color: red;"><center><i class="ace-icon fas fa-times bigger-180"></i></center></td>';
														}
														echo '<tr>';
														echo '<td>'.$cont.'</td>';
														echo '<td>'.$sr['nombres'].' '.$sr['apellidos'].'</td>';
														echo '<td>'.$sr['cedula'].'</td>';
														echo '<td>'.$sr['municipio'].'</td>';
														echo '<td>'.$sr['celular'].'</td>';
														echo $checked;
														echo '</tr>';
													}
												?>
											</tbody>
										</table>
								<?php }?>
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<?php 
			include 'modals/modal3.php';
			include 'vistas/footer.php';
			?>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="../../assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="../../assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../../assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script type="text/javascript">
			function mostrar() {
			 	$("#sModal").modal();
			 	document.getElementById('cedula').value='';
			 }
		</script>
		<!-- ace scripts -->
		<script src="../../assets/js/ace-elements.min.js"></script>
		<script src="../../assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				$('#id-change-style').on(ace.click_event, function() {
					var toggler = $('#menu-toggler');
					var fixed = toggler.hasClass('fixed');
					var display = toggler.hasClass('display');
					
					if(toggler.closest('.navbar').length == 1) {
						$('#menu-toggler').remove();
						toggler = $('#sidebar').before('<a id="menu-toggler" data-target="#sidebar" class="menu-toggler" href="#">\
							<span class="sr-only">Toggle sidebar</span>\
							<span class="toggler-text"></span>\
						 </a>').prev();
			
						 var ace_sidebar = $('#sidebar').ace_sidebar('ref');
						 ace_sidebar.set('mobile_style', 2);
			
						 var icon = $(this).children().detach();
						 $(this).text('Hide older Ace toggle button').prepend(icon);
						 
						 $('#id-push-content').closest('div').hide();
						 $('#id-push-content').removeAttr('checked');
						 $('.sidebar').removeClass('push_away');
					 } else {
						$('#menu-toggler').remove();
						toggler = $('.navbar-brand').before('<button data-target="#sidebar" id="menu-toggler" class="three-bars pull-left menu-toggler navbar-toggle" type="button">\
							<span class="sr-only">Toggle sidebar</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>\
						</button>').prev();
						
						 var ace_sidebar = $('#sidebar').ace_sidebar('ref');
						 ace_sidebar.set('mobile_style', 1);
						
						var icon = $(this).children().detach();
						$(this).text('Show older Ace toggle button').prepend(icon);
						
						$('#id-push-content').closest('div').show();
					 }
			
					 if(fixed) toggler.addClass('fixed');
					 if(display) toggler.addClass('display');
					 
					 $('.sidebar[data-sidebar-hover=true]').ace_sidebar_hover('reset');
					 $('.sidebar[data-sidebar-scroll=true]').ace_sidebar_scroll('reset');
			
					 return false;
				});
				
				$('#id-push-content').removeAttr('checked').on('click', function() {
					$('.sidebar').toggleClass('push_away');
				});
			});
		</script>
	</body>
</html>
