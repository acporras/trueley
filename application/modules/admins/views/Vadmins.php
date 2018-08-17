<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $this->lang->line('navinicio'); ?></span> - <?php echo $this->lang->line('navmodulo'); ?></h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <?php include(APPPATH.'/helpers/Botones_header.php'); ?>
            </div>
        </div>
    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo $url ?>home"><i class="icon-home2 position-left"></i> <?php echo $this->lang->line('navinicio'); ?></a></li>
            <li class="active"><?php echo $this->lang->line('navmodulo'); ?></li>
        </ul>

        <ul class="breadcrumb-elements">
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
    
    
    <div class="panel panel-primary">
          <div class="panel-heading">
                <h3 class="panel-title"><?php echo $this->lang->line('tituloPanel') ?></h3>
                <div class="heading-elements">
                    <a href="#" onClick="" class="uk-icon-button uk-margin-small-right newAdmin" uk-icon="plus" uk-tooltip="title: <?php echo $this->lang->line('tooltip_newadmin') ?>" ></a>
                </div>
          </div>
          <div class="panel-body">
                
                <div class="table-responsive">
                    <table class="table table-hover datatable-basic">
                        <thead>
                            <tr>
                                <th><?php echo $this->lang->line('tablaid') ?></th>
                                <th><?php echo $this->lang->line('tablaemail') ?></th>
                                <th><?php echo $this->lang->line('tablanombre') ?></th>
                                <th><?php echo $this->lang->line('tabladocumento') ?></th>
                                <th><?php echo $this->lang->line('tablaregistro') ?></th>
                                <th><?php echo $this->lang->line('tablaestado') ?></th>
                                <th><?php echo $this->lang->line('tablaopciones') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php if($lista){ foreach($lista as $item){
                        $clase = ($item->estatus == "Active") ? "bg-success" : "bg-danger";
                        $est = ($item->estatus == "Active") ? "Suspender" : "Activar";
                        $icon = ($item->estatus == "Active") ? "icon-arrow-down-right3" : "icon-arrow-up-right3";
                         ?>
                            <tr>
                                <td><?php echo $item->idUsuario; ?></td>
                                <td><?php echo $item->usuario; ?></td>
                                <td><?php echo $item->nombre; ?></td>
                                <td><?php echo $item->documento; ?></td>
                                <td><?php echo date("d-m-Y", strtotime($item->fechareg)); ?></td>
                                <td><span class="label <?php echo $clase ?>"><?php echo $item->estatus; ?></span></td>
                                <td>
                                <?php if($this->_session->data->usuario != $item->usuario){ ?>
                                    <button 
                                        type="button"
                                        class="btn bg-danger btn-sm eliminar" 
                                        uk-tooltip="title: Eliminar" 
                                        data-id="<?php echo $item->idUsuario; ?>" 
                                        data-estatus="<?php echo $item->estatus; ?>" >
                                        <i class="icon-x"></i>
                                    </button>
                                
                                    <button 
                                        type="button"
                                        class="btn bg-primary btn-sm <?php echo $est ?>" 
                                        uk-tooltip="title: <?php echo $est ?>" 
                                        data-id="<?php echo $item->idUsuario; ?>" 
                                        data-estatus="<?php echo $item->estatus; ?>" >
                                        <i class="<?php echo $icon ?>"></i>
                                    </button>
                                <?php } ?>

                                <?php if($this->_session->data->usuario == $item->usuario){ ?>
                                    <button 
                                        type="button"
                                        class="btn bg-primary btn-sm clave" 
                                        uk-tooltip="title: Cambio Clave" 
                                        data-id="<?php echo $item->idUsuario; ?>" 
                                        data-estatus="<?php echo $item->estatus; ?>" >
                                        <i class="icon-key"></i>
                                    </button>
                                <?php } ?>

                                    <button 
                                        type="button"
                                        class="btn bg-slate-700 btn-sm editar" 
                                        uk-tooltip="title: Editar" 
                                        data-nombre="<?php echo $item->nombre; ?>" 
                                        data-email="<?php echo $item->usuario; ?>" 
                                        data-documento="<?php echo $item->documento; ?>" 
                                        data-id="<?php echo $item->idUsuario; ?>" 
                                        data-estatus="<?php echo $item->estatus; ?>" >
                                        <i class="icon-pencil6"></i>
                                    </button>

                                </td>
                            </tr>
                    <?php }
                    }else{ ?>
                        <tr>
                            <td colspan="7">
                                <div class="alert alert-info">
                                    <strong>INFO!</strong> Sin Administradores Registrados
                                </div>
                            </td>
                        </tr>

                    <?php } ?>
                        </tbody>
                    </table>
                </div>
                
          </div>
    </div>
    


</div>

