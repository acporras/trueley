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



<div class="panel panel-primary">
        <div class="panel-heading ">
        <h3 class="panel-title">Listados</h3>
            <div class="heading-elements">
                <a href="#" onClick="" class="uk-icon-button uk-margin-small-right newLawyer" uk-icon="plus" uk-tooltip="title: Nuevo Abogado"></a>
            </div>
        </div>
    <div class="panel-body">
        
       
       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
           
           
           <div role="tabpanel">
               <!-- Nav tabs -->
               <ul class="nav nav-tabs nav-tabs-highlight" role="tablist">
                   <li role="presentation" class="active">
                       <a href="#general" aria-controls="home" role="tab" data-toggle="tab">Lista General</a>
                   </li>
                   <li role="presentation">
                       <a href="#activos" aria-controls="tab" role="tab" data-toggle="tab">Clientes Activos</a>
                   </li>
                   <li role="presentation">
                       <a href="#suspendidos" aria-controls="tab" role="tab" data-toggle="tab">Clientes Inactivos</a>
                   </li>
                   <li role="presentation">
                       <a href="#demo" aria-controls="tab" role="tab" data-toggle="tab">Clientes Demo</a>
                   </li>
               </ul>
           
               <!-- Tab panes -->
               <div class="tab-content">
                   <div role="tabpanel" class="tab-pane active" id="general">
                    
                        <div class="table-responsive">
                            <table class="table table-hover datatable-basic">
                                <thead>
                                    <tr>
                                        <th>Cod. Cliente</th>
                                        <th>Firma ó Abogado</th>
                                        <th>Documento</th>
                                        <th>Email</th>
                                        <th>Fecha Registro</th>
                                        <th>Estatus</th>
                                        <th>Ver Perfil</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php if($listas->general){ foreach($listas->general as $gen){
                            $clagen = ($gen->estatus == "1") ? "bg-success" : "bg-danger";
                            $esta = ($gen->estatus == "1") ? "Activo" : "Inactivo";
                             ?>
                                    <tr>
                                        <td><?php echo $gen->codcliente ?></td>
                                        <td><?php echo ucwords($gen->nombrefirma) ?></td>
                                        <td><?php echo $gen->documentofirma ?></td>
                                        <td><?php echo $gen->emailfirma ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($gen->fechareg)) ?></td>
                                        <td><span class="label <?php echo $clagen ?>"><?php echo $esta ?></span></td>
                                        <td>
                                            <a href="<?php echo $url ?>profile?id=<?php echo $gen->codcliente ?>" uk-tooltip="title: Ver Perfil" class="btn btn-sm bg-primary"><i class="icon-search4"></i></a>
                                        </td>
                                    </tr>
                        <?php } } ?>
                                </tbody>
                            </table>
                        </div><!--end table-->
                    
                   </div><!--end TAB-->
                   <div role="tabpanel" class="tab-pane" id="activos">
                        <div class="table-responsive">
                            <table class="table table-hover datatable-basic">
                                <thead>
                                    <tr>
                                        <th>Cod. Cliente</th>
                                        <th>Nombre y Apellido</th>
                                        <th>Documento</th>
                                        <th>Email</th>
                                        <th>Fecha Registro</th>
                                        <th>Estatus</th>
                                        <th>Ver Perfil</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php if($listas->activos){ foreach($listas->activos as $act){
                                $estab = ($gen->estatus == "1") ? "Activo" : "Inactivo"; ?>
                                    <tr>
                                        <td><?php echo $act->codcliente ?></td>
                                        <td><?php echo ucwords($act->nombrefirma) ?></td>
                                        <td><?php echo $act->documentofirma ?></td>
                                        <td><?php echo $act->emailfirma ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($act->fechareg)) ?></td>
                                        <td><span class="label bg-success"><?php echo $estab ?></span></td>
                                        <td>
                                            <a href="<?php echo $url ?>profile?id=<?php echo $act->codcliente ?>" uk-tooltip="title: Ver Perfil" class="btn btn-sm bg-primary"><i class="icon-search4"></i></a>
                                        </td>
                                    </tr>
                            <?php } }?>
                                </tbody>
                            </table>
                        </div><!--end table-->
                   </div><!--end TAB-->
                   <div role="tabpanel" class="tab-pane" id="suspendidos">
                        <div class="table-responsive">
                            <table class="table table-hover datatable-basic">
                                <thead>
                                    <tr>
                                        <th>Cod. Cliente</th>
                                        <th>Nombre y Apellido</th>
                                        <th>Documento</th>
                                        <th>Email</th>
                                        <th>Fecha Registro</th>
                                        <th>Estatus</th>
                                        <th>Ver perfil</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php if($listas->inactivos){ foreach($listas->inactivos as $in){ 
                                $estac = ($gen->estatus == "1") ? "Activo" : "Inactivo";
                                ?> 
                                    <tr>
                                        <td><?php echo $in->codcliente ?></td>
                                        <td><?php echo ucwords($in->nombrefirma) ?></td>
                                        <td><?php echo $in->documentofirma ?></td>
                                        <td><?php echo $in->emailfirma ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($in->fechareg)) ?></td>
                                        <td><span class="label bg-danger"><?php echo $estac ?></span></td>
                                        <td>
                                            <a href="<?php echo $url ?>profile?id=<?php echo $in->codcliente ?>" uk-tooltip="title: Ver Perfil" class="btn btn-sm bg-primary"><i class="icon-search4"></i></a>
                                        </td>
                                    </tr>
                            <?php } }?>
                                </tbody>
                            </table>
                        </div><!--end table-->

                   </div><!--end TAB-->

                   <div role="tabpanel" class="tab-pane" id="demo">
                        <div class="table-responsive">
                            <table class="table table-hover datatable-basic">
                                <thead>
                                    <tr>
                                        <th>Cod. Cliente</th>
                                        <th>Nombre y Apellido</th>
                                        <th>Documento</th>
                                        <th>Email</th>
                                        <th>Fecha Registro</th>
                                        <th>Estatus</th>
                                        <th>Ver perfil</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php if($listas->demos){ foreach($listas->demos as $dem){ 
                                $estac = ($gen->estatus == "1") ? "Activo" : "Inactivo";
                                ?> 
                                    <tr>
                                        <td><?php echo $dem->codcliente ?></td>
                                        <td><?php echo ucwords($dem->nombrefirma) ?></td>
                                        <td><?php echo $dem->documentofirma ?></td>
                                        <td><?php echo $dem->emailfirma ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($dem->fechareg)) ?></td>
                                        <td><span class="label bg-success"><?php echo $estac ?></span></td>
                                        <td>
                                            <a href="<?php echo $url ?>profile?id=<?php echo $dem->codcliente ?>" uk-tooltip="title: Ver Perfil" class="btn btn-sm bg-primary"><i class="icon-search4"></i></a>
                                        </td>
                                    </tr>
                            <?php } }?>
                                </tbody>
                            </table>
                        </div><!--end table-->

                   </div><!--end TAB-->

               </div><!--end TAB container-->
           </div><!--end TAB panel-->

       </div>
       
    </div>
