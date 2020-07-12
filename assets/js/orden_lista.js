$(document).ready(function(){
   // jQuery methods go here...
   $(".btnActOrden").on("click", function() {
     //Seleccionamos datos de la fila

      var idtr = $(this).closest('tr').attr('id');
      var id=$('#'+idtr+' td').eq(0).html();
      var sucursal=$('#'+idtr+' td').eq(1).html();
      var nota=$('#'+idtr+' td').eq(3).html();
      var fecha_reg=$('#'+idtr+' td').eq(4).html();
      var fecha_ejec=$('#'+idtr+' td').eq(7).html();
      var hora_ejec=$('#'+idtr+' td').eq(8).html();
      var cierre=$('#'+idtr+' td').eq(9).html();
      var id_rendimiento=$('#'+idtr+' td').eq(11).html();
      var uso=$('#'+idtr+' td').eq(21).html();

      //Ingresamos los datos al formulario de actualización
      $('#id_a').val(id);
      $('#sucursal_a').val(sucursal);
      $('#nota_a').val(nota);
      $('#fecha_reg_a').val(fecha_reg.split("-").reverse().join("-"));
      $('#fecha_ejec_a').val(fecha_ejec.split("-").reverse().join("-"));
      $('#hora_ejec_a').val(hora_ejec);
      $('#cierre_a').val(cierre);
      $('#rendimiento_a').val(id_rendimiento);

      var fieldset=$('fieldset.enuso');
      if(uso>0){
        fieldset.attr('disabled',true);

        $("#sucursal_a option:not(:selected)").attr('disabled',true);//select
        $("#sucursal_a").addClass("text-muted");//Texto gris

        $("#rendimiento_a option:not(:selected)").attr('disabled',true);//select
        $("#rendimiento_a").addClass("text-muted");
        //SIEMPRE DESHABILITADO EL CIERRE
        $("#cierre_a option:not(:selected)").attr('disabled',true);//select
        $("#cierre_a").addClass("text-muted");
      }else{
        fieldset.removeAttr('disabled');
        $("#rendimiento_a option").attr('disabled',false);//select
        $("#rendimiento_a").removeClass("text-muted");

        $("#sucursal_a option").attr('disabled',false);//select
        $("#sucursal_a").removeClass("text-muted");
        //SIEMPRE DESHABILITADO EL CIERRE
        $("#cierre_a option:not(:selected)").attr('disabled',true);//select
        $("#cierre_a").addClass("text-muted");
      }

    });
    $(".btnBorrOrden").on("click", function() {
      //Seleccionamos datos de la fila
       var idtr = $(this).closest('tr').attr('id');
       var id=$('#'+idtr+' td').eq(0).html();
       var id_sucursal=$('#'+idtr+' td').eq(1).html();
       var sucursal=$('#'+idtr+' td').eq(2).html();
       var nota=$('#'+idtr+' td').eq(3).html();
       //var fecha_reg=$('#'+idtr+' td').eq(4).html();
       var fecha_ejec=$('#'+idtr+' td').eq(7).html();
       var hora_ejec=$('#'+idtr+' td').eq(8).html();
       var cierre=$('#'+idtr+' td').eq(9).html();
       var id_rendimiento=$('#'+idtr+' td').eq(11).html();
       var rendimiento=$('#'+idtr+' td').eq(12).html();

       var uso=$('#'+idtr+' td').eq(21).html();
       var fieldset=$('fieldset.enuso');
       if(uso>0){fieldset.attr('disabled',true);}else{fieldset.removeAttr('disabled');}
       //Ingresamos los datos al formulario de actualización
       $('#id_b').val(id);
       $('#sucursal_b').val(id_sucursal+' : '+sucursal);
       $('#nota_b').val(nota);
      // $('#fecha_reg_b').val(fecha_reg.split("-").reverse().join("-"));
       $('#fecha_ejec_b').val(fecha_ejec+' : '+hora_ejec);
       $('#cierre_b').val(cierre);
       $('#rendimiento_b').val(id_rendimiento+' : '+rendimiento);
     });

});
