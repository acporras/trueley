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
                        <ul class="nav nav-tabs nav-tabs-highlight" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#variables" aria-controls="home" role="tab" data-toggle="tab"><i class="icon-drawer-in"></i> Variables </a>
                            </li>
                            <li role="presentation">
                                <a href="#fijos" aria-controls="tab" role="tab" data-toggle="tab"><i class="icon-database-time2"></i> Fijos </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="variables">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Feriados Variables</h3>
                                        <div class="heading-elements">
                                            <a href="#" onClick="" class="uk-icon-button uk-margin-small-right newProcess" uk-icon="plus" uk-tooltip="title: Nuevo Feriado" ></a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover datatable-basic">
                                                <thead>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Descripción</th>
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
                                                        if($item->tipo == "v") {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $item->fecha ?></td>
                                                            <td><span class="label <?php echo $cl; ?>" ><?php echo $tx; ?></span></td>
                                                            <td><?php echo $item->fechareg ?></td>
                                                            <td>
                                                                <button class="btn btn-primary" type="button">
                                                                    <i class="icon-menu7"></i>
                                                                </button>
                                                                <div uk-dropdown="mode: click; pos:top-left">
                                                                    <ul class="uk-nav uk-dropdown-nav">
                                                                        <li class="uk-active">
                                                                            <a href="#" data-id="<?php echo $item->idFeriado ?>" onclick="editHolyday(<?php echo $item->idFeriado ?>);">
                                                                                <i class="icon-database-edit2 text-primary"></i>
                                                                                Editar
                                                                            </a>
                                                                        </li>
                                                                        <li class="uk-active">
                                                                            <a href="#" data-id="<?php echo $item->idFeriado ?>" onclick="delHolyday(<?php echo $item->idFeriado ?>);">
                                                                                <i class="icon-database-remove text-danger"></i>
                                                                                Eliminar
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>            
                                                    <?php   
                                                                }     
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="fijos">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Feriados Fijos</h3>
                                        <div class="heading-elements">
                                            <a href="#" onClick="" class="uk-icon-button uk-margin-small-right newProcess" uk-icon="plus" uk-tooltip="title: Nuevo Feriado" ></a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover datatable-basic">
                                                <thead>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Descripción</th>
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
                                                            <td><span class="label <?php echo $cl; ?>" ><?php echo $tx; ?></span></td>
                                                            <td><?php echo $item->fechareg ?></td>
                                                            <td>
                                                                <button class="btn btn-primary" type="button">
                                                                    <i class="icon-menu7"></i>
                                                                </button>
                                                                <div uk-dropdown="mode: click; pos:top-left">
                                                                    <ul class="uk-nav uk-dropdown-nav">
                                                                        <li class="uk-active">
                                                                            <a href="#" data-id="<?php echo $item->idFeriado ?>" onclick="editAttorney(<?php echo $item->idFeriado ?>);">
                                                                                <i class="icon-database-edit2 text-primary"></i>
                                                                                Editar
                                                                            </a>
                                                                        </li>
                                                                        <li class="uk-active">
                                                                            <a href="#" data-id="<?php echo $item->idFeriado ?>" onclick="delAttorney(<?php echo $item->idFeriado ?>);">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<script type="text/javascript">
    $(function(){
        
    });
</script>