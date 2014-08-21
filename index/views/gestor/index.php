<html>
<head>
<title>Enquesta</title>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<script src='<?php echo base_url_static_f();?>js/jquery-ui-timepicker-addon.js'></script>
<script src='<?php echo base_url_static_f();?>bootstrap/js/bootstrap.js'></script>
<link href='<?php echo base_url_static_f();?>bootstrap/css/bootstrap.css' rel="stylesheet">
<script src='<?php echo base_url_static_f();?>js/funciones.js'></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

</head>
<body>
	
<div class="container">	
	
	<div class="row-fluid">
		<div class="span12"></div>
			<div class="row-fluid">
				<div class="span12">
					<div class="row-fluid">
						<h2>DATOS SOBRE LA ESCUESTA GENERAL</h2>
					</div>
			</div>
		</div>
	</div>
	<?php
	
		if(count($preguntasTotal) > 0){
			foreach($preguntasTotal as $preg){
				
				echo "<h3><b>".$preg->pregunta."</b></h3>";
				
								
				echo"<div id='container".$preg->id."' style='width:60%; height:400px;'></div>";
				$cat = json_encode($categorias[$preg->id]);
				$result = json_encode($resultados[$preg->id]);
					?>
					<script>
						$(function () {
							$('#container'+<?php echo $preg->id;?>).highcharts({
									chart: {
										type: 'column'
									},
									title: {
										text: 'Valoración'
									},
									subtitle: {
										text: 'CAUC'
									},
									xAxis: {
										categories: <?php echo $cat; ?>
									},
									yAxis: {
										min: 0,
										title: {
											text: 'Cantidad'
										}
									},
									tooltip: {
										headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
										pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
											'<td style="padding:0"><b>{point.y:.1f} votos/s</b></td></tr>',
										footerFormat: '</table>',
										shared: true,
										useHTML: true
									},
									plotOptions: {
										column: {
											pointPadding: 0.2,
											borderWidth: 0
										}
									},
									legend:[
										{
											enabled:false
										}
									],
									series: [{
										name: 'Valores',
										data: <?php echo $result; ?>
							
									}]
								});
							});
						</script>
									
						<?php
							
				}
				echo "<br>";
			}	

	?>

</div>


</body>
</html>
