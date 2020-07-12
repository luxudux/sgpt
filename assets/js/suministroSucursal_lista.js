$(document).ready(function(){

    //Limitar el Stock
    $("#materiaPrima_n").on("change", function() {
      var limite=$(this).find('option:selected').attr('rel');
      //Fijamos la cantidad máxima
      $('#cantidad_n').attr('disabled',false);
      $('#cantidad_n').attr('title','Cantidad máxima: '+limite);
      $('#cantidad_n').attr('placeholder','Cantidad máxima: '+limite);
      $('#cantidad_n').attr('max',limite);
    });



   // jQuery methods go here...
   $(".btnActSuministroSucursal").on("click", function() {
     //Seleccionamos datos de la fila
      var idtr = $(this).closest('tr').attr('id');
      var id=$('#'+idtr+' td').eq(0).html();
      var id_orden=$('#'+idtr+' td').eq(3).html();
      var orden=$('#'+idtr+' td').eq(4).html();
      var id_materiaPrima=$('#'+idtr+' td').eq(5).html();
      var materiaPrima=$('#'+idtr+' td').eq(6).html();
      var cantidad=$('#'+idtr+' td').eq(7).html();
      var id_proveedor=$('#'+idtr+' td').eq(9).html();
      var proveedor=$('#'+idtr+' td').eq(10).html();
      var limite=$('#'+idtr+' td').eq(11).html();
      //Fijamos la cantidad máxima
      $('#cantidad_a').attr('title','Cantidad máxima: '+limite);
      $('#cantidad_a').attr('max',limite);
      var fieldset=$('fieldset.enuso');
      if(limite==0){fieldset.attr('disabled',true);}else{fieldset.removeAttr('disabled');}
      //Ingresamos los datos al formulario de actualización
      $('#id_a').val(id);
      $('#id_orden_a').val(id_orden+' : '+orden);
      $('#proveedor_a').val(id_proveedor+' : '+proveedor);
      $("#materiaPrima_a").empty().append(new Option(id_materiaPrima+' : '+materiaPrima, id_materiaPrima));
      $('#cantidad_a').val(cantidad);

    });
    $(".btnBorrSuministroSucursal").on("click", function() {
      //Seleccionamos datos de la fila
      var idtr = $(this).closest('tr').attr('id');
      var id=$('#'+idtr+' td').eq(0).html();
      var id_orden=$('#'+idtr+' td').eq(3).html();
      var orden=$('#'+idtr+' td').eq(4).html();
      var id_materiaPrima=$('#'+idtr+' td').eq(5).html();
      var materiaPrima=$('#'+idtr+' td').eq(6).html();
      var cantidad=$('#'+idtr+' td').eq(7).html();
      var id_proveedor=$('#'+idtr+' td').eq(9).html();
      var proveedor=$('#'+idtr+' td').eq(10).html();

       //Ingresamos los datos al formulario de actualización
       $('#id_b').val(id);
       $('#id_orden_b').val(id_orden+' : '+orden);
       $('#proveedor_b').val(id_proveedor+' : '+proveedor);
       $('#materiaPrima_b').val(id_materiaPrima+' : '+materiaPrima);
       $('#cantidad_b').val(cantidad+' Kg.');
     });

});
