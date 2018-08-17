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

<?php if($lista->cantidad >= $this->_session->data->plan->limiteplan){ ?>
    <div class="alert alert-warning">
        <strong><i class="icon-warning22"></i> ATENCIÓN!</strong> Ha alcanzado el limite máximo de usuarios permitidos por su plan, para registrar más usuarios, por favor, cambie a un plan de pago superior.
    </div>
<?php } ?>


<?php 
    if(!$this->_session->data->cliente->estatus){ 
        $this->load->view('layouts/admin/Alerta');
    }else{
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    
    <div class="panel panel-primary">
          <div class="panel-heading">
                <h3 class="panel-title">Lista de Usuarios</h3>
                <?php if($lista->cantidad < $this->_session->data->plan->limiteplan){ ?>
                    <div class="heading-elements">
                        <a href="#" onClick="" class="uk-icon-button uk-margin-small-right newUser" uk-icon="plus" uk-tooltip="title: Nuevo Usuario" ></a>
                    </div>
                <?php } ?>
          </div>
          <div class="panel-body">
                
                <div class="table-responsive">
                    <table class="table table-hover datatable-basic">
                        <thead>
                            <tr>
                                <th>Fecha Registro</th>
                                <th>Nombre</th>
                                <th>Documento</th>
                                <th>Email</th>
                                <th>Estatus</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php if($lista->cantidad>=1){ foreach($lista->datos as $item){
                    $cl = ($item->estado) ? 'bg-success' : 'bg-danger'; 
                    ?>
                            <tr>
                                <td><?php echo date("d-m-Y H:i a", strtotime($item->fechareg)) ?></td>
                                <td><?php echo $item->nombre ?></td>
                                <td><?php echo $item->documento ?></td>
                                <td><?php echo $item->usuario ?></td>
                                <td><span class="label <?php echo $cl; ?>" ><?php echo $item->estatus ?></span></td>
                                <td>
                                
                                    <button 
                                        type="button" 
                                        data-id="<?php echo $item->idUsuario ?>" 
                                        data-cod="<?php echo $item->codcliente ?>" 
                                        data-usuario="<?php echo $item->usuario ?>" 
                                        data-nombre="<?php echo $item->nombre ?>" 
                                        data-documento="<?php echo $item->documento ?>" 
                                        uk-tooltip="title: Editar Usuario" 
                                        class="btn bg-teal-800 btn-sm editar"><i class="icon-pencil6"></i></button>
                                    <button 
                                        type="button" 
                                        data-id="<?php echo $item->idUsuario ?>" 
                                        data-cod="<?php echo $item->codcliente ?>" 
                                        data-usuario="<?php echo $item->usuario ?>" 
                                        data-nombre="<?php echo $item->nombre ?>" 
                                        data-documento="<?php echo $item->documento ?>" 
                                        uk-tooltip="title: Cambio de Clave" 
                                        class="btn bg-slate-800 btn-sm clave"><i class="icon-key"></i></button>
                                
                                <?php if($item->usuario != $this->_session->data->usuario){ ?>
                                    <button 
                                        type="button" 
                                        data-id="<?php echo $item->idUsuario ?>" 
                                        data-nombre="<?php echo $item->nombre ?>" 
                                        uk-tooltip="title: Eliminar Usuario" 
                                        class="btn btn-danger btn-sm eliminar"><i class="icon-cross2"></i></button>
                                <?php } ?>

                                </td>
                            </tr>
                <?php } } ?>
                        </tbody>
                    </table>
                </div>
                
          </div>
    </div>
    
</div>



<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="formedit" method="post" action="<?php echo $url ?>clientusers/updateuser">
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control"/>
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <label>Documento:</label>
                                <input type="text" name="documento" id="documento" class="form-control"/>
                            </div>
                        </div>
                        <?php if($this->_session->data->nivel == "Client"){ ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                <div class="form-group">
                                    <label>¿Cambiar Email?</label>
                                    <select name="cambiouser" id="cambiouser" class="form-control" required="required">
                                        <option value="no">No</option>
                                        <option value="si">Si</option>
                                    </select>
                                    
                                </div>
                            </div>
                        <?php } ?>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <label>Nuevo Email/Usuario:</label>
                                <input type="email" name="email" id="email" disabled class="form-control"/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="alert alert-warning" id="alerta" style="display:none">
                            <strong><i class="icon-warning"></i> Atención!</strong> Esta acción es irrevercible, se enviará un Email para Confirmación del cambio al usuario.
                        </div>
                    </div>
                    
                    <input type="hidden" name="id" id="id"/>
                    <input type="hidden" name="codigo" id="cod"/>
                    <input id="submit-hidden" type="submit" style="display: none" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary actualizar">Actualizar</button>
            </div>
        </div>
    </div>
</div>


<?php if($lista->cantidad < $this->_session->data->plan->limiteplan){ ?>
    <div class="modal fade" id="modal-nuevo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Nuevo Usuario</h4>
                </div>
                <div class="modal-body">

                <form method="post" action="<?php echo $url ?>clientusers/newuser" id="formnuevo">
                    
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
                    <input id="submit-hidden" type="submit" style="display: none" />
                </form>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btnregistrar">Registrar</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<script>
    $(function(){

        $(".newUser").click(function(e){
            e.preventDefault();
            $("#modal-nuevo").modal('show');
        })

        $(".btnregistrar").click(function(e){
            e.preventDefault();
            if (!$("#formnuevo")[0].checkValidity()) {
                $("#formnuevo").find("#submit-hidden").click();
            }else{
                $("#formnuevo").submit();
            }
        })

        $("#cambiouser").change(function(e){
            var valor = $(this).val();
            if(valor=="si"){
                $("#email").removeAttr('disabled');
                $("#alerta").slideDown();
            }else{
                $("#email").attr('disabled','disabled');
                $("#alerta").slideUp();
            }
        })

        $("#modal-edit").on('hide.bs.modal',function(){
            $("#email").attr('disabled','disabled');
            $("#alerta").slideUp();
            $("#cambiouser option").each(function(){
                if($(this).val()=="no"){
                    $(this).attr('selected','selected')
                }else{
                    $(this).removeAttr('selected')
                }
            })
        })

        $(".eliminar").click(function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            var nombre = $(this).attr('data-nombre');


            var not = new PNotify({
                title: 'Eliminación de Usuario',
                text: '¿Esta seguro de eliminar al usuario '+nombre+'?. Esta acción es Irreversible',
                icon: 'icon-warning22',
                type: 'warning',
                confirm:{ confirm:true, buttons:[ { text:'Confirmar', addClass:'btn btn-primary' },{ text:'Cancelar', addClass:'btn btn-danger' } ] },
                buttons: { closer: false, sticker: false },
                history: { history: false }
            });

            not.get().on('pnotify.confirm',function(){
                    
                    var validar = new PNotify({
                        title: 'Validación',
                        text: 'Ingrese su clave de acceso al sistema para confirmar la eliminación del usuario '+nombre,
                        hide: false,
                        
                        confirm: { prompt: true, buttons: [ { text: 'Confirmar', addClass: 'btn btn-sm btn-success' },{ text:'Cancelar', addClass: 'btn btn-sm btn-link btn-danger' } ] },
                        buttons: { closer: false, sticker: false },
                        history: { history: false }
                    });//end validar

                    validar.get().on('pnotify.confirm', function(e, notice, val) {
                        $.post('<?php echo $url ?>clientusers/deleteUser',{
                            id:id,
                            clave:val
                        })
                        .done(function(resp){
                            if(resp=="200"){
                                window.location.href="<?php echo $url ?>clientusers?msg=successDelete"
                            }else{
                                window.location.href="<?php echo $url ?>clientusers?msg=failDelete"
                            }
                        })
                        .fail(function(err){

                        })
                    })//end confirm validar

            })//end not

            not.get().on('pnotify.cancel', function() {
                
            });


        })//

        $(".editar").click(function(e){
            e.preventDefault();
            var id        = $(this).attr('data-id');
            var cod       = $(this).attr('data-cod');
            var usuario   = $(this).attr('data-usuario');
            var nombre    = $(this).attr('data-nombre');
            var documento = $(this).attr('data-documento');

            $("#nombre").val(nombre);
            $("#documento").val(documento);
            $("#email").val(usuario);
            $("#id").val(id);
            $("#cod").val(cod);

            $(".modal-title").html('Editar Usuario '+nombre);

            $("#modal-edit").modal('show');

        })//

        $(".actualizar").click(function(){
            if (!$("#formedit")[0].checkValidity()) {
                $("#formedit").find("#submit-hidden").click();
            }else{
                $("#formedit").submit();
            }
        })//

        $(".clave").click(function(e){
            e.preventDefault();
            var id        = $(this).attr('data-id');
            var cod       = $(this).attr('data-cod');
            var usuario   = $(this).attr('data-usuario');
            var nombre    = $(this).attr('data-nombre');
            var documento = $(this).attr('data-documento');

            var not = new PNotify({
                title: 'Cambio de Clave',
                text: '¿Desea Enviar el Email de Cambio de Clave a '+nombre+'?',
                icon: 'icon-warning22',
                type: 'warning',
                confirm:{ confirm:true, buttons:[ { text:'Enviar', addClass:'btn btn-primary' },{ text:'Cancelar', addClass:'btn btn-danger' } ] },
                buttons: { closer: false, sticker: false },
                history: { history: false }
            });

            not.get().on('pnotify.confirm',function(){
                //alert("ok")
                $("body").block({
                    message: '<span class="text-semibold"><i class="icon-spinner4 spinner position-left"></i>&nbsp; Enviando Email...</span>',
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
                
                $.post('<?php echo $url ?>clientusers/sendMail',{
                    id:id
                })
                .done(function(resp){
                    console.log(resp)
                    $("body").unblock();
                    if(resp=="200"){
                        new PNotify({
                            title: 'Éxito',
                            text: 'Email Enviado',
                            icon: 'icon-warning22',
                            type:'success'
                        });
                    }else{
                        new PNotify({
                            title: 'Atención',
                            text: 'Ha icurrido un error, por favor, intente de nuevo más tarde.',
                            icon: 'icon-warning22',
                            type:'error'
                        });
                    }
                })
                .fail(function(err){
                    $("body").unblock();
                    new PNotify({
                        title: 'Atención',
                        text: 'Ha icurrido un error, por favor, intente de nuevo más tarde.',
                        icon: 'icon-warning22',
                        type:'error'
                    });
                })
            })
            not.get().on('pnotify.cancel', function() {
                //alert('Oh ok. Chicken, I see.');
            });


        })//

    })
</script>



<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} ?>