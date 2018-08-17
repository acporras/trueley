<div class="col-lg-9">
    <div class="tabbable">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="activity">

                
                <div class="panel panel-primary">
                      <div class="panel-heading">
                            <h3 class="panel-title">Actividad</h3>
                      </div>
                      <div class="panel-body">

                        <!-- Timeline -->
                        <div class="timeline timeline-left content-group">
                            <div class="timeline-container">

                                    <!-- Invoices -->
                            <?php if($datos->historial){ foreach($datos->historial as $item){
                                switch($item->tipo){
                                    case 'Registro':
                                        $icon = 'icon-arrow-up-right32';
                                        $color = 'bg-primary-400';
                                        $border = "border-left-primary";
                                    break;
                                    
                                    case 'Actualización':
                                        $icon = 'icon-database-refresh';
                                        $color = 'bg-slate-700';
                                        $border = "border-left-slate";
                                    break;
                                    
                                    case 'Edición':
                                        $icon = 'icon-database-edit2';
                                        $color = 'bg-teal-700';
                                        $border = "border-left-teal";
                                    break;
                                    
                                    case 'Eliminación':
                                        $icon = 'icon-arrow-down-left32';
                                        $color = 'bg-danger-400';
                                        $border = "border-left-danger";
                                    break;
                                }
                                ?>
                                <div class="timeline-row">
                                    <div class="timeline-icon">
                                        <div class="<?php echo $color ?>">
                                            <i class="<?php echo $icon ?>"></i>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="panel border-left-lg <?php echo $border ?> invoice-grid timeline-content">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <h6 class="text-semibold no-margin-top">Tipo: <?php echo $item->tipo ?></h6>
                                                            <h6 class="text-semibold no-margin-top">Info: <?php echo $item->info ?></h6>
                                                            <ul class="list list-unstyled">
                                                                <li>Fecha: <span class="text-bold"><?php echo date("d-m-Y", strtotime($item->fecha)) ?></span> Hora: <span class="text-bold"><?php echo date("h:i a", strtotime($item->fecha)) ?></span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            <?php } }else{ ?>
                                
                                <div class="alert alert-info">
                                    <strong>INFO!</strong> El usuario no tiene Movimientos
                                </div>
                                
                            <?php } ?>
                                <!-- /invoices -->

                            </div>
                        </div>
                        <!-- /timeline -->

                    </div>
                </div>

            </div>

            <div class="tab-pane fade in " id="pagos">
                
                <div class="panel panel-success">
                      <div class="panel-heading">
                            <h3 class="panel-title">Últimos 50 Pagos Recibidos</h3>
                      </div>
                      <div class="panel-body">
                            
                            <div class="table-responsive">
                                <table class="table table-hover datatable-basic">
                                    <thead>
                                        <tr>
                                            <th>ID Pago</th>
                                            <th>Fecha Pago</th>
                                            <th>Fecha Actualización</th>
                                            <th>Monto</th>
                                            <th>Estatus</th>
                                            <th>Observación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            <?php if($datos->histo){ foreach($datos->histo as $pag){
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
                            <?php } }?>
                                    </tbody>
                                </table>
                            </div>
                            
                      </div>
                </div>
                
            </div>

            <!--div class="tab-pane fade in " id="notificaciones">
                
                <div class="panel panel-warning">
                      <div class="panel-heading">
                            <h3 class="panel-title">Notificaciones</h3>
                      </div>
                      <div class="panel-body">
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Tipo</th>
                                            <th>Asunto</th>
                                            <th>Mensaje</th>
                                            <th>estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                      </div>
                </div>
                
            </div-->

        </div>
    </div>
</div>