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
                    <h3 class="panel-title">Lista de Tipos de estados</h3>
                    <div class="heading-elements">
                        <a href="#" onClick="" class="uk-icon-button uk-margin-small-right newTypeState" uk-icon="plus" uk-tooltip="title: Nuevo Tipo de Estado" ></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover datatable-basic">
                            <thead>
                                <tr>
                                    <th>Descripción</th>
                                    <th>Movimiento</th>
                                    <th>Estado</th>
                                    <th>Fecha Registro</th>
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
                                        <td><?php echo $item->movimiento ?></td>
                                        <td><span class="label <?php echo $cl; ?>" ><?php echo $tx; ?></span></td>
                                        <td><?php echo $item->fechareg ?></td>
                                        <td>
                                            <button class="btn btn-primary" type="button">
                                                <i class="icon-menu7"></i>
                                            </button>
                                            <div uk-dropdown="mode: click; pos:top-left">
                                                <ul class="uk-nav uk-dropdown-nav">
                                                    <li class="uk-active">
                                                        <a href="#" data-id="<?php echo $item->idTipoEstado ?>" onclick="editTypeState(<?php echo $item->idTipoEstado ?>);">
                                                            <i class="icon-database-edit2 text-primary"></i>
                                                            Editar
                                                        </a>
                                                    </li>
                                                    <li class="uk-active">
                                                        <a href="#" data-id="<?php echo $item->idTipoEstado ?>" onclick="delTypeState(<?php echo $item->idTipoEstado ?>);">
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
                        <h4 class="modal-title">Nuevo Tipo de Estado</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?php echo $url ?>parameters/types_states/newtypestate" id="formnew">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" placeholder="Descripción" name="description" required></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <span>Movimiento:</span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                    <div class="form-group">
                                        <select name="movement" class="form-control">
                                            <?php 
                                                if($mae_movimientos->cantidad>=1){
                                                    foreach($mae_movimientos->movimientos as $mov){
                                            ?>
                                                <option value="<?php echo $mov->campo2 ?>"><?php echo $mov->campo1 ?></option>
                                            <?php             
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
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
                        <h4 class="modal-title">Editar Tipo de estado</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?php echo $url ?>parameters/types_states/updatetypestate" id="formedit">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <textarea id="taDescription" class="form-control" rows="3" placeholder="Descripción" name="description" required></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <span>Movimiento:</span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                    <div class="form-group">
                                        <select id="cboMovement" name="movement" class="form-control">
                                            <?php 
                                                if($mae_movimientos->cantidad>=1){
                                                    foreach($mae_movimientos->movimientos as $mov){
                                            ?>
                                                <option value="<?php echo $mov->campo2 ?>"><?php echo $mov->campo1 ?></option>
                                            <?php             
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" id="txtIdTypeState"/>
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

    function editTypeState(dataid){
        var id = dataid;

        $.post('<?php echo $url ?>parameters/types_states/getfulldata',{
            id:id
        })
        .done(function(resp){
            if(resp !="201"){
                var d = eval("("+resp+")");
                $("#taDescription").val(d.descripcion);
                $("#cboMovement").val(d.codmovimiento);
                $("#txtIdTypeState").val(d.idTipoEstado);
                $("#modal-edit").modal('show');
                

            }else{
                new PNotify({
                    title: 'Atención',
                    text: 'Ha ocurrido un error inesperado, por favor, refresque la pagina he intente de nuevo',
                    icon: 'icon-warning22',
                    type: 'error'
                });
            }
        })
        .fail(function(err){
                new PNotify({
                    title: 'Atención',
                    text: 'Ha ocurrido un error inesperado, por favor, refresque la pagina he intente de nuevo',
                    icon: 'icon-warning22',
                    type: 'error'
                });
        })
    }

    function delTypeState(dataid){
        var id = dataid;
        UIkit.modal.confirm('¿Esta seguro de eliminar el Tipo de estado?').then(function () {
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
                $.post('<?php echo $url ?>parameters/types_states/deltypestate',{
                    id:id,
                    clave:clave
                })
                .done(function(resp){
                    console.log(resp);
                    $("body").unblock();
                    if($.trim(resp)=="200"){
                        UIkit.modal.alert('Se ha eliminado el Tipo de estado correctamente, se procederá a refrescar las listas').then(function () {
                            window.location.href="<?php echo $url ?>parameters/types_states";
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

            case 'SuccessInsert':
                var msga = $("#modal-alert2").iziModal({
                    title: "Exito!",
                    subtitle: 'Se ha registrado el Tipo de estado',
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
                    subtitle: 'No se pudo insertar el Tipo de estado',
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
                    subtitle: 'Se ha actualizado correctamente el Tipo de estado',
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
                    subtitle: 'No se pudo actualizar el Tipo de estado',
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

        $(".newTypeState").click(function(e){
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