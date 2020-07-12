$(document).ready(function(){
//Datos Grafic
  var config = {
			type: 'pie',
			data: {
				datasets: [{
					data: [5,10,40, 12,23,],
					backgroundColor: ['#e92a2a','#ec7b06','#ebcb27','#449000','#2d8cc2',],
					label: 'Dataset 1'
				}],
				labels: ['Dato1','Dato2','Dato3','Dato4','Dato5']
			},
			options: {
				responsive: true,
        legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: 'Titulo de grafico'
					}
			}
		};
//Datos Grafico 1
    var config1 = {
        type: 'doughnut',
  			data: {
  				datasets: [{
  					data: [20,20,20,20,20,],
  					backgroundColor: ['#e92a2a','#ec7b06','#ebcb27','#449000','#2d8cc2',],
  					label: 'Dataset 2'
  				}],
  				labels: ['Dato6','Dato7','Dato8','Dato9','Dato10']
  			},
  			options: {
  				responsive: true,
          legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: 'titulo de Grafico 1'
					}
  			}
  		};
//Intancia Grafico
    var ctx=document.getElementById('chart').getContext('2d');
    window.pie= new Chart(ctx,config);//instancia pie
//Instancia Grafico 1
    var ctx1=document.getElementById('chart1').getContext('2d');
    window.pie1= new Chart(ctx1,config1);//instancia pie1

    //Se actualiza cada 5 segundos
    setInterval(function(){
//Grafico
      console.log("actualización grafico");
      //Agregamos o elminamos elementos al arreglo
      config.data.datasets.splice(0);//Eliminamos datos
      //Creamos nuevos datos
      var newData={
        data:[getRandom(),getRandom(),getRandom(),getRandom(),getRandom()],
        backgroundColor:['#e92a2a','#ec7b06','#ebcb27','#449000','#2d8cc2',]

      };
      //Ingresamos los datos
      config.data.datasets.push(newData);
      window.pie.update();//Actualizar el grafico

//Grafico 1
      console.log("actualización grafico1");
      //Agregamos o elminamos elementos al arreglo
      config1.data.datasets.splice(0);//Eliminamos datos
      //Creamos nuevos datos
      var newData={
        data:[getRandom(),getRandom(),getRandom(),getRandom(),getRandom()],
        backgroundColor:['#e92a2a','#ec7b06','#ebcb27','#449000','#2d8cc2',]
      };
      //Ingresamos los datos
      config1.data.datasets.push(newData);
      window.pie1.update();//Actualizar el grafico con la instancia pie1
    }, 5000);
    //Devuelve un numero aleatorio
    function getRandom(){
      return Math.round(Math.random()*100);
    };
});