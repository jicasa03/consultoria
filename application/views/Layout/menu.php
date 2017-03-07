			<!-- Main sidebar -->
			<div class="sidebar sidebar-main sidebar-default sidebar-fixed">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user-material">
						<div class="category-content">
							<div class="sidebar-user-material-content">
								<a href="#"><img src="<?php echo base_url()?>public/perfil/<?php echo $_SESSION['imagen'];?>" class="img-circle img-responsive" alt=""></a>
								<h6><?php echo $_SESSION['usuario_nombre'];?></h6>
								<span class="text-size-small"><?php echo $_SESSION['perfil'].",".$_SESSION['sede'];?></span>
							</div>

							<div class="sidebar-user-material-menu">
								<a href="#user-nav" data-toggle="collapse"><span>Mi cuenta</span> <i class="caret"></i></a>
							</div>
						</div>
						
						<div class="navigation-wrapper collapse" id="user-nav">
							<ul class="navigation">
								<li><a href="#"><i class="icon-user-plus"></i> <span>Mi perfil</span></a></li>
								<li><a href="#"><i class="icon-cog5"></i> <span>Configurar Cuenta</span></a></li>
								<li><a href="<?php echo base_url();?>Login/destroy_login"><i class="icon-switch2"></i> <span>Salir</span></a></li>
							</ul>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<li class="navigation-header"><span>Menu</span> <i class="icon-menu" title="Main pages"></i></li>
								<li class="active"><a href="index.html"><i class="icon-home4"></i> <span>Inicio</span></a></li>
								<?php foreach ($lista_modulos as $value) { 
									if(count($value["lista"])>0){ ?>
									<li>
										<a href="#"><i class="<?php echo strtolower($value["mod_icono"])?>"></i> <span><?php echo ($value["mod_descripcion"])?></span></a>
										<ul>
											<?php foreach ($value["lista"] as $val) { ?>
											<li><a href="#" onclick="reload_url('<?php echo $val["mod_url"]?>','<?php echo strtolower($value["mod_descripcion"])?>')">
												<i class="<?php echo strtolower($val["mod_icono"])?>"></i><?php echo $val["mod_descripcion"]?></a></li>
											<?php } 	?>	
										</ul>
									</li>
									<?php } 
								}
								?>
								<!-- /forms -->

								<!-- Appearance -->

								<!-- /page kits -->

							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->


			<!-- Main content -->
			
			<!-- /main content -->
