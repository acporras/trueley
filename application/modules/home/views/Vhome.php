<!-- Page header -->
<style>
.status {
    font-family: 'Source Sans Pro', sans-serif;
}
.status .panel-title {
    font-family: 'Oswald', sans-serif;
    font-size: 52px;
    font-weight: bold;
    color: #fff;
    line-height: 45px;
    padding-top: 0px;
    letter-spacing: -0.8px;
}
.status .panel-heading h6{
    text-align:center;
    color:#ffffff !important;
}
.body-card{
    cursor:pointer;
}
</style>
<?php if($this->_session->data->nivel=="Admin" || $this->_session->data->nivel=="Webmaster"){ ?>
    <div class="page-header page-header-default" <?php echo ($this->_session->data->nivel=="User") ? 'style="margin:0px !important"' : '' ?>>
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
        <?php if($this->_session->data->nivel=="Admin" || $this->_session->data->nivel=="Webmaster"){ ?>
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?php echo $url ?>home"><i class="icon-home2 position-left"></i> <?php echo $this->lang->line('navinicio'); ?></a></li>
                <li class="active"><?php echo $this->lang->line('navmodulo'); ?></li>
            </ul>

            <ul class="breadcrumb-elements">
            </ul>
        </div>
        <?php } ?>
    </div>
<?php } ?>
<style>
.media .profile-thumb img {
    width: 100px !important;
    height: 100px !important;
    max-width: 100px !important;
}
</style>


<script type="text/javascript" src="<?php echo $url ?>assets/js/plugins/media/fancybox.min.js"></script>
<script type="text/javascript" src="<?php echo $url ?>assets/js/pages/extension_blockui.js"></script>

<?php if($this->_session->data->nivel=="User"){ ?>

<div class="navbar navbar-default navbar-xs content-group">
    <ul class="nav navbar-nav visible-xs-block">
        <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
    </ul>

    <div class="navbar-collapse collapse" id="navbar-filter">
        <ul class="nav navbar-nav">
            <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true" style=""><i class="icon-menu7 position-left"></i> Mi Actividad</a></li>
            <li class=""><a href="#notificaciones" data-toggle="tab" aria-expanded="false" style=""><i class="icon-envelope position-left"></i> Notificaciones</a></li>
        </ul>

        <div class="navbar-right">
            <ul class="nav navbar-nav">
            </ul>
        </div>
    </div>
</div>
<?php } ?>
<!-- /page header -->
<!-- Content area -->
<div class="content">
<?php //var_dump($this->_session) ;?><br>
<!-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<!-- ||||||||||CONTENIDO A PARTIR DE AQUI||||||||||||||||||||||||||| -->

<?php 
/*try{
    $response = $this->_client->request('POST', 'https://api.mercadopago.com/v1/plans?access_token=TEST-3917184211237652-072603-27b0b339851af7ff40d4c6da197858d1-339806367', [
        'headers' => [
            'Accept'     => 'application/json',
            'content-type' =>'application/json'
        ],
        'json' => [
            'description'   => 'Descripcion del Plan',
            'auto_recurring' => [
                'frequency'          => 1,
                'frequency_type'     => 'months',
                'transaction_amount' => 200,
                'repetitions'        => 24
            ],
        ]
    ]);
    var_dump($response->getBody()->getContents());
}catch(Exception $e){
    var_dump($e->getMessage());
}*/


/*try{
    $response = $this->_client->request('PUT', 'https://api.mercadopago.com/v1/subscriptions/974a1f08268149ce8bfc8e3d65628c2e?access_token=TEST-6620427458460854-072323-1d76cf97cdff65b7ec67c8339594dfda-339256637', [
        'headers' => [
            'Accept'     => 'application/json',
            'content-type' =>'application/json'
        ],
        'json' => [
            'status'   => 'paused',
        ]
    ]);
    var_dump($response->getBody()->getContents());
}catch(Exception $e){
    var_dump($e->getMessage());
}*/
/*MercadoPago\SDK::setAccessToken('APP_USR-4672940012451051-072117-200bd60b8ad778ed1d69fa527ad5789a-160361203');

  $body = array(
    "json_data" => array(
      "site_id" => "MLA"
    )
  );

  $result = MercadoPago\SDK::post('/users/test_user', $body);

  var_dump($result);*/

?>

