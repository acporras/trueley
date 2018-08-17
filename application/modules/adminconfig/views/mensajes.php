
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


<div role="tabpanel">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#nuevo" aria-controls="home" role="tab" data-toggle="tab">Mensaje nuevo Cliente</a>
        </li>
        <li role="presentation">
            <a href="#clave" aria-controls="tab" role="tab" data-toggle="tab">Mensaje Recuperar Clave</a>
        </li>
        <li role="presentation">
            <a href="#politicas" aria-controls="tab" role="tab" data-toggle="tab">Politicas de uso</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="nuevo">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                
                <div class="panel panel-primary">
                    <div class="panel-heading">
                            <h3 class="panel-title">Mensaje de Bienvenida a Nuevo Cliente</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo $url ?>adminconfig/messages">

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <textarea class="summernoteb" name="nuevo" required><?php echo $con->mensajenuevo ?></textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <center>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </center>
                                </div>
                            </div>
                            
                        </form>
                        
                    </div>
                </div>
                
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="clave">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                
                <div class="panel panel-primary">
                    <div class="panel-heading">
                            <h3 class="panel-title">Mensaje para Restauración de Clave</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo $url ?>adminconfig/messages">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <textarea class="summernote" name="clave" required><?php echo $con->mensajeclave ?></textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <center>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </center>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="politicas">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                            <h3 class="panel-title">Politicas de Uso</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo $url ?>adminconfig/messages">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <textarea class="summernote" name="politicas" required><?php echo $con->politicas ?></textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <center>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </center>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

    
    
    
    
   
    
    
</div>
