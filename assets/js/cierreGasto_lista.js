$(document).ready(function(){
   // jQuery methods go here...
   $(".btnActCierreGasto").on("click", function() {
     //Seleccionamos datos de la fila
     var idtr = $(this).closest('tr').attr('id');
     var id=$('#'+idtr+' td').eq(0).html();
     var id_cierre=$('#'+idtr+' td').eq(1).html();
     var cierre=$('#'+idtr+' td').eq(2).html();
     var id_sucursal=$('#'+idtr+' td').eq(3).html();
     var sucursal=$('#'+idtr+' td').eq(4).html();
     var id_gasto=$('#'+idtr+' td').eq(5).html();
     var gasto=$('#'+idtr+' td').eq(6).html();
     var monto=$('#'+idtr+' td').eq(7).html();
     var bloqueado=$('#'+idtr+' td').eq(8).html();

     var fieldset=$('fieldset.enuso');
     if(bloqueado>0){fieldset.attr('disabled',true);}
     else{fieldset.removeAttr('disabled');}

     $('#id_a').val(id);
     $('#cierre_a').val(id_cierre+' : '+cierre);
     $('#sucursal_a').val(id_sucursal+' : '+sucursal);
     $('#gasto_a').val(id_gasto+' : '+gasto);
     $('#monto_a').val(monto);

    });
    $(".btnBorrCierreGasto").on("click", function() {
      //Seleccionamos datos de la fila
       var idtr = $(this).closest('tr').attr('id');
       var id=$('#'+idtr+' td').eq(0).html();
       var id_cierre=$('#'+idtr+' td').eq(1).html();
       var cierre=$('#'+idtr+' td').eq(2).html();
       var id_sucursal=$('#'+idtr+' td').eq(3).html();
       var sucursal=$('#'+idtr+' td').eq(4).html();
       var id_gasto=$('#'+idtr+' td').eq(5).html();
       var gasto=$('#'+idtr+' td').eq(6).html();
       var monto=$('#'+idtr+' td').eq(7).html();
       var bloqueado=$('#'+idtr+' td').eq(8).html();

       var fieldset=$('fieldset.enuso');
       if(bloqueado>0){fieldset.attr('disabled',true);}
       else{fieldset.removeAttr('disabled');}

       $('#id_b').val(id);
       $('#cierre_b').val(id_cierre+' : '+cierre);
       $('#sucursal_b').val(id_sucursal+' : '+sucursal);
       $('#gasto_b').val(id_gasto+' : '+gasto);
       $('#monto_b').val(monto+' MXN.');
     });

});
