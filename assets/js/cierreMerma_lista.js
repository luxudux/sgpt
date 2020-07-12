$(document).ready(function(){
   // jQuery methods go here...
   $(".btnActCierreMerma").on("click", function() {
     //Seleccionamos datos de la fila
     var idtr = $(this).closest('tr').attr('id');
     var id=$('#'+idtr+' td').eq(0).html();
     var id_cierre=$('#'+idtr+' td').eq(1).html();
     var cierre=$('#'+idtr+' td').eq(2).html();
     var id_sucursal=$('#'+idtr+' td').eq(3).html();
     var sucursal=$('#'+idtr+' td').eq(4).html();
     var id_merma=$('#'+idtr+' td').eq(5).html();
     var merma=$('#'+idtr+' td').eq(6).html();
     var cantidad=$('#'+idtr+' td').eq(7).html();
     var bloqueado=$('#'+idtr+' td').eq(8).html();

     var fieldset=$('fieldset.enuso');
     if(bloqueado>0){fieldset.attr('disabled',true);}
     else{fieldset.removeAttr('disabled');}


     //Ingresamos los datos al formulario de actualización
     $('#id_a').val(id);
     $('#cierre_a').val(id_cierre+' : '+cierre);
     $('#sucursal_a').val(id_sucursal+' : '+sucursal);
     $('#merma_a').val(id_merma+' : '+merma);
     $('#cantidad_a').val(cantidad);

    });
    $(".btnBorrCierreMerma").on("click", function() {
      //Seleccionamos datos de la fila
       var idtr = $(this).closest('tr').attr('id');
       var id=$('#'+idtr+' td').eq(0).html();
       var id_cierre=$('#'+idtr+' td').eq(1).html();
       var cierre=$('#'+idtr+' td').eq(2).html();
       var id_sucursal=$('#'+idtr+' td').eq(3).html();
       var sucursal=$('#'+idtr+' td').eq(4).html();
       var id_merma=$('#'+idtr+' td').eq(5).html();
       var merma=$('#'+idtr+' td').eq(6).html();
       var cantidad=$('#'+idtr+' td').eq(7).html();
       var bloqueado=$('#'+idtr+' td').eq(8).html();
       
       var fieldset=$('fieldset.enuso');
       if(bloqueado>0){fieldset.attr('disabled',true);}
       else{fieldset.removeAttr('disabled');}

       //Ingresamos los datos al formulario de actualización
       $('#id_b').val(id);
       $('#cierre_b').val(id_cierre+' : '+cierre);
       $('#sucursal_b').val(id_sucursal+' : '+sucursal);
       $('#merma_b').val(id_merma+' : '+merma);
       $('#cantidad_b').val(cantidad+' Kg.');
     });

});
