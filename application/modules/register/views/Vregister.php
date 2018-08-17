<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $titulo; ?></title>

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="favicon2.ico" type="image/x-icon">
    <link rel="icon" href="favicon2.ico" type="image/x-icon">
    <!-- / Favicons
    ================================================== -->

    <!-- >> CSS
    ============================================================================== -->
    <!-- Bootstrap styles -->
    <link href="<?php echo $url; ?>assets/inicio/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- /Bootstrap Styles -->
    <!-- Google Web Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- /google web fonts -->
    <!-- owl carousel -->
    <link href="<?php echo $url; ?>assets/inicio/vendor/owl.carousel/assets/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo $url; ?>assets/inicio/vendor/owl.carousel/assets/owl.theme.default.min.css" rel="stylesheet">
    <!-- /owl carousel -->
    <!-- fancybox.css -->
    <link href="<?php echo $url; ?>assets/inicio/vendor/animate.css" rel="stylesheet">
    <!-- /fancybox.css -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $url; ?>assets/inicio/vendor/font-awesome/css/font-awesome.min.css">
    <!-- /Font Awesome -->
    <!-- Main Styles -->
    <link href="<?php echo $url; ?>assets/inicio/css/styles.css" rel="stylesheet">
    <!-- /Main Styles -->
    <!-- >> /CSS
    ============================================================================== -->
</head>

<body>
<!-- Loader
================================================== -->
<div class="loader-container" id="page-loader"> 
  <div class="loading-wrapper loading-wrapper-hide">
    <div class="loader-animation" id="loader-animation">
        <div class="mask-loading">
          <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
          </div>
        </div>
    </div>    
    <!-- Edit With Your Logo -->
    <div class="loader-name" id="loader-name">
        <img src="<?php echo $url; ?>assets/images/true_blanco.png" alt="">
    </div>
    <!-- /Edit With Your Logo -->
  </div>   
</div>
<!-- /Loader
================================================== -->

<!-- Top Bar
================================================== -->
<div id="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ul class="list-inline">
                    <li class="top-bar-item"><a href="mailto:contacto@trueley.com "><i class="fa fa-envelope"></i>contacto@trueley.com</a></li>
                    <!--li class="top-bar-item"><a href="#"><i class="fa fa-phone"></i>8897-7778 000</a></li-->
                </ul>
            </div>
            <div class="col-md-6">
                 <div class="social-icons header-social-icons">
                    <ul class="social-icons list-inline text-right">
                        <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Top Bar
================================================== -->

<!-- Header
================================================== -->
<header id="masthead" class="site-header">    
    <!-- Main header -->
    <div class="container">     
        <!-- Navbar Header -->
        <div class="row">
            <!-- logo -->
            <div class="col-md-4 col-xs-10">
                <div class="header-logo">
                    <a href="<?php echo $url ?>"><img src="<?php echo $url; ?>assets/images/true_color.png" width="200px" alt=""/></a>                      
                </div>
            </div>
            <!-- /logo -->

            <!-- Mobile Menu -->
            <div class="col-xs-2 visible-xs visible-sm text-right">
                <i class="fa fa-bars" id="MobileMenu"></i>
            </div>
            <!-- Mobile Menu -->

            <!-- Main Navigation -->
            <div class="col-md-8">
                <nav id="main-navigation">                      
                    <ul class="list-inline text-right">
                        <li ><a title="Home" href="<?php echo $url; ?>">Inicio</a></li>
                        <!--li><a title="About Us" href="about.html">About Us</a></li-->
                        <li><a title="Register" href="<?php echo $url; ?>register">Registro</a></li>
                        <li><a title="Contact" href="<?php echo $url; ?>">Contacto</a></li>
                        <li><a title="Ingresar" class="light-color" style="color:#000000 !important" href="<?php echo $url; ?>login">Ingresar</a></li>
                    </ul>                   
                    <div class="top-bar-append"></div>
                </nav>
            </div>
            <!-- Main Navigation -->                         
        </div> 
        <!-- /Navbar Header -->  
    </div>
    <!-- /Main header -->
</header>
<!-- / Header
================================================== -->

