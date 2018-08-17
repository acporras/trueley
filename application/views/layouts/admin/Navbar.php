	<!-- Main navbar -->
<style>
	.navbar-brand {
		float: none !important;
	}

</style>
	<div class="navbar navbar-inverse <?php echo $conf['navColor'] ?>">
		<div class="navbar-header">
			<center>
				<a class="navbar-brand" href="<?php echo $url ?>home"><img src="<?php echo $url ?>assets/images/columna_blanca.png" alt="" style="width:30px !important; margin-bottom: -13px !important;" ></a>
			</center>
			<!--a class="navbar-brand" href="<?php echo $url ?>home"><?php echo $conf['appname'] ?></a-->

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
				<p class="navbar-text"><?php echo str_replace("%nombre%", $this->_session->data->nombre, $this->lang->line('saludo_barra') ) ?></p>
				<p class="navbar-text"><span class="label bg-success-400">Online</span></p>
			<?php if($this->_session->data->nivel == 'Client' || $this->_session->data->nivel == 'User' ){ ?>
				<ul class="nav navbar-nav">				
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-bell2"></i>
							<span class="visible-xs-inline-block position-right">Novedades</span>
							<span class="status-mark border-orange-400"></span>
						</a>

						<div class="dropdown-menu dropdown-content">
							<div class="dropdown-content-heading">
								Novedades
								<ul class="icons-list">
									<li><a href="#"><i class="icon-menu7"></i></a></li>
								</ul>
							</div>

							<ul class="media-list dropdown-content-body width-350">
							<?php if($novedades){ foreach($novedades as $nove){ ?>
								<li class="media">
									<div class="media-left">
										<a href="#" class="btn bg-success-400 btn-rounded btn-icon btn-xs"><i class="icon-mention"></i></a>
									</div>
									<div class="media-body">
										<?php echo $nove->info ?>
										<div class="media-annotation"><?php echo date("d-m-Y H:i a", strtotime($nove->fecha)) ?></div>
									</div>
								</li>
							<?php } }else{ ?>
								<li class="media">
									<div class="media-left">
										<a href="#" class="btn bg-success-400 btn-rounded btn-icon btn-xs"><i class="icon-mention"></i></a>
									</div>
									<div class="media-body">
										Sin Novedades
									</div>
								</li>
							<?php } ?>
							</ul>
						</div>
					</li>
				</ul>
			<?php } ?>

			</div>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">