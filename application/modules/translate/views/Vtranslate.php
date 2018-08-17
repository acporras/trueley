<h1>Prueba de Traductor</h1>


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">

            <div class="panel panel-default">
                <div class="panel-body">
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                                <textarea class="form-control" id="mensaje" rows="7" placeholder="Mensaje"></textarea>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <center>
                                <button class="btn btn-primary" id="enviar">Enviar</button>
                            </center>
                        </div>
                    </div>
                    
                </div>
            </div>
    
    </div>

    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        
        <div class="panel panel-default">
            <div class="panel-body">
               
               <div class="table-responsive">
                   <table class="table table-hover">
                       <thead>
                           <tr>
                               <th>Fecha</th>
                               <th>Saliente</th>
                               <th>Entrante</th>
                           </tr>
                       </thead>
                       <tbody id="mensajes">
                       </tbody>
                   </table>
               </div>
               
            </div>
        </div>
        
    </div>
    

</div>



<script>
    $(function(){
        $("#enviar").click(function(){
            var mensaje = $("#mensaje").val();
            if(mensaje == ""){
                alert("Debe ingresar un mensaje");
                return false;
            }

            $.post('<?php echo $url ?>translate/trans',{
                msg:mensaje
            })
            .done(function(resp){
                var b = eval("("+resp+")");
                var tb = `
                    <tr>
                        <td>`+b.fecha+`</td>
                        <td>`+b.saliente+`</td>
                        <td>`+b.entrante+`</td>
                    </tr>
                `;
                $("#mensajes").append(tb);
                $("#mensaje").val("");
            })
            .fail(function(err){

            })
        })
    })
</script>