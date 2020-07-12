$(document).ready(function(){
   // jQuery methods go here...
   $(".btnActReparticiones").on("click", function() {
     //Seleccionamos datos de la fila
      var idtr = $(this).closest('tr').attr('id');
      var id=$('#'+idtr+' td').eq(0).html();
      var id_empleado=$('#'+idtr+' td').eq(1).html();
      var empleado=$('#'+idtr+' td').eq(2).html();
      var id_sucursal=$('#'+idtr+' td').eq(5).html();
      var sucursal=$('#'+idtr+' td').eq(6).html();
      var id_ruta=$('#'+idtr+' td').eq(7).html();

      //Ingresamos los datos al formulario de actualización
      $('#id_a').val(id);
      $('#empleado_a').val(id_empleado+' : '+empleado);
      $('#ruta_a').val(id_ruta);
    });
    $(".btnBorrReparticiones").on("click", function() {
      //Seleccionamos datos de la fila
       var idtr = $(this).closest('tr').attr('id');
       var id=$('#'+idtr+' td').eq(0).html();
       var id_empleado=$('#'+idtr+' td').eq(1).html();
       var empleado=$('#'+idtr+' td').eq(2).html();
       var id_puesto=$('#'+idtr+' td').eq(3).html();
       var puesto=$('#'+idtr+' td').eq(4).html();
       var id_sucursal=$('#'+idtr+' td').eq(5).html();
       var sucursal=$('#'+idtr+' td').eq(6).html();
       var id_ruta=$('#'+idtr+' td').eq(7).html();
       var ruta=$('#'+idtr+' td').eq(8).html();

       //Ingresamos los datos al formulario de actualización
       $('#id_b').val(id);
       $('#empleado_b').val(id_empleado+' : '+empleado);
       $('#puesto_b').val(id_puesto+' : '+puesto);
       $('#sucursal_b').val(id_sucursal+' : '+sucursal);
       $('#ruta_b').val(id_ruta+' : '+ruta);
     });

});
