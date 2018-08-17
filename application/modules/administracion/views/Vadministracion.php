<style>
.status {
    font-family: 'Source Sans Pro', sans-serif;
}
.status .panel-title {
    font-family: 'Oswald', sans-serif;
    font-size: 32px;
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
<!--script type="text/javascript" src="https://www.google.com/jsapi"></script-->
<script type="text/javascript" src="<?php echo $url ?>assets/js/jsapi.JS"></script>

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
    <div class="row">
        
        <div class="col-xs-6 col-md-3">
            <div class="panel status">
                <div class="panel-heading bg-slate-800">
                    <h6>Total Recaudado a la Fecha</h6>
                    <h1 class="panel-title text-center">$<?php echo number_format($total['total'],'2','.',',') ?></h1>
                </div>
            </div>
        </div>

        <div class="col-xs-6 col-md-3">
            <div class="panel status">
                <div class="panel-heading bg-slate-800">
                    <h6>Total Recaudado Este Mes</h6>
                    <h1 class="panel-title text-center">$<?php echo number_format($total['mes'],'2','.',',') ?></h1>
                </div>
            </div>
        </div>
        
        <!--div class="col-xs-6 col-md-3">
            <div class="panel status">
                <div class="panel-heading bg-slate-800">
                    <h6>Recaudado PayPal</h6>
                    <h1 class="panel-title text-center">$<?php echo number_format('0','2','.',',') ?></h1>
                </div>
            </div>
        </div>
        
        <div class="col-xs-6 col-md-3">
            <div class="panel status">
                <div class="panel-heading bg-slate-800">
                    <h6>Recaudado Mercadopago</h6>
                    <h1 class="panel-title text-center">$<?php echo number_format('0','2','.',',') ?></h1>
                </div>
            </div>
        </div-->
            
    </div>

    </div>
</div>


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
            
            <div class="panel panel-primary">
                <div class="panel-heading">
                        <h3 class="panel-title">Últimos Pagos Reportados</h3>
                </div>
                <div class="panel-body">
                        
                        <div class="table-responsive">
                            <table class="table table-hover datatable-basic">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Cliente</th>
                                        <th>Monto</th>
                                        <th>Estatus</th>
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
                                        <td><?php echo date("d-m-Y H:i a", strtotime($pag->fechareg)) ?></td>
                                        <td><a href="<?php echo $url; ?>profile?id=<?php echo $pag->codcliente ?>"><?php echo $pag->clientname ?></a></td>
                                        <td>$<?php echo number_format($pag->monto,2,',','.') ?></td>
                                        <td><span class="label <?php echo $est[$pag->status][0] ?>"><?php echo $est[$pag->status][1] ?></span></td>
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
                        <h3 class="panel-title">Recaudación Últimos 12 Meses</h3>
                </div>
                <div class="panel-body">
                        
                        <div class="table-responsive">
                            <table class="table table-hover datatable-basic">
                                <thead>
                                    <tr>
                                        <th>Año</th>
                                        <th>Mes</th>
                                        <th>Monto Cobrado</th>
                                        <th>Monto Recibido Mercadopago</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php if($recauda){ foreach($recauda as $rec){
                                $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
                                ?>
                                    <tr>
                                        <td><?php echo $rec->ano ?></td>
                                        <td><?php echo $meses[$rec->mes-1] ?></td>
                                        <td>$<?php echo number_format($rec->monto,2,',','.') ?></td>
                                        <td>$<?php echo number_format($rec->receive,2,',','.') ?></td>
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




<script>
    $(function(){
        
    })
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawColumn);
// Chart settings
function drawColumn() {

// Data
var data = google.visualization.arrayToDataTable([
    ['Year', 'PayPal', 'Mercadopago'],
    ['Enero',  1000,      400],
    ['Febrero',  1170,      460],
    ['Marzo',  660,       1120],
    ['Abril',  1030,      540],
    ['Mayo',  2000,      350],
    ['Junio',  200,      140],
    ['Julio',  3000,      2300],
    ['Agosto',  1030,      540],
    ['Septiembre',  1030,      540],
    ['Octubre',  1030,      540],
    ['Noviembre',  1030,      540],
    ['Diciembre',  1030,      540]
]);


// Options
var options_column = {
    fontName: 'Roboto',
    height: 400,
    fontSize: 12,
    chartArea: {
        left: '5%',
        width: '90%',
        height: 350
    },
    tooltip: {
        textStyle: {
            fontName: 'Roboto',
            fontSize: 13
        }
    },
    vAxis: {
        title: 'PayPal y Mercadopago <?php echo date("Y") ?>',
        titleTextStyle: {
            fontSize: 13,
            italic: false
        },
        gridlines:{
            color: '#e5e5e5',
            count: 10
        },
        minValue: 0
    },
    legend: {
        position: 'top',
        alignment: 'center',
        textStyle: {
            fontSize: 12
        }
    }
};

// Draw chart
var column = new google.visualization.ColumnChart($('#google-column')[0]);
column.draw(data, options_column);
}


// Resize chart
// ------------------------------

$(function () {

// Resize chart on sidebar width change and window resize
$(window).on('resize', resize);
$(".sidebar-control").on('click', resize);

// Resize function
function resize() {
    drawColumn();
}
});
    
</script>