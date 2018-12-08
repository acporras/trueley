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

<?php 
    if(!$this->_session->data->cliente->estatus){ 
        $this->load->view('layouts/admin/Alerta');
    }else{
?>


    <div class="panel panel-default">
        <div class="panel-body">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                
                
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-highlight" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#despachados" aria-controls="home" role="tab" data-toggle="tab"><i class="icon-drawer-in"></i> A Despacho <span class="badge bg-primary"><?php echo ($exp['despachados']) ? count($exp['despachados']) : '0'; ?></span> </a>
                        </li>
                        <li role="presentation">
                            <a href="#sindespacho" aria-controls="tab" role="tab" data-toggle="tab"><i class="icon-database-time2"></i> Pendientes <span class="badge bg-slate-700"><?php echo ($exp['pendientes']) ? count($exp['pendientes']) : '0'; ?></span></a>
                        </li>
                        
                        <li role="presentation">
                            <a href="#" class="nuevo" aria-controls="tab" role="tab"><i class="icon-file-plus"></i> Agregar Nuevo Expediente</a>
                        </li>
                        
                        <li role="presentation">
                            <a href="#" class="update" aria-controls="tab" role="tab"><i class="icon-database-refresh"></i> Actualizar Expedientes</a>
                        </li>
                        
                    </ul>
                
                    <!-- Tab panes -->
                    <div class="tab-content">
                        
                        <div role="tabpanel" class="tab-pane active" id="despachados">

                        
                            <div class="table-responsive">
                                <table class="table table-hover datatable-basic">
                                    <thead>
                                        <tr>
                                            <th>Expediente</th>
                                            <th>Cliente</th>
                                            <th>Carátula</th>
                                            <th>Juzgado</th>
                                            <th>Localidad</th>
                                            <th>Fecha Despacho</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php if($exp['despachados']){ foreach($exp['despachados'] as $des){ 
                                    $bis = ($des->bis) ? ' bis'.$des->bisdata : '' ?>
                                        <tr>
                                            <td><?php echo $des->expediente.$bis ?></td>
                                            <td><?php echo $des->cliente ?></td>
                                            <td><?php echo $des->portada ?></td>
                                            <td><?php echo $des->juzgado ?></td>
                                            <td><?php echo $des->saliocon ?></td>
                                            <td><?php echo date("d-m-Y", strtotime($des->fechadespacho)) ?></td>
                                            <td>
                                                <button class="btn btn-primary" type="button"><i class="icon-menu7"></i></button>
                                                <div uk-dropdown="mode: click; pos:top-left">
                                                    <ul class="uk-nav uk-dropdown-nav">
                                                        <li class="uk-active"><a href="#" data-id="<?php echo $des->idExpe ?>" class="updatelinea"><i class="icon-database-refresh text-primary"></i> Actualizar</a></li>
                                                        <li class="uk-active"><a href="#" data-id="<?php echo $des->idExpe ?>" class="editlinea"><i class="icon-database-edit2 text-slate"></i> Editar</a></li>
                                                        <li class="uk-active"><a href="#" data-id="<?php echo $des->idExpe ?>" class="deletelinea"><i class="icon-database-remove text-danger"></i> Eliminar</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                <?php } } ?>
                                        <!--tr>
                                            <td colspan="8">
                                                
                                                <div class="alert alert-info">
                                                    <strong>INFO!</strong> No tiene expedientes Despachandos registrados en el Sistema.
                                                </div>
                                                
                                            </td>
                                        </tr-->
                                    </tbody>
                                </table>
                            </div>
                        
                        
                        </div>
                        
                        <div role="tabpanel" class="tab-pane" id="sindespacho">
                            <div class="table-responsive">
                                <table class="table table-hover datatable-basic">
                                    <thead>
                                        <tr>
                                            <th>Expediente</th>
                                            <th>Cliente</th>
                                            <th>Juzgado</th>
                                            <th>Estado</th>
                                            <th>Fecha Registro</th>
                                            <th>Última Revisión</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php if($exp['pendientes']){ foreach($exp['pendientes'] as $pen){
                                    $bis = ($pen->bis) ? ' bis'.$pen->bisdata : '' ?>
                                        <tr>
                                            <td><?php echo $pen->expediente.$bis; ?></td>
                                            <td><?php echo $pen->cliente; ?></td>
                                            <td><?php echo $pen->juzgado; ?></td>
                                            <td><?php echo ucwords($pen->estado); ?></td>
                                            <td><?php echo date("d-m-Y", strtotime($pen->fechareg)); ?></td>
                                            <td><?php echo date("d-m-Y", strtotime($pen->fechaupdate)); ?></td>
                                            <td>
                                                <button class="btn btn-primary" type="button"><i class="icon-menu7"></i></button>
                                                <div uk-dropdown="mode: click; pos:top-left">
                                                    <ul class="uk-nav uk-dropdown-nav">
                                                        <li class="uk-active"><a href="#" data-id="<?php echo $pen->idExpe ?>" class="updatelinea"><i class="icon-database-refresh"></i> Actualizar</a></li>
                                                        <li class="uk-active"><a href="#" data-id="<?php echo $pen->idExpe ?>" class="editlinea"><i class="icon-database-edit2"></i> Editar</a></li>
                                                        <li class="uk-active"><a href="#" data-id="<?php echo $pen->idExpe ?>" class="deletelinea"><i class="icon-database-remove"></i> Eliminar</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                <?php } } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                

            </div>

        </div>
    </div>


    <div class="modal fade" id="modal-nuevo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Registro de Expediente</h4>
                </div>
                <div class="modal-body">
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            
                        <form method="post" action="<?php echo $url ?>expedientes/newcasefile" id="formnuevo">
                                
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                <div class="form-group">
                                    <label>Nro Expediente:</label>
                                    <input type="text" name="expediente" id="expediente" class="form-control" placeholder="Nro Expediente" required/>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                                <div class="form-group">
                                    <label>Cliente o Carátula</label>
                                    <input type="text" name="portada" id="portada" class="form-control" placeholder="Cliente o Portada" required/>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                <div class="form-group">
                                    <label>¿Tiene Bis?</label>
                                    <select name="bis" id="bis" class="form-control" required>
                                        <option value="si">Si</option>
                                        <option value="no" selected>No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                                <div class="form-group">
                                    <label>Indique Bis del Expediente</label>
                                    <input type="text" name="bisdata" id="bisdata" class="form-control" placeholder="Bis del Expediente"/>
                                    <span class="text-muted">Ej.: 1/16</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                <div class="form-group">
                                    <label>Circunscripción</label>
                                    <select name="circunscripcion" onChange="getLocalidad(this.value)" id="circunscripcion" class="form-control" required>
                                        <option value="">Seleccione</option>
                                <?php foreach($this->juzgados->_getCircunscirpciones() as $cirval){ ?>
                                        <option value="<?php echo $cirval[0] ?>"><?php echo $cirval[1] ?></option>
                                <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                <div class="form-group">
                                    <label>Localidad</label>
                                    <select name="localidad" onChange="getJuzgado(this.value)" id="localidad" class="form-control" required>
                                        <option value="">Seleccione</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                <div class="form-group">
                                    <label>Juzgado</label>
                                    <select name="juzgado" id="juzgado" class="form-control" required>
                                        <option value="">Seleccione</option>
                                    </select>
                                </div>
                            </div>

                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Observaciones Adicionales:</label>
                                    <textarea class="form-control" name="observacion" placeholder="Observaciones"></textarea>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="respuesta">
                            </div>
                            
                            <input id="submit-hidden" type="submit" style="display: none" />
                        </form>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <center>
                                <button type="button" class="btn btn-success validar">Validar</button>
                            </center>
                        </div>
                    </div>
                    
                            
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary registrar">Registrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Editar Expediente</h4>
                </div>
                <div class="modal-body">
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            
                        <form method="post" action="<?php echo $url ?>expedientes/editcasefile" id="formedit">
                                
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                <div class="form-group">
                                    <label>Nro Expediente:</label>
                                    <input type="text" name="expedienteedit" id="expedienteedit" class="form-control" placeholder="Nro Expediente" required/>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                                <div class="form-group">
                                    <label>Cliente o Carátula</label>
                                    <input type="text" name="portadaedit" id="portadaedit" class="form-control" placeholder="Cliente o Portada" required/>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                <div class="form-group">
                                    <label>¿Tiene Bis?</label>
                                    <select name="bisedit" id="bisedit" class="form-control" required>
                                        <option value="si">Si</option>
                                        <option value="no" selected>No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                                <div class="form-group">
                                    <label>Indique Bis del Expediente</label>
                                    <input type="text" name="bisdataedit" id="bisdataedit" class="form-control" placeholder="Bis del Expediente"/>
                                    <span class="text-muted">Ej.: 1/16</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                <div class="form-group">
                                    <label>Circunscripción</label>
                                    <select name="circunscripcionedit" onChange="getLocalidad(this.value)" id="circunscripcionedit" class="form-control" required>
                                        <option value="">Seleccione</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                <div class="form-group">
                                    <label>Localidad</label>
                                    <select name="localidadedit" onChange="getJuzgado(this.value)" id="localidadedit" class="form-control" required>
                                        <option value="">Seleccione</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                <div class="form-group">
                                    <label>Juzgado</label>
                                    <select name="juzgadoedit" id="juzgadoedit" class="form-control" required>
                                        <option value="">Seleccione</option>
                                    </select>
                                </div>
                            </div>

                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Observaciones Adicionales:</label>
                                    <textarea class="form-control" name="observacionedit" id="observacionedit" placeholder="Observaciones"></textarea>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="respuestaedit">
                            </div>
                            
                            <input type="hidden" name="idedit" id="idedit" />
                            <input id="submit-hidden" type="submit" style="display: none" />
                        </form>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <center>
                                <button type="button" class="btn btn-success validaredit">Validar</button>
                            </center>
                        </div>
                    </div>
                    
                            
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary registraredit">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $(function(){
        
        $(".nuevo").click(function(e){
            e.preventDefault();
            $("#modal-nuevo").modal('show');
        })

        $(".update").click(function(e){
            e.preventDefault();
            UIkit.modal.confirm('Esta a punto de actualizar el estado de los Expedientes, esta acción podría tardar un poco en completarse de acuerdo a la cantidad de expedientes registrados, desea continuar?').then(function () {
               
               $("body").block({
                   message: '<span class="text-semibold"><i class="icon-spinner4 spinner position-left"></i>&nbsp; Actualizando Registros...</span>',
                   timeout: 6000000, //unblock after 2 seconds
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
               
               $.post('<?php echo $url ?>expedientes/generalUpdate')
               .done(function(resp){
                   $("body").unblock();
                   var b = eval("("+resp+")");
                   if(b.cod=="200"){
                        UIkit.modal.alert(b.viejos+' Expediente(s) Antiguo(s) Actualizado(s), <br>'+b.nuevos+' Expediente(s) Pendiente(s) a Despacho, <br>'+b.nada+' Expediente(s) sin Acción. <br>Al presionar OK se va a actualizar la lista').then(function () {
                            window.location.href="<?php echo $url ?>expedientes";
                        });
                   }else{
                       new PNotify({
                           title: 'Atención',
                           text: 'Ha ocurrido un error inesperado, por favor, intente de nuevo más tarde',
                           icon: 'icon-warning22',
                           type: 'error'
                       });
                   }
               })
               .fail(function(err){
                   $("body").unblock();

               })

               
               
           }, function () {
               new PNotify({
                   title: 'Atención',
                   text: 'Actualziación Cancelada',
                   icon: 'icon-warning22'
               });
           });

        })

        $(".updatelinea").click(function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            $("body").block({
                message: '<span class="text-semibold"><i class="icon-spinner4 spinner position-left"></i>&nbsp; Actualizando Registro...</span>',
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
            $.post('<?php echo $url ?>expedientes/lineUpdate',{
                id:id
            })
            .done(function(resp){
                $("body").unblock();
                if(resp=="200"){
                    UIkit.modal.alert('Se ha realizado la actualización correctamente, se procederá a refrescar las listas').then(function () {
                        window.location.href="<?php echo $url ?>expedientes";
                    });
                    console.log(resp);
                }else{
                    new PNotify({
                        title: 'Atención',
                        text: 'No se han encontrado registro de Despacho o ya esta a despacho',
                        icon: 'icon-warning22'
                    });
                    console.log(resp);
                }

            })
            .fail(function(err){
                $("body").unblock();

            })
        })

        $(".deletelinea").click(function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            UIkit.modal.confirm('¿Esta seguro de eliminar el Expediente?').then(function () {
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
                    $.post('<?php echo $url ?>expedientes/lineDelete',{
                        id:id,
                        clave:clave
                    })
                    .done(function(resp){
                        console.log(resp);
                        $("body").unblock();
                        if(resp=="200"){
                            UIkit.modal.alert('Se ha eliminado el expediente correctamente, se procederá a refrescar las listas').then(function () {
                                window.location.href="<?php echo $url ?>expedientes";
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
            
        });

        $(".validar").click(function(e){
            e.preventDefault();

            var codigo  = $("#expediente").val();
            var bis     = $("#bis").val();
            var bisdata = $("#bisdata").val();
            var juzgado = $("#juzgado").val();

            if(codigo==""){
                new PNotify({
                    title: 'Atención',
                    text: 'Debe ingresar un Número de Expediente',
                    icon: 'icon-warning22',
                    type: 'error'
                });
                return false;
            }
            if(bis=="si" && bisdata==""){
                new PNotify({
                    title: 'Atención',
                    text: 'Debe ingresar el Bis del Expediente',
                    icon: 'icon-warning22',
                    type: 'error'
                });
                return false;
            }
            if(juzgado==""){
                new PNotify({
                    title: 'Atención',
                    text: 'Debe seleccionar el Juzgado',
                    icon: 'icon-warning22',
                    type: 'error'
                });
                return false;
            }

            if(bis=="si" && bisdata !=""){
              var extra =   bisdata
                var cod = codigo+" bis"+extra;
            }else{
                var extra = "";
                var cod = codigo;
            }

            $(".modal-content").block({
                message: '<span class="text-semibold"><i class="icon-spinner4 spinner position-left"></i>&nbsp; Validando Despacho</span>',
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
            //$("#modal-nuevo").unblock();
            $("#respuesta").html("");
            $.post('<?php echo $url ?>expedientes/validfile',{
                expe:cod,
                juzgado:juzgado
            })
            .done(function(resp){
                $(".modal-content").unblock();
                var b = eval("("+resp+")");
                if(b.cod=="200"){
                    $("#respuesta").html(`<div class="alert alert-info">
                                <center>Despachado en fecha <b>`+b.despacho+`</b> en dependencia <b>`+b.dependencia+`</b></center>
                            </div>`);
                    //$("#portada").val(b.caratula);

                }else{
                    $("#respuesta").html(`<div class="alert alert-info">
                                <center>Sin Despacho</center>
                            </div>`);
                }
            })
            .fail(function(err){

            })

        })

        $(".validaredit").click(function(e){
            e.preventDefault();

            var codigo  = $("#expedienteedit").val();
            var bis     = $("#bisedit").val();
            var bisdata = $("#bisdataedit").val();
            var juzgado = $("#juzgadoedit").val();

            if(codigo==""){
                new PNotify({
                    title: 'Atención',
                    text: 'Debe ingresar un Número de Expediente',
                    icon: 'icon-warning22',
                    type: 'error'
                });
                return false;
            }
            if(bis=="si" && bisdata==""){
                new PNotify({
                    title: 'Atención',
                    text: 'Debe ingresar el Bis del Expediente',
                    icon: 'icon-warning22',
                    type: 'error'
                });
                return false;
            }
            if(juzgado==""){
                new PNotify({
                    title: 'Atención',
                    text: 'Debe seleccionar el Juzgado',
                    icon: 'icon-warning22',
                    type: 'error'
                });
                return false;
            }

            if(bis=="si" && bisdata !=""){
              var extra =   bisdata
                var cod = codigo+" bis"+extra;
            }else{
                var extra = "";
                var cod = codigo;
            }

            $(".modal-content").block({
                message: '<span class="text-semibold"><i class="icon-spinner4 spinner position-left"></i>&nbsp; Validando Despacho</span>',
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
            //$("#modal-nuevo").unblock();
            $("#respuesta").html("");
            $.post('<?php echo $url ?>expedientes/validfile',{
                expe:cod,
                juzgado:juzgado
            })
            .done(function(resp){
                $(".modal-content").unblock();
                var b = eval("("+resp+")");
                if(b.cod=="200"){
                    $("#respuestaedit").html(`<div class="alert alert-info">
                                <center>Despachado en fecha <b>`+b.despacho+`</b> en dependencia <b>`+b.dependencia+`</b></center>
                            </div>`);
                    //$("#portada").val(b.caratula);

                }else{
                    $("#respuestaedit").html(`<div class="alert alert-info">
                                <center>Sin Despacho</center>
                            </div>`);
                }
            })
            .fail(function(err){

            })

        })

        $(".registrar").click(function(e){
            e.preventDefault();
            if (!$("#formnuevo")[0].checkValidity()) {
                $("#formnuevo").find("#submit-hidden").click();
            }else{
                $("#formnuevo").submit();
            }
        })
        $(".registraredit").click(function(e){
            e.preventDefault();
            if (!$("#formedit")[0].checkValidity()) {
                $("#formedit").find("#submit-hidden").click();
            }else{
                $("#formedit").submit();
            }
        })

        $("#bis").change(function(){
            var valor = $(this).val();
            if(valor=="si"){
                $("#bisdata").attr('required','required');
            }else{
                $("#bisdata").removeAttr('required');
            }
        })

        $(".editlinea").click(function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            
            $.post('<?php echo $url ?>expedientes/getfulldata',{
                id:id
            })
            .done(function(resp){
                if(resp !="201"){
                    var d = eval("("+resp+")");
                    $("#expedienteedit").val(d.expediente);
                    $("#portadaedit").val(d.cliente);
                    $("#portadaedit").val(d.cliente);
                    if(d.bis=="1"){
                        $("#bisedit option").each(function(){
                            if($(this).val()=="si"){
                                $(this).attr('selected','selected');
                            }else{
                                $(this).removeAttr('selected');
                            }
                        })
                        $("#bisdataedit").val(d.bisdata)
                    }else{
                        $("#bisedit option").each(function(){
                            if($(this).val()=="si"){
                                $(this).removeAttr('selected');
                            }else{
                                $(this).attr('selected','selected');
                            }
                        })
                        $("#bisdataedit").val("")
                    }
                    $("#circunscripcionedit").html("");
                    getCircunscipcionEdit(d.circunscripcion);
                    getLocalidadEdit(d.circunscripcion,d.localidad);
                    getJuzgadoEdit(d.circunscripcion,d.localidad,d.dependencia);
                    $("#observacionedit").val(d.observacion);
                    $("#idedit").val(d.idExpe);

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

        })


    })



    function getLocalidad(X){
        if(X==""){
            return false;
        }
        $("#juzgado").html("");
        $("#juzgado").append('<option value="">Seleccione</option>')

        $.post('<?php echo $url ?>expedientes/getlocal',{
            valor:X
        })
        .done(function(resp){

            var b = eval("("+resp+")");

            $("#localidad").html("");

            $("#localidad").append('<option value="">Seleccione Localidad</option>')
            for(var i=0; i< b.length; i++){
                $("#localidad").append('<option value="'+b[i][0]+'">'+b[i][1]+'</option>')
            }

        })
        .fail(function(err){

        })
    }//

    function getJuzgado(X){
        if(X==""){
            return false;
        }

        $.post('<?php echo $url ?>expedientes/getjuzgado',{
            valora:$("#circunscripcion").val(),
            valorb:X
        })
        .done(function(resp){

            var b = eval("("+resp+")");

            $("#juzgado").html("");

            $("#juzgado").append('<option value="">Seleccione Juzgado</option>')
            for(var i=0; i< b.length; i++){
                $("#juzgado").append('<option value="'+b[i][0]+'">'+b[i][1]+'</option>')
            }

        })
        .fail(function(err){

        })
    }//


    function getCircunscipcionEdit(X){
        if(X==""){
            return false;
        }

        $.post('<?php echo $url ?>expedientes/getciscunscripcion')
        .done(function(resp){

            var b = eval("("+resp+")");

            $("#circunscripcionedit").html("");

            $("#circunscripcionedit").append('<option value="">Seleccione Localidad</option>')
            
            for(var i=0; i< b.length; i++){
               if(b[i][0]==X){
                   var sel = 'selected';
               }else{
                   var sel = '';
               };
                $("#circunscripcionedit").append('<option '+sel+' value="'+b[i][0]+'">'+b[i][1]+'</option>');
            }

        })
        .fail(function(err){

        })
    }//  

    function getLocalidadEdit(X,Y){
        if(X==""){
            return false;
        }

        $.post('<?php echo $url ?>expedientes/getlocal',{
            valor:X
        })
        .done(function(resp){
            var b = eval("("+resp+")");

            $("#localidadedit").html("");

            $("#localidadedit").append('<option value="">Seleccione Localidad</option>')
            for(var i=0; i< b.length; i++){
               if(b[i][0]==Y){
                   var sel = 'selected';
               }else{
                   var sel = '';
               };
                $("#localidadedit").append('<option '+sel+'  value="'+b[i][0]+'">'+b[i][1]+'</option>')
            }

        })
        .fail(function(err){

        })
    }//

    function getJuzgadoEdit(X,Y,Z){
        if(X==""){
            return false;
        }

        $.post('<?php echo $url ?>expedientes/getjuzgado',{
            valora:X,
            valorb:Y
        })
        .done(function(resp){

            var b = eval("("+resp+")");

            $("#juzgadoedit").html("");

            $("#juzgadoedit").append('<option value="">Seleccione Juzgado</option>')
            for(var i=0; i< b.length; i++){
                if(b[i][0]==Z){
                   var sel = 'selected';
               }else{
                   var sel = '';
               };
                $("#juzgadoedit").append('<option '+sel+' value="'+b[i][0]+'">'+b[i][1]+'</option>')
            }

        })
        .fail(function(err){

        })
    }//
</script>


<?php } ?>