<html>
<head>
<title>Registro</title>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src='<?php echo base_url_static_f();?>js/jquery-ui.js'></script>
<script src='<?php echo base_url_static_f();?>js/jquery-ui-timepicker-addon.js'></script>
<script src='<?php echo base_url_static_f();?>bootstrap/js/bootstrap.js'></script>
<link href='<?php echo base_url_static_f();?>bootstrap/css/bootstrap.css' rel="stylesheet">
<link href='<?php echo base_url_static_f();?>bootstrap/css/bootstrap-responsive.css' rel="stylesheet">
<script src='<?php echo base_url_static_f();?>js/funciones.js'></script>

</head>
<body>

    <div class="container">
		
    	<div class="row-fluid">
			<div class="span12"></div>
    		<div class="span12">
				<div class="row-fluid">
					<div class="span2">
					<img src="<?php echo base_url_static_f();?>images/logo.png" />
					</div>
					<div class="offset1 span6">
			    		<h1 face="verdana">ENCUESTA DE SATISFACCIÓN</h1>
			    	</div>
			    </div>
				
			</div>
			<div class="span12"></div>
			<div class="span12"></div>
			<div class="span12">
				<div class="offset3 span6">
					<?php
					$attributes = array('class' => 'form-signin');
					echo form_open('login/doLogin', $attributes);
					?>
						<!-- <h2 class="form-signin-heading">Inicia sessió</h2> -->
						<fieldset class="row fieldset">
							<legend>Iniciar sessión</legend>
								<input class="input-large" type="text" class="input-block-level" placeholder="Usuari" id="username" name="username" value="<?php echo set_value('username'); ?>">
								<?php //echo form_error('username'); ?>
								<input class="input-large" type="password" class="input-block-level" placeholder="Contrasenya" id="password" name="password">
								<button type="submit" class="btn btn-primary btn-xs">Accedir</button>
				</div>
			</div>
			<div class="row-fluid">
				<div class="offset3 span6">

					<?php if ( validation_errors() ){ ?>
						<div class="alert">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Errors!</strong><?php echo validation_errors(); ?>
						</div>
					<?php } ?>
				</div>
			</div>
			</form>
			</fieldset>

		</div>
		
    </div> <!-- /container -->

</body>
</html>
