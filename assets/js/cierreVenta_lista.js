$(document).ready(function(){

    $("#cierre_n").on("change", function() {
      var id=$(this).val();
      var sucursal_selec=$(this).find('option:selected').attr('rel');

      var lista=$("#costo_suc_cat_n > option");
      var selec=$("#costo_suc_n");
      var contador=lista.length;
      var valor=0;
      var cad='';
      var sucursal_id=0;
      //Sucursal del cierre seleccionado

       selec.find('option').remove();//limpiar
       selec.append('<option selected disabled>Selecciona un producto</option>');

       for(var i=0; i<contador; i++){
         valor=lista.eq(i).val();
         sucursal_id=lista.eq(i).attr('rel');
         texto=lista.eq(i).text();

         if(sucursal_selec==sucursal_id){
            selec.append('<option value='+valor+'>'+texto+'</option>');

          }
       }

    });
   // jQuery methods go here...
   $(".btnActCierreVenta").on("click", function() {
     //Seleccionamos datos de la fila
     var idtr = $(this).closest('tr').attr('id');
     var id=$('#'+idtr+' td').eq(0).html();
     var id_cierre=$('#'+idtr+' td').eq(1).html();
     var cierre=$('#'+idtr+' td').eq(2).html();
     var id_sucursal=$('#'+idtr+' td').eq(4).html();
     var sucursal=$('#'+idtr+' td').eq(5).html();
     var id_producto=$('#'+idtr+' td').eq(6).html();
     var producto=$('#'+idtr+' td').eq(7).html();
     var cantidad=$('#'+idtr+' td').eq(8).html();
     var bloqueado=$('#'+idtr+' td').eq(9).html();

     var fieldset=$('fieldset.enuso');
     if(bloqueado>0){fieldset.attr('disabled',true);}
     else{fieldset.removeAttr('disabled');}

      //Ingresamos los datos al formulario de actualización
      $('#id_a').val(id);
      $('#cierre_a').val(id_cierre+' : '+cierre);
      $('#sucursal_a').val(id_sucursal+' : '+sucursal);
      $('#producto_a').val(id_producto+' : '+producto);
      $('#cantidad_a').val(cantidad);
    });
    $(".btnBorrCierreVenta").on("click", function() {
      //Seleccionamos datos de la fila
       var idtr = $(this).closest('tr').attr('id');
       var id=$('#'+idtr+' td').eq(0).html();
       var id_cierre=$('#'+idtr+' td').eq(1).html();
       var cierre=$('#'+idtr+' td').eq(2).html();
       var id_sucursal=$('#'+idtr+' td').eq(4).html();
       var sucursal=$('#'+idtr+' td').eq(5).html();
       var id_producto=$('#'+idtr+' td').eq(6).html();
       var producto=$('#'+idtr+' td').eq(7).html();
       var cantidad=$('#'+idtr+' td').eq(8).html();
       var bloqueado=$('#'+idtr+' td').eq(9).html();

       var fieldset=$('fieldset.enuso');
       if(bloqueado>0){fieldset.attr('disabled',true);}
       else{fieldset.removeAttr('disabled');}

       //Ingresamos los datos al formulario de actualización
       $('#id_b').val(id);
       $('#cierre_b').val(id_cierre+' : '+cierre);
       $('#sucursal_b').val(id_sucursal+' : '+sucursal);
       $('#producto_b').val(id_producto+' : '+producto);
       $('#cantidad_b').val(cantidad+' Kg.');

     });

});
