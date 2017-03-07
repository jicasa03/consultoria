

<script type="text/javascript">
	function selecionar(data2,data1,data3) {
		 
     var listaCompras = "";
     $("input[id=id_tiempo]").each(function (index) {  
       
          data= $(this).val();
          datos=data.split(",");
           
            if( datos[1]==data1 &&  datos[2]==data2)
            { 
            	if(  $(this).prop('checked') ) 
               {
                  $(this).prop("checked",false);
              }
              else
              {
              	$(this).prop("checked",true);
              }
              
            
          
            }
            else
              {
              	$(this).prop("checked",false);
              }

      
    });

    
		  	    $("input[id=id_t]").each(function (index) 
		       {   

                  if($(this).val()==data3) 
               {

                                        if(  $(this).prop('checked') ) 
                                                {
                                            $(this).prop("checked",true);
                                               }
                                   else
                                        {
                                        	$(this).prop("checked",false);
                                           }

              }
              else
              {
              	$(this).prop("checked",false);
              }

		       });
     

        $(".styled, .multiselect-container input").uniform({
        radioClass: "choice"
    });
}
 

</script>


<?php 
if(isset($data))
{
    
    foreach ($data as  $value) {

      $idenfoque=$value->id_ficha_enfoque;

  $id_categoria=$value->id_categoria;
  $id_grado=$value->id_grado;
  $titulo=$value->titulo_enfoque;
  $id_especialidad=$value->id_especialidad;

    }


?>
<script type="text/javascript">
	$(function(){
   $.post(base_url+"Ficha_enfoque/asesores",function(data){
      $('#id_trabajador').empty();
        $('#id_trabajador').append(data);
     
	});

             $.post(base_url+'Ficha_enfoque/data', {id:<?php echo $idenfoque;?>}, function(data, textStatus, xhr) {
            
                $("#nombres").val(data.cliente_nombre);
         $("#apellidos").val(data.cliente_apellidos);
         $("#correo").val(data.cliente_correo);
         $("#telefono").val(data.telefono_cliente);
         $("#universidad").val(data.universidad);
         $("#carrera").val(data.carrera);
         $("#direccion").val(data.direccion_cliente);
         $("#dni").val(data.dni);
         $("#dni1").val(data.dni);
         $("#id_ficha_enfoque").val(data.id_ficha_enfoque);
          $("#id_tipocliente option[value="+ data.tipocliente+"]").attr("selected",true);
           $("#id_tipo_enfoque option[value="+ data.id_tipo_enfoque+"]").attr("selected",true);
          $("#id_categoria option[value="+ data.id_categoria+"]").attr('checked', 'checked');
           $("#id_trabajador option[value="+ data.id_trabajador+"]").attr("selected",true);
                       },"json");
	});
</script>
<?php }
else{
     $id_categoria="";
     $id_grado="";
     $titulo="";
  $id_especialidad="";
   $id_ficha_enfoque="";
  ?>

  <script type="text/javascript">
  	$(function(){
       $.post(base_url+"Ficha_enfoque/asesores",function(data){
      $('#id_trabajador').empty();
        $('#id_trabajador').append(data);
     
	});
  	});
  </script>
 <?php 

}



 ?>

<style>

	

	#calendar {
		max-width: 900px;
		margin: 0 auto;
		width: 900px;
		height: 800px;
		
	}

</style>
    <?php
     if($_SESSION['usuario_perfil']==2)
     	
     {  ?>    
     	    <script type="text/javascript">
     	    $( function() {
     	     $('#formulario1').find('input, textarea, select').attr('disabled','disabled');
     	     $('#btn_form2').attr("disabled",false);
     	     $('#guardar_clientes').attr("disabled",true);
     	      $('#id_tipo_enfoque').attr("disabled",true);
     	      $('#id_trabajador').attr("disabled",true);
     	      
     	   
 var opciones1 = document.getElementsByName("id_especialidad");
for(var i=0; i<opciones1.length; i++) {
opciones1[i].disabled = true;
}
var opciones1 = document.getElementsByName("id_grado");
for(var i=0; i<opciones1.length; i++) {
opciones1[i].disabled = true;
}
var opciones1 = document.getElementsByName("id_categoria");
for(var i=0; i<opciones1.length; i++) {
opciones1[i].disabled = true;
}




     	             $("#tab1").removeClass('active');
           $("#tab2").removeClass('disabledTab');
      $("#tab2").addClass('active');

       $("#bordered-justified-tab1").removeClass('active');
      $("#bordered-justified-tab2").addClass('active');
     	         });
     	     </script>

   <?php   }





    $universidad1=array();

    foreach ($universidad as  $value) {

      $universidad1[]=$value->descripcion;
    }




     ?>
 <style type="text/css">
 	.disabledTab{
    pointer-events: none;
}
 </style>