<?php if($this->_session->data->nivel=="Admin" || $this->_session->data->nivel=="Webmaster"){ ?>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col-xs-6 col-md-3">
                    
                    <div class="panel status">
                        <div class="panel-heading bg-slate-800">
                            <h6><?php echo $this->lang->line('card_sucursales') ?></h6>
                            <h1 class="panel-title text-center"><?php echo number_format($numeros['clientes'],'0',',','.') ?></h1>
                        </div>
                        <!--div class="panel-body text-center body-card">
                            <strong><?php echo $this->lang->line('btn_sucursales') ?></strong>
                        </div-->
                    </div>

                </div>          
                <div class="col-xs-6 col-md-3">
                    
                    <div class="panel status">
                        <div class="panel-heading bg-slate-800">
                            <h6><?php echo $this->lang->line('card_aplicaciones') ?></h6>
                            <h1 class="panel-title text-center"><?php echo number_format($numeros['abogados'],'0',',','.') ?></h1>
                        </div>
                        <!--div class="panel-body text-center body-card">
                            <strong><?php echo $this->lang->line('btn_aplicaciones') ?></strong>
                        </div-->
                    </div>

                </div>
                <div class="col-xs-6 col-md-3">
                    
                    <div class="panel status">
                        <div class="panel-heading bg-slate-800">
                            <h6><?php echo $this->lang->line('card_usuarios') ?></h6>
                            <h1 class="panel-title text-center"><?php echo number_format($numeros['expedientes'],'0',',','.') ?></h1>
                        </div>
                        <!--div class="panel-body text-center body-card">
                            <strong><?php echo $this->lang->line('btn_usuarios') ?></strong>
                        </div-->
                    </div>

                    
                </div>
                <div class="col-xs-6 col-md-3">
                    
                    <div class="panel status">
                        <div class="panel-heading bg-slate-800">
                            <h6><?php echo $this->lang->line('card_plan') ?></h6>
                            <h1 class="panel-title text-center"><?php echo number_format($numeros['despachados'],'0',',','.') ?></h1>
                        </div>
                        <!--div class="panel-body text-center body-card">
                            <strong><?php echo $this->lang->line('btn_plan') ?></strong>
                        </div-->
                    </div>

                    
                </div>
            </div>

        </div>

        
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                            <h3 class="panel-title">Últimos Clientes Registrados</h3>
                    </div>
                    <div class="panel-body">
                        
                        <div class="table-responsive">
                            <table class="table table-hover datatable-basic">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Código</th>
                                        <th>Cliente</th>
                                        <th>Tipo</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php if($ultimos){ foreach($ultimos as $ult){ ?>
                                    <tr>
                                        <td><?php echo date("d-m-Y", strtotime($ult->fechareg)) ?></td>
                                        <td><a href="<?php echo $url ?>profile?id=<?php echo $ult->codcliente ?>"><?php echo $ult->codcliente ?></a></td>
                                        <td><?php echo ucwords($ult->nombrefirma) ?></td>
                                        <td><?php echo ucwords($ult->tipocliente) ?></td>
                                    </tr>
                        <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                            <h3 class="panel-title">Últimas Novedades</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Info</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php if($novedades){ foreach($novedades as $nov){ ?>
                                    <tr>
                                        <td><?php echo date("d-m-Y", strtotime($nov->fecha)) ?></td>
                                        <td><?php echo $nov->info ?></td>
                                    </tr>
                            <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    

<?php } ?>





<?php 
    if($this->_session->data->nivel=="User" || $this->_session->data->nivel=="Client"){  
        if(!$this->_session->data->cliente->estatus){ 
            $this->load->view('layouts/admin/Alerta');
        }

        include(__DIR__.'/Tarjetas.php');
        include(__DIR__.'/Timeline.php');
?>

<?php if($afilia){ ?>

<div id="modal-bienvenida" class="uk-modal-full" uk-modal>
    <div class="uk-modal-dialog">
        <!--button class="uk-modal-close-full uk-close-large" type="button" uk-close></button-->
        <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
            <div class="uk-background-cover" style="background-image: url('<?php echo $url ?>assets/images/bg_login_b.jpg');" uk-height-viewport></div>
            <div class="uk-padding-large">
                <h1>Bienvenido(a) a TrueLey</h1>
                <p>Estimado(a) <b><?php echo $this->_session->data->nombre ?></b> nos complace darle la bienvenida a <b>Trueley</b> la más innovadora plataforma donde usted y su equipo legal podrá llevar la gestion de sus Expedientes y Casos Judiciales.</p>
                <p>Por favor, le pedimos que haga clic en el Siguiente enlace para Completar su perfil de Pago:</p>
                <p>
                    <center>
                        <?php echo $this->mhome->_mp() ?>
                    </center>
                </p>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<script>
    $(function() {    
        <?php if($afilia){ ?>
            UIkit.modal("#modal-bienvenida").show();
            $(".blue-ar-l-ov-undefined").click(function(){
            })
        <?php } ?>

        var msg = '<?php echo isset($_GET['msg']) ? $_GET['msg'] : '' ?>';

        switch (msg) {
            case 'successAfiliation':
                new PNotify({
                    title: 'Éxito',
                    text: 'Se ha copletado la afiliación al Sistema, le notificaremos cuando se Procese el pago.',
                    icon: 'icon-warning22',
                    type: 'success'
                });
            break;
           
            case 'faileAfiliation':
                new PNotify({
                    title: 'Atención',
                    text: 'Se ha completado el Registro, pero ha ocurrido un error, por favor, le contactaremos en breve',
                    icon: 'icon-warning22',
                    type: 'warning'
                });
            break;
        
            default:
            break;
        }
    });
</script>

<?php } ?>