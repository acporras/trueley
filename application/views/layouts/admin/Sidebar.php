<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-default">
	<div class="sidebar-content">

		<!-- User menu -->
		<div class="sidebar-user-material">
			<div class="category-content">
				<div class="sidebar-user-material-content">
					<a href="#" class="cambiaimagen" style="border-radius:50% !important"><img src="<?php echo ($this->_session->data->foto==null) ? $url.$this->_conf['imguser'] : $this->_session->data->foto ?>" class="img-circle img-responsive" alt=""></a>
					<h6 class="uk-text-capitalize"><?php echo $this->_session->data->nombre ?></h6>
					<span class="text-size-small"><?php echo $this->_session->data->usuario; ?></span>
				</div>
											
				<div class="sidebar-user-material-menu">
					<a href="#user-nav" data-toggle="collapse"><span><?php echo $this->lang->line('mi_cuenta'); ?></span> <i class="caret"></i></a>
				</div>
			</div>
			
			<div class="navigation-wrapper collapse" id="user-nav">
				<ul class="navigation">
					<!--li class="<?php echo ($clase=="companyprofile") ? 'active' : ''; ?>"><a href="<?php echo $url ?>companyprofile"><i class="icon-user-plus"></i> <span><?php echo $this->lang->line('mi_perfil'); ?></span></a></li-->
					<li class="divider"></li>
					<!--li><a href="#"><i class="icon-cog5"></i> <span><?php echo $this->lang->line('mi_configuracion'); ?></span></a></li-->
					<li><a href="<?php echo $url ?>login/logout"><i class="icon-switch2"></i> <span><?php echo $this->lang->line('salir'); ?></span></a></li>
				</ul>
			</div>
		</div>
		<!-- /user menu -->


		<!-- Main navigation -->
		<div class="sidebar-category sidebar-category-visible">
			<div class="category-content no-padding">
				<ul class="navigation navigation-main navigation-accordion">

					<!-- Main>								
					<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li -->
					
					<?php if($this->_session->data->nivel == "Webmaster"){ ?>
						<li class="<?php echo ($clase=="docs") ? 'active' : ''; ?>"><a href="<?php echo $url ?>docs"><i class="icon-home4"></i> <span>Docs</span></a></li>
					<?php } ?>

					<?php if($this->_session->data->nivel == "Admin" || $this->_session->data->nivel == "Webmaster"){ ?>
						<li class="<?php echo ($clase=="desktop") ? 'active' : ''; ?>"><a href="<?php echo $url ?>home"><i class="icon-home4"></i> <span>Escritorio</span></a></li>
					
						<li class="<?php echo ($clase=="admins") ? 'active' : ''; ?>"><a href="<?php echo $url ?>admins"><i class="icon-portfolio"></i> <span>Gestión de Administradores</span></a></li>
						
						<li class="<?php echo ($clase=="lawyers") ? 'active' : ''; ?>"><a href="<?php echo $url ?>lawyers"><i class="icon-users"></i> <span>Gestión de Clientes</span></a></li>
						
						<li class="<?php echo ($clase=="administracion") ? 'active' : ''; ?>"><a href="<?php echo $url ?>administracion"><i class="icon-cash3"></i> <span>Administración</span></a></li>
						<li class="<?php echo ($clase=="adminconfig") ? 'active' : ''; ?>"><a href="<?php echo $url ?>adminconfig"><i class="icon-gear"></i> <span>Configuracion</span></a></li>
				
					<?php } ?>



					<?php if($this->_session->data->nivel == "User" || $this->_session->data->nivel == "Client"){ ?>
						<li class="<?php echo ($clase=="desktop") ? 'active' : ''; ?>"><a href="<?php echo $url ?>home"><i class="icon-home4"></i> <span>Escritorio</span></a></li>
					
						<li class="<?php echo ($clase=="expedientes") ? 'active' : ''; ?>"><a href="<?php echo $url ?>expedientes"><i class="icon-portfolio"></i> <span>Gestión de Expedientes</span></a></li>

						<?php if($this->_session->data->nivel == "Client"){ ?>
							<li class="<?php echo ($clase=="clientusers") ? 'active' : ''; ?>"><a href="<?php echo $url ?>clientusers"><i class="icon-gear"></i> <span>Gestión de Usuarios</span></a></li>
							<li class="<?php echo ($clase=="lawyerconf") ? 'active' : ''; ?>"><a href="<?php echo $url ?>lawyerconf"><i class="icon-gear"></i> <span>Pagos</span></a></li>
						<?php } ?>
				
					<?php } ?>


					<!--li <?php switch($clase){ case 'branchs': case 'newbranch': case '': echo 'active'; break; default: echo ""; break; }; ?>>
						<a href="#"><i class="icon-stack2"></i> <span>Sucursales</span></a>
						<ul>
							<li class="<?php echo ($clase=="newbranch") ? 'active' : ''; ?>"><a href="<?php echo $url ?>newbranch">Gestión de Sucursales</a></li>
						</ul>
					</li-->

				</ul>
			</div>
		</div>
		<!-- /main navigation -->

	</div>
</div>
<!-- /main sidebar -->





<!-- Main content -->
<div class="content-wrapper">