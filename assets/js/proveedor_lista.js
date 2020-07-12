$(document).ready(function(){
   // jQuery methods go here...
   $(".btnActProv").on("click", function() {
     //Seleccionamos datos de la fila
      var idtr = $(this).closest('tr').attr('id');
      var id=$('#'+idtr+' td').eq(0).html();
      var nombre=$('#'+idtr+' td').eq(1).html();
      var correo=$('#'+idtr+' td').eq(2).html();
      var telefono=$('#'+idtr+' td').eq(3).html();
      var activo=$('#'+idtr+' td').eq(4).html();
      //Ingresamos los datos al formulario de actualización
      $('#id_a').val(id);
      $('#nombre_a').val(nombre);
      $('#correo_a').val(correo);
      $('#telefono_a').val(telefono);
      $('#activo_a').val(activo);
    });
    $(".btnBorrProv").on("click", function() {
      //Seleccionamos datos de la fila
       var idtr = $(this).closest('tr').attr('id');
       var id=$('#'+idtr+' td').eq(0).html();
       var nombre=$('#'+idtr+' td').eq(1).html();
       var correo=$('#'+idtr+' td').eq(2).html();
       var telefono=$('#'+idtr+' td').eq(3).html();
       var activo=$('#'+idtr+' td').eq(4).html();
       //Ingresamos los datos al formulario de actualización
       $('#id_b').val(id);
       $('#nombre_b').val(nombre);
       $('#correo_b').val(correo);
       $('#telefono_b').val(telefono);
       $('#activo_b').val(activo);
     });

});