<div class="panel panel-flat">
  <div class="panel-heading">
  
  </div>

  <div class="panel-body">
    <div class="row">
     <div class="tabbable tab-content-bordered">
	 <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
		<li id="tab1" class="active"><a href="#bordered-justified-tab1" data-toggle="tab" class="legitRipple" aria-expanded="true">Datos Personales</a></li>
		<li id="tab2" ><a href="#bordered-justified-tab2" data-toggle="tab" class="legitRipple" aria-expanded="false">Ficha de enfoque</a></li>
		<li id="tab3" ><a href="#bordered-justified-tab3" data-toggle="tab" class="legitRipple" aria-expanded="false">Asignacion</a></li>
		<li id="tab4" ><a href="#bordered-justified-tab4" data-toggle="tab" class="legitRipple" aria-expanded="false">Horario</a></li>
		<li id="tab5" ><a href="#bordered-justified-tab5" data-toggle="tab" class="legitRipple" aria-expanded="false">pagos</a></li>
		<li id="tab6"><a href="#bordered-justified-tab6" data-toggle="tab" class="legitRipple" aria-expanded="false">Contrato</a></li>
		
	</ul>
		 <div class="tab-content">
	       <div  class="tab-pane has-padding active " id="bordered-justified-tab1">
									
							<form id="formulario1" >
												<div class="row">
													<div class="form-group">
			                                          <label class="control-label col-lg-1">Nombres<span class="text-danger">*</span></label>
				                                     <div class="col-lg-5">
			    	                                   <input type="text" required="true" name="nombres" id="nombres" class="form-control" value="" >
			                                  	      </div>

			                                  	          <label class="control-label col-lg-1">Apellidos<span class="text-danger">*</span></label>
				                                     <div class="col-lg-5">
			    	                                   <input type="text" required="true" class="form-control" name="apellidos" id="apellidos" value="" >
		                                           </div>
		                                           </div>
												</div>
                                                 
                                                 <div class="row">
													<div class="form-group">
			                                          <label class="control-label col-lg-1">DNI<span class="text-danger">*</span></label>
				                                     <div class="col-lg-5">
			    	                                   <input type="text" required="true" maxlength="8" name="dni" id="dni"  class="form-control" value="" >
			                                  	      </div>

			                                  	          <label class="control-label col-lg-1">Telefono<span class="text-danger">*</span></label>
				                                     <div class="col-lg-5">
			    	                                   <input type="text" required="true" maxlength="9" id="telefono" name="telefono" class="form-control" value="" >
		                                           </div>
		                                           </div>
												</div>


                                                     <div class="row">
													<div class="form-group">
			                                          <label class="control-label col-lg-1">Correo<span class="text-danger">*</span></label>
				                                     <div class="col-lg-10">
			    	                                   <input type="text" required="true" id="correo" name="correo" class="form-control" value="" >
			                                  	      </div>

			                                  	    
		                                           </div>
												</div>
												 <div class="row">
													<div class="form-group">
			                                          <label class="control-label col-lg-1">Direccion<span class="text-danger">*</span></label>
				                                     <div class="col-lg-10">
			    	                                   <input type="text" required="true" id="direccion" name="direccion" class="form-control" value="" >
			                                  	      </div>

			                                  	    
		                                           </div>
												</div>
                                                   <br>
												<div class="row">
											      <div class="form-group">
										            <label class="control-label col-lg-1">Departamento:</label>
										            <div class="col-lg-3">
										            	<select name="select" id="departamento" name="departamento" class="form-control">
			                                              <option value="opt1">Selecionar</option>

			                                              <?php
                                                               foreach ($departamento as $value ){
                                                               	echo "<option value='".$value->id_departamento."'>".$value->descripcion."</option>";
                                                               }
			                                              ?>
			                                            </select>
									                </div>
									                <label class="control-label col-lg-1">Provincia:</label>
										            <div class="col-lg-3">
										            	<select name="select" id="provincia" name="departamento" class="form-control">
			                                              <option value="opt1">Selecionar</option>
			                                             
			                                            </select>
									                </div>
									                <label class="control-label col-lg-1">Distrito:</label>
										            <div class="col-lg-3">
										            	<select  id="distrito" name="distrito" class="form-control">
			                                              <option value="opt1">Selecionar</option>
			                                            </select>
									                </div>
								                  </div>          
										         </div>
										         <br>
                                                <div class="row">
                                                	<div class="form-group">
                                                		<label class="control-label col-lg-1">Tipo Cliente:</label>
										            <div class="col-lg-3">
										            	<select  id="id_tipocliente" name="id_tipocliente" class="form-control">
			                                              <?php print_r($tipocliente);
                                                               foreach ($tipocliente as $value ){
                                                               	echo "<option value='".$value->id_tipocliente."'>".$value->descripcion."</option>";
                                                               }
			                                              ?>
			                                             
			                                            </select>
									                </div>

									                <label class="control-label col-lg-1">Universidad<span class="text-danger">*</span></label>
				                                     <div class="col-lg-3">
			    	                                   <input type="text" required="true" id="universidad" name="universidad" class="form-control" value=""  id="universidad">
		                                           </div>

		                                           <label class="control-label col-lg-1">Carrera<span class="text-danger">*</span></label>
				                                     <div class="col-lg-3">
			    	                                   <input type="text" required="true" id="carrera" name="carrera" class="form-control" value="" >
		                                           </div>

                                                	</div>
                                                </div>
											
                                                </form>
                  

												<br>
												<div class="row">
												
				                        	       <center> 
				                        	          <button class="btn btn-danger legitRipple" type="button"  onclick="reload_url('Ficha_enfoque','Tesis')">Cancelar</button>
				                        	         <button id="guardar_clientes" class="btn btn-primary legitRipple">Guardar y seguir</button>
                                                    </center>
				                                
				                                 </div>                                 
		  </div>
                                             
                                                                            
			
		  <div class="tab-pane has-padding " id="bordered-justified-tab2">
		     <form id="formulario_enfoque" > 
		         <input type="hidden" value="<?php echo $idenfoque; ?>" name="id_enfoque" id="id_enfoque" />
		         <input type="hidden" name="dni1" id="dni1">
		        
                      <div class="row">
                      	<div class="col-md-4">
                      	<div class="form-group">
			              <label class="control-label col-lg-6">Tipo de Enfoque<span class="text-danger">*</span></label>
                      		<select class="form-control" value="" name="id_tipo_enfoque" id="id_tipo_enfoque">
                      			 <?php

                      			 foreach ($tipo as $value) {
                      			 	echo "<option value=''>Seleccionar por favor</option>";
                      			 	echo "<option value='".$value->id_tipo_enfoque."'>".$value->descripcion."</option>";
                      			 }

                      			  ?>
                      		</select>
                      		</div>
                      	</div>
                      </div>
                      <br>
                      <div class="row">
                      	<div class="form-group">
			              <label class="control-label col-lg-1">Titulo<span class="text-danger">*</span></label>
				          <div class="col-lg-11">
                          <input type="text" required="true" name="titulo_enfoque" id="titulo_enfoque" class="form-control" value="<?php echo $titulo; ?>" >
			             </div>
	                   </div>
                      </div>
                      <br/>
                      <div class="row">
                       <div class="col-md-4">
                        <div class="form-group">
						  <label class="text-semibold">Categorias</label>
							<?php foreach($categoria as $value){
							
                              if($value->id_categoria==$id_categoria){
                                     echo '<div class="radio">
							<label>
							<input type="radio" value="'.$value->id_categoria.'" id="id_categoria" checked="checked" name="id_categoria" >
												'.$value->descripcion.'
							</label>
						    </div>';
                              }
                            else{
							echo '<div class="radio">
							<label>
							<input type="radio" value="'.$value->id_categoria.'" id="id_categoria" name="id_categoria" >
												'.$value->descripcion.'
							</label>
						    </div>';
						    }
						}
						    ?>
						</div>
						</div>
						<div class="col-md-4">
						 <div class="form-group">
						  <label class="text-semibold">Grado academico</label>
							<?php foreach($grado as $value){
							if($value->id_grado==$id_grado)
							{
                                  echo '<div class="radio">
							<label>
							<input checked="checked" type="radio" value="'.$value->id_grado.'" id="id_grado" name="id_grado" >
												'.$value->descripcion.'
							</label>
						    </div>';
							}
						  else{
                              echo '<div class="radio">
							<label>
							<input type="radio" value="'.$value->id_grado.'" id="id_grado" name="id_grado" >
												'.$value->descripcion.'
							</label>
						    </div>';
						  }
						}
						    ?>
						</div>
                       </div>

                       <div class="col-md-4">
                       	  <div class="panel-body">
									<div class="form-group">
										<label>Seleccionar asesor</label>
										<select class="form-control" id="id_trabajador" name="id_trabajador" >
											<option value="-1">Selecionar asesor</option>
										</select>
									</div>

									
								</div>
                       </div>
                       

                     </div>
                      <div class="row">
                      	<div class="form-group">
							<label class="display-block text-semibold">Especialidad de la tesis</label>
							 <?php foreach($especialidad as $value1){
	    						if($value1->id_especialidad==$id_especialidad){
	    							echo '<label class="radio-inline">
									   <input type="radio" checked="checked" value="'.$value1->id_especialidad.'" name="id_especialidad" id="id_especialidad" >'.$value1->descripcion.'</label>';
	    						   }

	    							else{
	    								echo '<label class="radio-inline">
									   <input type="radio" value="'.$value1->id_especialidad.'" name="id_especialidad" id="id_especialidad" >'.$value1->descripcion.'</label>';
	    							}
								       	
	    							}
                                 ?>
									
									</div>
                      </div>

                     <div class="row">
                     	<center><h2><u>ENFOQUE</u></h2></center>
                     	<rigth><label>(Debe Contener la idea clara de la problematica, ademas debe mostar cataracteristcas detalladas de la empresa o institucion arealizar la investigacion ""Nombre a que se dedica, donde encontrar informacion, deudas, cantidad producida)</label></rigth>
                     </div>

                     <div class="row">
                     	 <div class="form-group">
	                      <label class="control-label col-lg-2">¿Porque?</label>
		                   <div class="col-lg-11">
			               <textarea rows="2 	" cols="5" class="form-control" name="porque" id="porque"></textarea>
		                  </div>
	                     </div>  
                     </div>
                     <div class="row">
                     	 <div class="form-group">
	                      <label class="control-label col-lg-2">¿Para que?</label>
		                   <div class="col-lg-11">
			               <textarea rows="2 	" cols="5" class="form-control" name="paraque" id="paraque"></textarea>
		                  </div>
	                     </div>  
                     </div>
                      <div class="row">
                     	 <div class="form-group">
	                      <label class="control-label col-lg-2">¿Como?</label>
		                   <div class="col-lg-11">
			               <textarea rows="2 	" cols="5" class="form-control" name="como" id="como"></textarea>
		                  </div>
	                     </div>  
                     </div>
                     <div class="row">
                     	 <div class="form-group">
	                      <label class="control-label col-lg-2">¿Donde?</label>
		                   <div class="col-lg-11">
			               <textarea rows="2 	" cols="5" class="form-control" name="donde" id="donde"></textarea>
		                  </div>
	                     </div>  
                     </div>
                     <div class="row">
                     	 <div class="form-group">
	                      <label class="control-label col-lg-2">Variables</label>
		                   <div class="col-lg-11">
			               <textarea rows="1 	" cols="5" class="form-control" name="variables" id="variables"></textarea>
		                  </div>
	                     </div>  
                     </div>
                     <div class="row">
                     	<div class="form-group">
			              <label class="control-label col-lg-2">Diseño de investigacion<span class="text-danger">*</span></label>
				          <div class="col-lg-10">
			    	      <input type="text" required="true" name="dis_inv" id="dis_inv" class="form-control" value="" >
			              </div>
			            </div>
                     </div>
                     <div class="row">
                     	<div class="form-group">
			              <label class="control-label col-lg-1">Muestra<span class="text-danger">*</span></label>
				          <div class="col-lg-11">
			    	      <input type="text" required="true" name="muestra" id="muestra" class="form-control" value="" >
			              </div>
			            </div>
                     </div>
                     <br>
                     <div class="row form-horizontal">
                     	<div class="col-md-4">
                     		<fieldset class="content-group">
									<legend class="text-bold">Antecedentes</legend>

									<div class="form-group">
										<label class="control-label col-lg-5">Años de antiguedad</label>
										<div class="col-lg-7">
											<div class="input-group">
												<input type="text" name="anios_antiguedad" id="anios_antiguedad" class="form-control" >
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-lg-5">Cant. de internacionales</label>
										<div class="col-lg-7">
											<div class="input-group">
												<input type="text" class="form-control" name="cant_inter" id="cant_inter" >
												
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-lg-5">Cant. de Nacionales</label>
										<div class="col-lg-7">
											<div class="input-group">
												
												<input type="text" class="form-control" name="cant_nacio" id="cant_nacio" >
												
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-5">Cant. de Locales</label>
										<div class="col-lg-7">
											<div class="input-group">
												
												<input type="text" class="form-control" name="cant_local" id="cant_local" >
												
											</div>
										</div>
									</div>

								</fieldset>
                     	</div>
                     	<div class="col-md-4">
                     		<fieldset class="content-group">
									<legend class="text-bold">REALIDAD PROBLEMATICA Y MARCO TEORICO</legend>

									<div class="form-group">
										<label class="control-label col-lg-8">Cant. hojas realidad problematica</label>
										<div class="col-lg-4">
											<div class="input-group">
												<input type="text" class="form-control" name="can_realidad" id="can_realidad" >
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-lg-8">Cant. hojas de marco teorico</label>
										<div class="col-lg-4">
											<div class="input-group">
												<input type="text" class="form-control" name="cant_marco" id="cant_marco" >
												
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-lg-8">Años de antiguedad de las teorias</label>
										<div class="col-lg-4">
											<div class="input-group">
												
												<input type="text" class="form-control" name="anio_teoria" id="anio_teoria"	  >
												
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-8">Cantidad de autores</label>
										<div class="col-lg-4">
											<div class="input-group">
												
												<input type="text" class="form-control" name="can_autor" id="can_autor">
												
											</div>
										</div>
									</div>
                                     	<div class="form-group">
										<label class="control-label col-lg-9">Llevar Marco conceptual con autores</label>
										<div class="col-lg-3">
											<div class="input-group">
												 <div class="radio">
							                        <label> 
							                          <input type="radio"  value="si" name="marco_conceptual" checked="checked">
												        Si
							                          </label>
						                           </div>
												<div class="radio">
							                        <label> 
							                          <input type="radio" value="no" name="marco_conceptual" >
												        No
							                          </label>
						                           </div>
												
											</div>
										</div>
								     </div>					
						</fieldset>
                     	</div>
                     	<div class="col-md-4">
                     		<fieldset class="content-group">
									<legend class="text-bold">RESULTADOS</legend>
									<div class="form-group">
										<label class="control-label col-lg-5">Cant. hojas</label>
										<div class="col-md-7">
											<div class="input-group">
												<input type="text" class="form-control" name="res_cant_hojas" id="res_cant_hojas" >
											</div>
										</div>
									</div>
									<div class="form-group ">
										<label class="display-block text-semibold">Resultado por:</label>
										<?php foreach ($resultado as $value) {?>
											
										
										<div class="checkbox">
											<label>
												<span class="checked"><input value="<?php echo $value->id_resultado; ?>" type="checkbox" name="res_por[]" id="res_por[]" class="styled"></span>
												<?php echo $value->descripcion; ?>
																						</label>
										</div>
										<?php }?>
									</div>
							</fieldset>
                     	</div>
                     </div>
                <div class="row">
                   <div class="col-md-4">
                   	  <fieldset class="content-group" >
                   	    <legend>Referencias bibliograficas</legend>
                   	     	<div class="form-group">
							 <label class="control-label col-lg-9">Tipo de normas</label>
								<div class="col-lg-3">
								 <div class="input-group">
								  <?php foreach($tipo_norma as $value){
								  echo '<div class="radio">
							       <label> 
							       <input type="radio" value="'.$value->id_tipo_norma.'" name="id_tipo_norma" id="id_tipo_norma" checked="checked">'.$value->descripcion.'
								    
							      </label>
						        </div>';
							   }?>
												
							  </div>
							 </div>
							</div>
                   	  	 <div class="form-group">

                   	  	     <label class="control-label col-lg-5">Cantidad</label>
							<div class="col-md-7">
							 <div class="input-group">
							  <input type="text" class="form-control" name="bio_cantidad" id="bio_cantidad" >
							 </div>
							</div>
						 </div>
                         <div class="form-group">
										<label class="control-label col-lg-5">Ordenado por:</label>
										<div class="col-lg-7">
											<div class="input-group">
												 <div class="radio">
							                        <label> 
							                          <input type="radio" value="si" name="bio_ordenado" checked="checked">
												        Orden Alfabetico
							                          </label>
						                           </div>
												<div class="radio">
							                        <label> 
							                          <input type="radio" value="no" name="bio_ordenado" >
												        Por tipo
							                          </label>
						                           </div>
												
											</div>
										</div>
								     </div>	

                   	  </fieldset>

                   </div>           	
                </div>
               <div class="row">
                     	 <div class="form-group">
	                      <center><label class="control-label col-lg-12" style="text-transform: uppercase;">Forma y orden de como se expresa los resultados</label></center>
		                   <div class="col-lg-12">
			               <textarea rows="5" cols="5" class="form-control" name="forma_orden" id="forma_orden"></textarea>
		                  </div>
	                     </div>  
                </div>
                <div class="row">
                	<div class="col-md-8">
                		<div class="form-group">
										<label class="control-label col-lg-5">La investigacion¿llevara un plan de mejoramiento?:</label>
										<div class="col-lg-7">
											<div class="input-group">
												 <div class="radio">
							                        <label> 
							                          <input type="radio" value="si" name="plan_mejora" checked="checked">
												        si
							                          </label>
						                           </div>
												<div class="radio">
							                        <label> 
							                          <input type="radio" value="no" name="plan_mejora" >
												       no
							                          </label>
						                           </div>
												
											</div>
										</div>
								     </div>	
                	</div>
                </div>
                
                <div class="row">
                	<center>
                		<div class="row">
							 <center> 
				                <button class="btn btn-danger legitRipple" type="button"  onclick="reload_url('Ficha_enfoque','Tesis')">Cancelar</button>
				                <button id="btn_form2" disabled="true" type="button" class="btn btn-primary legitRipple">Guardar </button>
                              </center>               
				       </div>
                	</center>
                </div>
			</form>
		  </div>
            



			




		  <div class="tab-pane has-padding" id="bordered-justified-tab3">
		  <div id="cabeza-tab3">
		    <form id="formulario2">
		    <input type="hidden" name="id_produccion" value="" id="id_produccion">
		      <div id="cuerpo-tab3">
		      <div class="row"> 
		      	<table class="table table-bordered table-framed">
		      	  <thead>
		      		<tr>
		      			<th width="80%" colspan="2">
		      				<b>FASES A EJECUTAR</b>
		      			</th>
		      			<th colspan="3">
		      				<center>HACER </center>
		      			</th>
		      			<th colspan="3">
		      				<center>CORREGIR</center>
		      			</th>
		      		</tr>
		      		<tr>
		      		    <th></th>
		      			<th></th>
		      			<th><center><b >Bajo</b><br><input id="id_t"  class="styled" value="1" type="checkbox" onclick="selecionar('1','1','1')"/></center></th>
		      			<th><center><b >Medio</b><br><input id="id_t"  class="styled" value="2"   type="checkbox" onclick="selecionar('1','2','2')"/></center></th>
		      			<th><center><b >Dificil</b><br><input id="id_t"  class="styled" value="3"  type="checkbox" onclick="selecionar('1','3','3')"/></center></th>
		      		    <th><center><b >Bajo</b><br><input  id="id_t" class="styled" value="4"  type="checkbox" onclick="selecionar('2','1','4')"></center></th>
		      			<th><center><b >Medio</b><br><input id="id_t"  class="styled" value="5"  type="checkbox" onclick="selecionar('2','2','5')"/></center></th>
		      			<th><center><b >Dificil</b><br><input  id="id_t" class="styled" value="6"  type="checkbox" onclick="selecionar('2','3','6')"/></center></th>
		      		</tr>
		      		</thead>
		      		<tbody id="cuerpo_tabla">
		      		 
		       		</tbody>
		      	</table>
		      </div>
		      </div>
		      <br><br>
		      <div class="row" id="boton3">
							 <center> 
				                <button class="btn btn-danger legitRipple" type="button"  onclick="reload_url('Ficha_enfoque','Tesis')">Cancelar</button>
				                <button id="btn_form3"  type="button" class="btn btn-primary legitRipple">Guardar </button>
                              </center>               
				       </div>
			</form>
			</div>
			<div id="boton2">
				
			</div>
		  </div>







			
		  <div class="tab-pane has-padding" id="bordered-justified-tab4">
			<div id='calendar'></div>
		  </div>
			
		  <div class="tab-pane has-padding" id="bordered-justified-tab5">
		

           <form class="form-horizontal" role="form" id="formulario" onsubmit="return guardar()">

	
	<div class="form-group">
		<label class="col-sm-1 control-label">Monto_Pago.</label>
		<div class="col-md-1">
			<div class="icon-group">
			   	<i class="fa fa-dollar"></i>
			    	<input type="number" class="form-control" name="monto" id="monto" autocomplete="off" onkeyup="sincronograma()" required>
			</div>
		</div>
		<label class="col-sm-1 control-label">Fecha_Pago.</label>
		<div class="col-md-2">
			<input type="date" class="form-control" id="fechaprestamo" name="fechaprestamo" onkeyup="sincronograma()" value="<?php echo date('Y-m-d');?>" max="<?php echo date('Y-m-d');?>" required>
		</div>
		<label class="col-sm-1 control-label">#Partes</label>
		<div class="col-md-1">
			<input type="number" class="form-control" name="semanas" id="semanas" value="4" onkeyup="sincronograma()" required>
		</div>
		<label class="col-sm-1 control-label">Intervalo</label>
		<div class="col-md-2">
			<select class="form-control" name="intervalo" id="intervalo" required onchange="vercronograma()">
				<option value="MENSUAL">MENSUAL</option>
				<option value="DIARIO">DIARIO</option>
				<option value="SEMANAL">SEMANAL</option>
				<option value="QUINCENAL">QUINCENAL</option>
				
			</select>
		</div>
		<div class="col-md-2">
			<button type="button" class="btn btn-primary" onclick="vercronograma()">Ver cronograma</button>
		</div>
	</div> <hr>
	<div class="form-group" id="cronograma"></div>
	<div class="form-group">
		<center>
			<button type="submit" class="btn btn-primary" id="btn_guardar">
				<i class="fa fa-save"></i> Guardar
			</button>
			<button type="button" class="btn btn-danger"  onclick="reload_url('Ficha_enfoque','Tesis')">
				Cancelar - Atras
			</button>
		</center>
	</div>