<!--Nuevo Admin-->
<div class="modal fade" id="modal-nuevo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('titmodalnuevo') ?></h4>
            </div>
            <div class="modal-body">

            <form method="post" action="<?php echo $url ?>admins/newadmin" id="formnuevo">
                
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email" name="email" required/>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Nombre y Apellido" name="nombre" required/>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Documento" name="documento" required/>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Ingrese la Clave" name="clave11" required/>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Repita la Clave" name="clave22" required/>
                        </div>
                    </div>
                    
                </div>
                
            </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancelar') ?></button>
                <button type="button" class="btn btn-primary btnregistrar"><?php echo $this->lang->line('registrar') ?></button>
            </div>
        </div>
    </div>
</div>
<!--end/Nuevo Admin-->

<!--cambio de clave-->
<div id="modal-group-1" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Cambio de Clave</h2>
        </div>
        <div class="uk-modal-body">
            <p>
                
                <div class="alert alert-warning">
                    <strong>Atención!</strong> una vez complete el cambio de clave el sistema automaticamente lo desconectara para que vuelva a ingresar.
                </div>
                
            </p>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
            <a href="#modal-group-2" class="uk-button uk-button-primary" uk-toggle>Continuar</a>
        </div>
    </div>
</div>

<div id="modal-group-2" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Cambio de Clave</h2>
        </div>
        <div class="uk-modal-body">
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                    <input type="password" name="claveanterior" id="claveanterior" class="form-control" placeholder="Clave Anterior"/>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                    <input type="password" name="clave1" id="clave1" class="form-control" placeholder="Clave"/>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                    <input type="password" name="clave2" id="clave2" class="form-control" placeholder="Repita Clave"/>
                </div>
            </div>
            
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
            <a href="#" onClick="completaClave()" class="uk-button uk-button-primary">Completar</a>
        </div>
    </div>
</div>
<!--end/cambio de clave-->

<!--edit admin-->
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Editar Usuario</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo $url ?>admins/edit" id="formedit">
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label>Usuario/Email</label>
                                <input type="text" name="emailedit" id="emailedit" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label>Nombre y Apellido</label>
                                <input type="text" name="nombreedit" id="nombreedit" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label>Documento</label>
                                <input type="text" name="documentoedit" id="documentoedit" class="form-control" required/>
                            </div>
                        </div>
                        
                    </div>
                    <input type="hidden" name="idedit" id="idedit"/>
                    <input id="submit-hidden" type="submit" style="display: none" />
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" onClick="saveedit()" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!--end/edit admin-->


