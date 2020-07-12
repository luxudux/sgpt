$(document).ready(function(){
     //Rendimiento de la tortilla de maíz
     $(".calcula_n").on("change keyup", function() {

       var deshi=$('#deshidrata_n').val();
       var calculo;
       deshi=parseFloat(deshi);

       if(deshi>0){
         calculo=1-(deshi/100);
         $('#tortillaM_n').val(calculo.toFixed(2));
       }else{
         $('#tortillaM_n').val(0);
       }
    });
    $(".calcula_a").on("change keyup", function() {

      var deshi=$('#deshidrata_a').val();
      var calculo;
      deshi=parseFloat(deshi);

      if(deshi>0){
        calculo=1-(deshi/100);
        $('#tortillaM_a').val(calculo.toFixed(2));
      }else{
        $('#tortillaM_a').val(0);
      }
   });
   // jQuery methods go here...
   $(".btnActRendimiento").on("click", function() {
     //Seleccionamos datos de la fila
      var idtr = $(this).closest('tr').attr('id');
      var id=$('#'+idtr+' td').eq(0).html();
      var nombre=$('#'+idtr+' td').eq(1).html();
      var maiz=$('#'+idtr+' td').eq(2).html();
      var amaiz=$('#'+idtr+' td').eq(3).html();
      var harina=$('#'+idtr+' td').eq(4).html();
      var aharina=$('#'+idtr+' td').eq(5).html();
      var masa=$('#'+idtr+' td').eq(6).html();
      var deshi=$('#'+idtr+' td').eq(7).html();
      var rtm=$('#'+idtr+' td').eq(8).html();
      var rth=$('#'+idtr+' td').eq(9).html();
      var activo=$('#'+idtr+' td').eq(10).html();
      var uso=$('#'+idtr+' td').eq(12).html();
      var bloqueado=$('#'+idtr+' td').eq(14).html();
      var fieldset=$('fieldset.enuso');
      if(uso>0 || bloqueado>0){fieldset.attr('disabled',true);}else{fieldset.removeAttr('disabled');}
      //Ingresamos los datos al formulario de actualización
      $('#id_a').val(id);
      $('#nombre_a').val(nombre);
      $('#sacoMaiz_a').val(maiz);
      $('#aguaMaiz_a').val(amaiz);
      $('#sacoHarina_a').val(harina);
      $('#aguaHarina_a').val(aharina);
      $('#masa_a').val(masa);
      $('#deshidrata_a').val(deshi);
      $('#tortillaM_a').val(rtm);
      $('#tortillaH_a').val(rth);
      $('#activo_a').val(activo);
    });
    $(".btnBorrRendimiento").on("click", function() {
      //Seleccionamos datos de la fila
      var idtr = $(this).closest('tr').attr('id');
      var id=$('#'+idtr+' td').eq(0).html();
      var nombre=$('#'+idtr+' td').eq(1).html();
      var maiz=$('#'+idtr+' td').eq(2).html();
      var amaiz=$('#'+idtr+' td').eq(3).html();
      var harina=$('#'+idtr+' td').eq(4).html();
      var aharina=$('#'+idtr+' td').eq(5).html();
      var masa=$('#'+idtr+' td').eq(6).html();
      var deshi=$('#'+idtr+' td').eq(7).html();
      var rtm=$('#'+idtr+' td').eq(8).html();
      var rth=$('#'+idtr+' td').eq(9).html();
      var activo=$('#'+idtr+' td').eq(10).html();
      var uso=$('#'+idtr+' td').eq(12).html();
      var bloqueado=$('#'+idtr+' td').eq(14).html();
       var fieldset=$('fieldset.enuso');
       if(uso>0 || bloqueado>0){fieldset.attr('disabled',true);}else{fieldset.removeAttr('disabled');}

       $('#id_b').val(id);
       $('#nombre_b').val(nombre);
       $('#sacoMaiz_b').val(maiz);
       $('#aguaMaiz_b').val(amaiz);
       $('#sacoHarina_b').val(harina);
       $('#aguaHarina_b').val(aharina);
       $('#masa_b').val(masa);
       $('#deshidrata_b').val(deshi);
       $('#tortillaM_b').val(rtm);
       $('#tortillaH_b').val(rth);
       $('#activo_b').val(activo);
     });

});
