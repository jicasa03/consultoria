<div class="panel-body">
	<div class="panel panel-white">
		<div class="panel-heading">
			<h6 class="panel-title">Lista de Producción</h6>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
					<li><a data-action="reload"></a></li>
					<li><a data-action="close"></a></li>
				</ul>
			</div>
		</div>

		<table class="table table-lg invoice-archive" id="table_sistema">
			<thead>
				<tr>
					<th>#</th>
					<th>Titulo Enfoque</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($lista as $value) { ?>
				<tr>
					<td><?php echo $value->id_ficha_enfoque;?></td>
					<td><?php echo $value->titulo_enfoque;?></td>
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
<script type="text/javascript" src="<?php echo base_url();?>public/modulos/documentos.js"></script>