</form>




















		  </div>
          <div class="tab-pane has-padding" id="bordered-justified-tab6">
			<div class="row">
						<div class="col-md-4">
							<div class="panel panel-body border-top-info">
								<div class="text-center">
									<h6 class="text-semibold no-margin">Asesor</h6>
									<p class="content-group-sm text-muted">jimmy carbajal sanchez</p>
								</div>

								<ul class="dropdown-menu dropdown-menu-sortable" style="display: block; position: static; width: 100%; margin-top: 0; float: none;">
									
														
									
									</ul>
							</div>

							<div class="panel panel-body border-top-info">
								<div class="text-center">
									<h6 class="text-semibold no-margin">Asesor</h6>
									<p class="content-group-sm text-muted">jimmy carbajal sanchez</p>
								</div>

								<ul class="dropdown-menu dropdown-menu-sortable" style="display: block; position: static; width: 100%; margin-top: 0; float: none;">
									
														
									
									</ul>
							</div>
						</div>






						<div class="col-md-4">
							<div class="panel panel-body border-top-info">
								<div class="text-center">
									<h6 class="no-margin text-semibold">Fases del proceso</h6>
									
								</div>

								
								   <div class="form-group">
								   <label class=""><b>Enter your name:</b></label>
								   <ul class="dropdown-menu dropdown-menu-sortable" style="display: block; position: static; width: 100%; margin-top: 0; float: none;">
									 
									<li class=""><a href="#">Something else here</a></li>
									<li class=""><a href="#">One more separated line</a></li>
									<li class=""><a href="#">Action</a></li>
									</ul>
                                   </div>
                                   <div class="form-group">
								   <label class=""><b>Enter your name:</b></label>
								   <ul class="dropdown-menu dropdown-menu-sortable" style="display: block; position: static; width: 100%; margin-top: 0; float: none;">
									 
									<li class=""><a href="#">Something else here</a></li>
									<li class=""><a href="#">One more separated line</a></li>
									<li class=""><a href="#">Action</a></li>
									</ul>
                                   </div>
                                  	
							</div>
						</div>





						<div class="col-md-4">
							<div class="panel panel-body border-top-info">
								<div class="text-center">
									<h6 class="text-semibold no-margin">Asesor</h6>
									<p class="content-group-sm text-muted">jimmy carbajal sanchez</p>
								</div>

								<ul class="dropdown-menu dropdown-menu-sortable" style="display: block; position: static; width: 100%; margin-top: 0; float: none;">
									
														
									
									</ul>
							</div>
						</div>
					</div>
		  </div>
											
	    </div>
	  </div>
   </div>
  </div>
 </div>





                  <div id="modal_large" class="modal fade">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h5 class="modal-title">Ficha de enfoque</h5>
								</div>

								<div class="modal-body">
									<center><iframe id="ficha_enfoque_pdf" src="" width="850px" height="450px"></iframe></center>
								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Cerrar</button>
									<button type="button" id="modal-fase3" data-dismiss="modal" class="btn btn-primary">Continuar</button>
								</div>
							</div>
						</div>
					</div>



				<div id="modal_remote" class="modal">
						<div class="modal-dialog modal-full">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h5 class="modal-title">Horario del asesor : <label id="nombre_asesor"></label></h5>
								</div>

								<div class="modal-body">
									<div id="calendar1"></div>

								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary">Save changes</button>
								</div>
							</div>
						</div>
					</div>



















