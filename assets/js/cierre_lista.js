$(document).ready(function(){

    $("#sucursal_n").on("change", function() {
      var id=$(this).val();
      //var sucursal_selec=$(this).find('option:selected').attr('rel');

      var lista=$("#ordensin_n > option");
      var selec=$(".orden_n:last");
      var contador=lista.length;
      var valor=0;
      var texto='';

       selec.find('option').remove();//limpiar
       for(var i=0; i<contador; i++){
         valor=lista.eq(i).val();
         sucursal_id=lista.eq(i).attr('rel');
         texto=lista.eq(i).text();


         if(id==sucursal_id){
           selec.append('<option value='+valor+'>'+texto+'</option>');

         }
       }

    });
   // jQuery methods go here...
   $(".btnActCierre").on("click", function() {

     //Seleccionamos datos de la fila

      var idtr = $(this).closest('tr').attr('id');
      var id=$('#'+idtr+' td').eq(0).html();
      var sucursal=$('#'+idtr+' td').eq(1).html();
      var nota=$('#'+idtr+' td').eq(3).html();
      var fecha_reg=$('#'+idtr+' td').eq(4).html();
      var uso=$('#'+idtr+' td').eq(13).html();
      var bloqueado=$('#'+idtr+' td').eq(17).html();


      //Ingresamos los datos al formulario de actualización
      $('#id_a').val(id);
      $('#sucursal_a').val(sucursal);
      $('#nota_a').val(nota);
      $('#fecha_reg_a').val(fecha_reg.split("-").reverse().join("-"));
      $('#bloqueado_a').val(bloqueado);

      var fieldset=$('fieldset.enuso');
      if(bloqueado>0){
        //BOTONES
        fieldset.attr('disabled',true);
        $('#nota_a').attr('readonly',true);
        //DATOS DE FORMULARIO
        $('#fecha_reg_a').attr('readonly',true);
      }else if(uso>0 && bloqueado==0){
        //BOTONES
        fieldset.attr('disabled',true);
        //DATOS DE FORMULARIO
        $('#fecha_reg_a').attr('readonly',true);
        $('#nota_a').attr('readonly',false);

      }else{
        //BOTONES
        fieldset.removeAttr('disabled');
        //DATOS DE FORMULARIO
        $('#fecha_reg_a').attr('readonly',false);
        $('#nota_a').attr('readonly',false);
      }

      var lista=$("#orden_a > option");
      var selec=$("#ordensel_a");
      var contador=lista.length;
      var valor=0;
      var texto='';
       selec.find('option').remove();//limpiar
       for(var i=0; i<contador; i++){
         valor=lista.eq(i).val();
         texto=lista.eq(i).text();
         if(valor==id){selec.append('<option value='+valor+'>'+texto+'</option>');}
       }




    });
    $(".btnBorrCierre").on("click", function() {
      //Seleccionamos datos de la fila
       var idtr = $(this).closest('tr').attr('id');
       var id=$('#'+idtr+' td').eq(0).html();
       var sucursal=$('#'+idtr+' td').eq(2).html();
       var nota=$('#'+idtr+' td').eq(3).html();
       var fecha_reg=$('#'+idtr+' td').eq(4).html();
       var uso=$('#'+idtr+' td').eq(13).html();
       var bloqueado=$('#'+idtr+' td').eq(17).html();


       var fieldset=$('fieldset.enuso');
       if(uso>0 || bloqueado>0){fieldset.attr('disabled',true);}else{fieldset.removeAttr('disabled');}
       //Ingresamos los datos al formulario de actualización
       $('#id_b').val(id);
       $('#sucursal_b').val(sucursal);
       $('#nota_b').val(nota);
      // $('#fecha_reg_b').val(fecha_reg.split("-").reverse().join("-"));
       $('#fecha_reg_b').val(fecha_reg);
       $('#bloqueado_b').val(bloqueado);


      // alert(id);
       var lista=$("#orden_a > option");
       var selec=$("#ordensel_b");
       var contador=lista.length;
       var valor=0;
       var texto='';
        selec.find('option').remove();//limpiar
        for(var i=0; i<contador; i++){
          valor=lista.eq(i).val();
          texto=lista.eq(i).text();
          if(valor==id){selec.append('<option value='+valor+'>'+texto+'</option>');}
        }

     });
});
