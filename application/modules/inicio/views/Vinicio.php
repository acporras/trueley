<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $titulo; ?></title>

    <!-- Favicons
    ================================================== -->
    <!--link rel="shortcut icon" href="<?php //echo $url; ?>assets/inicio/img/favicon2.ico" type="image/x-icon">
    <link rel="icon" href="<?php //echo $url; ?>assets/inicio/img/favicon2.ico" type="image/x-icon"-->
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

    <link href="<?php echo $url; ?>assets/inicio/css/iziModal.min.css" rel="stylesheet">

    <script src="<?php echo $url; ?>assets/inicio/vendor/jquery.min.js"></script>

    <style>
        #modal-custom header{
  background: #eee;
  margin-bottom: 10px;
  overflow: hidden;
  border-radius: 3px 3px 0 0;
  width: 100%;
}
#modal-custom header a{
  display: block;
  float: left;
  width: 50%;
  padding: 0;
  text-align: center;
  background: #ddd;
  color: #999;
  height: 65px;
  vertical-align: middle;
  line-height: 65px;
  font-family: 'Lato', arial;
  font-size: 15px;
  transition: all 0.3s ease;
}
#modal-custom header a:not(.active):hover{
  box-shadow: inset 0 -10px 20px -10px #aaa
} 
#modal-custom header a.active{
  background: #fff;
  color: #777;
}
#modal-custom .sections{
  overflow: hidden;
}
#modal-custom section{
  padding: 30px;
}
#modal-custom section input:not([type="checkbox"]), #modal-custom section button, #modal-custom section textarea{
  width: 100%;
  border-radius: 3px;
  border: 1px solid #ddd;
  margin-bottom: 26px;
  padding: 15px;
  font-size: 14px;
}
#modal-custom section button{
  height: 46px;
  padding: 0;
}

#modal-custom section input:focus{
  border-color:#28CA97;
}
#modal-custom section label[for="check"]{
  margin-bottom: 26px;
  font-size: 14px;
  color: #999;
  display: block;
}
#modal-custom section footer{
  overflow: hidden;
}
#modal-custom section button{
  background: #28CA97;
  color: white;
  margin: 0;
  border: 0;
  cursor: pointer;
  width: 50%;
  float: left;
}
#modal-custom section button:hover{
  opacity: 0.8;
}
#modal-custom section button:nth-child(1){
  border-radius: 3px 0 0 3px;
  background: #aaa;
}
#modal-custom section button:nth-child(2){
  border-radius: 0 3px 3px 0;
}

#modal-custom .icon-close{
  background: #FFF;
  margin-bottom: 10px;
  position: absolute;
  right: -8px;
  top: -8px;
  font-size: 14px;
  font-weight: bold;
  border-radius: 50%;
  width: 30px;
  height: 30px;
  border: 0;
  color: #a9a9a9;
  cursor: pointer;
}
#modal-custom .icon-close:hover, #modal-custom .icon-close:focus{
  color: black;
}
#modal-custom.hasScroll .icon-close{
  display: none;
}


#modal-clave header{
  background: #eee;
  margin-bottom: 10px;
  overflow: hidden;
  border-radius: 3px 3px 0 0;
  width: 100%;
}
#modal-clave header a{
  display: block;
  float: left;
  width: 50%;
  padding: 0;
  text-align: center;
  background: #ddd;
  color: #999;
  height: 65px;
  vertical-align: middle;
  line-height: 65px;
  font-family: 'Lato', arial;
  font-size: 15px;
  transition: all 0.3s ease;
}
#modal-clave header a:not(.active):hover{
  box-shadow: inset 0 -10px 20px -10px #aaa
} 
#modal-clave header a.active{
  background: #fff;
  color: #777;
}
#modal-clave .sections{
  overflow: hidden;
}
#modal-clave section{
  padding: 30px;
}
#modal-clave section input:not([type="checkbox"]), #modal-clave section button, #modal-clave section textarea{
  width: 100%;
  border-radius: 3px;
  border: 1px solid #ddd;
  margin-bottom: 26px;
  padding: 15px;
  font-size: 14px;
}
#modal-clave section button{
  height: 46px;
  padding: 0;
}

