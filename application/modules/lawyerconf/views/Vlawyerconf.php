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


<div role="tabpanel">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <!--li role="presentation" class="active">
            <a href="#informacion" aria-controls="home" role="tab" data-toggle="tab">Información</a>
        </li-->
        <li role="presentation" class="active">
            <a href="#pagos" aria-controls="tab" role="tab" data-toggle="tab">Pagos Realizados</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <!--div role="tabpanel" class="tab-pane active" id="informacion">

            
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                    <h3 class="panel-title">Información de la Cuenta</h3>
                            </div>
                            <div class="panel-body">
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label>Fecha Registro</label><br>
                                            <span><?php echo date("d-m-Y H:i a", strtotime($datos->info->fechareg)) ?></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label>Cliente</label><br>
                                            <span><?php echo $datos->info->nombrefirma ?></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label>Documento</label><br>
                                            <span><?php echo $datos->info->documentofirma ?></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Dirección</label><br>
                                            <span><?php echo $datos->info->direccionfirma ?></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Teléfonos</label><br>
                                            <span><?php echo $datos->info->telefonosfirma ?></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Email</label><br>
                                            <span><?php echo $datos->info->emailfirma ?></span>
                                        </div>
                                    </div>
                                    
                            </div>
                        </div>
                        
                    </div>


                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                    <h3 class="panel-title">Información de Pago</h3>
                            </div>
                            <div class="panel-body">
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label>Plan:</label><br>
                                            <span><?php echo ucwords($datos->plan->nombreplan) ?></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label>Costo:</label><br>
                                            <span>$<?php echo number_format($datos->plan->costopeso,2,',','.') ?></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label>Estado:</label><br>
                                            <span><?php echo ($datos->plan->estatus) ? '<span class="label bg-success">Activo</span>' : '<span class="label bg-danger">Inactivo</span>' ?></span>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label>Fecha Último Pago:</label><br>
                                            <span><?php echo date("d-m-Y", strtotime($datos->info->fechapago)) ?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label>Fecha Próximo Pago:</label><br>
                                            <span><?php echo date("d-m-Y", strtotime($datos->info->proximopago)) ?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label>Días que Restan:</label><br>
                                            <span><?php echo $this->general->diferencia(array($this->general->date()->datetime,$datos->info->proximopago)) ?></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                        <center>
                                            <?php 
                                                if($this->general->diferencia(array($this->general->date()->datetime,$datos->info->proximopago)) <=70 ){
                                                    //echo $afiliate;
                                                }
                                            ?>
                                        
                                        </center>
                                        </div>
                                    </div>

                                    
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
    
        </div-->
        <div role="tabpanel" class="tab-pane active" id="pagos">
            
            <div class="panel panel-default">
                <div class="panel-body">
                   
                   <div class="table-responsive">
                       <table class="table table-hover datatable-basic">
                           <thead>
                               <tr>
                                   <th>ID del Pago</th>
                                   <th>Fecha Registro</th>
                                   <th>Fecha Actualización</th>
                                   <th>Monto</th>
                                   <th>Estatus</th>
                                   <th>Observaciones</th>
                               </tr>
                           </thead>
                           <tbody>
                               <?php if($pagos){ foreach($pagos as $pag){
                                   $est = [
                                       'in_process' => ['bg-primary','En Proceso','Pendiente Cobro'],
                                       'approved'   => ['bg-success','Aprovado','Cuata Cobrada'],
                                       'cancelled'  => ['bg-danger','Rechazado','Contactenos para Saber de su Estatus'],
                                   ]
                                   ?>
                                    <tr>
                                        <td><?php echo $pag->payment_id ?></td>
                                        <td><?php echo date("d-m-Y H:i a", strtotime($pag->fechareg)) ?></td>
                                        <td><?php echo date("d-m-Y H:i a", strtotime($pag->fechaupdate)) ?></td>
                                        <td>$<?php echo number_format($pag->monto,2,',','.') ?></td>
                                        <td><span class="label <?php echo $est[$pag->status][0] ?>"><?php echo $est[$pag->status][1] ?></span></td>
                                        <td><?php echo $est[$pag->status][2] ?></td>
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


<script>
    $(function(){

    })
</script>