<?php echo carga_script_js(pathinfo(__FILE__, PATHINFO_FILENAME)); ?>
<main role="main" >
    <div class="row">
        <div class="col-9 text-left p-2 mt-2">
          <h3 class="font-italic text-dark">
            <?php echo icono_mod_cierres();?>
            cierre de repartición</h3>
        </div>
        <div class="col-1 text-center p-1 mt-1">
          <a class="btn btn-outline-dark" href="<?php echo site_url($this->router->fetch_class().'/exportar'); ?>" role="button" target="_blank">
            <?php echo icono_excel();?>
          </a>
        </div>
        <div class="col-2 text-center p-1 mt-1">
          <!-- Button to Open the Modal Nuevo cierreReparticion-->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoCierreReparticion">
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
        <th style="display:none">Id</th>
        <th>Id Cierre</th>
        <th style="display:none">Nota Cierre</th>
        <th style="display:none">Id Sucursal</th>
        <th>Nombre Sucursal</th>

        <th style="display:none">Id Cliente</th>
        <th>Cliente</th>
        <th>Id Ruta</th>
        <th style="display:none">Ruta</th>
        <th style="display:none">Id Producto</th>
        <th>Producto</th>

        <th style="display:none">Id Empleado</th>
        <th>Repartió</th>
        <th>Cantidad (Kg.)</th>
        <th colspan="2"><?php echo accionAE();?></th>
      </tr>
    </thead>
    <tbody>
    <?php for($i=0; $i<count($cierreReparticion); $i++) {?>
      <tr class="text-center" id="fila_<?php echo $i+1;?>">
        <!-- <th scope="row"><?php echo $i+1;?></th> -->
        <td style="display:none"><?php echo $cierreReparticion[$i]->id; ?></td>
        <td><?php echo $cierreReparticion[$i]->id_cierre; ?></td>
        <td style="display:none" class="text-left"><?php echo $cierreReparticion[$i]->cierre; ?></td>
        <td style="display:none" class="text-center"><?php echo $cierreReparticion[$i]->id_sucursal; ?></td>
        <td class="text-left"><?php echo $cierreReparticion[$i]->sucursal; ?></td>

        <td style="display:none" class="text-center"><?php echo $cierreReparticion[$i]->id_cliente; ?></td>
        <td class="text-left"><?php echo $cierreReparticion[$i]->cliente; ?></td>
        <td class="text-center"><?php echo $cierreReparticion[$i]->id_ruta; ?></td>
        <td style="display:none" class="text-left"><?php echo $cierreReparticion[$i]->ruta; ?></td>


        <td style="display:none" class="text-center"><?php echo $cierreReparticion[$i]->id_producto; ?></td>
        <td class="text-left"><?php echo $cierreReparticion[$i]->producto; ?></td>



        <td style="display:none"><?php echo $cierreReparticion[$i]->id_empleado; ?></td>
        <td class="text-left"><?php echo $cierreReparticion[$i]->empleado_ejec; ?></td>
        <td class="text-right"><?php echo $cierreReparticion[$i]->cantidad; ?></td>
        <td class="text-right">
          <button type="button" class="btn btn-outline-dark center-block btnActCierreReparticion"  data-toggle="modal" data-target="#actualizarCierreReparticion">
            <?php echo icono_actualizar();?>
          </button>
        </td>
        <td class="text-left">
          <button type="button" class="btn btn-outline-dark center-block btnBorrCierreReparticion"  data-toggle="modal" data-target="#borrarCierreReparticion">
            <?php echo icono_borrar();?>
          </button>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  <?php echo $this->pagination->create_links(); ?>
<!-- The Modal Nuevo CierreReparticion -->
<div class="modal fade" id="nuevoCierreReparticion">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('CierreReparticion/nuevo'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">
          <?php echo icono_titulo_nuevo();?>
          Registro de cierre de repartición:
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
            <div class="form-group row ">
              <label for="producto_n" class="col-2 col-form-label">Producto:</label>
              <div class="col-10">
                <select class="custom-select" id="producto_n" name="producto_n">
                  <option value="" selected disabled>Selecciona un producto del catálogo</option>
                  <?php for($i=0; $i<count($producto); $i++) { ?>
                    <option value="<?php echo $producto[$i]->id; ?>" >
                      <?php echo $producto[$i]->id.' : '.$producto[$i]->nombre; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row d-none">
              <label for="costo_cliente_cat_n" class="col-2 col-form-label">Cliente:</label>
              <div class="col-10">
                <select class="custom-select" id="costo_cliente_cat_n" name="costo_cliente_cat_n">
                  <?php for($i=0; $i<count($costoCliente); $i++) { ?>
                    <option value="<?php echo $costoCliente[$i]->id; ?>" rel="<?php echo $costoCliente[$i]->id_producto; ?>">
                      <?php echo $costoCliente[$i]->id_cliente.' : '.$costoCliente[$i]->cliente.' : '.$costoCliente[$i]->id_producto.
                    ' : '.$costoCliente[$i]->producto.' : ( $ '.$costoCliente[$i]->monto.' Kg.: '.nice_date($costoCliente[$i]->fecha_reg, 'd-m-Y').' )'; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="costo_cliente_n" class="col-2 col-form-label">Cliente:</label>
              <div class="col-10">
                <select class="custom-select" id="costo_cliente_n" name="costo_cliente_n" required>
                    <option value="" selected disabled>Estos datos son dinámicos</option>
                </select>
              </div>
            </div>

            <div class="form-group row d-none">
              <label for="empleado_cat_n" class="col-2 col-form-label">Empleado:</label>
              <div class="col-10">
                <select class="custom-select" id="empleado_cat_n" name="empleado_cat_n">
                  <?php for($i=0; $i<count($empleado); $i++) { ?>
                    <option value="<?php echo $empleado[$i]->id; ?>" rel="<?php echo $empleado[$i]->id_sucursal; ?>">
                      <?php echo $empleado[$i]->id.' : '.$empleado[$i]->nombre.' ('.$empleado[$i]->sucursal.' - '.$empleado[$i]->puesto.')'; ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="empleado_n" class="col-2 col-form-label">Empleado:</label>
              <div class="col-10">
                <select class="custom-select" id="empleado_n" name="empleado_n" required>
                    <option value="" selected disabled>Estos datos son dinámicos</option>
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
<!-- End modal Nuevo cierreReparticion -->

<!-- The Modal Actualizar cierreReparticion -->
<div class="modal fade" id="actualizarCierreReparticion">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('CierreReparticion/actualizar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-success">
        <h4 class="modal-title">
          <?php echo icono_titulo_actualizar();?>
          Actualizar cierre de repartición:
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
              <label for="cliente_a" class="col-2 col-form-label">Cliente:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="cliente_a" name="cliente_a" maxlength="80" placeholder="Nombre del cliente" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="ruta_a" class="col-2 col-form-label">Ruta:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="ruta_a" name="ruta_a" maxlength="80" placeholder="Nombre de la ruta" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="producto_a" class="col-2 col-form-label">Producto:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="producto_a" name="producto_a" maxlength="80" placeholder="Nombre del producto" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="empleado_a" class="col-2 col-form-label">Empleado:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="empleado_a" name="empleado_a" maxlength="80" placeholder="Nombre del empleado" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="cantidad_a" class="col-2 col-form-label">Cantidad:</label>
              <div class="col-10">
                <input class="form-control" type="number" placeholder="000.00" min="0" step=".01" max="9999" id="cantidad_a" name="cantidad_a" required>
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
        <button type="submit" class="btn btn-success">
          <?php echo icono_guardar(); ?>
          Guardar
        </button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- End modal Actualizar cierreReparticion -->

<!-- The Modal Borrar cierreReparticion -->
<div class="modal fade" id="borrarCierreReparticion">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('CierreReparticion/borrar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-danger">
        <h4 class="modal-title">
          <?php echo icono_titulo_borrar();?>
          Borrar cierre de repartición:
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
              <label for="cliente_b" class="col-2 col-form-label">Cliente:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="cliente_b" name="cliente_b" maxlength="80" placeholder="Nombre del cliente" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="ruta_b" class="col-2 col-form-label">Ruta:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="ruta_b" name="ruta_b" maxlength="80" placeholder="Nombre de la ruta" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="producto_b" class="col-2 col-form-label">Producto:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="producto_b" name="producto_b" maxlength="80" placeholder="Nombre del producto" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="empleado_b" class="col-2 col-form-label">Empleado:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="empleado_b" name="empleado_b" maxlength="80" placeholder="Nombre del empleado" readonly>
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
        <button type="submit" class="btn btn-danger">
          <?php echo icono_guardar(); ?>
          Borrar
        </button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- End modal Borrar cierreReparticion -->
</main>
