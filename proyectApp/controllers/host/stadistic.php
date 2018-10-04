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
								<table id="simple-table" class="table  table-bordered table-hover">
											<thead>
												<tr>
													<th class="detail-col">Candidato</th>
													<th>Cargo</th>
													<th>Votos Realizados</th>
													<th>Votos Proyectados</th>
													<th>Cumplimiento</th>
													<th>Porcentaje De Cumplimiento</th>
												</tr>
											</thead>

											<tbody>
												<?php
													$año=date ("Y");
													$sql=mysqli_query($con, "SELECT * FROM candidatos WHERE ano_actual='".$año."'");
													while ($row=mysqli_fetch_assoc($sql)) {
														$name=$row['name_cand'].' '.$row['last_name_cand'];
														$cargo=$row['id_cargo'];
														$candi=$row['id_cand'];
														$votos=0;
														$candv=0;
														$var='';
														if($cargo==1){
															$var='Senado';
															$cont=mysqli_query($con, "SELECT confirm FROM usuarios WHERE senado='".$candi."'");
															while ($rs=mysqli_fetch_assoc($cont)) {
																if($rs['confirm']==1){
																	$votos++;
																	$candv++;
																}else{
																	$candv++;
																}
															}
														}elseif ($cargo==2) {
															$var='Camara';
															$cont=mysqli_query($con, "SELECT confirm FROM usuarios WHERE camara='".$candi."'");
															while ($rs=mysqli_fetch_assoc($cont)) {
																if($rs['confirm']==1){
																	$votos++;
																	$candv++;
																}else{
																	$candv++;
																}
															}
														}else{
															echo "ERROR!!!";
														}
															$porcentaje=($votos/$candv)*100;
														if($porcentaje<=64){
															$vista='<td><center><b style="color: red;">'.$votos.'</b></center></td>'.
														'<td style="color: blue;"><center><b>'.$candv.'</b></center></td>'.
														'<td style="color: blue;"><center><b>'.$votos.' / '.$candv.'</b></center></td>'.
														'<td style="color: red;"><center><b>'.$porcentaje.'%'.'</b></center></td>';
														}elseif ($porcentaje<=84 and $porcentaje>=65) {
															$vista='<td><center><b style="color: orange;">'.$votos.'</b></center></td>'.
														'<td style="color: blue;"><center><b>'.$candv.'</b></center></td>'.
														'<td style="color: blue;"><center><b>'.$votos.' / '.$candv.'</b></center></td>'.
														'<td style="color: orange;"><center><b>'.$porcentaje.'%'.'</b></center></td>';
														}elseif ($porcentaje>=85) {
															$vista='<td><center><b style="color: green;">'.$votos.'</b></center></td>'.
														'<td style="color: blue;"><center><b>'.$candv.'</b></center></td>'.
														'<td style="color: blue;"><center><b>'.$votos.' / '.$candv.'</b></center></td>'.
														'<td style="color: green;"><center><b>'.$porcentaje.'%'.'</b></center></td>';
														}
														echo '<tr>';
														echo '<td><a href="datos.php?cand='.$candi.'&car='.$cargo.'" target="_blank"><b>'.$name.'</b></td>';
														echo '<td><center><b>'.$var.'</b></center></td>';
														echo $vista;
														echo '</tr>';
													}

												?>
											</tbody>
										</table>
										<br>
										<div class="page-header">
											<center><h1>Lideres Estadistica</h1></center>
										</div>
										<button style="font-size: 16px;" type="submit" class="btn btn-danger" id="guardar_datos" onclick="mostrar();"> <i class="ace-icon fa fa-search bigger-130"></i>Buscar</button><br><br>
										<?php if(isset($_POST['cedula'])){
										?>
											<table id="simple-table" class="table  table-bordered table-hover">
											<thead>
												<tr>
													<th class="detail-col">Lideres</th>
													<th>Cedula</th>
													<th>Senado</th>
													<th>Camara</th>
													<th>Votos Proyectados</th>
													<th>Votos Realizados</th>
													<th>Cumplimiento</th>
												</tr>
											</thead>

											<tbody>
												<?php
													$año=date ("Y");
													$sqlc=mysqli_query($con, "SELECT * FROM lideres WHERE cedula='".$_POST['cedula']."'");
													while ($res=mysqli_fetch_assoc($sqlc)) {
														$name=$res['name'];
														$last=$res['last_name'];
														$cedula=$res['cedula'];
														$senado='';
														$camara='';
														$votos=0;
														$votosr=0;
														$sn=mysqli_query($con, "SELECT senado, camara FROM usuarios WHERE lider='".$cedula."' LIMIT 1");
														if($sns=mysqli_fetch_assoc($sn)){
															$senado=$sns['senado'];
															$camara=$sns['camara'];
															$names='';
															$namec='';
															$search=mysqli_query($con, "SELECT name_cand, last_name_cand FROM candidatos WHERE id_cand='".$senado."' LIMIT 1");
															if($sr=mysqli_fetch_assoc($search)){
																$names=$sr['name_cand'].' '.$sr['last_name_cand'];
															}
															$search=mysqli_query($con, "SELECT name_cand, last_name_cand FROM candidatos WHERE id_cand='".$camara."' LIMIT 1");
															if($sr=mysqli_fetch_assoc($search)){
																$namec=$sr['name_cand'].' '.$sr['last_name_cand'];
															}
														}
														$vt=mysqli_query($con, "SELECT COUNT(cedula) FROM usuarios WHERE lider='".$cedula."'");
														if($vts=mysqli_fetch_assoc($vt)){
															$votos=$vts['COUNT(cedula)'];
														}
														$vtr=mysqli_query($con, "SELECT COUNT(cedula) FROM usuarios WHERE lider='".$cedula."' and confirm='1'");
														if($vtrs=mysqli_fetch_assoc($vtr)){
															$votosr=$vtrs['COUNT(cedula)'];
														}
														echo '<tr>';
														echo '<td><a href="datosl.php?lider='.$cedula.'" target="_blank"><b>'.$name.' '.$last.'</b></td>';
														echo '<td>'.$cedula.'</td>';
														echo '<td><b>'.$names.'</b></td>';
														echo '<td><b>'.$namec.'</b></td>';
														echo '<td><center>'.$votos.'</center></td>';
														echo '<td><center>'.$votosr.'</center></td>';
														echo '<td><center><b style="color: red;">'.$votosr.' / '.$votos.'</center></td>';
													}
												?>
											</tbody>
										</table>
										<?php }else{
											?>
											<table id="simple-table" class="table  table-bordered table-hover">
											<thead>
												<tr>
													<th class="detail-col">Lideres</th>
													<th>Cedula</th>
													<th>Senado</th>
													<th>Camara</th>
													<th>Votos Proyectados</th>
													<th>Votos Realizados</th>
													<th>Cumplimiento</th>
												</tr>
											</thead>

											<tbody>
												<?php
													$año=date ("Y");
													$sqlc=mysqli_query($con, "SELECT * FROM lideres");
													while ($res=mysqli_fetch_assoc($sqlc)) {
														$name=$res['name'];
														$last=$res['last_name'];
														$cedula=$res['cedula'];
														$senado='';
														$camara='';
														$votos=0;
														$votosr=0;
														$sn=mysqli_query($con, "SELECT senado, camara FROM usuarios WHERE lider='".$cedula."' LIMIT 1");
														if($sns=mysqli_fetch_assoc($sn)){
															$senado=$sns['senado'];
															$camara=$sns['camara'];
															$names='';
															$namec='';
															$search=mysqli_query($con, "SELECT name_cand, last_name_cand FROM candidatos WHERE id_cand='".$senado."' LIMIT 1");
															if($sr=mysqli_fetch_assoc($search)){
																$names=$sr['name_cand'].' '.$sr['last_name_cand'];
															}
															$search=mysqli_query($con, "SELECT name_cand, last_name_cand FROM candidatos WHERE id_cand='".$camara."' LIMIT 1");
															if($sr=mysqli_fetch_assoc($search)){
																$namec=$sr['name_cand'].' '.$sr['last_name_cand'];
															}
														}
														$vt=mysqli_query($con, "SELECT COUNT(cedula) FROM usuarios WHERE lider='".$cedula."'");
														if($vts=mysqli_fetch_assoc($vt)){
															$votos=$vts['COUNT(cedula)'];
														}
														$vtr=mysqli_query($con, "SELECT COUNT(cedula) FROM usuarios WHERE lider='".$cedula."' and confirm='1'");
														if($vtrs=mysqli_fetch_assoc($vtr)){
															$votosr=$vtrs['COUNT(cedula)'];
														}
														echo '<tr>';
														echo '<td><a href="datosl.php?lider='.$cedula.'" target="_blank"><b>'.$name.' '.$last.'</b></td>';
														echo '<td>'.$cedula.'</td>';
														echo '<td><b>'.$names.'</b></td>';
														echo '<td><b>'.$namec.'</b></td>';
														echo '<td><center>'.$votos.'</center></td>';
														echo '<td><center>'.$votosr.'</center></td>';
														echo '<td><center><b style="color: red;">'.$votosr.' / '.$votos.'</center></td>';
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
			include 'modals/modal.php';
			include 'vistas/footer.php'
			;?>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->
		<script type="text/javascript">
			function mostrar() {
			 	$("#sModal").modal();
			 	document.getElementById('cedula').value='';
			 }
		</script>
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
