<div  class=" panel panel-flat "  >
<div class="panel-heading" id="cuerpo">
	   <?php if($_SESSION['usuario_perfil']==1)
     	
     { ?>
			<button onclick="nuevo()"  class="btn btn-primary legitRipple">Nueva ficha</button>
	   
		<?php }?>
	
	</div>
	<div class="panel-body">
<div class="table-responsive">
<table class="table datatable-basic" id="table_sistema">
	<thead>
		<tr >
			<th width="5%">#</th>
			<th width="25%">Titulo</th>
			<th width="30%">Cliente</th>
			<th width="25%">Asesor</th>
			<th width="10%">Estado</th>
			<th width="5%">Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$c=1;
		$titulo="";
        $estado="";
       foreach ($lista as $value) {
                	 if($value->titulo!=""){$titulo=$value->titulo;}else{$titulo="<label style='color:red;font-size:10px;'>Falta agregar titulo</label>";}
                	echo "<tr>";
                	echo "<td>".$c."</td>";
                    
                	echo "<td>".$titulo."</td>";
                	echo "<td>".$value->cliente_nombre." ".$value->cliente_apellidos."</td>";
                	echo "<td>".$value->trabajador_nombre." ".$value->trabajador_apellido."</td>";
                      if($value->estado==1){
                          $estado='<span class="label label-danger">Asignado</span>';
                      }
                      if($value->estado==2){
                        $estado='<span class="label label-info">Ficha</span>';
                      }
                      if($value->estado==3){
                        $estado='<span class="label label-success">Asesor</span>';
                      }
                      if($value->estado==4){
                         $estado='<span class="label label-success">Horario</span>';
                      }
                      if($value->estado==5){
                       $estado='<span class="label label-success">Pagos</span>';
                      }

                    echo "<td>".$estado."</td>";
                    echo '<td> <ul class="icons-list">';?>
			   <li class="text-primary-600"><a onclick="modificar('<?php echo $value->id_ficha_enfoque; ?>')"  href="#"><i class="icon-pencil7">
			   </i></a></li>

			    <li class="text-danger-600"><a onclick="eliminar('<?php echo $value->id_ficha_enfoque; ?>')" href="#"><i class="icon-trash"></i></a> </li>
												
			<?php echo "</ul></td>
                    </tr>";
                    $c=$c+1;
 
                }
          

         
		?>
	</tbody>
</table>
</div>
</div>
</div>

<script type="text/javascript" src="<?php echo base_url();?>public/modulos/ficha_enfoque.js"></script>
