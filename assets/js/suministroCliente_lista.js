$(document).ready(function(){

    //Validar que la cantidad devuelta no sobre pase a la cantidad_a
    $("#cantidad_n").on("change keyup", function() {
      var limite=$(this).val();
      var devolucion=$('#devolucion_n');
      devolucion.attr('title','La cantidad maxima devuelta puede ser : '+limite);
      devolucion.attr('max',limite);
    });
    $("#cantidad_a").on("change keyup", function() {
      var limite=$("#cantidad_a").val();
      var devolucion=$('#devolucion_a');
      devolucion.attr('title','La cantidad maxima devuelta puede ser : '+limite);
      devolucion.attr('max',limite);
    });
    $("#devolucion_a").on("change keyup", function() {
      var limite=$("#cantidad_a").val();
      var devolucion=$('#devolucion_a');
      devolucion.attr('title','La cantidad maxima devuelta puede ser : '+limite);
      devolucion.attr('max',limite);
    });
   // jQuery methods go here...
   $(".btnActSuministroCliente").on("click", function() {
     //Seleccionamos datos de la fila
      var idtr = $(this).closest('tr').attr('id');
      var id=$('#'+idtr+' td').eq(0).html();
      var id_orden=$('#'+idtr+' td').eq(1).html();
      var orden=$('#'+idtr+' td').eq(2).html();
      var id_costo_cliente=$('#'+idtr+' td').eq(3).html();
      var id_cliente=$('#'+idtr+' td').eq(4).html();
      var cliente=$('#'+idtr+' td').eq(5).html();
      var id_producto=$('#'+idtr+' td').eq(6).html();
      var producto=$('#'+idtr+' td').eq(7).html();
      var id_grupop=$('#'+idtr+' td').eq(8).html();
      var grupop=$('#'+idtr+' td').eq(9).html();
      var cantidad=$('#'+idtr+' td').eq(10).html();
      var id_empleado=$('#'+idtr+' td').eq(13).html();
      var empleado=$('#'+idtr+' td').eq(14).html();
      var devolucion=$('#'+idtr+' td').eq(15).html();

      //Ingresamos los datos al formulario de actualización
      $('#id_a').val(id);
      $('#id_orden_a').val(id_orden+' : '+orden);
      $('#costo_cliente_a').val(id_costo_cliente);
      $('#cantidad_a').val(cantidad);
      $('#empleado_a').val(id_empleado);
      $('#devolucion_a').val(devolucion);

    });
    $(".btnBorrSuministroCliente").on("click", function() {
      //Seleccionamos datos de la fila
      var idtr = $(this).closest('tr').attr('id');
      var id=$('#'+idtr+' td').eq(0).html();
      var id_orden=$('#'+idtr+' td').eq(1).html();
      var orden=$('#'+idtr+' td').eq(2).html();
      var id_costo_cliente=$('#'+idtr+' td').eq(3).html();
      var id_cliente=$('#'+idtr+' td').eq(4).html();
      var cliente=$('#'+idtr+' td').eq(5).html();
      var id_producto=$('#'+idtr+' td').eq(6).html();
      var producto=$('#'+idtr+' td').eq(7).html();
      var id_grupop=$('#'+idtr+' td').eq(8).html();
      var grupop=$('#'+idtr+' td').eq(9).html();
      var cantidad=$('#'+idtr+' td').eq(10).html();
      var id_empleado=$('#'+idtr+' td').eq(13).html();
      var empleado=$('#'+idtr+' td').eq(14).html();
      var devolucion=$('#'+idtr+' td').eq(15).html();

       //Ingresamos los datos al formulario de actualización
       $('#id_b').val(id);
       $('#id_orden_b').val(id_orden+' : '+orden);
       //$('#cliente_a').val(id_cliente);
       $('#cliente_b').val(id_cliente+' : '+cliente);
       $('#producto_b').val(id_producto+' : '+producto);
       $('#cantidad_b').val(cantidad+' Kg.');
       $('#empleado_b').val(id_empleado+' : '+empleado);
       $('#devolucion_b').val(devolucion);
     });

});
