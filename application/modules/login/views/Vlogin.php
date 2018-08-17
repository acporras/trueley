<!DOCTYPE html>
<html lang="en">


<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $titulo ?></title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo $url; ?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $url; ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $url; ?>assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $url; ?>assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $url; ?>assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo $url; ?>assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo $url; ?>assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $url; ?>assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $url; ?>assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo $url; ?>assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script type="text/javascript" src="<?php echo $url; ?>assets/js/core/app.js"></script>
	<script type="text/javascript" src="<?php echo $url; ?>assets/js/pages/login.js"></script>

	<script type="text/javascript" src="<?php echo $url; ?>assets/js/pages/components_notifications_pnotify.js"></script>

	<script type="text/javascript" src="<?php echo $url; ?>assets/js/plugins/notifications/pnotify.min.js"></script>
	<!-- /theme JS files -->
	<style>
		body{
			background-image:url('<?php echo $url ?>/assets/images/bg_inicio_nuevo.jpg') !important;
			background-size:cover !important;
			background-position: right top !important;
		}
		.ui-pnotify-icon, .ui-pnotify-title, .ui-pnotify-text {
			color: #000000 !important;
		}
	</style>
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $url; ?>assets/images/fav/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo $url; ?>assets/images/fav/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $url; ?>assets/images/fav/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $url; ?>assets/images/fav/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $url; ?>assets/images/fav/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $url; ?>assets/images/fav/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $url; ?>assets/images/fav/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $url; ?>assets/images/fav/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $url; ?>assets/images/fav/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo $url; ?>assets/images/fav/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $url; ?>assets/images/fav/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo $url; ?>assets/images/fav/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $url; ?>assets/images/fav/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="<?php echo $this->_conf['sideHover'] ?>">
	<meta name="msapplication-TileImage" content="<?php echo $url; ?>assets/images/fav/ms-icon-144x144.png">
	<meta name="theme-color" content="<?php echo $this->_conf['sideHover'] ?>">

</head>

<body class="login-container bg-slate-800">

	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Advanced login -->
					<form action="<?php echo $url ?>login/signinUser" method="post">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<!--div class="icon-object border-warning-400 text-warning-400"><i class="icon-people"></i></div-->
								<div class="">
									<img src="<?php echo $url ?>assets/images/true_color.png" width="250px"/>
								</div>
								<h5 class="content-group-lg"><small class="display-block">Ingrese sus Credenciales</small></h5>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="text" name="usuario" class="form-control" placeholder="Email">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" name="clave" class="form-control" placeholder="Clave">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group login-options">
								<div class="row">
									<!--div class="col-sm-6">
										<label class="checkbox-inline">
											<input type="checkbox" name="recordar" class="styled">
											Remember
										</label>
									</div-->

									<div class="col-sm-6">
										<a href="#" class="olvido">Olvidó su clave?</a>
									</div>
								</div>
							</div>
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

							<div class="form-group">
								<button type="submit" class="btn bg-primary-400 btn-block">Ingresar <i class="icon-circle-right2 position-right"></i></button>
							</div>


							<!--div class="content-divider text-muted form-group"><span>or sign in with</span></div>
							<div class="content-divider text-muted form-group"><span>Don't have an account?</span></div>
							<a href="login_registration.html" class="btn bg-slate btn-block content-group">Register</a-->
							<!--span class="help-block text-center no-margin">By continuing, you're confirming that you've read our <a href="#">Terms &amp; Conditions</a> and <a href="#">Cookie Policy</a></span-->
						</div>
					</form>
					<!-- /advanced login -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

	<div class="modal fade" id="modal-olvido">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Recuperar Clave</h4>
				</div>
				<div class="modal-body">
					
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="alert alert-info">
							<strong>INFO</strong> Le será enviado un Email con el Enlace de Recuperación a su cuenta registrada, <code>El enlace de recuperación tiene una vigencia de 2 horas</code>
						</div>
					</div>
					
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="emailrecu" id="emailrecu" placeholder="Ingrese su Email"/>
						</div>
					</div>
					
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-primary completar">Recuperar</button>
				</div>
			</div>
		</div>
	</div>
	