<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/pages/extra_fullcalendar_formats.js"></script>
<script type="text/javascript">

$( function() {
$(".styled, .multiselect-container input").uniform({
        radioClass: 'choice'
    });


           $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $('#calendar').fullCalendar('render');
       
    });
    $('#myTab a:first').tab('show');

	    $(".styled, .multiselect-container input").uniform({
        radioClass: 'choice'
    });
      
      $( document ).tooltip({
      track: true
    });

   availableTags = <?php echo json_encode($universidad1);?>;
 //  alert(availableTags);
  $('.select').select2({
        minimumResultsForSearch: Infinity
    });


     
    // Select with search
  
    $( "#universidad" ).autocomplete({
      source: availableTags
    });
 

  $('.select-search').select2();


  } );

/*$("#id_trabajador").click(function(event) {
	if($('input:radio[name=id_categoria]:checked').val()!="" && $('input:radio[name=id_grado]:checked').val()!="" && $("'input:radio[name=id_especialidad]:checked'").val()!="")
	{
     alert("dasd");  
	}
	else{
		alert("por favor seleccione grado,especialidad y categoria primero");
	}
});*/

$("#dni").keyup(function(event) {
    $("#dni1").val($("#dni").val());
    var r=$("#dni").val();
    if(r.length==8){
    
    	$.post(base_url+"Ficha_enfoque/traer_un_cliente",{"dni":r},function(data){
    		//alert(data);
         $("#nombres").val(data.nombres);
         $("#apellidos").val(data.apellidos);
         $("#correo").val(data.correo);
         $("#telefono").val(data.telefono);
         $("#universidad").val(data.descripcion);
         $("#carrera").val(data.carrera);
         $("#direccion").val(data.direccion);
            $.post(base_url+"Ficha_enfoque/distrito_lista",{"id_distrito":data.id_distrito},function(data){
                 $('#distrito').empty();
        $('#distrito').append(data);
        $("#distrito option[value="+ data.id_distrito+"]").attr("selected",true);
            });
      


     $("#id_tipocliente option[value="+ data.id_tipocliente +"]").attr("selected",true);
	},"json");
    }
});

