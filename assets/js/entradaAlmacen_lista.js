$(document).ready(function(){
   // jQuery methods go here...
   $(".btnActEntradaAlmacen").on("click", function() {
     //Seleccionamos datos de la fila
      var idtr = $(this).closest('tr').attr('id');
      var id=$('#'+idtr+' td').eq(0).html();
      var materiaPrima=$('#'+idtr+' td').eq(1).html();
      var proveedor=$('#'+idtr+' td').eq(3).html();
      var cantidad=$('#'+idtr+' td').eq(5).html();
      var fecha=$('#'+idtr+' td').eq(6).html();
      var uso=$('#'+idtr+' td').eq(7).html();

      //if(uso>0){fieldset.attr('disabled',true);}else{fieldset.removeAttr('disabled');}

      //Ingresamos los datos al formulario de actualización
      $('#id_a').val(id);
      $('#materiaPrima_a').val(materiaPrima);
      $('#proveedor_a').val(proveedor);
      $('#cantidad_a').val(cantidad);
      $('#fecha_a').val(fecha.split("-").reverse().join("-"));

      var fieldset=$('fieldset.enuso');
      if(uso>0){
        //BOTONES
        fieldset.attr('disabled',true);
        //DATOS DE FORMULARIO
        $('#fecha_a').attr('readonly',true);
        $("#proveedor_a option:not(:selected)").attr('disabled',true);//select
      }else{
        //BOTONES
        fieldset.removeAttr('disabled');
        //DATOS DE FORMULARIO
        $('#fecha_a').attr('readonly',false);
        $('#proveedor_a option').attr('disabled',false);//select
      }

    });
    $(".btnBorrEntradaAlmacen").on("click", function() {
      //Seleccionamos datos de la fila
       var idtr = $(this).closest('tr').attr('id');
       var id=$('#'+idtr+' td').eq(0).html();
       var id_materiaPrima=$('#'+idtr+' td').eq(1).html();
       var materiaPrima=$('#'+idtr+' td').eq(2).html();
       var id_proveedor=$('#'+idtr+' td').eq(3).html();
       var proveedor=$('#'+idtr+' td').eq(4).html();
       var cantidad=$('#'+idtr+' td').eq(5).html();
       var fecha=$('#'+idtr+' td').eq(6).html();
       var uso=$('#'+idtr+' td').eq(7).html();
       var fieldset=$('fieldset.enuso');
       if(uso>0){fieldset.attr('disabled',true);}else{fieldset.removeAttr('disabled');}

       //Ingresamos los datos al formulario de actualización
       $('#id_b').val(id);
       $('#materiaPrima_b').val(id_materiaPrima+' : '+materiaPrima);
       $('#proveedor_b').val(id_proveedor+' : '+proveedor);
       $('#cantidad_b').val(cantidad+' Kg.');
       $('#fecha_b').val(fecha.split("-").reverse().join("-"));
     });

});
