<?php echo carga_script_js(pathinfo(__FILE__, PATHINFO_FILENAME)); ?>
<main role="main" >
    <div class="row">
        <div class="col-9 text-left p-2 mt-2">
          <h3 class="font-italic text-dark">
            <?php echo icono_mod_ordenes();?>
            suministro a sucursales</h3>
        </div>
        <div class="col-1 text-center p-1 mt-1">
          <a class="btn btn-outline-dark" href="<?php echo site_url($this->router->fetch_class().'/exportar'); ?>" role="button" target="_blank">
            <?php echo icono_excel();?>
          </a>
        </div>
        <div class="col-2 text-center p-1 mt-1">
          <!-- Button to Open the Modal Nuevo suministroSucursal-->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoSuministroSucursal">
            <?php echo icono_nuevo(); ?>
          </button>
        </div>
      </div>
  <!-- Mensajes-->
  <?php
  if(count($this->session->tempdata()))
  {
  ?>
      <div class="alert <?php echo $this->session->tempdata('alert'); ?>" role="alert">
        <strong>
          <?php echo $this->session->tempdata('icono'); ?>
        </strong>
        <?php echo $this->session->tempdata('mensaje'); ?>
      </div>
<?php
  }
?>
  <!-- Fin mensajes -->
  <table class="table table-hover ">
    <thead>
      <tr class="text-center table-secondary">
        <!-- <th>#</th> -->
        <th>Id</th>


        <th style="display:none">Id Sucursal</th>
        <th>Sucursal</th>
        <th>Numero de orden</th>
        <th style="display:none">Orden</th>
        <th style="display:none">Id Materia prima</th>
        <th>Materia prima</th>
        <th>Cantidad Suministrada</th>
        <th style="display:none">Id Almacen Gral.</th>
        <th style="display:none">Id Proveedor</th>
        <th>Proveedor</th>
        <th style="display:none">Stock</th>
        <th>Stock</th>
        <th style="display:none" >Mat. Prima Total</th>
        <th colspan="2"><?php echo accionAE();?></th>
      </tr>
    </thead>
    <tbody>
    <?php for($i=0; $i<count($suministroSucursal); $i++) {?>
      <tr class="text-center" id="fila_<?php echo $i+1;?>">
        <!-- <th scope="row"><?php echo $i+1;?></th> -->
        <td><?php echo $suministroSucursal[$i]->id; ?></td>
        <td style="display:none" style="display:nones"><?php echo $suministroSucursal[$i]->id_sucursal; ?></td>
        <td style="display:nones"><?php echo $suministroSucursal[$i]->sucursal; ?></td>
        <td><?php echo $suministroSucursal[$i]->id_orden; ?></td>
        <td style="display:none" class="text-left"><?php echo $suministroSucursal[$i]->orden; ?></td>
        <td style="display:none"><?php echo $suministroSucursal[$i]->id_matprima; ?></td>
        <td class="text-left"><?php echo $suministroSucursal[$i]->materiaPrima; ?></td>
        <td class="text-center"><?php echo $suministroSucursal[$i]->cantidad; ?></td>
        <td style="display:none" class="text-center"><?php echo $suministroSucursal[$i]->id_almacen_gral; ?></td>
        <td style="display:none" class="text-center"><?php echo $suministroSucursal[$i]->id_proveedor; ?></td>
        <td class="text-center"><?php echo $suministroSucursal[$i]->proveedor; ?></td>
        <td style="display:none" class="text-center"><?php echo $suministroSucursal[$i]->stock; ?></td>
        <td class="text-center"><?php echo icono_tiene_matprima($suministroSucursal[$i]->stock); ?></td>
        <td style="display:none" class="text-center"><?php echo $suministroSucursal[$i]->totalProducto; ?></td>
        <td class="text-right">
          <button type="button" class="btn btn-outline-dark center-block btnActSuministroSucursal"  data-toggle="modal" data-target="#actualizarSuministroSucursal">
            <?php echo icono_actualizar();?>
          </button>
        </td>
        <td class="text-left">
          <button type="button" class="btn btn-outline-dark center-block btnBorrSuministroSucursal"  data-toggle="modal" data-target="#borrarSuministroSucursal">
            <?php echo icono_borrar();?>
          </button>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  <?php echo $this->pagination->create_links(); ?>
<!-- The Modal Nuevo SuministroSucursal -->
<div class="modal fade" id="nuevoSuministroSucursal">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('SuministroSucursal/nuevo'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">
          <?php echo icono_titulo_nuevo();?>
          Registro de suministro a sucursal:
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="container">
          <div class="form-group row">
            <label for="materiaPrima_n" class="col-2 col-form-label">Orden: </label>
            <div class="col-10">
              <select class="custom-select" id="orden_n" name="orden_n" required>
                <option value="" selected disabled>Selecciona una orden</option>
                <?php for($i=count($orden)-1; $i>=0; $i--) { ?>
                  <option value="<?php echo $orden[$i]->id; ?>"><?php echo $orden[$i]->id.' : '.$orden[$i]->nota.' ('.nice_date($orden[$i]->fecha_ejec, 'd-m-Y').')'; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
            <div class="form-group row">
              <label for="materiaPrima_n" class="col-2 col-form-label">Materia: </label>
              <div class="col-10">
                <select class="custom-select" id="materiaPrima_n" name="materiaPrima_n" required>
                  <option value="" selected disabled>Selecciona la materia prima</option>
                  <?php for($i=0; $i<count($entradaAlmacen); $i++) {
                      if($entradaAlmacen[$i]->cantidad>0){?>
                        <option value="<?php echo $entradaAlmacen[$i]->id; ?>" rel="<?php echo $entradaAlmacen[$i]->stock; ?>">
                            <?php echo $entradaAlmacen[$i]->id.': '.$entradaAlmacen[$i]->materiaPrima.' '.
                            $entradaAlmacen[$i]->id_proveedor.': '.$entradaAlmacen[$i]->proveedor.' '.
                            '(Stock: '.$entradaAlmacen[$i]->stock.')'; ?>
                      </option>
                  <?php }
                      } ?>
                </select>
                <small  class="text-muted">
                  Materia prima / Proveedor / (Stock).
                </small>
              </div>
            </div>

            <div class="form-group row">
              <label for="cantidad_n" class="col-2 col-form-label">Cantidad: </label>
              <div class="col-10">
                <input class="form-control" type="number" placeholder="000.00" min="0" step=".01" max="999" id="cantidad_n" name="cantidad_n" required disabled>
                <small  class="text-muted">
                  La cantidad debe ser en Kilogramos (Kg.).
                </small>
              </div>
            </div>
        </div>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-info">
          <?php echo icono_guardar(); ?>
          Guardar
        </button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- End modal Nuevo suministroSucursal -->

<!-- The Modal Actualizar suministroSucursal -->
<div class="modal fade" id="actualizarSuministroSucursal">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('SuministroSucursal/actualizar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-success">
        <h4 class="modal-title">
          <?php echo icono_titulo_actualizar();?>
          Actualizar suministro a sucursal:
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <div class="container">
          <div class="form-group row">
            <label for="id_a" class="col-2 col-form-label">Id: </label>
            <div class="col-10">
              <input class="form-control" type="text" id="id_a" name="id_a" readonly>
            </div>
          </div>
            <div class="form-group row">
              <label for="id_orden_a" class="col-2 col-form-label">Orden: </label>
              <div class="col-10">
                <input class="form-control" type="text" id="id_orden_a" name="id_orden_a" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="proveedor_a" class="col-2 col-form-label">Proveedor: </label>
              <div class="col-10">
                <input class="form-control" type="text" id="proveedor_a" name="proveedor_a" readonly>
              </div>
            </div>
            <fieldset disabled>
              <div class="form-group row">
                <label for="materiaPrima_a" class="col-2 col-form-label">Materia: </label>
                <div class="col-10">
                  <select class="custom-select" id="materiaPrima_a" name="materiaPrima_a">
                  </select>
                </div>
              </div>
            </fieldset>
            <div class="form-group row">
              <label for="cantidad_a" class="col-2 col-form-label">Cantidad: </label>
              <div class="col-10">
                <fieldset class="enuso">
                  <input class="form-control" type="number" placeholder="000.00" min="0" step=".01" max="999" id="cantidad_a" name="cantidad_a" required>
                </fieldset>
                <small  class="text-muted">
                  La cantidad debe ser en Kilogramos (Kg.).
                </small>
              </div>
            </div>
            <input type="hidden" value="<?php echo $pagina; ?>" id="pagina_a" name="pagina_a">
        </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <fieldset class="enuso">
          <button type="submit" class="btn btn-success">
            <?php echo icono_guardar(); ?>
            Guardar
          </button>
        <fieldset>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- End modal Actualizar suministroSucursal -->

<!-- The Modal Borrar suministroSucursal -->
<div class="modal fade" id="borrarSuministroSucursal">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('SuministroSucursal/borrar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-danger">
        <h4 class="modal-title">
          <?php echo icono_titulo_borrar();?>
          Borrar entrada de almacén:
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <div class="alert alert-danger" role="alert">
          <strong>Atención!</strong> Se va a borrar el siguiente registro.
        </div>
          <div class="container">
            <div class="form-group row">
              <label for="id_b" class="col-2 col-form-label">Id: </label>
              <div class="col-10">
                <input class="form-control" type="text" id="id_b" name="id_b" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="id_orden_b" class="col-2 col-form-label">Orden: </label>
              <div class="col-10">
                <input class="form-control" type="text" id="id_orden_b" name="id_orden_b" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="proveedor_b" class="col-2 col-form-label">Proveedor: </label>
              <div class="col-10">
                <input class="form-control" type="text" id="proveedor_b" name="proveedor_b" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="materiaPrima_b" class="col-2 col-form-label">Materia: </label>
              <div class="col-10">
                <input class="form-control" type="text" id="materiaPrima_b" name="materiaPrima_b" readonly>
              </div>
            </div>
              <div class="form-group row">
                <label for="cantidad_n" class="col-2 col-form-label">Cantidad:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="cantidad_b" name="cantidad_b" maxlength="80" placeholder="cantidad" readonly>
                </div>
              </div>
              <input type="hidden" value="<?php echo $pagina; ?>" id="pagina_b" name="pagina_b">
          </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">
          <?php echo icono_guardar(); ?>
          Borrar
        </button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- End modal Borrar suministroSucursal -->
</main>
