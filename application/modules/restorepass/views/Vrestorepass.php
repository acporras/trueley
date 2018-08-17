<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/material/login_unlock.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 18 Apr 2018 09:39:02 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $titulo; ?></title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo $url ?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $url ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $url ?>assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $url ?>assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $url ?>assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo $url ?>assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo $url ?>assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $url ?>assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $url ?>assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo $url ?>assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script type="text/javascript" src="<?php echo $url ?>assets/js/core/app.js"></script>
	<script type="text/javascript" src="<?php echo $url ?>assets/js/pages/login.js"></script>

	<script type="text/javascript" src="<?php echo $url ?>assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->

</head>

<body class="login-container">

	<!-- Main navbar -->
	<div class="navbar navbar-inverse bg-indigo">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.html"><img src="<?php echo $url ?>assets/images/true_blanco.png" alt=""></a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Unlock user -->
					<form action="<?php echo $url ?>restorepass/complete" class="login-form" method="post" >
						<div class="panel">
							<div class="panel-body">
								<div class="thumb thumb-rounded">
									<img src="<?php echo ($this->_session->data->foto==null) ? $url.$this->_conf['imguser'] : $this->_session->data->foto ?>" alt="">
									<div class="caption-overflow">
										<span>
											<a href="#" class="btn border-white text-white btn-flat btn-icon btn-rounded btn-xs"><i class="icon-collaboration"></i></a>
											<a href="#" class="btn border-white text-white btn-flat btn-icon btn-rounded btn-xs ml-5"><i class="icon-question7"></i></a>
										</span>
									</div>
								</div>

								<h6 class="content-group text-center text-semibold no-margin-top"><?php echo $this->_session->data->nombre ?> <small class="display-block">Recuperacion de Clave</small></h6>

								<div class="form-group has-feedback">
									<input type="password" class="form-control" placeholder="Nueva Clave" name="nuevaclave" required>
									<input type="hidden" class="form-control" value="<?php echo $_GET['token']; ?>" name="token">
								</div>
								<button type="submit" class="btn bg-pink-400 btn-block">Recuperar <i class="icon-arrow-right14 position-right"></i></button>
							</div>
						</div>
					</form>
					<!-- /unlock user -->


					<!-- Footer -->
					<div class="footer text-muted text-center">
						&copy; <?php echo date("Y") ?>. <a href="https://trueley.com">TrueLey</a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>

<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/material/login_unlock.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 18 Apr 2018 09:39:02 GMT -->
</html>
