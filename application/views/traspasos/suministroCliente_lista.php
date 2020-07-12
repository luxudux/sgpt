<?php echo carga_script_js(pathinfo(__FILE__, PATHINFO_FILENAME)); ?>
<main role="main" >
    <div class="row">
        <div class="col-9 text-left p-2 mt-2">
          <h3 class="font-italic text-dark">
            <?php echo icono_mod_ordenes();?>
            suministro a clientes</h3>
        </div>
        <div class="col-1 text-center p-1 mt-1">
          <a class="btn btn-outline-dark" href="<?php echo site_url($this->router->fetch_class().'/exportar'); ?>" role="button" target="_blank">
            <?php echo icono_excel();?>
          </a>
        </div>
        <div class="col-2 text-center p-1 mt-1">
          <!-- Button to Open the Modal Nuevo suministroCliente-->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoSuministroCliente">
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
        <th >Id</th>
        <th>Numero de orden</th>
        <th style="display:none">Orden</th>
        <th style="display:none">Id Costo Cliente</th>
        <th style="display:none">Id Cliente</th>
        <th>Cliente</th>
        <th style="display:none">Id Producto</th>
        <th>Producto</th>
        <th style="display:none">Id Grupo</th>
        <th>Grupo</th>
        <th>Cantidad</th>
        <th title="Precio unitario por unidad">Unitario ($)</th>
        <th title="">Recaudo ($)</th>
        <th title="Empleado asignado a la repartición">Id Empleado</th>
        <th title="Empleado asignado a la repartición">Empleado</th>
        <th title="Empleado asignado a la repartición">Devolucion</th>
        <th colspan="2"><?php echo accionAE();?></th>
      </tr>
    </thead>
    <tbody>
    <?php for($i=0; $i<count($suministroCliente); $i++) {?>
      <tr class="text-center" id="fila_<?php echo $i+1;?>">
        <th style="display:none" scope="row"><?php echo $i+1;?></th>
        <td ><?php echo $suministroCliente[$i]->id; ?></td>
        <td title="<?php echo $suministroCliente[$i]->orden; ?>"><?php echo $suministroCliente[$i]->id_orden; ?></td>
        <td style="display:none" class="text-left"><?php echo $suministroCliente[$i]->orden; ?></td>
        <td style="display:none"><?php echo $suministroCliente[$i]->id_costo_cliente; ?></td>
        <td style="display:none"><?php echo $suministroCliente[$i]->id_cliente; ?></td>
        <td class="text-left"><?php echo $suministroCliente[$i]->cliente; ?></td>
        <td style="display:none"><?php echo $suministroCliente[$i]->id_producto; ?></td>
        <td class="text-left"><?php echo $suministroCliente[$i]->producto; ?></td>
        <td style="display:none"><?php echo $suministroCliente[$i]->id_grupop; ?></td>
        <td class="text-left"><?php echo $suministroCliente[$i]->grupop; ?></td>
        <td class="text-right"><?php echo $suministroCliente[$i]->cantidad; ?></td>
        <td class="text-right"><?php echo $suministroCliente[$i]->monto; ?></td>
        <td class="text-right"><?php echo number_format($suministroCliente[$i]->cantidad*$suministroCliente[$i]->monto,2); ?></td>
        <td class="text-center" title="<?php echo $suministroCliente[$i]->empleado; ?>"><?php echo $suministroCliente[$i]->id_empleado; ?></td>
        <td class="text-right"><?php echo $suministroCliente[$i]->empleado; ?></td>
        <td class="text-right"><?php echo $suministroCliente[$i]->devolucion; ?></td>
        <td class="text-right">
          <button type="button" class="btn btn-outline-dark center-block btnActSuministroCliente"  data-toggle="modal" data-target="#actualizarSuministroCliente">
            <?php echo icono_actualizar();?>
          </button>
        </td>
        <td class="text-left">
          <button type="button" class="btn btn-outline-dark center-block btnBorrSuministroCliente"  data-toggle="modal" data-target="#borrarSuministroCliente">
            <?php echo icono_borrar();?>
          </button>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  <?php echo $this->pagination->create_links(); ?>
<!-- The Modal Nuevo SuministroCliente -->
<div class="modal fade" id="nuevoSuministroCliente">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('SuministroCliente/nuevo'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">
          <?php echo icono_titulo_nuevo();?>
          Nuevo suministro a clientes:
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="container">
          <div class="form-group row">
            <label for="cliente_n" class="col-2 col-form-label">Orden: </label>
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
            <label for="costo_cliente_n" class="col-2 col-form-label">Costos:</label>
            <div class="col-10">
              <select class="custom-select" id="costo_cliente_n" name="costo_cliente_n">
                <?php for($i=0; $i<count($costoCliente); $i++) { ?>
                  <option value="<?php echo $costoCliente[$i]->id; ?>" rel="<?php echo $costoCliente[$i]->id_grupop; ?>">
                    <?php echo $costoCliente[$i]->id_cliente.' : '.$costoCliente[$i]->cliente.' : '.$costoCliente[$i]->id_producto.
                  ' : '.$costoCliente[$i]->producto.' '.$costoCliente[$i]->id_grupop.' : '.$costoCliente[$i]->grupop.' : ($'.$costoCliente[$i]->monto.')'; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
              <label for="cantidad_n" class="col-2 col-form-label">Cantidad: </label>
              <div class="col-10">
                <input class="form-control" type="number" placeholder="000.00" min="0" step=".01" max="999" id="cantidad_n" name="cantidad_n" required>
                <small  class="text-muted">
                  La cantidad suministrada debe ser en Kilogramos (Kg.).
                </small>
              </div>
          </div>
          <div class="form-group row">
            <label for="empleado_n" class="col-2 col-form-label">Empleado:</label>
            <div class="col-10">
              <select class="custom-select" id="empleado_n" name="empleado_n" required>
                <option selected disabled>Seleccione un empleado de reparticion</option>
                <?php for($i=0; $i<count($empleado); $i++) { ?>
                <option value="<?php echo $empleado[$i]->id; ?>"><?php echo $empleado[$i]->id.' : '.$empleado[$i]->nombre.' ('.$empleado[$i]->puesto.')'; ?></option>
              <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="devolucion_n" class="col-2 col-form-label">Devuelta:</label>
            <div class="col-10">
              <input class="form-control" value="0" type="number" placeholder="000.00" min="0" step=".01" max="999" id="devolucion_n" name="devolucion_n" required>
              <small  class="text-muted">
                La cantidad devuelta debe ser en Kilogramos (Kg.).
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
<!-- End modal Nuevo suministroCliente -->

<!-- The Modal Actualizar suministroCliente -->
<div class="modal fade" id="actualizarSuministroCliente">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('SuministroCliente/actualizar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-success">
        <h4 class="modal-title">
          <?php echo icono_titulo_actualizar();?>
          Actualizar suministro a clientes:
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

              <label for="costo_cliente_a" class="col-2 col-form-label">Costos:</label>
              <div class="col-10">
                <fieldset disabled>
                <select class="custom-select" id="costo_cliente_a" name="costo_cliente_a">
                  <?php for($i=0; $i<count($costoCliente); $i++) { ?>
                    <option value="<?php echo $costoCliente[$i]->id; ?>" rel="<?php echo $costoCliente[$i]->id_grupop; ?>">
                      <?php echo $costoCliente[$i]->id_cliente.' : '.$costoCliente[$i]->cliente.' : '.$costoCliente[$i]->id_producto.
                    ' : '.$costoCliente[$i]->producto.' '.$costoCliente[$i]->id_grupop.' : '.$costoCliente[$i]->grupop.' : ($'.$costoCliente[$i]->monto.')'; ?></option>
                  <?php } ?>
                </select>
              </fieldset>
              </div>

            </div>
            <div class="form-group row">
              <label for="cantidad_a" class="col-2 col-form-label">Cantidad: </label>
              <div class="col-10">
                <input class="form-control" type="number" placeholder="000.00" min="0" step=".01" max="999" id="cantidad_a" name="cantidad_a" required>
                <small  class="text-muted">
                  La cantidad suministrada debe ser en Kilogramos (Kg.).
                </small>
              </div>
            </div>
            <div class="form-group row">
              <label for="empleado_a" class="col-2 col-form-label">Empleado:</label>
              <div class="col-10">
                <select class="custom-select" id="empleado_a" name="empleado_a" required>
                  <?php for($i=0; $i<count($empleado); $i++) { ?>
                  <option value="<?php echo $empleado[$i]->id; ?>"><?php echo $empleado[$i]->id.' : '.$empleado[$i]->nombre.' ('.$empleado[$i]->puesto.')'; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="devolucion_a" class="col-2 col-form-label">Devuelta:</label>
              <div class="col-10">
                <input class="form-control" type="number" placeholder="000.00" min="0" step=".01" max="999" id="devolucion_a" name="devolucion_a">
                <small  class="text-muted">
                  La cantidad devuelta debe ser en Kilogramos (Kg.).
                </small>
              </div>
            </div>
            <input type="hidden" value="<?php echo $pagina; ?>" id="pagina_a" name="pagina_a">
        </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">
          <?php echo icono_guardar(); ?>
          Guardar
        </button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- End modal Actualizar suministroCliente -->

<!-- The Modal Borrar suministroCliente -->
<div class="modal fade" id="borrarSuministroCliente">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('SuministroCliente/borrar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-danger">
        <h4 class="modal-title">
          <?php echo icono_titulo_borrar();?>
          Borrar suministro a cliente:
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
              <label for="cliente_b" class="col-2 col-form-label">Cliente: </label>
              <div class="col-10">
                <input class="form-control" type="text" id="cliente_b" name="cliente_b" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="producto_b" class="col-2 col-form-label">Producto: </label>
              <div class="col-10">
                <input class="form-control" type="text" id="producto_b" name="producto_b" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="cantidad_n" class="col-2 col-form-label">Cantidad:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="cantidad_b" name="cantidad_b" maxlength="80" placeholder="cantidad" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="empleado_n" class="col-2 col-form-label">Empleado:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="empleado_b" name="empleado_b" maxlength="80" placeholder="empleado" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="devolucion_b" class="col-2 col-form-label">Devuelta:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="devolucion_b" name="devolucion_b"  placeholder="devolucion" readonly>
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
<!-- End modal Borrar suministroCliente -->
</main>
