<script type="text/javascript" src="<?php echo $url; ?>assets/js/plugins/editors/summernote/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

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

<div class="panel panel-default">
    <div class="panel-body">
       
       <div role="tabpanel">
           <!-- Nav tabs -->
           <ul class="nav nav-tabs nav-tabs-top nav-justified" role="tablist">
               <!--li role="presentation" class="active">
                   <a href="#general" aria-controls="general" id="generaltab" role="tab" data-toggle="tab"><i class="icon-stack2"></i> General</a>
               </li-->
               <li role="presentation" class="active">
                   <a href="#planes" aria-controls="planes" id="planestab" role="tab" data-toggle="tab"><i class="icon-price-tags2"></i> Planes <span class="badge bg-danger pull-right"><?php echo count($planes) ?></span> </a>
               </li>
               <li role="presentation">
                   <a href="#cuentas" aria-controls="cuentas" id="cuentastab" role="tab" data-toggle="tab"><i class="icon-cash3"></i> Registrar Novedad</a>
               </li>
               <li role="presentation">
                   <a href="#mensajes" aria-controls="mensajes" role="tab" id="mensajesb" data-toggle="tab"><i class="icon-envelope"></i> Mensajes del Sistema</a>
               </li>
           </ul>
       
           <!-- Tab panes -->
           <div class="tab-content">
               <div role="tabpanel" class="tab-pane" id="general">
               
               </div>
               <div role="tabpanel" class="tab-pane active" id="planes">
                    <?php include(__DIR__.'/planes.php'); ?>
               </div>
               <div role="tabpanel" class="tab-pane" id="cuentas">
                    <?php include(__DIR__.'/cuentas.php'); ?>
               </div>
               <div role="tabpanel" class="tab-pane" id="mensajes">
                    <?php include(__DIR__.'/mensajes.php'); ?>
               </div>
           </div>
       </div>
       
    </div>
</div>


<div class="modal fade" id="modal-plan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Registro de Plan de Consumo</h4>
            </div>
            <div class="modal-body">

                <form method="post" action="<?php echo $url ?>adminconfig/newplan" id="nuevoplan">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <label>Nombre del Plan</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label>Limite de Abogados</label>
                                <input type="number" min="0" name="limite" id="limite" class="form-control" required/>
                                <span class="text-muted">Utilice <code>0</code> para Ilimitado</span>
                            </div>
                        </div>
                        <!--div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <label>Costo en Dólares</label>
                                <input type="decimal" min="1" name="dolares" id="dolares" class="form-control" required/>
                            </div>
                        </div-->
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <label>Costo en Pesos</label>
                                <input type="decimal" min="1" name="pesos" id="pesos" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Boton</label>
                                <textarea required class="form-control" placeholder="Pegar Código del Botón" name="boton"></textarea>
                            </div>
                        </div>                        
                    </div>
                    <input id="submit-hidden" type="submit" style="display: none" />
                </form>
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary registrar">Registrar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-editar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edición de Plan</h4>
            </div>
            <div class="modal-body">

                <form method="post" action="<?php echo $url ?>adminconfig/editplan" id="editplan">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <label>Nombre del Plan</label>
                                <input type="text" name="nombre" id="nombreedit" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label>Limite de Abogados</label>
                                <input type="number" min="0" name="limite" id="limiteedit" class="form-control" required/>
                                <span class="text-muted">Utilice <code>0</code> para Ilimitado</span>
                            </div>
                        </div>
                        <!--div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label>Costo en Dólares</label>
                                <input type="decimal" min="1" name="dolares" id="dolaresedit" class="form-control" required/>
                            </div>
                        </div-->
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label>Costo en Pesos</label>
                                <input type="decimal" min="1" name="pesos" id="pesosedit" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Boton</label>
                                <textarea required class="form-control" id="botonedit" placeholder="Pegar Código del Botón" name="boton"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group" id="selector">
                            </div>
                        </div>
                    </div>
                    <input id="codigoeditar" name="codigo" id="codigoeditar" type="hidden" />
                    <input id="submit-hidden-edit" type="submit" style="display: none" />
                </form>
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary actualizar">Actualizar</button>
            </div>
        </div>
    </div>
</div>





<script>
    var llega = '<?php echo (isset($_GET['tab'])) ? $_GET['tab'] : '' ?>';
    var msg = '<?php echo (isset($_GET['msg'])) ? $_GET['msg'] : '' ?>';
    $(function(){

        $('.select').select2();


        $('.summernote, .summernoteb').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['font', ['strikethrough']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']]
            ]
        });

        switch (llega) {
            case 'planes':
                $("#planestab").click();
            break;
            
            case 'general':
                $("#generaltab").click();
            break;
            
            case 'cuentas':
                $("#cuentastab").click();
            break;
            
            case 'mensajes':
                $("#mensajesb").click();
            break;
        
            /*default:
                $("#generaltab").click();
            break;*/
        }

        switch (msg) {
            case 'successNovedad':
                new PNotify({
                    title: 'Éxito',
                    text: 'Novedad Registrada con Exito',
                    icon: 'icon-warning22',
                    type: 'success'
                });
            break;
            
            case 'failNovedad':
                new PNotify({
                    title: 'Atención',
                    text: 'Ha ocurrido un error inesperado, por favor, intente nuevamente',
                    icon: 'icon-warning22',
                    type: 'warning'
                });
            break;
        
            default:
            break;
        }

        $(".newPlan").click(function(){
            $("#modal-plan").modal('show');
        })

        $(".registrar").click(function(){
            if (!$("#nuevoplan")[0].checkValidity()) {
                $("#nuevoplan").find("#submit-hidden").click();
            }else{
                $("#nuevoplan").submit();
            }
        })
        
        $(".actualizar").click(function(){
            if (!$("#editplan")[0].checkValidity()) {
                $("#editplan").find("#submit-hidden-edit").click();
            }else{
                $("#editplan").submit();
            }
        })

        $(".editar").click(function(e){
            e.preventDefault();
            var id      = $(this).attr('data-id');
            var codigo  = $(this).attr('data-cod');
            var nombre  = $(this).attr('data-nom');
            //var dolares = $(this).attr('data-dolares');
            var pesos   = $(this).attr('data-pesos');
            var estatus = $(this).attr('data-estatus');
            var limite  = $(this).attr('data-limite');

            $("#nombreedit").val(nombre);
            $("#codigoeditar").val(codigo);
            $("#limiteedit").val(limite);
            //$("#dolaresedit").val(dolares);
            $("#pesosedit").val(pesos);

            $.post('<?php echo $url ?>adminconfig/getBoton',{
                plan:codigo
            }).done(function(resp){
                $("#botonedit").val(resp)
            })
            
            var act   = (estatus == '1') ? 'selected'   : '';
            var actcl = (estatus == '1') ? 'bg-success' : 'bg-danger';
            var iact  = (estatus == '0') ? 'selected'   : '';

            var sel = `<label>Estatus</label>
                        <select class="form-control `+actcl+`" name="estatus" id="estatusedit">
                            <option value="1" `+act+`>Activa</option>
                            <option value="0" `+iact+`>Inactiva</option>
                        </select>`;
            $("#selector").html(sel);

            $("#modal-editar").modal('show');
        })

        $(".eliminar").click(function(e){
            e.preventDefault();
            var cod = $(this).attr('data-cod');
        })


    })

</script>