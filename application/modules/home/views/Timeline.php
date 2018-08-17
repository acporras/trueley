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
                            <?php if($timeline){ foreach($timeline as $item){
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
                                    <strong>INFO!</strong> Aún no tienes actividad en tu Panel
                                </div>
                            <?php } ?>
                                <!-- /invoices -->

                            </div>
                        </div>
                        <!-- /timeline -->

                    </div>
                </div>

            </div>

            <div class="tab-pane fade in " id="notificaciones">
                
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
                
            </div>

        </div>
    </div>
</div>