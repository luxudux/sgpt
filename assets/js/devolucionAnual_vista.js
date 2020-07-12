$(document).ready(function () {

	var MESES = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Augosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
	//$.getJSON( "json/gastos1.json", function( datos ) {
	$.getJSON("http://localhost/g1646015/sgpt/ApiGrafico/reporteDevolucionReal", function (datos) {

	}).always(function () {
		//console.log("Esto siempre se ejecuta");
	}).fail(function () {
		console.log("No se encuentra el servicio disponible");
	}).done(function (datos) {
		//console.log("Se encuentra el servicio disponible");
		//console.log(datos);
		var config = {
			//type: 'line',
			type: 'bar',
			data: {
				labels: MESES,
				datasets: datos,
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Grafica de devolucion mensual por sucursal'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				/* //Lineas rectas
				elements: {
				           line: {
				              tension: 0.000001
				           }
				       },*/
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Meses del año'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Valores en Kilogramos (Kg.)'
						}
					}]
				}
			}
		};

		var ctx = document.getElementById('canvas_devoluciones').getContext('2d');
		window.myLine = new Chart(ctx, config);

	});
});
