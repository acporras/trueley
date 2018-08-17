<!-- Page header -->
<link href="<?php echo $url ?>assets/js/plugins/prism/prism.css" rel="stylesheet" />
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Docs</h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                <a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                <a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
            </div>
        </div>
    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
        <li><a href="<?php echo $url ?>home"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">Docs</li>
        </ul>

        <ul class="breadcrumb-elements">
            <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-gear position-left"></i>
                    Settings
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                    <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                    <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<script type="text/javascript" src="<?php echo $url ?>assets/js/plugins/media/fancybox.min.js"></script>
<script type="text/javascript" src="<?php echo $url ?>assets/js/pages/extension_blockui.js"></script>
<!-- /page header -->
<!-- Content area -->
<div class="content">
<!-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<!-- ||||||||||CONTENIDO A PARTIR DE AQUI||||||||||||||||||||||||||| -->

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="col-md-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Documentación</h6>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <div class="tabbable">
                    <ul class="nav nav-tabs nav-tabs-top">
                        <li class="active"><a href="#top-tab1" data-toggle="tab">General Class</a></li>
                        <li><a href="#top-tab2" data-toggle="tab">Firemanager Class</a></li>
                        <li><a href="#top-tab3" data-toggle="tab">Storage Class</a></li>
                        <li><a href="#top-tab4" data-toggle="tab">Valid Class</a></li>
                        <li><a href="#top-tab5" data-toggle="tab">Seguridad</a></li>
                        <li><a href="#top-tab6" data-toggle="tab">GuzzleHTTP</a></li>
                        <li><a href="#top-tab7" data-toggle="tab">Myemail</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="top-tab1">
                            <?php include(APPPATH.'/docs/general_docs.php') ?>
                        </div>

                        <div class="tab-pane" id="top-tab2">
                            <?php include(APPPATH.'/docs/fireuser_docs.php') ?>
                        </div>
                        
                        <div class="tab-pane" id="top-tab3">
                            <?php include(APPPATH.'/docs/cloudstorage_docs.php') ?>
                        </div>
                        
                        <div class="tab-pane" id="top-tab4">
                            <?php include(APPPATH.'/docs/validclass_docs.php') ?>
                        </div>

                        <div class="tab-pane" id="top-tab5">
                            <?php include(APPPATH.'/docs/seguridad_docs.php') ?>
                        </div>
                        
                        <div class="tab-pane" id="top-tab6">
                            <?php include(APPPATH.'/docs/guzzle_docs.php') ?>
                        </div>
                        
                        <div class="tab-pane" id="top-tab7">
                            <?php include(APPPATH.'/docs/mailjet_docs.php') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo $url ?>assets/js/plugins/prism/prism.js"></script>