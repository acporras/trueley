					<!-- Footer -->
					<div class="footer text-muted">
						&copy; <?php echo date("Y"); ?>. <a href="#"><?php echo $conf['footer'] ?></a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
	<?php include(APPPATH.'/helpers/Barra_apps.php'); ?>
	<?php include(APPPATH.'/helpers/Barra_mensajes.php'); ?>

	<div class="modal fade" id="modal-imagen">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Cambiar imágen de Perfil</h4>
			</div>
			<div class="modal-body">
				<div class="image-cropper-container" style="width:100% !important"><img src="" alt="" id="imgcambia" class="crop-basic"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary">Guardar</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(function(){
		$(".cambiaimagen").click(function(e){
			e.preventDefault();
			$("#imgcambia").attr('src','<?php echo ($this->_session->data->foto==null) ? $url.$this->_conf['imguser'] : $this->_session->data->foto ?>');
			$('.crop-basic').cropper({
				minCropBoxWidth: 150,
        		minCropBoxHeight: 150
			});
			$("#modal-imagen").modal('show');
		})
	})
</script>

</body>

</html>