#modal-clave section input:focus{
  border-color:#28CA97;
}
#modal-clave section label[for="check"]{
  margin-bottom: 26px;
  font-size: 14px;
  color: #999;
  display: block;
}
#modal-clave section footer{
  overflow: hidden;
}
#modal-clave section button{
  background: #28CA97;
  color: white;
  margin: 0;
  border: 0;
  cursor: pointer;
  width: 50%;
  float: left;
}
#modal-clave section button:hover{
  opacity: 0.8;
}
#modal-clave section button:nth-child(1){
  border-radius: 3px 0 0 3px;
  background: #aaa;
}
#modal-clave section button:nth-child(2){
  border-radius: 0 3px 3px 0;
}

#modal-clave .icon-close{
  background: #FFF;
  margin-bottom: 10px;
  position: absolute;
  right: -8px;
  top: -8px;
  font-size: 14px;
  font-weight: bold;
  border-radius: 50%;
  width: 30px;
  height: 30px;
  border: 0;
  color: #a9a9a9;
  cursor: pointer;
}
#modal-clave .icon-close:hover, #modal-clave .icon-close:focus{
  color: black;
}
#modal-clave.hasScroll .icon-close{
  display: none;
}

.columns {
    float: left;
    width: 33.3%;
    padding: 8px;
}

.price {
    list-style-type: none;
    border: 1px solid #eee;
    margin: 0;
    padding: 0;
    -webkit-transition: 0.3s;
    transition: 0.3s;
}

.price:hover {
    box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
}

.price .header {
    background-color: #111;
    color: white;
    font-size: 25px;
}

.price li {
    border-bottom: 1px solid #eee;
    padding: 20px;
    text-align: center;
}

.price .grey {
    background-color: #eee;
    font-size: 20px;
}

.buttonprice {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 10px 25px;
    text-align: center;
    text-decoration: none;
    font-size: 18px;
}

.price {
    list-style-type: none;
    border: 1px solid #eee;
    margin: 0;
    padding: 0;
    -webkit-transition: 0.3s;
    transition: 0.3s;
    margin-bottom:30px;
}

.price:hover {
    box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
}

.price .header {
    background-color: #111;
    color: white;
    font-size: 25px;
}

.price li {
    border-bottom: 1px solid #eee;
    background-color: #eee !important
    padding: 20px;
    text-align: center;
}
.price .feature {
    background-color: #eee !important;
    color: #333333 !important;
}

/* Grey list item */
.price .grey {
    background-color: #0071BC;
    font-size: 20px;
    cursor:pointer;
}
.price .amount {
    background-color: #0071BC !important;
    color: #ffffff !important;
}
.price .grey:hover {
    background-color: #00426f;
    color:#ffffff;
    font-size: 20px;
    cursor:pointer;
}
.price .button:hover {
    color: #ffffff !important;
}
@media (min-width: 768px){
    .title1:after, .title-section:after {
        background-color: #0071bc !important;
    }
}

