<?php echo carga_script_js(pathinfo(__FILE__, PATHINFO_FILENAME)); ?>
<main role="main" >
    <div class="row">
        <div class="col-9 text-left p-2 mt-2">
          <h3 class="font-italic text-dark">
            <?php echo icono_mod_cierres();?>
            cierres de venta por producto</h3>
        </div>
        <div class="col-1 text-center p-1 mt-1">
          <a class="btn btn-outline-dark" href="<?php echo site_url($this->router->fetch_class().'/exportar'); ?>" role="button" target="_blank">
            <?php echo icono_excel();?>
          </a>
        </div>
        <div class="col-2 text-center p-1 mt-1">
          <!-- Button to Open the Modal Nuevo cierreVenta-->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoCierreVenta">
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
        <th style="display:none">#</th>
        <th>Id</th>
        <th>Id Cierre</th>
        <th style="display:none">Nota cierre</th>
        <th style="display:none">Id Costo Sucursal</th>
        <th style="display:none">Id Sucursal</th>
        <th>Nombre sucursal</th>
        <th>Id Producto</th>
        <th>Producto</th>
        <th>Cantidad (Kg.)</th>
        <th style="display:none">Bloqueado</th>
        <th>Bloqueado</th>
        <th colspan="2"><?php echo accionAE();?></th>
      </tr>
    </thead>
    <tbody>
    <?php for($i=0; $i<count($cierreVenta); $i++) {?>
      <tr class="text-center" id="fila_<?php echo $i+1;?>">
        <th scope="row"style="display:none"><?php echo $i+1;?></th>
        <td><?php echo $cierreVenta[$i]->id; ?></td>
        <td><?php echo $cierreVenta[$i]->id_cierre; ?></td>
        <td style="display:none" class="text-left"><?php echo $cierreVenta[$i]->cierre; ?></td>
        <td style="display:none"><?php echo $cierreVenta[$i]->id_cost_suc; ?></td>
        <td style="display:none"><?php echo $cierreVenta[$i]->id_sucursal; ?></td>
        <td ><?php echo $cierreVenta[$i]->sucursal; ?></td>
        <td class="text-center"><?php echo $cierreVenta[$i]->id_producto; ?></td>
        <td class="text-left"><?php echo $cierreVenta[$i]->producto; ?></td>
        <td class="text-right"><?php echo $cierreVenta[$i]->cantidad; ?></td>
        <td style="display:none"  class="text-center"><?php echo $cierreVenta[$i]->bloqueado; ?></td>
        <td class="text-center"><?php echo icono_reg_bloqueado($cierreVenta[$i]->bloqueado); ?></td>
        <td class="text-right">
          <button type="button" class="btn btn-outline-dark center-block btnActCierreVenta"  data-toggle="modal" data-target="#actualizarCierreVenta">
            <?php echo icono_actualizar();?>
          </button>
        </td>
        <td class="text-left">
          <button type="button" class="btn btn-outline-dark center-block btnBorrCierreVenta"  data-toggle="modal" data-target="#borrarCierreVenta">
            <?php echo icono_borrar();?>
          </button>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  <?php echo $this->pagination->create_links(); ?>
<!-- The Modal Nuevo CierreVenta -->
<div class="modal fade" id="nuevoCierreVenta">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('CierreVenta/nuevo'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">
          <?php echo icono_titulo_nuevo();?>
          Registro de cierre de venta:
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="container">

            <div class="form-group row">
              <label for="cierre_n" class="col-2 col-form-label">Cierre:</label>
              <div class="col-10">
                <select class="custom-select" id="cierre_n" name="cierre_n" required>
                  <option value="" selected disabled>Selecciona un cierre</option>
                  <?php for($i=0; $i<count($cierre); $i++) { ?>
                    <option value="<?php echo $cierre[$i]->id; ?>" rel="<?php echo $cierre[$i]->id_sucursal; ?>"><?php echo $cierre[$i]->id.' : ( '.$cierre[$i]->sucursal.' : '.nice_date($cierre[$i]->fecha_reg, 'd-m-Y').' )'; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row d-none">
              <label for="costo_suc_cat_n" class="col-2 col-form-label">Costo sucursal:</label>
              <div class="col-10">
                <select class="custom-select" id="costo_suc_cat_n" name="costo_suc_cat_n">
                  <?php for($i=0; $i<count($costoSucursal); $i++) { ?>
                    <option value="<?php echo $costoSucursal[$i]->id; ?>" rel="<?php echo $costoSucursal[$i]->id_sucursal; ?>"><?php echo $costoSucursal[$i]->id_producto.
                    ' : '.$costoSucursal[$i]->producto.' : ( $ '.$costoSucursal[$i]->monto.' MXN.: '.nice_date($costoSucursal[$i]->fecha_reg, 'd-m-Y').' )'; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="costo_suc_n" class="col-2 col-form-label">Producto:</label>
              <div class="col-10">
                <select class="custom-select" id="costo_suc_n" name="costo_suc_n" required>
                  <option selected disabled>Estos datos son dinámicos</option>

                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="cantidad_n" class="col-2 col-form-label">Cantidad: </label>
              <div class="col-10">
                <input class="form-control" type="number" placeholder="000.00" min="0" step=".01" max="999" id="cantidad_n" name="cantidad_n" required>
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
<!-- End modal Nuevo cierreVenta -->

<!-- The Modal Actualizar cierreVenta -->
<div class="modal fade" id="actualizarCierreVenta">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('CierreVenta/actualizar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-success">
        <h4 class="modal-title">
          <?php echo icono_titulo_actualizar();?>
          Actualizar cierre de venta:
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <div class="container">
            <div class="form-group row">
              <label for="id_a" class="col-2 col-form-label">ID: </label>
              <div class="col-10">
                <input class="form-control" type="text" id="id_a" name="id_a" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="cierre_a" class="col-2 col-form-label">Cierre:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="cierre_a" name="cierre_a" maxlength="80" placeholder="Nombre del cierre" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="sucursal_a" class="col-2 col-form-label">Sucursal:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="sucursal_a" name="sucursal_a" maxlength="80" placeholder="Nombre de sucursal" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="producto_a" class="col-2 col-form-label">Producto:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="producto_a" name="producto_a" maxlength="80" placeholder="Nombre del producto" readonly>
              </div>
            </div>
            <fieldset class='enuso'>
              <div class="form-group row">
                <label for="cantidad_a" class="col-2 col-form-label">Cantidad:</label>
                <div class="col-10">
                  <input class="form-control" type="number" placeholder="000.00" min="0" step=".01" max="999" id="cantidad_a" name="cantidad_a" required>
                  <small  class="text-muted">
                    La cantidad debe ser en Kilogramos (Kg.).
                  </small>
                </div>
              </div>
            </fieldset>
            <input type="hidden" value="<?php echo $pagina; ?>" id="pagina_a" name="pagina_a">
        </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <fieldset class='enuso'>
          <button type="submit" class="btn btn-success">
            <?php echo icono_guardar(); ?>
            Guardar
          </button>
        </fieldset>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- End modal Actualizar cierreVenta -->

<!-- The Modal Borrar cierreVenta -->
<div class="modal fade" id="borrarCierreVenta">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('CierreVenta/borrar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-danger">
        <h4 class="modal-title">
          <?php echo icono_titulo_borrar();?>
          Borrar cierre de venta:
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
                <label for="id_b" class="col-2 col-form-label">ID: </label>
                <div class="col-10">
                  <input class="form-control" type="text" id="id_b" name="id_b" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="cierre_b" class="col-2 col-form-label">Cierre:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="cierre_b" name="cierre_b" maxlength="80" placeholder="Nombre del cierre" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="sucursal_b" class="col-2 col-form-label">Sucursal:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="sucursal_b" name="sucursal_b" maxlength="80" placeholder="Nombre de sucursal" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="producto_b" class="col-2 col-form-label">Producto:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="producto_b" name="producto_b" maxlength="80" placeholder="Nombre del producto" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="cantidad_b" class="col-2 col-form-label">Cantidad:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="cantidad_b" name="cantidad_b" maxlength="80" placeholder="Cantidad" readonly>
                </div>
              </div>
              <input type="hidden" value="<?php echo $pagina; ?>" id="pagina_b" name="pagina_b">
          </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <fieldset class='enuso'>
          <button type="submit" class="btn btn-danger">
            <?php echo icono_guardar(); ?>
            Borrar
          </button>
        </fieldset>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- End modal Borrar cierreVenta -->
</main>
