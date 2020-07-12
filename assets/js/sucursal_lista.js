$(document).ready(function(){
   // jQuery methods go here...
   $(".btnActSucur").on("click", function() {
     //Seleccionamos datos de la fila

      var idtr = $(this).closest('tr').attr('id');
      var id=$('#'+idtr+' td').eq(0).html();
      var nombre=$('#'+idtr+' td').eq(1).html();
      var direccion=$('#'+idtr+' td').eq(2).html();
      var telefono=$('#'+idtr+' td').eq(3).html();

      //Ingresamos los datos al formulario de actualización
      $('#id_a').val(id);
      $('#nombre_a').val(nombre);
      $('#direccion_a').val(direccion);
      $('#telefono_a').val(telefono);

    });
    $(".btnBorrSucur").on("click", function() {
      //Seleccionamos datos de la fila
       var idtr = $(this).closest('tr').attr('id');
       var id=$('#'+idtr+' td').eq(0).html();
       var nombre=$('#'+idtr+' td').eq(1).html();
       var direccion=$('#'+idtr+' td').eq(2).html();
       var telefono=$('#'+idtr+' td').eq(3).html();

       //Ingresamos los datos al formulario de actualización
       $('#id_b').val(id);
       $('#nombre_b').val(nombre);
       $('#direccion_b').val(direccion);
       $('#telefono_b').val(telefono);

     });

});