$("#id_trabajador").change(function(event) {
  var id=$("#id_trabajador").val(); 
  var opcion_seleccionada = $("#id_trabajador option[value="+id+"]").text();
 
 if(id!="-1")
 {
 	$("#nombre_asesor").html("<b>"+opcion_seleccionada+"</b>");
 	$("#modal_remote").modal();
 	$('#calendar1').fullCalendar({
 	     height: 500,
 	     width: 100,
				
				header: 
			{
				left: 'prev,next today',
				center: 'title',
				right: 'agendaWeek,agendaDay,listWeek'
			},
			hiddenDays: [ 0 ] ,
			defaultView: 'agendaWeek',
     	defaultDate: '2017-02-12',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			
    });
 }


  // alert($("#formulario_enfoque").serialize());
	$.post(base_url+"Ficha_enfoque/guardar_ficha_admin",$("#formulario_enfoque").serialize(),function(data){
     //alert(data);

	});
});



	 $("#departamento").change(function(event) {
  $.post(base_url+"Ficha_enfoque/provincia",{"id": $("#departamento").val()},function(data){
     // alert(data);
      $('#provincia').empty();

        $('#provincia').append(data);
   });
 
  });

    $("#provincia").change(function(event) {
  $.post(base_url+"Ficha_enfoque/distrito",{"id": $("#provincia").val()},function(data){
  //  alert(data);
      $('#distrito').empty();
        $('#distrito').append(data);
   });
 
  });

    $("#guardar_clientes").click(function(){
 

        $("#tab1").removeClass('active');
           $("#tab2").removeClass('disabledTab');
      $("#tab2").addClass('active');

       $("#bordered-justified-tab1").removeClass('active');
      $("#bordered-justified-tab2").addClass('active');

      /*$.post(base_url+"Ficha_enfoque/registrarcliente",$("#formulario1").serialize(),function(data){
      //alert(data);
     
	});*/
    });


