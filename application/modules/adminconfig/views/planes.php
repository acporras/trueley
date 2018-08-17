
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title" style="cursor:pointer">Planes Registrados</h3>
                <!--div class="heading-elements">
                    <a href="#" onClick="" class="uk-icon-button uk-margin-small-right newPlan" uk-icon="plus" uk-tooltip="title: Nuevo Plan"></a>
                </div-->
            </div>
            <div class="panel-body">
                
                <div class="table-responsive">
                    <table class="table table-hover datatable-basic">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Clientes Usandolo</th>
                                <th>Costo Pesos</th>
                                <th>Estatus</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php if($planes){ foreach($planes as $plan){
                        $cla = ($plan->estatus=="1") ? 'bg-success' : 'bg-danger';
                        $est = ($plan->estatus=="1") ? 'Activo'     : 'Inactivo';
                         ?>
                            <tr>
                                <td><?php echo $plan->codplan ?></td>
                                <td><?php echo ucwords($plan->nombreplan) ?></td>
                                <td><?php echo $plan->registroplan ?></td>
                                <td><?php echo $plan->costopeso ?></td>
                                <td><span class="label <?php echo $cla; ?>"><?php echo $est ?></span></td>
                                <td>
                                    <button 
                                        data-id      = "<?php echo $plan->idPlan ?>"
                                        data-cod     = "<?php echo $plan->codplan ?>"
                                        data-nom     = "<?php echo ucwords($plan->nombreplan) ?>"
                                        data-dolares = "<?php echo $plan->costodolar ?>"
                                        data-pesos   = "<?php echo $plan->costopeso ?>"
                                        data-estatus = "<?php echo $plan->estatus ?>"
                                        data-limite  = "<?php echo $plan->limiteplan ?>" 
                                        type         = "button"
                                        class        = "btn bg-primary-800 editar"
                                        uk-tooltip   = "title: Editar" ><i class="icon-pencil6"></i></button>

                                    <?php if($plan->registroplan <=0){ ?>
                                    <!--button 
                                        data-cod="<?php echo $plan->codplan ?>" 
                                        type="button" 
                                        class="btn bg-danger-800 eliminar" 
                                        uk-tooltip="title: Eliminar" ><i class="icon-cross2"></i></button-->
                                    <?php } ?>
                                </td>
                            </tr>
                    <?php } }; ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
    </div>
</div>