<script>
    $(function(){
        $(".newAdmin").click(function(e){
            e.preventDefault();
            $("#modal-nuevo").modal('show');
        })

        $(".btnregistrar").click(function(e){
            e.preventDefault();
            $("#formnuevo").submit();
        })

        $(".eliminar").click(function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            var estatus = $(this).attr('data-estatus');

            UIkit.modal.confirm('Está Seguro de suspender a este Administrador?').then(function () {
                //console.log('Confirmed.')
                UIkit.modal.prompt('Ingrese su clave de Acceso para Confirmar', '').then(function (name) {
                    
                    if(name==""){
                        new PNotify({
                            title: 'Atención',
                            text: 'Debe ingresar su clave de acceso para confirmar la eliminación, por favor, intente nuevamente',
                            icon: 'icon-warning22',
                            type: 'error'
                        });
                        return false;
                    }
                    
                    bloker();
                    $.post('<?php echo $url ?>admins/estatus',{
                        tipo:'eliminar',
                        id:id,
                        clave:name
                    })
                    .done(function(resp){
                        if(resp=="200"){
                            setTimeout(() => {
                                window.location.href="<?php echo $url ?>admins?msg=successDelete";
                            }, 1500);
                        }else{
                            $("body").unblock();
                            new PNotify({
                                title: 'Atención',
                                text: 'Ha ocurrido un error inesperado, por favor, intente nuevamente',
                                icon: 'icon-warning22',
                                type: 'error'
                            });
                            
                        }
                    })
                    .fail(function(err){
                            $("body").unblock();
                            new PNotify({
                                title: 'Atención',
                                text: 'Ha ocurrido un error inesperado, por favor, intente nuevamente',
                                icon: 'icon-warning22',
                                type: 'error'
                            });
                    }) 
                });
            }, function () {
                new PNotify({
                    title: 'Atención',
                    text: 'Ha cancelado la Eliminación',
                    icon: 'icon-warning22',
                    type: 'success'
                });
            });

        })
        
        $(".Suspender").click(function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            var estatus = $(this).attr('data-estatus');
            UIkit.modal.confirm('Está Seguro de suspender a este Administrador?').then(function () {
                //console.log('Confirmed.')
                bloker();
                $.post('<?php echo $url ?>admins/estatus',{
                    tipo:'suspender',
                    id:id,
                    clave:'na'
                })
                .done(function(resp){
                    if(resp=="200"){
                        setTimeout(() => {
                            window.location.href="<?php echo $url ?>admins?msg=successDeactive";
                        }, 1500);
                    }else{
                        $("body").unblock();
                        new PNotify({
                            title: 'Atención',
                            text: 'Ha ocurrido un error inesperado, por favor, intente nuevamente',
                            icon: 'icon-warning22',
                            type: 'error'
                        });
                    }
                })
                .fail(function(err){
                    $("body").unblock();
                        new PNotify({
                            title: 'Atención',
                            text: 'Ha ocurrido un error inesperado, por favor, intente nuevamente',
                            icon: 'icon-warning22',
                            type: 'error'
                        });
                })

            }, function () {
                new PNotify({
                    title: 'Atención',
                    text: 'Ha cancelado la Suspención',
                    icon: 'icon-warning22',
                    type: 'success'
                });
            });
        })
        
        $(".Activar").click(function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            var estatus = $(this).attr('data-estatus');
            UIkit.modal.confirm('Está Seguro de activar a este Administrador?').then(function () {
                //console.log('Confirmed.')
                bloker();
                $.post('<?php echo $url ?>admins/estatus',{
                    tipo:'activar',
                    id:id,
                    clave:'na'
                })
                .done(function(resp){
                    if(resp=="200"){
                        setTimeout(() => {
                            window.location.href="<?php echo $url ?>admins?msg=successActivate";
                        }, 1500);
                    }else{
                        $("body").unblock();
                        new PNotify({
                            title: 'Atención',
                            text: 'Ha ocurrido un error inesperado, por favor, intente nuevamente',
                            icon: 'icon-warning22',
                            type: 'error'
                        });
                    }
                })
                .fail(function(err){
                    $("body").unblock();
                        new PNotify({
                            title: 'Atención',
                            text: 'Ha ocurrido un error inesperado, por favor, intente nuevamente',
                            icon: 'icon-warning22',
                            type: 'error'
                        });
                })

            }, function () {
                new PNotify({
                    title: 'Atención',
                    text: 'Ha cancelado la Activación',
                    icon: 'icon-warning22',
                    type: 'success'
                });
            });
        })
        
        $(".clave").click(function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            var estatus = $(this).attr('data-estatus');

            UIkit.modal('#modal-group-1').show();
        })

        $(".editar").click(function(e){
            e.preventDefault();
            $("#emailedit").val($(this).attr('data-email'));
            $("#nombreedit").val($(this).attr('data-nombre'));
            $("#documentoedit").val($(this).attr('data-documento'));
            $("#idedit").val($(this).attr('data-id'));
            $("#modal-edit").modal('show');

        })
    })

    function saveedit(){
        if (!$("#formedit")[0].checkValidity()) {
            $("#formedit").find("#submit-hidden").click();
        }else{
            $("#formedit").submit();
        }
    }//

    function completaClave(){
        var anterior = $("#claveanterior").val();
        var clave1 = $("#clave1").val();
        var clave2 = $("#clave2").val();

        if(clave1 !== clave2){
            new PNotify({
                title: 'Atención',
                text: 'Las claves no coinciden, por favor, verifique he intente de nuevo.',
                icon: 'icon-warning22',
                type: 'error'
            });
            return false;
        }//
        
        bloker();
        UIkit.modal('#modal-group-2').hide();
        $.post('<?php echo $url ?>admins/cambioclave',{
            anterior:anterior,
            clave1:clave1,
            clave2:clave2
        })
        .done(function(resp){
            $("#clave1").val("");
            $("#clave2").val("");
            $("#claveanterior").val("");
            if(resp=="200"){
                $("body").unblock();
                new PNotify({
                    title: 'Éxito',
                    text: 'Ha cambiado su clave correctamente, en 3 segundos será desconectado',
                    icon: 'icon-warning22',
                    type: 'success'
                });
                setTimeout(() => {
                    window.location.href="<?php echo $url ?>login/logout";
                }, 3000);
            }else{
                $("#clave1").val("");
                $("#claveanterior").val("");
                $("#clave2").val("");
                $("body").unblock();
                new PNotify({
                    title: 'Atención',
                    text: 'Ha ocurrido un error inesperado, por favor, verifique',
                    icon: 'icon-warning22',
                    type: 'error'
                });
            }
        })
        .fail(function(err){
                $("#clave1").val("");
                $("#clave2").val("");
                $("#claveanterior").val("");
                $("body").unblock();
                new PNotify({
                    title: 'Atención',
                    text: 'Ha ocurrido un error inesperado, por favor, verifique',
                    icon: 'icon-warning22',
                    type: 'error'
                });
        })

    }//


    function bloker(){
        $("body").block({
            message: '<span class="text-semibold"><i class="icon-spinner4 spinner position-left"></i>&nbsp; Procesando...</span>',
            timeout: 600000, //unblock after 2 seconds
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
    }

    
</script>