.quover-features .practice-areas-item:hover {
    width: 38%;
    background: #0071bc !important;
  }
  .back-to-top {
    background: #0071bc !important;
}
.primary-btn.light-color:before {
    background-color: #0071bc !important;
}
.owl-carousel .owl-controls .owl-dot.active span {
    height: 10px;
    width: 10px;
    border: 2px solid #0071bc !important;
    background-color: #0071bc !important;
}
.section-contact .form input[type=submit] {
    background: #0071bc !important;
}
.social-icons a:hover {
    background-color: #0071bc !important;
    border: 1px solid #0071bc !important;
}
    </style>

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
                        <li><a href="#" target="_blank" class="face"><i class="fa fa-facebook"></i></a></li>
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
                        <!--li><a title="Register" href="#" class="registrar">Registro</a></li-->
                        <li><a title="Register" href="#section-planes" class="">Precios</a></li>
                        <li><a title="Contact" href="#contacto">Contacto</a></li>
                        <li><a title="Ingresar" class="ingresar" href="#">Ingresar</a></li>
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

        <!-- SECTION: Slideshow -->
        <div class="owl-carousel main-carousel owl-theme">

            <!-- Slide -->
            <div class="featured-slide slide bg-cover viewport" style="background-image: url('<?php echo $url; ?>assets/inicio/img/slide1.jpg');">
                <div class="slide-inner">
                    <div class="slide-icon"></div>
                    <!-- SLide Title -->
                    <h2 class="slide-title">Automatizamos tu día</h2>
                    <!-- /SLide Title -->
                    <!-- Slide Text -->
                    <p class="slide-text">Gestionamos de manera inteligente tu gestión legal.</p>
                    <!-- /Slide Text -->
                    <!-- Slide link -->
                    <a class="primary-btn light-color" href="#section-planes">Registrarse</a>
                    <!-- /Slide link -->
                </div>
            </div>
            <!-- Slide -->
        </div>
        <!-- /SECTION: Slideshow -->

        <!-- SECTION: Practice Areas -->
        <div id="section-practice-areas" class="section section-practice-areas no-padding">
            <div class="quover features">
                <div class="container-fluid quover-features">
                    <div class="row">
                        <!-- Practice Areas - Item -->
                        <div class="practice-areas-item">                            
                            <div class="practice-areas-item-wrapper">
                                <!-- Item Icon -->
                                <div class="practice-areas-item-icon">
                                    <img src="<?php echo $url; ?>assets/inicio/img/jail-icon2.png" alt=""/>
                                </div>
                                <!-- /Item Icon -->
                                <!-- Item Title -->
                                <h2 class="practice-areas-title">Gestión de Expedientes</h2>
                                <!-- /Item Title -->
                            </div>                       
                        </div>
                        <!-- /Practice Areas - Item -->
                        <!-- Practice Areas - Item -->
                        <div class="practice-areas-item">                            
                            <div class="practice-areas-item-wrapper">
                                <!-- Item Icon -->
                                <div class="practice-areas-item-icon">
                                    <img src="<?php echo $url; ?>assets/inicio/img/hand-icon.png" alt=""/>
                                </div>
                                <!-- /Item Icon -->
                                <!-- Item Title -->
                                <h2 class="practice-areas-title">Gestión de Usuarios</h2>
                                <!-- /Item Title -->
                            </div>
                        </div>
                        <!-- /Practice Areas - Item -->
                        <!-- Practice Areas - Item -->
                        <div class="practice-areas-item">
                            <div class="practice-areas-item-wrapper">
                                <!-- Item Icon -->
                                <div class="practice-areas-item-icon">
                                    <img src="<?php echo $url; ?>assets/inicio/img/house-icon.png" alt=""/>
                                </div>
                                <!-- /Item Icon -->
                                <!-- Item Title -->
                                <h2 class="practice-areas-title">Recordatorios</h2>
                                <!-- /Item Title -->
                            </div>
                        </div>
                        <!-- /Practice Areas - Item -->
                    </div>
                </div>
            </div>
        </div>
        <!-- SECTION: Practice Areas -->

        <!-- SECTION: About -->
        <div id="section-about" class="section section-about no-padding">
            <div class="container-fluid no-padding">
                <div class="row">

                    <!-- About Image -->
                    <div class="col-lg-6 post-block-col col-lg-push-6 about-image" data-match-height="PostBlockCol" style="background-image: url('<?php echo $url; ?>assets/inicio/img/about-us-img.jpg'); background-position: center !important; background-size:cover !important; min-height: 523px !important;">
                    </div>
                    <!-- / About Image -->

                    <!-- Post Content -->
                    <div class="col-lg-6 post-block-col col-lg-pull-6" data-match-height="PostBlockCol">
                        <div class="about-content">
                            <!-- About Title -->
                            <h2 class="title1">Trueley</h2>
                            <!-- /About Title -->
                            <!-- About Content -->
                            <p>Es una aplicación web que vienen a ayudar a Abogados y Firmas a gestionar sus expedientes de una manera más eficiente</p>
                            <!-- /About Content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- SECTION: About -->
        
        <!-- SECTION: About -->
        <div id="section-planes" class="section" style="background-color:#333333; color:#ffffff;">
            <div class="">
                <div class="row">
                    <!-- Post Content -->
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                        <div class="about-content">
                            <!-- About Title -->
                            <h2 class="title1">Planes</h2>
                            <!-- /About Title -->
                            <!-- About Content -->
                            <p>Ofrecemos una serie de planes que adaptan a sus necesidades y a las de su Grupo de trabajo.</p>
                            <!-- /About Content -->
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                    <?php if($planes){ foreach($planes as $plan){ 
                        $f = explode(",", $plan->features); ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <ul class="price">
                                    <li class="header"><?php echo ucwords($plan->nombreplan) ?></li>
                                    <li class="grey amount">$ <?php echo $plan->costopeso ?> / mes</li>
                                    <?php for($i=0; $i<count($f); $i++){ ?>
                                        <li class="feature"><?php echo $f[$i] ?></li>
                                    <?php }?>
                                    <li class="grey registrar" data-nombre="<?php echo ucwords($plan->nombreplan) ?>" data-codigo="<?php echo $plan->codplan ?>">Registrarse</li>
                                </ul>
                            </div>
                    <?php } } ?>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- SECTION: About -->

        <!-- SECTION: Contact -->
        <div class="section section-contact bg-cover bg-fixed with-dark-bg" id="contacto" style="background-image: url(<?php echo $url; ?>assets/inicio/img/contact-bg.jpg);">
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
<div id="modal-custom">
    <!--button data-iziModal-close class="icon-close"></button-->
    <header>
        <a href="" id="login" class="">Ingresar</a>
        <a href="" id="registrar" class="active">Nueva Cuenta</a>
    </header>
    <div class="sections">
        <section class="ingre" style="display:none">
            <form method="post" id="formingreso" action="<?php echo $url ?>login/signinUser">
                <input type="text" name="usuario" id="usuarioingresa" required placeholder="Usuario">
                <input type="password" name="clave" id="claveingresa" required placeholder="Clave">
                <footer>
                    <button data-iziModal-close>Cancelar</button>
                    <button type="submit" class="submit">Ingresar</button>
                </footer>
                <hr>
                <label><olvido>¿Olvido su Clave?</olvido></label>
            </form>
        </section>
        <section class="regis">
        
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <input type="email" placeholder="Email" name="email" id="emailreg" autocomplete="off" required>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                <input type="text" placeholder="Nombre" name="nombre" id="nombrereg" autocomplete="off" required>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                <input type="text" placeholder="Documento" name="documento" id="documentoreg" autocomplete="off" required>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <textarea placeholder="Direccion" name="direccion" id="direccionreg" autocomplete="off" required></textarea>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                <input type="text" placeholder="Teléfonos" name="telefonos" id="telefonosreg" autocomplete="off" required>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                <input type="text" placeholder="Plan" readonly name="plan" id="planreg" autocomplete="off" required>
                <input type="hidden" name="codplan" id="codplanreg" required>
            </div>
            <label for="check"><input type="checkbox" name="checkbox" id="acepto" required value="1"> Acepto los <u>Terminos y Condiciones</u>.</label>
                
            <footer>
                <button data-iziModal-close data-iziModal-transitionOut="fadeOutLeft">Cancelar</button>
                <button class="submitreg" id="enviarreg">Crear Cuenta</button>
            </footer>
        </section>
    </div>
