<!-- Page header -->
<div class="page-header page-header-default no-padding" style="margin:0px !important">
    <div class="page-header-content">
        <div class="page-title">
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $this->lang->line('navinicio'); ?></span> - <?php echo $this->lang->line('navmodulo'); ?>  <b><?php echo ucwords($datos->info->nombrefirma); ?></b></h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <?php include(APPPATH.'/helpers/Botones_header.php'); ?>
            </div>
        </div>
    </div>

    <!--div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo $url ?>home"><i class="icon-home2 position-left"></i> <?php echo $this->lang->line('navinicio'); ?></a></li>
            <li><a href="<?php echo $url ?>lawyers"><i class="icon-users position-left"></i> <?php echo $this->lang->line('navgestion'); ?></a></li>
            <li class="active"><?php echo $this->lang->line('navmodulo'); ?></li>
        </ul>

        <ul class="breadcrumb-elements">
        </ul>
    </div-->
</div>
<style>
.media .profile-thumb img {
    width: 100px !important;
    height: 100px !important;
    max-width: 100px !important;
}
</style>
<script type="text/javascript" src="<?php echo $url ?>assets/js/plugins/media/fancybox.min.js"></script>
<script type="text/javascript" src="<?php echo $url ?>assets/js/pages/extension_blockui.js"></script>
<div class="navbar navbar-default navbar-xs content-group">
    <ul class="nav navbar-nav visible-xs-block">
        <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
    </ul>

    <div class="navbar-collapse collapse" id="navbar-filter">
        <ul class="nav navbar-nav">
            <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true" style=""><i class="icon-menu7 position-left"></i> Actividad</a></li>
            <li class=""><a href="#pagos" data-toggle="tab" aria-expanded="false" style=""><i class="icon-cash3 position-left"></i> Pagos <span class="badge bg-danger pull-right"><?php echo ($datos->histo) ? count($datos->histo) : '0' ?></span></a></li>
            <!--li class=""><a href="#notificaciones" data-toggle="tab" aria-expanded="false" style=""><i class="icon-envelope position-left"></i> Notificaciones</a></li-->
        </ul>

        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style=""><i class="icon-gear"></i> <span class="position-right"> Opciones</span> <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a 
                            href="#" 
                            class="inactivar" 
                            data-id="<?php echo $datos->info->idCliente ?>" 
                            data-tipo="<?php echo ($datos->info->estatus=="1") ? 'inactivar' : 'activar' ?>">
                                <i class="<?php echo ($datos->info->estatus=="1") ? 'icon-database-remove' : 'icon-database-add' ?>"></i> 
                                    <?php echo ($datos->info->estatus=="1") ? 'Inactivar' : 'Activar' ?> Cliente
                            </a>
                        </li>
                        <li><a 
                            href="#" 
                            class="eliminar" 
                            data-id="<?php echo $datos->info->idCliente ?>" 
                            data-tipo="eliminar">
                                <i class="<?php echo ($datos->info->estatus=="1") ? 'icon-database-remove' : 'icon-database-add' ?>"></i> 
                                    Eliminar Cliente
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
<!-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<!-- ||||||||||CONTENIDO A PARTIR DE AQUI||||||||||||||||||||||||||| -->

<div class="row">
    <?php include(__DIR__.'/Timeline.php'); ?>
    <?php include(__DIR__.'/Tarjetas.php'); ?>
</div>



<script>
    $(function(){
        $(".inactivar").click(function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            var tipo = $(this).attr('data-tipo');
            UIkit.modal.confirm('Esta seguro que desea desactivar a este cliente??').then(function () {
                UIkit.modal.prompt('Ingrese su clave de acceso para confirmar', '').then(function (clave) {
                    block();
                    $.post('<?php echo $url ?>profile/estatus',{
                        id:id,
                        clave:clave,
                        tipo:tipo
                    })
                    .done(function(resp){
                        $("body").unblock();
                        if(resp=="200"){
                            window.location.href="<?php echo $url ?>profile?msg=successChange&id=<?php echo $_GET['id'] ?>";
                        }else{
                            new PNotify({
                                title: 'Atención',
                                text: 'Ha ocurrido un error inesperado, por favor, intente nuevamente',
                                icon: 'icon-warning22'
                            });
                        }
                    })
                    .fail(function(err){
                        $("body").unblock();
                            new PNotify({
                                title: 'Atención',
                                text: 'Ha ocurrido un error inesperado, por favor, intente nuevamente',
                                icon: 'icon-warning22'
                            });
                    })
                });

            }, function () {
                console.log('Rejected.')
            });
        })


        $(".eliminar").click(function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            var tipo = $(this).attr('data-tipo');
            UIkit.modal.confirm('Esta seguro de eliminar esta Cuenta?? Esta acción es irreversible y destruirá toda la informacion en el sistema').then(function () {
                UIkit.modal.prompt('Ingrese su clave de acceso para confirmar la eliminación', '').then(function (clave) {
                    block();
                    $.post('<?php echo $url ?>profile/estatus',{
                        id:id,
                        clave:clave,
                        tipo:tipo
                    })
                    .done(function(resp){
                        $("body").unblock();
                        if(resp=="200"){
                            window.location.href="<?php echo $url ?>lawyers?msg=successDelete";
                        }else{
                            new PNotify({
                                title: 'Atención',
                                text: 'Ha ocurrido un error inesperado, por favor, intente nuevamente',
                                icon: 'icon-warning22'
                            });
                        }
                    })
                    .fail(function(err){
                        $("body").unblock();
                            new PNotify({
                                title: 'Atención',
                                text: 'Ha ocurrido un error inesperado, por favor, intente nuevamente',
                                icon: 'icon-warning22'
                            });
                    })
                });

            }, function () {
                console.log('Rejected.')
            });
        })

        $(".enviar").click(function(e){
            e.preventDefault();
            var mensaje = $("#mensaje").val();
            var cod = $(this).attr('data-cod');

            if(mensaje==""){
                new PNotify({
                    title: 'Atención',
                    text: 'Debe escribir un mensaje a enviar',
                    icon: 'icon-warning22',
                    type: 'error'
                });
                return false;
            }
                
                block();
                $.post('<?php echo $url; ?>profile/sendMessage',{
                    mensaje:mensaje,
                    codcliente:cod
                })
                .done(function(resp){
                    $("body").unblock();
                    if(resp=="200"){
                        new PNotify({
                            title: 'Éxito',
                            text: 'Mensaje Enviado',
                            icon: 'icon-warning22',
                            type: 'success'
                        });
                        $("#mensaje").val("");
                    }else{
                        new PNotify({
                            title: 'Atención',
                            text: 'Ha ocurrido un error, por favor, intente nuevamente',
                            icon: 'icon-warning22',
                            type: 'error'
                        });
                    }
                })
                .fail(function(err){
                    $("body").unblock();
                    new PNotify({
                        title: 'Atención',
                        text: 'Ha ocurrido un error, por favor, intente nuevamente',
                        icon: 'icon-warning22',
                        type: 'error'
                    });
                })

        })
    })

    function block(){
        $("body").block({
            message: '<span class="text-semibold"><i class="icon-spinner4 spinner position-left"></i>&nbsp; Procesando...</span>',
            timeout: 600000, 
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
        
    }
</script>