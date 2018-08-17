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
	<link href="<?php echo $url ?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $url ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $url ?>assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $url ?>assets/css/components.css?v=<?php echo rand(100,2500) ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo $url ?>assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo $url ?>assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo $url ?>assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $url ?>assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $url ?>assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- UIkit CSS -->
	<link rel="stylesheet" href="<?php echo $url ?>assets/css/uikit.min.css" />

	<!-- UIkit JS -->
	<script src="<?php echo $url ?>assets/js/uikit.min.js"></script>
	<script src="<?php echo $url ?>assets/js/uikit-icons.min.js"></script>

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo $url ?>assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script type="text/javascript" src="<?php echo $url ?>assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script type="text/javascript" src="<?php echo $url ?>assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="<?php echo $url ?>assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo $url ?>assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script type="text/javascript" src="<?php echo $url ?>assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="<?php echo $url ?>assets/js/plugins/pickers/daterangepicker.js"></script>

	<script type="text/javascript" src="<?php echo $url ?>assets/js/core/app.js"></script>
	
	<!--script type="text/javascript" src="<?php echo $url ?>assets/js/plugins/ui/ripple.min.js"></script-->

	<script type="text/javascript" src="<?php echo $url ?>assets/js/plugins/notifications/pnotify.min.js"></script>

	<script type="text/javascript" src="<?php echo $url ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>

	<script type="text/javascript" src="<?php echo $url ?>assets/js/plugins/media/cropper.min.js"></script>

	<script>
	$(function(){
		$('.datatable-basic').DataTable({
			language: {
				"paginate": {
					"first":      "Primera",
					"last":       "Última",
					"next":       "Sig",
					"previous":   "Ant"
				},
				'previous': '&larr; Ant',
				"lengthMenu": "Ver _MENU_ Registros por Página",
				"zeroRecords": "No se encontro el registro",
				"info": "Viendo página _PAGE_ de _PAGES_",
				"infoEmpty": "Viendo 0 a 0 de 0 registros",
				"infoEmpty": "Sin registros",
				"search": "Buscar: ",
				"emptyTable": "Sin registros a mostrar",
				"loadingRecords": "Cargando...",
				"processing": "Procesando...",
			}
		});
	})
	</script>
	<!-- /theme JS files -->
	<style>
		.navbar-brand>img {
			margin-top: -10px !important;
			height: 40px !important;
		}
		a{
			text-decoration:none !important;
		}
		.sidebar-user-material-menu a:hover, .sidebar-user-material-menu i:hover{
			color:#ffffff !important;
		}
		.sidebar-default .navigation>li.active>a, .sidebar-default .navigation>li.active>a:focus, .sidebar-default .navigation>li.active>a:hover {
			background-color: <?php echo $this->_conf['sideHover'] ?> !important;
			color: <?php echo $this->_conf['textColor'] ?> !important;
		}
		.sidebar-default .navigation ul li.active>a, .sidebar-default .navigation ul li.active>a:focus, .sidebar-default .navigation ul li.active>a:hover {
			background-color:<?php echo $this->_conf['subSideH'] ?> !important;
			color:<?php echo $this->_conf['textColor'] ?> !important;
		}
		.uk-offcanvas-bar {
			background: rgba(0,0,0,0.8) !important;
		}
		.uk-offcanvas-overlay::before {
			background: rgba(0,0,0,.5);
		}
		.sidebar-user-material-content>a>img {
			height: 120px !important;
		}

		.style-1::-webkit-scrollbar {
			width: 2px;
			background-color: <?php echo $this->_conf['sideHover'] ?>;
		} 
		.style-1::-webkit-scrollbar-thumb {
			background-color: <?php echo $this->_conf['sideHover'] ?>;
		}
		.style-1::-webkit-scrollbar-track {
			-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
			background-color: #F5F5F5;
		}
		.chip {
			display: inline-block;
			padding: 0 5px;
			height: 50px;
			font-size: 16px;
			line-height: 50px;
			border-radius: 25px;
			background-color: #f1f1f1;
			margin-right:20px !important;
			margin-left:20px !important
		}

		.chip img {
			float: left;
			margin: 0 10px 0 -25px;
			height: 50px;
			width: 50px;
			border-radius: 50%;
		}
		.iscusblue {
			background-color: rgba(0,87,231,1) !important;
			border-color: #0288d1 !important; 
			color: #fff !important;
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
	<link rel="manifest" href="<?php echo $url; ?>assets/images/fav/manifest.json">
	<link rel="shortcut icon" href="<?php echo $url; ?>/favicon.ico" type="image/x-icon">
	<meta name="msapplication-TileColor" content="<?php echo $this->_conf['sideHover'] ?>">
	<meta name="msapplication-TileImage" content="<?php echo $url; ?>assets/images/fav/ms-icon-144x144.png">
	<meta name="theme-color" content="<?php echo $this->_conf['sideHover'] ?>">

</head>

<body>