</div>


<!--modal nuevo-->
<div class="modal fade" id="modal-nuevo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Agregar Nuevo Abogado</h4>
            </div>
            <form method="post" action="<?php echo $url ?>lawyers/newlawyer" id="formnuevo">
            <div class="modal-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label>Tipo Cliente</label>
                            <select name="tipocliente" id="tipocliente" class="form-control" required="required">
                                <option value="">Seleccione</option>
                                <option value="firma">Firma Bogados</option>
                                <option value="individual">Individual</option>
                                <option value="demo">Demo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                        <div class="form-group">
                        <label>Nombre del Abogado o Firma</label>
                            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre Abogado o Firma" required/>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label>Documento</label>
                            <input type="text" name="documento" class="form-control" id="documento" placeholder="Documento" required/>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email" required/>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>Dirección</label>
                            <textarea class="form-control" name="direccion" placeholder="Dirección" required></textarea>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                        <div class="form-group">
                            <label>Números Telefónicos</label>
                            <input type="text" name="telefonos" class="form-control" id="telefonos" placeholder="Números Telefónicos" required/>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                            <div class="form-group">
                                <label>Plan</label>
                                <select name="plan" id="plan" class="form-control" required="required">
                                    <option value="">Seleccione</option>
                                    <?php if($planes){ foreach($planes as $pl){ ?>
                                        <option value="<?php echo $pl->codplan ?>"><?php echo ucwords($pl->nombreplan) ?></option>
                                    <?php }  }else{ ?>
                                        <option value="">Sin Planes</option>
                                    <?php } ?>
                                </select>
                                
                            </div>
                    </div>

                </div>
                
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel-body" id="bloqueusuario" style="display:none; background-color:#455A64">
                <div class="panel-title">
                    <h5 class="text-white">Usuario Principal/Administrador:</h5>
                </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label class="text-white">Email Usuario</label>
                            <input type="email" name="emailusuario" id="emailusuario" class="form-control text-white" placeholder="Email Usuario"/>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label class="text-white">Nombre y Apellido</label>
                            <input type="text" name="nombreusuario" id="nombreusuario" class="form-control text-white" placeholder="Nombre y Apellido"/>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label class="text-white">Documento</label>
                            <input type="text" name="documentousuario" id="documentousuario" class="form-control text-white" placeholder="Documento"/>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <input id="submit-hidden" type="submit" style="display: none" />
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary registrar">Registrar</button>
            </div>
        </div>
    </div>
