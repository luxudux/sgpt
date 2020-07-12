$(document).ready(function(){
   // jQuery methods go here...
   $(".btnActClien").on("click", function() {
     //Seleccionamos datos de la fila

      var idtr = $(this).closest('tr').attr('id');
      var id=$('#'+idtr+' td').eq(0).html();
      var nombre=$('#'+idtr+' td').eq(1).html();
      var direccion=$('#'+idtr+' td').eq(2).html();
      var telefono=$('#'+idtr+' td').eq(3).html();
      var ruta=$('#'+idtr+' td').eq(4).html();
      var correo=$('#'+idtr+' td').eq(6).html();
      var activo=$('#'+idtr+' td').eq(7).html();
      //Ingresamos los datos al formulario de actualización
      $('#id_a').val(id);
      $('#nombre_a').val(nombre);
      $('#direccion_a').val(direccion);
      $('#telefono_a').val(telefono);
      $('#ruta_a').val(ruta);
      $('#correo_a').val(correo);
      $('#activo_a').val(activo);
    });
    $(".btnBorrClien").on("click", function() {
      //Seleccionamos datos de la fila
       var idtr = $(this).closest('tr').attr('id');
       var id=$('#'+idtr+' td').eq(0).html();
       var nombre=$('#'+idtr+' td').eq(1).html();
       var direccion=$('#'+idtr+' td').eq(2).html();
       var telefono=$('#'+idtr+' td').eq(3).html();
       var id_ruta=$('#'+idtr+' td').eq(4).html();
       var ruta=$('#'+idtr+' td').eq(5).html();
       var correo=$('#'+idtr+' td').eq(6).html();
       var activo=$('#'+idtr+' td').eq(7).html();
       //Ingresamos los datos al formulario de actualización
       $('#id_b').val(id);
       $('#nombre_b').val(nombre);
       $('#direccion_b').val(direccion);
       $('#telefono_b').val(telefono);
       $('#ruta_b').val(id_ruta+' : '+ruta);
       $('#correo_b').val(correo);
       $('#activo_b').val(activo);
     });

});
