$(document).ready(function(){
   // jQuery methods go here...
   $(".btnActGasto").on("click", function() {
     //Seleccionamos datos de la fila
      var idtr = $(this).closest('tr').attr('id');
      var id=$('#'+idtr+' td').eq(0).html();
      var nombre=$('#'+idtr+' td').eq(1).html();
      var grupo=$('#'+idtr+' td').eq(2).html();

      //Ingresamos los datos al formulario de actualización
      $('#id_a').val(id);
      $('#nombre_a').val(nombre);
      $('#grupo_a').val(grupo);
    });
    $(".btnBorrGasto").on("click", function() {
      //Seleccionamos datos de la fila
       var idtr = $(this).closest('tr').attr('id');
       var id=$('#'+idtr+' td').eq(0).html();
       var nombre=$('#'+idtr+' td').eq(1).html();
       var id_grupo=$('#'+idtr+' td').eq(2).html();
       var grupo=$('#'+idtr+' td').eq(3).html();

       //Ingresamos los datos al formulario de actualización
       $('#id_b').val(id);
       $('#nombre_b').val(nombre);
       $('#grupo_b').val(id_grupo+' : '+grupo);
     });

});
