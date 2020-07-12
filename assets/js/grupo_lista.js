$(document).ready(function(){
   // jQuery methods go here...
   $(".btnActGrupo").on("click", function() {
     //Seleccionamos datos de la fila
      var idtr = $(this).closest('tr').attr('id');
      var id=$('#'+idtr+' td').eq(0).html();
      var nombre=$('#'+idtr+' td').eq(1).html();

      var uso=$('#'+idtr+' td').eq(2).html();
      var bloqueado=$('#'+idtr+' td').eq(4).html();
      var fieldset=$('fieldset.enuso');
      if(uso>0 || bloqueado>0){fieldset.attr('disabled',true);}else{fieldset.removeAttr('disabled');}

      //Ingresamos los datos al formulario de actualización
      $('#id_a').val(id);
      $('#nombre_a').val(nombre);
    });
    $(".btnBorrGrupo").on("click", function() {
      //Seleccionamos datos de la fila
       var idtr = $(this).closest('tr').attr('id');
       var id=$('#'+idtr+' td').eq(0).html();
       var nombre=$('#'+idtr+' td').eq(1).html();

       var uso=$('#'+idtr+' td').eq(2).html();
       var bloqueado=$('#'+idtr+' td').eq(4).html();
       var fieldset=$('fieldset.enuso');
       if(uso>0 || bloqueado>0){fieldset.attr('disabled',true);}else{fieldset.removeAttr('disabled');}

       //Ingresamos los datos al formulario de actualización
       $('#id_b').val(id);
       $('#nombre_b').val(nombre);
     });

});
