$(document).ready(function(){

  $("#cierre_n").on("change", function() {
    var id=$(this).val();
    var sucursal_selec=$(this).find('option:selected').attr('rel');

    var lista=$("#empleado_cat_n > option");
    var selec=$("#empleado_n");
    var contador=lista.length;
    var valor=0;
    var cad='';
    var sucursal_id=0;
    //Sucursal del cierre seleccionado

     selec.find('option').remove();//limpiar
     selec.append('<option selected disabled>Selecciona un empleado</option>');

     for(var i=0; i<contador; i++){
       valor=lista.eq(i).val();
       sucursal_id=lista.eq(i).attr('rel');
       texto=lista.eq(i).text();

       if(sucursal_selec==sucursal_id){
          selec.append('<option value='+valor+'>'+texto+'</option>');

        }
     }

  });

  $("#producto_n").on("change", function() {
    var id_selec=$(this).val();

    var lista=$("#costo_cliente_cat_n > option");
    var selec=$("#costo_cliente_n");
    var contador=lista.length;
    var valor=0;
    var cad='';
    var producto_id=0;
     selec.find('option').remove();//limpiar
     selec.append('<option selected disabled>Selecciona el cliente con el producto surtido</option>');

     for(var i=0; i<contador; i++){
       valor=lista.eq(i).val();
       producto_id=lista.eq(i).attr('rel');
       texto=lista.eq(i).text();

       if(id_selec==producto_id){
          selec.append('<option value='+valor+'>'+texto+'</option>');

        }
     }

  });

   // jQuery methods go here...
   $(".btnActCierreReparticion").on("click", function() {
     //Seleccionamos datos de la fila
     var idtr = $(this).closest('tr').attr('id');
     var id=$('#'+idtr+' td').eq(0).html();
     var id_cierre=$('#'+idtr+' td').eq(1).html();
     var cierre=$('#'+idtr+' td').eq(2).html();
     var id_sucursal=$('#'+idtr+' td').eq(3).html();
     var sucursal=$('#'+idtr+' td').eq(4).html();
     var id_cliente=$('#'+idtr+' td').eq(5).html();
     var cliente=$('#'+idtr+' td').eq(6).html();
     var id_ruta=$('#'+idtr+' td').eq(7).html();
     var ruta=$('#'+idtr+' td').eq(8).html();
     var id_producto=$('#'+idtr+' td').eq(9).html();
     var producto=$('#'+idtr+' td').eq(10).html();
     var id_empleado=$('#'+idtr+' td').eq(11).html();
     var empleado=$('#'+idtr+' td').eq(12).html();
     var cantidad=$('#'+idtr+' td').eq(13).html();


     //Ingresamos los datos al formulario de actualización
     $('#id_a').val(id);
     $('#cierre_a').val(id_cierre+' : '+cierre);
     $('#sucursal_a').val(id_sucursal+' : '+sucursal);
     $('#cliente_a').val(id_cliente+' : '+cliente);
     $('#ruta_a').val(id_ruta+' : '+ruta);
     $('#producto_a').val(id_producto+' : '+producto);
     $('#empleado_a').val(id_empleado+' : '+empleado);
     $('#cantidad_a').val(cantidad);

    });
    $(".btnBorrCierreReparticion").on("click", function() {
      //Seleccionamos datos de la fila
       var idtr = $(this).closest('tr').attr('id');
       var id=$('#'+idtr+' td').eq(0).html();
       var id_cierre=$('#'+idtr+' td').eq(1).html();
       var cierre=$('#'+idtr+' td').eq(2).html();
       var id_sucursal=$('#'+idtr+' td').eq(3).html();
       var sucursal=$('#'+idtr+' td').eq(4).html();
       var id_cliente=$('#'+idtr+' td').eq(5).html();
       var cliente=$('#'+idtr+' td').eq(6).html();
       var id_ruta=$('#'+idtr+' td').eq(7).html();
       var ruta=$('#'+idtr+' td').eq(8).html();
       var id_producto=$('#'+idtr+' td').eq(9).html();
       var producto=$('#'+idtr+' td').eq(10).html();
       var id_empleado=$('#'+idtr+' td').eq(11).html();
       var empleado=$('#'+idtr+' td').eq(12).html();
       var cantidad=$('#'+idtr+' td').eq(13).html();


       //Ingresamos los datos al formulario de actualización
       $('#id_b').val(id);
       $('#cierre_b').val(id_cierre+' : '+cierre);
       $('#sucursal_b').val(id_sucursal+' : '+sucursal);
       $('#cliente_b').val(id_cliente+' : '+cliente);
       $('#ruta_b').val(id_ruta+' : '+ruta);
       $('#producto_b').val(id_producto+' : '+producto);
       $('#empleado_b').val(id_empleado+' : '+empleado);
       $('#cantidad_b').val(cantidad+' Kg.');
     });

});