$("#tab4").click(function(event) {

		$('#calendar').fullCalendar({
				
				header: 
			{
				left: 'prev,next today',
				center: 'title',
				right: 'agendaWeek,agendaDay,listWeek'
			},
			hiddenDays: [ 0 ] ,
			defaultView: 'agendaWeek',
     	defaultDate: new Date(),
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			
    });
		
		
});



function vercronograma(){
	if($("#fechaprestamo").val()==""){
		$("#fechaprestamo").focus(); return 0;
	}
	if($("#monto").val()==""){
		$("#monto").focus(); return 0;
	}
	if($("#semanas").val()==""){
		$("#semanas").focus(); return 0;
	}

	$("#cronograma").empty().html('<center> <h1><i class="fa fa-spin fa-spinner"></i></h1> </center>');
	$.post(base_url+"Ficha_enfoque/cronograma_prestamo",$("#formulario").serialize(),function(data){
          $('#cronograma').empty().html(data);
     	});
}

function sincronograma(){
	$("#cronograma").empty();
}






$("#btn_form2").click(function(event) {
	//alert($("#formulario_enfoque").serialize());
	$.post(base_url+'Ficha_enfoque/ingresar', $("#formulario_enfoque").serialize(), function(data, textStatus, xhr) {
	 var ruta=base_url+"pdf/crear.php?id="+$("#id_enfoque").val();
	 var iframe = document.getElementById("ficha_enfoque_pdf");
     iframe.setAttribute("src", ruta);
	 $("#modal_large").modal();
         

         $.post(base_url+'Ficha_enfoque/categoria_subfases', {id_categoria: $("#id_categoria").val(),id_tipo_enfoque:$("#id_tipo_enfoque").val()}, function(data, textStatus, xhr) {
         //	alert(data);
         	$('#cuerpo_tabla').empty();
            $('#cuerpo_tabla').append(data);
         });

	});
});
</script>

