$(document).ready(function(){
   // jQuery methods go here...
   $(".btnActCostoCliente").on("click", function() {
     //Seleccionamos datos de la fila
      var idtr = $(this).closest('tr').attr('id');
      var id=$('#'+idtr+' td').eq(0).html();
      var cliente=$('#'+idtr+' td').eq(1).html();
      var producto=$('#'+idtr+' td').eq(3).html();
      var monto=$('#'+idtr+' td').eq(5).html();
      var fecha=$('#'+idtr+' td').eq(8).html();
      var uso=$('#'+idtr+' td').eq(9).html();
      var activo=$('#'+idtr+' td').eq(11).html();
      var fieldset=$('fieldset.enuso');

      var input_cliente=$('#cliente_a option');
      var input_producto=$('#producto_a option');
      var input_monto=$('#monto_a');
      var input_fecha=$('#fecha_a');
      if(uso>0){
        fieldset.attr('disabled',true);
        input_cliente.attr("disabled","disabled");
        $('#cliente_a option[value='+cliente+']').removeAttr("disabled");
        input_producto.attr("disabled","disabled");
        $('#producto_a option[value='+producto+']').removeAttr("disabled");
        input_monto.attr('readonly', true);
        input_fecha.attr('readonly', true);
      }else{
        fieldset.removeAttr('disabled');
        input_cliente.removeAttr('disabled');
        input_producto.removeAttr('disabled');
        input_monto.removeAttr('readonly');
        input_fecha.removeAttr('readonly');
      }

      //Ingresamos los datos al formulario de actualización
      $('#id_a').val(id);
      $('#cliente_a').val(cliente);
      $('#producto_a').val(producto);
      $('#monto_a').val(monto);
      $('#fecha_a').val(fecha.split("-").reverse().join("-"));
      $('#activo_a').val(activo);
    });
    $(".btnBorrCostoCliente").on("click", function() {
      //Seleccionamos datos de la fila
       var idtr = $(this).closest('tr').attr('id');
       var id=$('#'+idtr+' td').eq(0).html();
       var id_cliente=$('#'+idtr+' td').eq(1).html();
       var cliente=$('#'+idtr+' td').eq(2).html();
       var id_producto=$('#'+idtr+' td').eq(3).html();
       var producto=$('#'+idtr+' td').eq(4).html();
       var monto=$('#'+idtr+' td').eq(5).html();
       var fecha=$('#'+idtr+' td').eq(8).html();
       var uso=$('#'+idtr+' td').eq(9).html();
       var activo=$('#'+idtr+' td').eq(11).html();
       var fieldset=$('fieldset.enuso');
       if(uso>0){fieldset.attr('disabled',true);}else{fieldset.removeAttr('disabled');}
       //Ingresamos los datos al formulario de actualización
       $('#id_b').val(id);
       $('#cliente_b').val(id_cliente+' : '+cliente);
       $('#producto_b').val(id_producto+' : '+producto);
       $('#monto_b').val(monto+' MXN.');
       $('#fecha_b').val(fecha.split("-").reverse().join("-"));
       $('#activo_b').val(activo);
     });

});