</div>

<div id="modal-alert2"></div>
<div id="modal-clave2"></div>

<div id="modal-politicas" data-iziModal-fullscreen="true">
    <div style="padding:20px !important; width:100% !important">
        <?php echo $politicas->politicas; ?>
    </div>
</div>


<div id="modal-clave">
    <header>
        <a href="" id="login" class="active">Recuperar Clave</a>
    </header>
    <div class="sections">
        <section class="ingre">
                <input type="email" name="usuarioclave" id="usuarioclave" required placeholder="Email">
                <footer>
                    <button data-iziModal-close>Cancelar</button>
                    <button type="button" class="enviarrecu">Recuperar</button>
                </footer>
        </section>
    </div>
</div>




<!-- >> JS
============================================================================== -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
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

<script src="<?php echo $url; ?>assets/inicio/js/iziModal.min.js"></script>

<script>
    var msg = '<?php echo isset($_GET['msg']) ? $_GET['msg'] : '' ?>';
    $(function(){

        switch (msg) {
            case 'successReg':
                var msga = $("#modal-alert2").iziModal({
                    title: "Éxito",
                    subtitle: 'Su cuenta se ha activado con exito, puede ingresar con las credenciales enviadas a su cuenta de Email',
                    headerColor: '#4f7c34',
                    width: 600,
                    timeout: 7000,
                    setZindex:2000000,
                    timeoutProgressbar: true,
                    transitionIn: 'fadeInDown',
                    transitionOut: 'fadeOutDown',
                    pauseOnHover: true
                });
                msga.iziModal('open');
            break;
            
            case 'badEmailFormat':
                var msgb = $("#modal-alert2").iziModal({
                    title: "Atención",
                    subtitle: 'El formato de Email es inválido, por favor, verifique he intente de nuevo',
                    headerColor: '#BD5B5B',
                    width: 600,
                    timeout: 7000,
                    setZindex:2000000,
                    timeoutProgressbar: true,
                    transitionIn: 'fadeInDown',
                    transitionOut: 'fadeOutDown',
                    pauseOnHover: true
                });
                msgb.iziModal('open');
            break;
           
            case 'errorData':
                var msgc = $("#modal-alert2").iziModal({
                    title: "Atención",
                    subtitle: 'Los datos enviados son incorrectos, por favor, verifique he intente de nuevo',
                    headerColor: '#BD5B5B',
                    width: 600,
                    timeout: 7000,
                    setZindex:2000000,
                    timeoutProgressbar: true,
                    transitionIn: 'fadeInDown',
                    transitionOut: 'fadeOutDown',
                    pauseOnHover: true
                });
                msgc.iziModal('open');
            break;
            
            case 'logOut':
                var msgd = $("#modal-alert2").iziModal({
                    title: "Éxito",
                    subtitle: 'Ha cerrado su sesión correctamente',
                    headerColor: '#4f7c34',
                    width: 600,
                    timeout: 7000,
                    setZindex:2000000,
                    timeoutProgressbar: true,
                    transitionIn: 'fadeInDown',
                    transitionOut: 'fadeOutDown',
                    pauseOnHover: true
                });
                msgd.iziModal('open');
            break;
            
            case 'successChange':
                var msgd = $("#modal-alert2").iziModal({
                    title: "Éxito",
                    subtitle: 'Su clave se ha modificado exitosamente',
                    headerColor: '#4f7c34',
                    width: 600,
                    timeout: 7000,
                    setZindex:2000000,
                    timeoutProgressbar: true,
                    transitionIn: 'fadeInDown',
                    transitionOut: 'fadeOutDown',
                    pauseOnHover: true
                });
                msgd.iziModal('open');
            break;
        
            default:
            break;
        }

            var modal = $('#modal-custom').iziModal({
                history: false,
                overlayClose: false,
                width: 600,
                overlayColor: 'rgba(0, 0, 0, 0.6)',
                transitionIn: 'fadeInRight',
                transitionOut: 'fadeOutLeft',
                navigateCaption: false,
                navigateArrows: "false",
                /*onOpened: function() {
                    //console.log('onOpened');
                },
                onClosed: function() {
                    //console.log('onClosed');  
                }*/
            });

            var recupera = $('#modal-clave').iziModal({
                history: false,
                overlayClose: false,
                width: 600,
                overlayColor: 'rgba(0, 0, 0, 0.6)',
                transitionIn: 'fadeInRight',
                transitionOut: 'fadeOutLeft',
                navigateCaption: false,
                navigateArrows: "false",
                /*onOpened: function() {
                    //console.log('onOpened');
                },
                onClosed: function() {
                    //console.log('onClosed');  
                }*/
            });

            var politicas = $("#modal-politicas").iziModal({
                history: false,
                overlayColor: 'rgba(0, 0, 0, 0.6)',
                transitionIn: 'fadeInRight',
                transitionOut: 'fadeOutLeft',
                navigateCaption: false,
                navigateArrows: "false",
                title: 'Trueley',
                subtitle: 'Politicas de uso',
                headerColor: '#0071BC',
                zindex: 100000,
                onClosed: function() {
                    //console.log('onClosed');
                    modal.iziModal('open');
                }
            });

            $("u").click(function(){
                modal.iziModal('close')
                politicas.iziModal('open')
            })

            $("olvido").click(function(){
                modal.iziModal('close')
                recupera.iziModal('open')
            })

        $(".grey").click(function(){
            var nom = $(this).attr('data-nombre');
            var cod = $(this).attr('data-codigo');
            $("#planreg").val(nom);
            $("#codplanreg").val(cod);
        })
        
        $(".registrar").click(function(e){
            e.preventDefault();
            $("#registrar").addClass('active');
            $("#login").removeClass('active');
            $(".regis").css('display','block');
            $(".ingre").css('display','none');


            /*modal.iziModal('setTransitionIn', 'fadeInRight');
            modal.iziModal('setTransitionOut', 'fadeOutLeft');
            modal.iziModal('overlayClose', false);*/
            modal.iziModal('startLoading');
            modal.iziModal('setZindex', 1000000);
            modal.iziModal('open');
            resized(1);
            setTimeout(() => {
                modal.iziModal('stopLoading');
            }, 1000);
        })

        $(".enviarrecu").click(function(e){
            e.preventDefault();
            var email = $("#usuarioclave").val();
            if(email==""){
                var recua = $("#modal-alert2").iziModal({
                    title: "Atención",
                    subtitle: 'Debe ingresar un email válido, por favor, intente nuevamente',
                    headerColor: '#BD5B5B',
                    width: 600,
                    timeout: 7000,
                    setZindex:2000000,
                    timeoutProgressbar: true,
                    transitionIn: 'fadeInDown',
                    transitionOut: 'fadeOutDown',
                    pauseOnHover: true,
                    onClosed: function() {
                    //console.log('onClosed');
                    recupera.iziModal('open');
                }
                });
                recupera.iziModal('close')
                recua.iziModal('open');
                return false;
            }
            recupera.iziModal('startLoading');
            $.post('<?php echo $url ?>inicio/restore',{email:email})
            .done(function(resp){
                recupera.iziModal('stopLoading');
                switch (resp) {
                    case 'nouser':
                        var nouser = $("#modal-alert2").iziModal({
                                title: "Atención",
                                subtitle: 'El email indicado no se encuentra en nuestras bases de datos, por favor, verifique',
                                headerColor: '#BD5B5B',
                                width: 600,
                                timeout: 7000,
                                setZindex:2000000,
                                timeoutProgressbar: true,
                                transitionIn: 'fadeInDown',
                                transitionOut: 'fadeOutDown',
                                pauseOnHover: true,
                                onClosed: function() {
                                recupera.iziModal('open');
                            }
                        });
                        recupera.iziModal('close')
                        nouser.iziModal('open');
                        
                    break;
                    
                    case 'badformat':
                        var badformat = $("#modal-alert2").iziModal({
                                title: "Atención",
                                subtitle: 'El email enviano no tiene un formato válido, poer favor, verifique',
                                headerColor: '#BD5B5B',
                                width: 600,
                                timeout: 7000,
                                setZindex:2000000,
                                timeoutProgressbar: true,
                                transitionIn: 'fadeInDown',
                                transitionOut: 'fadeOutDown',
                                pauseOnHover: true,
                                onClosed: function() {
                                recupera.iziModal('open');
                            }
                        });
                        recupera.iziModal('close')
                        badformat.iziModal('open');
                        
                    break;
                    
                    case '200':
                        var correcto = $("#modal-clave2").iziModal({
                                title: "Éxito",
                                subtitle: 'Se ha enviado un email con el enlace de recuperación de su clave',
                                headerColor: '#4f7c34',
                                width: 600,
                                timeout: 7000,
                                setZindex:2000000,
                                timeoutProgressbar: true,
                                transitionIn: 'fadeInDown',
                                transitionOut: 'fadeOutDown',
                                pauseOnHover: true,
                        });
                        recupera.iziModal('close')
                        correcto.iziModal('open')
                    break;
                
                    default:
                    break;
                }
            })
            .fail(function(err){

            })

        })
        
        $(".ingresar").click(function(e){
            e.preventDefault();
            $("#login").addClass('active');
            $("#registrar").removeClass('active');
            $(".ingre").css('display','block');
            $(".regis").css('display','none');

            modal.iziModal('setTransitionIn', 'fadeInRight');
            modal.iziModal('setTransitionOut', 'fadeOutLeft');
            modal.iziModal('startLoading');
            modal.iziModal('setZindex', 1000000);
            modal.iziModal('open');
            resized(0);
            setTimeout(() => {
                modal.iziModal('stopLoading');
            }, 1000);
        })

        $("#enviarreg").click(function(e){
            e.preventDefault();
            modal.iziModal('startLoading');
            var obj = {
                nombre:$("#nombrereg").val(),
                documento:$("#documentoreg").val(),
                email:$("#emailreg").val(),
                direccion:$("#direccionreg").val(),
                telefonos:$("#telefonosreg").val(),
                plan:$("#planreg").val(),
                codigo:$("#codplanreg").val(),
            }
            if(obj.nombre=="" || obj.documento=="" || obj.email=="" || obj.direccion=="" || obj.telefonos==""){
                modal.iziModal('stopLoading');
                setTimeout(() => {
                    alert("Debe completar los datos del formulario");
                }, 500);
                return false;
            }
            $.post('<?php echo $url ?>inicio/newaccount',obj)
            .done(function(resp){
                
                if(resp!=="200"){
                    switch (resp) {
                        case '204':
                            setTimeout(() => {
                                modal.iziModal('stopLoading');
                                modal.iziModal('close');
                                var error = $("#modal-alert2").iziModal({
                                        title: "Atención",
                                        subtitle: 'El Email ya se encuentra Registrado en el Sistema, por favor, verifique',
                                        headerColor: '#BD5B5B',
                                        width: 600,
                                        timeout: 5000,
                                        setZindex:2000000,
                                        timeoutProgressbar: true,
                                        transitionIn: 'fadeInDown',
                                        transitionOut: 'fadeOutDown',
                                        pauseOnHover: true
                                    });
                                    error.iziModal('open');
                                return false;
                            }, 1000);
                        break;
                        
                        case '205':
                            setTimeout(() => {
                                modal.iziModal('stopLoading');
                                modal.iziModal('close');
                                var errora = $("#modal-alert2").iziModal({
                                        title: "Atención",
                                        subtitle: 'El número de Documento ya se encuentra registrado al Sistema, por favor, verifique',
                                        headerColor: '#BD5B5B',
                                        width: 600,
                                        timeout: 5000,
                                        setZindex:2000000,
                                        timeoutProgressbar: true,
                                        transitionIn: 'fadeInDown',
                                        transitionOut: 'fadeOutDown',
                                        pauseOnHover: true
                                    });
                                    errora.iziModal('open');
                                return false;
                            }, 1000);
                        break;
                        
                        case '400':
                            setTimeout(() => {
                                modal.iziModal('stopLoading');
                                modal.iziModal('close');
                                var errorb = $("#modal-alert2").iziModal({
                                        title: "Atención",
                                        subtitle: 'Ha ocurrido un error inesperado, por favor intente nuevamente',
                                        headerColor: '#BD5B5B',
                                        width: 600,
                                        timeout: 5000,
                                        setZindex:2000000,
                                        timeoutProgressbar: true,
                                        transitionIn: 'fadeInDown',
                                        transitionOut: 'fadeOutDown',
                                        pauseOnHover: true
                                    });
                                    errorb.iziModal('open');
                                return false;
                            }, 1000);
                        break;
                    }
                }else{

                    $("#nombrereg").val("");
                    $("#documentoreg").val("");
                    $("#emailreg").val("");
                    $("#direccionreg").val("");
                    $("#telefonosreg").val("");
                    $("#planreg").val("");
                    $("#codplanreg").val("");
                    
                    setTimeout(() => {
                        modal.iziModal('stopLoading');
                        modal.iziModal('close');
                        var exito = $("#modal-alert2").iziModal({
                                title: "Éxito",
                                subtitle: 'Se ha registrado Correctamentem, por favor, verifique su Email para Activar su cuenta',
                                headerColor: '#4f7c34',
                                width: 600,
                                timeout: 5000,
                                setZindex:2000000,
                                timeoutProgressbar: true,
                                transitionIn: 'fadeInDown',
                                transitionOut: 'fadeOutDown',
                                pauseOnHover: true
                            });
                            exito.iziModal('open');
                        return false;
                    }, 1000);

                }
            })
            .fail(function(err){
                modal.iziModal('stopLoading');
            })

        })

        $("#modal-custom").on('click', 'header a', function(event) {
            event.preventDefault();
            var $this = $(this);
            

            var index = $this.index();
            $this.addClass('active').siblings('a').removeClass('active');
            
            var $sections = $this.closest('div').find('.sections');
            console.log(index);

            var $currentSection = $this.closest("div").find("section").eq(index);
            //var $nextSection = $this.closest("div").find("section").eq(index).siblings('section');

            $sections.css('height', $currentSection.innerHeight());

            function changeHeight(){
                $this.closest("div").find("section").eq(index).fadeIn().siblings('section').fadeOut(100);
            }

            if( $currentSection.innerHeight() > $sections.innerHeight() ){
                changeHeight();
            } else {
                setTimeout(function() {
                    changeHeight();
                }, 150);
            }

            if( $this.index() === 0 ){
                $("#modal-custom .iziModal-content .icon-close").css('background', '#ddd');
            } else {
                $("#modal-custom .iziModal-content .icon-close").attr('style', '');
            }
        });

        function resized(x){
            var $this = $("#modal-custom");

            var index = x;
            //$this.addClass('active').siblings('a').removeClass('active');
            
            var $sections = $this.closest('div').find('.sections');
            //console.log(index);

            var $currentSection = $this.closest("div").find("section").eq(x);
            //var $nextSection = $this.closest("div").find("section").eq(index).siblings('section');

            $sections.css('height', $currentSection.innerHeight());

            function changeHeight(){
                $this.closest("div").find("section").eq(x).fadeIn().siblings('section').fadeOut(100);
            }

            if( $currentSection.innerHeight() > $sections.innerHeight() ){
                changeHeight();
            } else {
                setTimeout(function() {
                    changeHeight();
                }, 150);
            }

            if( $this.index() === 0 ){
                $("#modal-custom .iziModal-content .icon-close").css('background', '#ddd');
            } else {
                $("#modal-custom .iziModal-content .icon-close").attr('style', '');
            }
        }//

    })
</script>

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