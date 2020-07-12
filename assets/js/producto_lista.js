$(document).ready(function(){
   // jQuery methods go here...
   $(".btnActProducto").on("click", function() {
     //Seleccionamos datos de la fila
      var idtr = $(this).closest('tr').attr('id');
      var id=$('#'+idtr+' td').eq(0).html();
      var nombre=$('#'+idtr+' td').eq(1).html();
      var descripcion=$('#'+idtr+' td').eq(2).html();
      var grupop=$('#'+idtr+' td').eq(3).html();

      //Ingresamos los datos al formulario de actualización
      $('#id_a').val(id);
      $('#nombre_a').val(nombre);
      $('#descripcion_a').val(descripcion);
      $('#grupop_a').val(grupop);
    });
    $(".btnBorrProducto").on("click", function() {
      //Seleccionamos datos de la fila
       var idtr = $(this).closest('tr').attr('id');
       var id=$('#'+idtr+' td').eq(0).html();
       var nombre=$('#'+idtr+' td').eq(1).html();
       var descripcion=$('#'+idtr+' td').eq(2).html();
       var id_grupop=$('#'+idtr+' td').eq(3).html();
       var grupop=$('#'+idtr+' td').eq(4).html();

       //Ingresamos los datos al formulario de actualización
       $('#id_b').val(id);
       $('#nombre_b').val(nombre);
       $('#descripcion_b').val(descripcion);
       $('#grupop_b').val(id_grupop+' : '+grupop);
     });

});