<script>
	var msg = '<?php echo (isset($_GET['msg'])) ? $_GET['msg'] : ''; ?>';

	$(function(){
		switch (msg) {
			case 'badEmailFormat':
				new PNotify({
					title: 'Atención',
					text: 'Formato de Email Inválido, por favor, revise',
					icon: 'icon-blocked',
					type: 'error'
				});
			break;
			
			case 'errorData':
				new PNotify({
					title: 'Atención',
					text: 'Los datos enviados son errados, por favor, revise he intente de nuevo',
					icon: 'icon-blocked',
					type: 'error'
				});
			break;
			
			case 'Invalid or empty token supplied':
			case 'Invalid user logged in':
			case 'Signature verification failed':
			case 'Invalid token supplied.':
				new PNotify({
					title: 'Atención',
					text: 'No hemos podido validar su sesión, por favor intente de nuevo o contacte al Administrador',
					icon: 'icon-blocked',
					type: 'error'
				});
			break;
			
			case 'Expired token':
				new PNotify({
					title: 'Atención',
					text: 'Ha finalziado su sesion por tiempo de inactividad, por favor, ingrese nuevamente',
					icon: 'icon-blocked',
					type: 'warning'
				});
			break;
			
			case 'logOut':
				new PNotify({
					title: 'Éxito',
					text: 'Ha finalziado su sesion por tiempo de inactividad, por favor, ingrese nuevamente',
					icon: 'icon-checkmark3',
					type: 'success'
				});
			break;
			
			case 'successChange':
				new PNotify({
					title: 'Éxito',
					text: 'Se ha completado el cambio de clave exitosamente',
					icon: 'icon-checkmark3',
					type: 'success'
				});
			break;
			
			case 'failChange':
				new PNotify({
					title: 'Atención',
					text: 'Ha ocurrido un error inesperado o el enlace enviado no tiene validez, por favor, solicite un nuevo enlace',
					icon: 'icon-checkmark3',
					type: 'error'
				});
			break;
		
			default:
			break;
		}

		$(".olvido").click(function(){
			$("#modal-olvido").modal('show');
		})

		$(".completar").click(function(e){
			e.preventDefault();
			var email = $("#emailrecu").val();
			if(email==""){
				new PNotify({
					title: 'Atención',
					text: 'Debe ingresar un email Válido',
					icon: 'icon-warning22',
					type: 'warning'
				});
				return false;
			}

			$("#modal-olvido").modal('hide');

			$("body").block({
				message: '<span class="text-semibold"><i class="icon-spinner4 spinner position-left"></i>&nbsp; Validando Información</span>',
				timeout: 6000000, 
				overlayCSS: {
					backgroundColor: '#000',
					opacity: 0.8,
					cursor: 'wait'
				},
				css: {
					border: 0,
					padding: '10px 15px',
					color: '#fff',
					width: 'auto',
					'-webkit-border-radius': 2,
					'-moz-border-radius': 2,
					backgroundColor: '#9E0000'
				}
			});
			//$("this").unblock();
			
			$.post('<?php echo base_url() ?>login/restore',{
				email:email
			}).done(function(resp){
				$("body").unblock();
				
				switch (resp) {
					case 'badformat':
						$("#modal-olvido").modal('show');
						new PNotify({
							title: 'Error',
							text: 'Formato de Email Inválido, por favor, verifique e intente de nuevo',
							icon: 'icon-warning22',
							type: 'error'
						});
						return false;
					break;

					case 'nouser':
						$("#modal-olvido").modal('show');
						new PNotify({
							title: 'Error',
							text: 'El usuario no se encuentra registrado en el Sistema, por favor, verifique e intente de nuevo',
							icon: 'icon-warning22',
							type: 'error'
						});
						return false;
					break;

					case '200':
						$("#emailrecu").val("");
						new PNotify({
							title: 'Éxito',
							text: 'Hemos enviado un email de recuperación, por favor, siga las instrucciones',
							icon: 'icon-warning22',
							type: 'success'
						});
						return false;
					break;
				
				}
				
			}).fail(function(err){
				$("body").unblock();

			})

		})
	})
</script>
</body>


</html>