<!-- Main Content
================================================== -->
<div id="content" class="site-content">
    <div id="primary" class="content-area">

        <!-- SECTION: Contact -->
        <div class="section section-contact bg-cover bg-fixed with-dark-bg" style="background-image: url(<?php echo $url; ?>assets/inicio/img/contact-bg.jpg);">
            <div class="container">
                <!-- Section Title -->                    
                <h2 class="title-section">Contactenos</h2>
                <!-- /Section Title --> 
                <!-- Section Content -->   
                <p>Si desea información personalizada, por favor, contactenos.</p>
                <!-- /Section Content -->   
                <!-- Contact Form -->
                <form class="form main-contact-form">
                    <div class="row">
                        <!-- Form Group -->
                        <div class="col-sm-4 form-group">
                            <input type="text" class="form-control required" placeholder="Nombre *" id="name" name="nombre" required/>
                            <!-- Form Group -->
                        </div>
                        <!-- Form Group -->

                        <!-- Form Group -->
                        <div class="col-sm-4 form-group">
                            <input type="email" class="form-control required" placeholder="Email *" id="email" name="email" required/>
                        </div>
                        <!-- Form Group -->

                        <!-- Form Group -->
                        <div class="col-sm-4 form-group">
                            <input type="text" class="form-control required" placeholder="Asunto *" id="subject" name="asunto" required/>
                        </div>
                        <!-- Form Group -->

                        <!-- Form Group -->
                        <div class="col-sm-12 form-group">
                            <textarea class="form-control required" placeholder="Mensaje *" name="mensaje" id="message" required></textarea>
                        </div>
                        <!-- Form Group -->

                        <!-- Form Group -->
                        <div class="col-sm-12 form-group">
                            <?php 
                                echo $this->recaptcha->getScriptTag();
                                echo $this->recaptcha->getWidget(array('data-theme' => 'dark'));
                            ?>
                        </div>
                        <!-- Form Group -->

                        <!-- Form Group -->
                        <div class="col-sm-12 form-group">
                            <input type="submit" value="Enviar" class="">
                        </div>
                        <!-- Form Group -->
                    </div>                    
                </form>
                <!-- Contact Form -->
            </div>
        </div>
        <!-- SECTION: Contact -->  
    </div>
</div>
<!-- /Main Content    
================================================== -->

<!-- Footer
================================================== -->
<footer id="colophon" class="site-footer">              
    <!-- footer bottom -->
    <div class="footer-bottom">
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-sm-8">
                    <!-- Site Info -->
                    <div class="site-quote">
                        <p>Trueley.com</p>
                    </div>
                    <!-- /Site info -->
                </div>
                <!-- /col -->
                <!-- col -->
                <div class="col-sm-4">
                    <!-- social icons -->
                    <div class="social-icons footer-social-icons">
                        <ul class="social-icons-list text-right">
                            <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                    <!-- /social icons -->    
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->               
        </div>
    </div>
    <!-- /footer bottom -->     
</footer>
<!-- /Footer    
================================================== -->

<!-- Back to Top Button -->
<div id="back-to-top" class="back-to-top back-to-top-hide"><i class="fa fa-angle-up"></i></div>
<!-- /Back to Top Button -->

<!-- Contact Form - Ajax Messages
========================================================= -->
<!-- Form Sucess -->
<div class="form-result modal-wrap" id="contactSuccess">
  <div class="modal-bg"></div>
  <div class="modal-content">
    <h4 class="modal-title"><i class="fa fa-check-circle"></i> Éxito!</h4>
    <p>Su mensaje ha sido enviado.</p>
  </div>
</div>
<!-- /Form Sucess -->
<!-- form-error -->
<div class="form-result modal-wrap" id="contactError">
  <div class="modal-bg"></div>
  <div class="modal-content">
    <h4 class="modal-title"><i class="fa fa-times"></i> Atención</h4>
    <p>Ha ocurrido un error al enviar el mensaje.</p>
  </div>
</div>
<!-- /form-error -->
<!-- form-sending -->
<div class="form-result modal-wrap" id="contactWait">
  <div class="modal-bg"></div>
  <div class="modal-content">  
    <div class="modal-loader"></div> 
    <p>Enviando, Por favor espere...</p>
  </div>
</div>
<!-- /form-sending -->
<!-- / Contact Form - Ajax Messages
========================================================= -->


<!-- >> JS
============================================================================== -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo $url; ?>assets/inicio/vendor/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo $url; ?>assets/inicio/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $url; ?>assets/inicio/vendor/validate.js"></script>
<!-- CountDown -->
<script src="<?php echo $url; ?>assets/inicio/vendor/jquery.countdown.min.js"></script>
<!-- Count To (Counters) -->
<script src="<?php echo $url; ?>assets/inicio/vendor/count-to.js"></script>
<!-- ImagesLoaded -->
<script src="<?php echo $url; ?>assets/inicio/vendor/imagesloaded.pkgd.min.js"></script>
<!-- Waypoints-->
<script src="<?php echo $url; ?>assets/inicio/vendor/waypoints.min.js"></script>
<!-- /Waypoints-->
<!-- Owl Caroulsel -->
<script src="<?php echo $url; ?>assets/inicio/vendor/owl.carousel/owl.carousel.min.js"></script>
<!-- Cross-browser -->
<script src="<?php echo $url; ?>assets/inicio/vendor/cross-browser.js"></script>
<!-- Match Height Plugin to add height on elements -->
<script src="<?php echo $url; ?>assets/inicio/vendor/jquery.matchHeight-min.js"></script>
<!-- Wow js for on scroll animations -->
<script src="<?php echo $url; ?>assets/inicio/vendor/wow.min.js"></script>
<!-- Main Scripts -->
<script src="<?php echo $url; ?>assets/inicio/js/main.js"></script>


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="vendor/html5shiv.js"></script>
<script src="vendor/respond.min.js"></script>
<![endif]-->
<!-- >> /JS
============================================================================= -->
</body>

</html>