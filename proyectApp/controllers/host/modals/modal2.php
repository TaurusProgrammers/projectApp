<div class="modal fade" id="sModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Buscar Cedula</h4>
		  </div>
		  <div class="modal-body">
			<form action="" method="post" >
			<div id="resultados_ajax_productos"></div>
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label"><b>Digite Cedula:</b></label>
				<div class="col-sm-8">
					<input type="text" name="cedula" id="cedula">
				</div>
			  </div>
			  
			
		  </div>
		  <div class="modal-footer" style="margin-top: 5%;">
			<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-danger" id="guardar_datos"> <i class="ace-icon fa fa-search bigger-110"></i>Buscar</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>