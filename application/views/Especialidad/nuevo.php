<div class="panel panel-flat">
 <div class="panel-heading">
  
 </div>
<?php 

if(isset($data)){
    if(is_object($data)) {
      $id_especialidad=$data->id_especialidad;
      $descripcion=$data->descripcion;
      $observacion=$data->observacion;
    }
}
    else{
    	 $id_especialidad="";
  $descripcion="";
  $observacion="";
    }

?>

 <div class="panel-body">
<form onsubmit="return guardar()" id="formulario">
<input type="hidden" name="id_especialidad" id="id_especialidad" value="<?php echo $id_especialidad; ?>">
	<div class="row">
		<div class="form-group">
			<label class="control-label col-lg-2">Nombre de Especialidad<span class="text-danger">*</span></label>
				<div class="col-lg-10">
			    	<input type="text" required="true" class="form-control" value="<?php echo $descripcion; ?>" name="descripcion" id="descripcion">
				</div>
		</div>
	 </div>

	
	<div class="row">
	 <div class="form-group">
	   <label class="control-label col-lg-2">Observacion</label>
		<div class="col-lg-10">
			<textarea rows="3 	" cols="5" class="form-control" name="observacion" id="observacion"><?php echo $observacion ?></textarea>
		</div>
	</div>
	</div>
      <br>
      <div class="row">
      <center>
      	 <button type="submit" id="btn_guardar" class="btn btn-primary " ><?php if(isset($data)){echo 'actualizar';}else
      	 {echo 'Registrar';}?></button>
      
      	 <button type="button" class="btn btn-danger" onclick="reload_url('Especialidad','mantenimiento')");">Cancelar</button>
      	 </center>
      </div>
</form>
	</div>
 </div>

<script type="text/javascript">
		
</script>
