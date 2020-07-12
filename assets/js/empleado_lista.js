$(document).ready(function(){
   // jQuery methods go here...
   $(".btnActEmpl").on("click", function() {
     //Seleccionamos datos de la fila

      var idtr = $(this).closest('tr').attr('id');
      var id=$('#'+idtr+' td').eq(0).html();
      var nombre=$('#'+idtr+' td').eq(1).html();
      var direccion=$('#'+idtr+' td').eq(2).html();
      var telefono=$('#'+idtr+' td').eq(3).html();
      var nacimiento=$('#'+idtr+' td').eq(4).html();
      var puesto=$('#'+idtr+' td').eq(5).html();
      var sucursal=$('#'+idtr+' td').eq(7).html();
      var activo=$('#'+idtr+' td').eq(9).html();

      //Ingresamos los datos al formulario de actualización
      $('#id_a').val(id);
      $('#nombre_a').val(nombre);
      $('#direccion_a').val(direccion);
      $('#telefono_a').val(telefono);
      $('#nacimiento_a').val(nacimiento.split("-").reverse().join("-"));
      $('#puesto_a').val(puesto);
      $('#sucursal_a').val(sucursal);
      $('#activo_a').val(activo);
    });
    $(".btnBorrEmpl").on("click", function() {
      //Seleccionamos datos de la fila
       var idtr = $(this).closest('tr').attr('id');
       var id=$('#'+idtr+' td').eq(0).html();
       var nombre=$('#'+idtr+' td').eq(1).html();
       var direccion=$('#'+idtr+' td').eq(2).html();
       var telefono=$('#'+idtr+' td').eq(3).html();
       var nacimiento=$('#'+idtr+' td').eq(4).html();
       var id_puesto=$('#'+idtr+' td').eq(5).html();
       var puesto=$('#'+idtr+' td').eq(6).html();
       var id_sucursal=$('#'+idtr+' td').eq(7).html();
       var sucursal=$('#'+idtr+' td').eq(8).html();
       var activo=$('#'+idtr+' td').eq(9).html();
       //Ingresamos los datos al formulario de actualización
       $('#id_b').val(id);
       $('#nombre_b').val(nombre);
       $('#direccion_b').val(direccion);
       $('#telefono_b').val(telefono);
       $('#nacimiento_b').val(nacimiento.split("-").reverse().join("-"));
       $('#puesto_b').val(id_puesto+' : '+puesto);
       $('#sucursal_b').val(id_sucursal+' : '+sucursal);
       $('#activo_b').val(activo);
     });

});
