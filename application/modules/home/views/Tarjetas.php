<div class="col-lg-3">

    <!-- Navigation -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <!--h6 class="panel-title">Navigation<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
            <div class="heading-elements">
                <a href="#" class="heading-text">See all →</a>
            </div-->
        </div>

        <div class="list-group no-border no-padding-top">
            <!--a href="#" class="list-group-item"><i class="icon-calendar"></i> Fecha Registro: </a>
            <a href="#" class="list-group-item"><i class="icon-tree7"></i> Conexiones <span class="badge bg-danger pull-right">29</span></a-->
            <!--div class="list-group-divider"></div-->
            <a href="#" class="list-group-item"><i class="icon-files-empty"></i> Expedientes Registrados <span class="badge bg-slate-800 pull-right"><?php echo number_format($numeros->expedientes,'0',',','.') ?></span></a>
            <a href="#" class="list-group-item"><i class="icon-file-check"></i> Expedientes A despacho <span class="badge bg-slate-800 pull-right"><?php echo number_format($numeros->despachados,'0',',','.') ?></span></a>
            <a href="#" class="list-group-item"><i class="icon-file-check"></i> Expedientes Pendientes <span class="badge bg-slate-800 pull-right"><?php echo number_format($numeros->pendientes,'0',',','.') ?></span></a>
        </div>
    </div>
    <!-- /navigation -->


    <!-- Share your thoughts -->
    <!--div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title">Enviar Mensaje<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
            <div class="heading-elements">
                <ul class="icons-list">

                </ul>
            </div>
        </div>

        <div class="panel-body">
            <form action="#">
                <div class="form-group">
                    <textarea name="enter-message" id="mensaje" class="form-control mb-15" rows="3" cols="1" placeholder="Escriba un Mensaje"></textarea>
                </div>

                <div class="row">
                    <div class="col-xs-6">
                        <ul class="icons-list icons-list-extended mt-10">
                        </ul>
                    </div>

                    <div class="col-xs-6 text-right">
                        <button type="button" data-cod="<?php //echo $datos->info->codcliente ?>" class="btn btn-primary btn-labeled btn-labeled-right enviar">Enviar <b><i class="icon-circle-right2"></i></b></button>
                    </div>
                </div>
            </form>
        </div>
    </div-->
    <!-- /share your thoughts -->


</div>