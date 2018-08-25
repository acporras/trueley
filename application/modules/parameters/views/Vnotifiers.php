<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $this->lang->line('navinicio'); ?></span> - <?php echo $this->lang->line('navmodulo'); ?> - <?php echo $this->lang->line('navsubmo1'); ?></h4>
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
<link href="<?php echo $url; ?>assets/inicio/css/iziModal.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo $url ?>assets/js/plugins/media/fancybox.min.js"></script>
<script type="text/javascript" src="<?php echo $url ?>assets/js/pages/extension_blockui.js"></script>
<script type="text/javascript" src="<?php echo $url; ?>assets/inicio/js/iziModal.min.js"></script>
<!-- /page header -->
<!-- Content area -->
<div class="content">
    <!-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
    <!-- ||||||||||CONTENIDO A PARTIR DE AQUI||||||||||||||||||||||||||| -->
    <?php 
        if(!$this->_session->data->cliente->estatus){ 
            $this->load->view('layouts/admin/Alerta');
        }else{
    ?>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Lista de Notificadores</h3>
                    <div class="heading-elements">
                        <a href="#" onClick="" class="uk-icon-button uk-margin-small-right newNotifier" uk-icon="plus" uk-tooltip="title: Nuevo Notificador" ></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover datatable-basic">
                            <thead>
                                <tr>
                                    <th>Descripción</th>
                                    <th>Domicilio</th>
                                    <th>Ciudad</th>
                                    <th>C. Postal</th>
                                    <th>Teléfono</th>
                                    <th>Fax</th>
                                    <th>E-mail</th>
                                    <th>Estado</th>
                                    <th>Fecha registro</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if($lista->cantidad>=1){
                                        foreach ($lista ->datos as $item) {
                                            $cl = ($item->estatus) ? 'bg-success' : 'bg-danger'; 
                                            $tx = ($item->estatus == '1') ? 'Activo' : 'Inactivo'; 
                                ?>
                                    <tr>
                                        <td><?php echo $item->descripcion ?></td>
                                        <td><?php echo $item->domicilio ?></td>
                                        <td><?php echo $item->ciudad ?></td>
                                        <td><?php echo $item->codigo_postal ?></td>
                                        <td><?php echo $item->telefono ?></td>
                                        <td><?php echo $item->fax ?></td>
                                        <td><?php echo $item->correo ?></td>
                                        <td><span class="label <?php echo $cl; ?>" ><?php echo $tx; ?></span></td>
                                        <td><?php echo $item->fechareg ?></td>
                                        <td>
                                            <button class="btn btn-primary" type="button">
                                                <i class="icon-menu7"></i>
                                            </button>
                                            <div uk-dropdown="mode: click; pos:top-left">
                                                <ul class="uk-nav uk-dropdown-nav">
                                                    <li class="uk-active">
                                                        <a href="#" data-id="<?php echo $item->idNotificador ?>" onclick="editNotifier(<?php echo $item->idNotificador ?>);">
                                                            <i class="icon-database-edit2 text-primary"></i>
                                                            Editar
                                                        </a>
                                                    </li>
                                                    <li class="uk-active">
                                                        <a href="#" data-id="<?php echo $item->idNotificador ?>" onclick="delNotifier(<?php echo $item->idNotificador ?>);">
                                                            <i class="icon-database-remove text-danger"></i>
                                                            Eliminar
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>            
                                <?php        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-new">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Nuevo Notificador</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?php echo $url ?>parameters/notifiers/newnotifier" id="formnew">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <textarea name="description" class="form-control" placeholder="Descripción"></textarea>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <textarea name="address" class="form-control" placeholder="Domicilio"></textarea>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
                                    <input name="city" class="form-control" placeholder="Ciudad"></input>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <input name="postalcode" class="form-control" placeholder="C. Postal"></input>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <input name="phone" class="form-control" placeholder="Telefono"></input>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <input name="fax" class="form-control" placeholder="Fax"></input>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <input name="email" class="form-control" placeholder="Correo"></input>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-6 col-lg-6 col-lg-offset-6">
                                    <input name="auxiliar1" class="form-control" placeholder="Auxiliar 1"></input>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <input name="auxiliar2" class="form-control" placeholder="Auxiliar 2"></input>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="button" class="btn btn-primary btnregister">
                            Registrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-edit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Editar Notificador</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?php echo $url ?>parameters/notifiers/updatenotifier" id="formedit">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <textarea id="taDescription" name="description" class="form-control" placeholder="Descripción"></textarea>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <textarea id="taAddress" name="address" class="form-control" placeholder="Domicilio"></textarea>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
                                    <input id="txtCity" name="city" class="form-control" placeholder="Ciudad"></input>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <input id="txtPostalCode" name="postalcode" class="form-control" placeholder="C. Postal"></input>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <input id="txtPhone" name="phone" class="form-control" placeholder="Telefono"></input>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <input id="txtFax" name="fax" class="form-control" placeholder="Fax"></input>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <input id="txtEmail" name="email" class="form-control" placeholder="Correo"></input>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-6 col-lg-6 col-lg-offset-6">
                                    <input id="txtAuxiliar1" name="auxiliar1" class="form-control" placeholder="Auxiliar 1"></input>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <input id="txtAuxiliar2" name="auxiliar2" class="form-control" placeholder="Auxiliar 2"></input>
                                </div>
                            </div>
                            <input type="hidden" name="id" id="txtIdNotifier"/>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="button" class="btn btn-primary btnupdate">
                            Actualizar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal-alert2"></div>
    <?php } ?>
</div>

<script type="text/javascript">
    var msg = '<?php echo isset($_GET['msg']) ? $_GET['msg'] : '' ?>';

    function editNotifier(dataid){
        var id = dataid;

        $.post('<?php echo $url ?>parameters/notifiers/getfulldata',{
            id:id
        })
        .done(function(resp){
            if(resp !="201"){
                var d = eval("("+resp+")");
                $("#taDescription").val(d.descripcion);
                $("#taAddress").val(d.direccion);
                $("#txtCity").val(d.ciudad);
                $("#txtPostalCode").val(d.codigo_postal);
                $("#txtPhone").val(d.telefono);
                $("#txtFax").val(d.fax);
                $("#txtEmail").val(d.correo);
                $("#txtAuxiliar1").val(d.auxiliar1);
                $("#txtAuxiliar2").val(d.auxiliar2);
                $("#txtIdNotifier").val(d.idNotificador);
                $("#modal-edit").modal('show');
                

            }else{
                new PNotify({
                    title: 'Atención',
                    text: 'Ha ocurrido un error inesperado, por favor, refresque la pagina he inetente de nuevo',
                    icon: 'icon-warning22',
                    type: 'error'
                });
            }
        })
        .fail(function(err){
                new PNotify({
                    title: 'Atención',
                    text: 'Ha ocurrido un error inesperado, por favor, refresque la pagina he inetente de nuevo',
                    icon: 'icon-warning22',
                    type: 'error'
                });
        })
    }

    function delNotifier(dataid){
        var id = dataid;
        UIkit.modal.confirm('¿Esta seguro de eliminar el Notificador?').then(function () {
            UIkit.modal.prompt('Ingrese su clave de acceso para confirmar la eliminación', '').then(function (clave) {

                if(clave==""){
                    new PNotify({
                        title: 'Atención',
                        text: 'Debe ingresar la clave de acceso',
                        icon: 'icon-warning22'
                    });
                    return false;
                }

                $("body").block({
                    message: '<span class="text-semibold"><i class="icon-spinner4 spinner position-left"></i>&nbsp; Eliminando Registro...</span>',
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
                $.post('<?php echo $url ?>parameters/notifiers/delnotifier',{
                    id:id,
                    clave:clave
                })
                .done(function(resp){
                    console.log(resp);
                    $("body").unblock();
                    if($.trim(resp)=="200"){
                        UIkit.modal.alert('Se ha eliminado el Notificador correctamente, se procederá a refrescar las listas').then(function () {
                            window.location.href="<?php echo $url ?>parameters/notifiers";
                        });

                    }else{
                        new PNotify({
                            title: 'Atención',
                            text: 'Ha ocurrido un error inesperado o la data esta errada',
                            icon: 'icon-warning22'
                        });
                    }

                })
                .fail(function(err){
                    $("body").unblock();

                })

            });
        }, function () {
            new PNotify({
                title: 'Info',
                text: 'Ha cancelado la eliminación',
                icon: 'icon-warning22'
            });
        });
    }

    $(function(){
        switch (msg) {
            case 'emptyDescription':
                var msga = $("#modal-alert2").iziModal({
                    title: "Alerta",
                    subtitle: 'Se debe incluir una descripción',
                    headerColor: '#f4d276',
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

            case 'emptyPhone':
                var msga = $("#modal-alert2").iziModal({
                    title: "Alerta",
                    subtitle: 'Se debe incluir un telefono',
                    headerColor: '#f4d276',
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

            case 'SuccessInsert':
                var msga = $("#modal-alert2").iziModal({
                    title: "Exito!",
                    subtitle: 'Se ha registrado el Notificador',
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

            case 'FailedInsert':
                var msga = $("#modal-alert2").iziModal({
                    title: "Error!",
                    subtitle: 'No se pudo insertar el Notificador',
                    headerColor: '#BD5B5B',
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

            case 'SuccessUpdate':
                var msga = $("#modal-alert2").iziModal({
                    title: "Exito!",
                    subtitle: 'Se ha actualizado correctamente el Notificador',
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

            case 'FailedUpdate':
                var msga = $("#modal-alert2").iziModal({
                    title: "Error!",
                    subtitle: 'No se pudo actualizar el Notificador',
                    headerColor: '#BD5B5B',
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
        }

        $(".newNotifier").click(function(e){
            e.preventDefault();
            $("#modal-new").modal('show');
        });

        $(".btnregister").click(function(e){
            e.preventDefault();
            if (!$("#formnew")[0].checkValidity()) {
                $("#formnew").find("#submit-hidden").click();
            }else{
                $("#formnew").submit();
            }
        });

        $(".btnupdate").click(function(){
            if (!$("#formedit")[0].checkValidity()) {
                $("#formedit").find("#submit-hidden").click();
            }else{
                $("#formedit").submit();
            }
        });
    });
</script>