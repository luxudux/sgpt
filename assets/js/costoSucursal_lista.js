$(document).ready(function(){
   // jQuery methods go here...
   $(".btnActCostoSucursal").on("click", function() {
     //Seleccionamos datos de la fila
      var idtr = $(this).closest('tr').attr('id');
      var id=$('#'+idtr+' td').eq(0).html();
      var sucursal=$('#'+idtr+' td').eq(1).html();
      var producto=$('#'+idtr+' td').eq(3).html();
      var monto=$('#'+idtr+' td').eq(5).html();
      var fecha=$('#'+idtr+' td').eq(6).html();
      var uso=$('#'+idtr+' td').eq(7).html();
      var activo=$('#'+idtr+' td').eq(9).html();
      var fieldset=$('fieldset.enuso');

      var input_sucursal=$('#sucursal_a option');
      var input_producto=$('#producto_a option');
      var input_monto=$('#monto_a');
      var input_fecha=$('#fecha_a');
      if(uso>0){
          fieldset.attr('disabled',true);
          input_sucursal.attr("disabled","disabled");
          $('#sucursal_a option[value='+sucursal+']').removeAttr("disabled");
          input_producto.attr("disabled","disabled");
          $('#producto_a option[value='+producto+']').removeAttr("disabled");
          input_monto.attr('readonly', true);
          input_fecha.attr('readonly', true);
      }else{
        fieldset.removeAttr('disabled');
        input_sucursal.removeAttr('disabled');
        input_producto.removeAttr('disabled');
        input_monto.removeAttr('readonly');
        input_fecha.removeAttr('readonly');
      }
      //Ingresamos los datos al formulario de actualización
      $('#id_a').val(id);
      $('#sucursal_a').val(sucursal);
      $('#producto_a').val(producto);
      $('#monto_a').val(monto);
      $('#fecha_a').val(fecha.split("-").reverse().join("-"));
      $('#activo_a').val(activo);
    });
    $(".btnBorrCostoSucursal").on("click", function() {
      //Seleccionamos datos de la fila
       var idtr = $(this).closest('tr').attr('id');
       var id=$('#'+idtr+' td').eq(0).html();
       var id_sucursal=$('#'+idtr+' td').eq(1).html();
       var sucursal=$('#'+idtr+' td').eq(2).html();
       var id_producto=$('#'+idtr+' td').eq(3).html();
       var producto=$('#'+idtr+' td').eq(4).html();
       var monto=$('#'+idtr+' td').eq(5).html();
       var fecha=$('#'+idtr+' td').eq(6).html();
       var uso=$('#'+idtr+' td').eq(7).html();
       var activo=$('#'+idtr+' td').eq(9).html();

       var fieldset=$('fieldset.enuso');
       if(uso>0){fieldset.attr('disabled',true);}else{fieldset.removeAttr('disabled');}
       //Ingresamos los datos al formulario de actualización
       $('#id_b').val(id);
       $('#sucursal_b').val(id_sucursal+' : '+sucursal);
       $('#producto_b').val(id_producto+' : '+producto);
       $('#monto_b').val(monto+' MXN.' );
       $('#fecha_b').val(fecha.split("-").reverse().join("-"));
       $('#activo_b').val(activo);
     });

});
