<style>
    .select2-container {
        display: block !important;
    }
</style>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="panel panel-primary">
              <div class="panel-heading">
                    <h3 class="panel-title">Registrar Novedad</h3>
              </div>
              <div class="panel-body">
                <form method="post" action="<?php echo $url ?>adminconfig/novedad">
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Para:</label>
                                <select name="para" id="para" class="select" required="required">
                                    <option value="All">Todos</option>
                                    <option value="Admin">Administradores</option>
                                    <?php if($clientes){ foreach($clientes as $cli){ ?>
                                        <option value="<?php echo $cli->codcliente; ?>"><?php echo $cli->nombrefirma; ?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <textarea class="summernote" name="novedad" required></textarea>
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