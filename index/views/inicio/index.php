<html>
<head>
<title>Enquesta</title>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src='<?php echo base_url_static_f();?>js/jquery-ui-timepicker-addon.js'></script>
<script src='<?php echo base_url_static_f();?>bootstrap/js/bootstrap.js'></script>
<link href='<?php echo base_url_static_f();?>bootstrap/css/bootstrap.css' rel="stylesheet">
<link href='<?php echo base_url_static_f();?>bootstrap/css/bootstrap-responsive.css' rel="stylesheet">
<script src='<?php echo base_url_static_f();?>js/funciones.js'></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

</head>
<body>
	
<div class="container">	
	
	<div class="row-fluid">
		<div class="span12"></div>
			<div class="row-fluid">
				<div class="span12">
					<h3>ENCUESTA</h3>
				</div>
				<div class="span12">
					<br>
					<div class="row-fluid">
					<p>Estos datos serán utilizados únicamente para valorar el servicio que estamos dando, y poder mostrar al público las valoraciones recibidas.</p>
					<p>En ningún momento se proporcionan los datos de nuestros clientes al público.</p>
					</div>
				</div>
		</div>
		
		<?php //if ( validation_errors() ){ ?>
				<!--	<div class="span12">
						<div class="span4">
							<div class="alert alert-danger">
							  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  <strong>Errors!</strong><?php //echo validation_errors(); ?>
							</div>
						</div>
					</div> -->
			<?php //} ?>
		
		<?php echo form_open('inicio/buscar');?>
		
		<fieldset class="row fieldset">
			<legend>Enquesta</legend>
				<div class="span12">
					<?php
					if(count($preguntasPadre) > 0){
						foreach($preguntasPadre as $preg){
							echo"<div class='row-fluid'>";
								echo"<div class='span8'>";
									if( form_error('optionsPreg'.$preg->id) ){
										echo"<h5 class='alert alert-danger'>".$preg->pregunta."</h5>";
									}else{
										echo"<h5>".$preg->pregunta."</h5>";
									}

									$pregHijo = $this->preguntas->getPreguntasHijo($preg->id);
									
									if(count($pregHijo) > 0){
									?>
									<table class="table table-condensed">
										<thead>
											<tr>
												<td>&nbsp;</td>
												<td>1</td>
												<td>2</td>
												<td>3</td>
												<td>4</td>
												<td>5</td>
												<td>6</td>
												<td>7</td>
												<td>8</td>
												<td>9</td>
												<td>10</td>
												<td>N/A</td>
											</tr>
										</thead>
										<tbody>
									<?php
										foreach( $pregHijo as $pHijo ){
											echo"<tr>";
												if( form_error('optionsPreg'.$pHijo->id) ){
													echo"<td><span class='label label-danger'>".$pHijo->pregunta."</span></td>";
												}else{
													echo"<td><span>".$pHijo->pregunta."</span></td>";
												}
												echo"<td><input type='radio' name='optionsPreg".$pHijo->id."' value='1'" .set_radio('optionsPreg'.$pHijo->id, 1).">&nbsp;</td>";
												echo"<td><input type='radio' name='optionsPreg".$pHijo->id."' value='2'" .set_radio('optionsPreg'.$pHijo->id, 2).">&nbsp;</td>";
												echo"<td><input type='radio' name='optionsPreg".$pHijo->id."' value='3'" .set_radio('optionsPreg'.$pHijo->id, 3).">&nbsp;</td>";
												echo"<td><input type='radio' name='optionsPreg".$pHijo->id."' value='4'" .set_radio('optionsPreg'.$pHijo->id, 4).">&nbsp;</td>";
												echo"<td><input type='radio' name='optionsPreg".$pHijo->id."' value='5'" .set_radio('optionsPreg'.$pHijo->id, 5).">&nbsp;</td>";
												echo"<td><input type='radio' name='optionsPreg".$pHijo->id."' value='6'" .set_radio('optionsPreg'.$pHijo->id, 6).">&nbsp;</td>";
												echo"<td><input type='radio' name='optionsPreg".$pHijo->id."' value='7'" .set_radio('optionsPreg'.$pHijo->id, 7).">&nbsp;</td>";
												echo"<td><input type='radio' name='optionsPreg".$pHijo->id."' value='8'" .set_radio('optionsPreg'.$pHijo->id, 8).">&nbsp;</td>";
												echo"<td><input type='radio' name='optionsPreg".$pHijo->id."' value='9'" .set_radio('optionsPreg'.$pHijo->id, 9).">&nbsp;</td>";
												echo"<td><input type='radio' name='optionsPreg".$pHijo->id."' value='10'" .set_radio('optionsPreg'.$pHijo->id, 10).">&nbsp;</td>";
												echo"<td><input type='radio' name='optionsPreg".$pHijo->id."' value='11'" .set_radio('optionsPreg'.$pHijo->id, 11).">&nbsp;</td>";
											echo"</tr>";
										}
										
									?>
										</tbody>
									</table>
									
									<?php
									//FIN IF pregHijo	
									}else{
										
										echo"<div class='row-fluid'>";
											echo"<div class='input'>";
												echo"<ul class='input-list'>";
												$opciones = $this->opciones->getOpcionById($preg->id);
												if( count($opciones) > 0 ){
													foreach( $opciones as $op ){
														echo"<li>";
															echo"<label>";
																echo"<input type='radio' name='optionsPreg".$preg->id."' value='".$op->valor."'" .set_radio('optionsPreg'.$preg->id, $op->valor).">&nbsp;";
																echo"<span>".$op->opcion."</span>";
																echo"</label>";
														echo"</li>";
													}
												}

												echo"</ul>";
											echo"</div>";
										echo"</div>";
										
										echo"<div class='row-fluid span8'>";
											echo"<div class='span8'>";
												echo"<p>Comentario :</p>";
												//echo"<textarea id='textarea".$preg->id."' name='textarea".$preg->id."' rows='3' class='xxlarge'>".set_value('textarea'.$preg->id)."</textarea>";
												$attrArea = array(
												  'name'        => 'textarea'.$preg->id,
												  'id'          => 'textarea'.$preg->id,
												  'value'       => set_value('textarea'.$preg->id),
												  'rows'		=>'3',
												  'class'       => 'xxlarge',
												);
												echo form_textarea($attrArea);
											echo"</div>";
										echo"</div>";
										
									}
										
										

								echo"</div>";
							echo"</div>";
						}
						
					}
					echo"<input type='hidden' name='numTicket' id='numTicket' value='".(int)$id."' />";
					echo"<input type='hidden' name='numPreg' id='numPreg' value='".count($preguntas)."' />";
					
					?>

					<div class='row-fluid span6'>
						<div class="span4">
							&nbsp;
						</div>
						<div class="span4">
							<input type="email" class="form-control" id="email" name="email" placeholder="introduce un correo electrónico" />
						</div>
					</div>

					<?php
					if( form_error('email') ){
						echo"<h5 class='alert alert-danger'>Campo obligatorio</h5>";
					}
					?>

					<div class='row-fluid'>
						<div class="span4">
							&nbsp;
						</div>
						<div class="span4">
							<button type="submit" class="btn btn-primary btn-sm">Enviar encuesta</button>
						</div>
					</div>
				</div>
		 </fieldset>
		 
		 </form>

	</div>

</body>
</html>