</div>


<script>
    var msg = '<?php echo isset($_GET['msg']) ? $_GET['msg'] : '' ?>';
    $(function(){

        switch (msg) {
            case 'notExits':
                new PNotify({
                    title: 'Atención',
                    text: 'El perfil de cliente no existe, por favor, verifique ',
                    icon: 'icon-warning22',
                    type: 'error'
                });
                return false;
            break;
        
            default:
            break;
        }

        $(".newLawyer").click(function(){
            $("#modal-nuevo").modal('show');
        })

        $("#tipocliente").change(function(){
            var tipo = $(this).val();
            switch (tipo) {
                case '':
                case 'individual':
                case 'demo':
                    $("#bloqueusuario").slideUp()
                break;
                case 'firma':
                    $("#bloqueusuario").slideDown()
                break;
            
                default:
                    $("#bloqueusuario").slideDown()
                break;
            }
        })

        $(".registrar").click(function(e){
            if (!$("#formnuevo")[0].checkValidity()) {
                $("#formnuevo").find("#submit-hidden").click();
            }else{
                var tipo = $("#tipoplan").val();
                if(tipo=='firma'){
                    var us = $("#emailusuario").val();
                    var tip = 'firma';
                    if(us==""){
                        new PNotify({
                            title: 'Atención',
                            text: 'Debe indicar el Email del Usuario principal',
                            icon: 'icon-warning22',
                            type: 'error'
                        });
                        return false;
                    }
                }else{
                    var us = $("#email").val();
                    var tip = 'individual';
                    if(us==""){
                        new PNotify({
                            title: 'Atención',
                            text: 'Debe indicar el Email de la Firma o Abogado',
                            icon: 'icon-warning22',
                            type: 'error'
                        });
                        return false;
                    }
                }

                

                $.post('<?php echo $url ?>lawyers/validuser',{
                    usuario:us,
                    tipo:tip
                })
                .done(function(resp){
                    if(resp=="200"){
                        $("#formnuevo").submit();
                    }else{
                        new PNotify({
                            title: 'Atención',
                            text: 'El email de usuario o Firma se Encuentra Registrado, por favor, verifique',
                            icon: 'icon-warning22',
                            type: 'error'
                        });
                    }
                })
                .fail(function(err){

                })

            }
        })
    })
</script>