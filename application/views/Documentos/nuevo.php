<div class="panel panel-flat">
<div class="panel-heading">
	
<head>
	<meta charset="utf-8">
	<link href="../public/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
	<script src="../public/js/fileinput.js" type="text/javascript"></script>
</head>
<div class="container">
	<h1>Subir Archivos</h1>

	<br>
	<input id="id_archivo" type="hidden" value="<?php echo $id ;?>">
	<input id="activo" type="hidden" value="<?php echo base_url() ?>">
	<input id="archivos" name="imagenes[]" type="file" multiple=true class="file-loading">
	<br>

</div>

<div id="modal_default" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-body">
				<div class="form-group">
					<label class="control-label col-lg-2">Descripcion</label>
					<div class="col-lg-10">
						<input type="text" name="descripcion" id="descripcion" class="form-control" >

					</div>
				</div>
				<br>
				<br>
				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal" id="negacion">Cancelar</button>
					<button type="button" class="btn btn-primary" data-toggle="modal" id="confirmacion" value="si">Guardar</button>
				</div>
			</div>
		</div>
	</div>
</div>
<table class="table table-lg invoice-archive" id="table_sistema">
	<thead>
		<tr>
			<th>#</th>
			<th>Titulo Enfoque</th>
			<th>Archivo</th>
			<th>Observación</th>
			<th>Tipo Transacción</th>
			<th>Fecha de Transacción</th>
			<th class="text-center">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($lista as $value) { ?>
		<tr>
			<td><?php echo $value->id_ficha_enfoque;?></td>
			<td><?php echo $value->titulo_enfoque;?></td>
			<td><?php echo $value->nombre_archivo;?></td>
			<td><?php echo $value->observacion;?></td>
			<td><?php echo $value->descripcion;?></td>
			<td><?php echo $value->fecha_movimiento;?></td>
			<td class="text-center">
				<ul class="icons-list">
					<li><a href="#" data-toggle="modal" data-target="#invoice" onclick="ver('<?php echo $value->id_ficha_enfoque;?>')"><i class="icon-file-eye"></i></a></li>
				</ul>
			</td>
		</tr>
		<?php }	?>
	</tbody>
</table>
</div>
</div>
<!-- The blueimp Gallery widget -->

<!-- The template to display files available for upload -->



<script type="text/javascript">
	<?php 	echo $directory =  "archivos/".$id."/";?> 
	<?php   
	$images = glob($directory . "*.*");
	?>
 $("#table_sistema").DataTable();
	$("#archivos").fileinput({
		uploadUrl: base_url+"Usuario_c/prueba", 
		uploadAsync: false,
		showUpload: false, 
		showRemove: false,
		showUploadFile: true, 
		showBrowse:false,

		previewFileIcon: '',
		preferIconicPreview: true,

		uploadExtraData: function() {
			return {
				descrip: $("#descripcion").val(),
				id_ficha: $("#id_archivo").val()
			};
		},

		initialPreview: [
		<?php foreach($images as $image){?>

			"<video src='<?php echo base_url().utf8_decode($image); ?>' height='120px' class='kv-preview-data file-preview-video'>",
			<?php } ?>],
			fileActionSettings: { showRemove: false,
				uploadTitle: 'Upload file' } ,
				initialPreviewConfig: [<?php foreach($images as $image){ $infoImagenes=explode("/",$image);?>
				{caption: "<?php echo $infoImagenes[2];?>",  height: "120px", url:base_url+"Usuario_c/borrar", key:"<?php echo $infoImagenes[2].'';?>",key1 :"<?php echo '2' ?>"},
				<?php } ?>],
	 // this will force thumbnails to display icons for following file extensions
	        previewFileIconSettings: { // configure your icon file extensions
	        	'doc': '<i class="fa fa-file-word-o text-primary"></i>',
	        	'xls': '<i class="fa fa-file-excel-o text-success"></i>',
	        	'ppt': '<i class="fa fa-file-powerpoint-o text-danger"></i>',
	        	'pdf': '<i class="fa fa-file-pdf-o text-danger"></i>',
	        	'zip': '<i class="fa fa-file-archive-o text-muted"></i>',
	        	'htm': '<i class="fa fa-file-code-o text-info"></i>',
	        	'txt': '<i class="fa fa-file-text-o text-info"></i>',
	        	'mov': '<i class="fa fa-file-movie-o text-warning"></i>',
	        	'mp3': '<i class="fa fa-file-audio-o text-warning"></i>',
	            // note for these file types below no extension determination logic 
	            // has been configured (the keys itself will be used as extensions)
	            'jpg': '<i class="fa fa-file-photo-o text-danger"></i>', 
	            'gif': '<i class="fa fa-file-photo-o text-muted"></i>', 
	            'png': '<i class="fa fa-file-photo-o text-primary"></i>'    
	        },
	        previewFileExtSettings: { // configure the logic for determining icon file extensions
	        	'doc': function(ext) {
	        		return ext.match(/(doc|docx)$/i);
	        	},
	        	'xls': function(ext) {
	        		return ext.match(/(xls|xlsx)$/i);
	        	},
	        	'ppt': function(ext) {
	        		return ext.match(/(ppt|pptx)$/i);
	        	},
	        	'zip': function(ext) {
	        		return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
	        	},
	        	'htm': function(ext) {
	        		return ext.match(/(htm|html)$/i);
	        	},
	        	'txt': function(ext) {
	        		return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
	        	},
	        	'mov': function(ext) {
	        		return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
	        	},
	        	'mp3': function(ext) {
	        		return ext.match(/(mp3|wav)$/i);
	        	},
	        },

	    }).on("filebatchselected", function(event, files) {
	    	var res = $("#modal_default").modal('show');
	    	$('#confirmacion').click(function(){
	    		$("#archivos").fileinput("upload");
	    		$('#archivos').fileinput('reset');
	    		$("#modal_default").modal('hide');
	    		$("#descripcion").val('');
	    	});

	    	$('#negacion').click(function(){
	    		$("#modal_default").modal('hide');
	    		$('#archivos').fileinput('reset');
	    		$("#descripcion").val('');
	    	});

	    });

	</script>
}
