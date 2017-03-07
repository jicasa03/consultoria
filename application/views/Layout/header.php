<div class="navbar navbar-inverse navbar-fixed-top bg-indigo">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.html"><img src="<?php echo base_url(); ?>public/assets/images/logo grupo.png" id="iman"></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

			</ul>

			<div class="navbar-right">
				<p class="navbar-text">Bienvenido, <?php echo " ".$_SESSION['usuario']?></p>
				
				<ul class="nav navbar-nav">				
					<li class="dropdown">
						<a href="#" class="dropdown-toggle legitRipple" data-toggle="dropdown" aria-expanded="false">
							<i class="icon-bell2"></i>
							<span class="visible-xs-inline-block position-right">Notificaciones</span>
							
						</a><span class="badge bg-danger-400 media-badge position-right"><div id="notican">0</div></span>


						<div class="dropdown-menu dropdown-content">
							<div class="dropdown-content-heading">
								Notificaciones
								<ul class="icons-list">
									<li><a href="#"><i class="icon-menu7"></i></a></li>
								</ul>
							</div>
                           
							<div id="notificacion">
							   
							</div>
						</div>
					</li>

					
				</ul>


<audio id="sound"></audio>













			</div>
		</div>
	</div>