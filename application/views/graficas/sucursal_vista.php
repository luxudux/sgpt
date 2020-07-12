<?php echo carga_script_js(pathinfo(__FILE__, PATHINFO_FILENAME)); ?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
		canvas {
			-moz-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
		}
		.chart-container {
			width: 500px;
			margin-left: 50px;
			margin-right: 50px;
		}
		.container {
			display: flex;
			flex-direction: row;
			flex-wrap: wrap;
			justify-content: center;
		}
	</style>
  </head>
  <body>
     grafica de la sucursal

   <!-- <div class="canvas-container" sytle"width:40%;">
     <canvas id="chart" ></canvas>
     <canvas id="chart1" ></canvas>
   </div> -->


   <div class="container">
		<div class="chart-container">
			<canvas id="chart" ></canvas>
		</div>
		<div class="chart-container">
			 <canvas id="chart1" ></canvas>
		</div>
	</div>


  </body>
</html>