<script type="text/javascript">
	$(function(){
         // Dragula
    // ------------------------------

    // Draggable panels
    dragula([document.getElementById('panels-target-left'), document.getElementById('panels-target-right')]);


    // Draggable forms
    dragula([document.getElementById('forms-target-left'), document.getElementById('forms-target-right')]);


    // Draggable media lists
    dragula([document.getElementById('media-list-target-left'), document.getElementById('media-list-target-right')], {
        mirrorContainer: document.querySelector('.media-list-container'),
        moves: function (el, container, handle) {
            return handle.classList.contains('dragula-handle');
        }
    });


    //
    // Dropdown menu items
    //

    // Define containers
    var containers = $('.dropdown-menu-sortable').toArray();

    // Init dragula
    dragula(containers, {
            mirrorContainer: document.querySelector('.dropdown-menu-sortable')
    });

     
	});

	$("#modal-fase3").click(function(event) {
		//alert("hola");
		 document.body.scrollTop = 0;
                $("#tab3").removeClass('disabledTab');
      $("#tab3").addClass('active');
      $("#tab2").removeClass('active');
       $("#bordered-justified-tab2").removeClass('active');
      $("#bordered-justified-tab3").addClass('active');
      $.post(base_url+'Ficha_enfoque/estado3', {id_enfoque:$("#id_enfoque").val()}, function(data, textStatus, xhr) {
      	
      });
			});

 $("#btn_form3").click(function(event) {
   
 // alert($("#formulario2").serialize());
  $.ajax({
    url:base_url+"Ficha_enfoque/asesores_subfase",
    data:"id_enfoque="+$("#id_enfoque").val()+"&"+$("#formulario2").serialize(),
    type:"post",
     dataType: "json",
   
    success: function(data) {
  //alert(data);
     $("#id_produccion").val(data.id_produccion);
      $("#cuerpo-tab3").empty();
      $("#cuerpo-tab3").append(data.asesores);
       $("#boton3").empty();
       $("#boton3").append(data.boton);
    }
  });

  });




function horario(id){
	$.post(base_url+'Ficha_enfoque/horario', {id: id}, function(data, textStatus, xhr) {
		
	});

}

function boton(){
	 $.ajax({
    url:base_url+"Ficha_enfoque/asignacion",
    data:"id_produccion="+$("#id_produccion").val()+"&"+$("#formulario2").serialize(),
    type:"post",
     dataType: "json",
   
    success: function(data) {
  
    }
  });
}
              
            
</script>


              

