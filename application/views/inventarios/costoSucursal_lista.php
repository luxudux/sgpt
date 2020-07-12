<?php echo carga_script_js(pathinfo(__FILE__, PATHINFO_FILENAME)); ?>
<main role="main" >
    <div class="row">
        <div class="col-9 text-left p-2 mt-2">
          <h3 class="font-italic text-dark">
            <?php echo icono_mod_inventarios();?>
            costos por sucursal</h3>
        </div>
        <div class="col-1 text-center p-1 mt-1">
          <a class="btn btn-outline-dark" href="<?php echo site_url($this->router->fetch_class().'/exportar'); ?>" role="button" target="_blank">
            <?php echo icono_excel();?>
          </a>
        </div>
        <div class="col-2 text-center p-1 mt-1">
          <!-- Button to Open the Modal Nuevo costoSucursal-->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoCostoSucursal">
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
        <th>#</th>
        <th>Id</th>
        <th style="display:none">Id Sucursal</th>
        <th>Sucursal</th>
        <th style="display:none">Id Producto</th>
        <th>Producto</th>
        <th>Monto ($)</th>
        <th>Fecha registro</th>
        <th style="display:none">Uso</th>
        <th>Uso</th>
        <th style="display:none">Activo</th>
        <th>Activo</th>
        <th colspan="3"><?php echo accionAER();?></th>
      </tr>
    </thead>
    <tbody>
    <?php for($i=0; $i<count($costoSucursal); $i++) {?>
      <tr class="text-center" id="fila_<?php echo $i+1;?>">
        <th scope="row"><?php echo $i+1;?></th>
        <td><?php echo $costoSucursal[$i]->id; ?></td>
        <td style="display:none"><?php echo $costoSucursal[$i]->id_sucursal; ?></td>
        <td class="text-left"><?php echo $costoSucursal[$i]->sucursal; ?></td>
        <td style="display:none"><?php echo $costoSucursal[$i]->id_producto; ?></td>
        <td class="text-left"><?php echo $costoSucursal[$i]->producto; ?></td>
        <td class="text-right"><?php echo $costoSucursal[$i]->monto; ?></td>
        <td ><?php echo nice_date($costoSucursal[$i]->fecha_reg, 'd-m-Y'); ?></td>
        <td style="display:none" class="text-center"><?php echo $costoSucursal[$i]->uso; ?></td>
        <td class="text-center"><?php echo icono_reg_uso($costoSucursal[$i]->uso); ?></td>
        <td style="display:none" class="text-center"><?php echo $costoSucursal[$i]->activo; ?></td>
        <td class="text-center"><?php echo icono_activo($costoSucursal[$i]->activo); ?></td>
        <td class="text-right">
          <button type="button" class="btn btn-outline-dark center-block btnActCostoSucursal"  data-toggle="modal" data-target="#actualizarCostoSucursal">
            <?php echo icono_actualizar();?>
          </button>
        </td>
        <td class="text-center">
          <button type="button" class="btn btn-outline-dark center-block btnBorrCostoSucursal"  data-toggle="modal" data-target="#borrarCostoSucursal">
            <?php echo icono_borrar();?>
          </button>
        </td>
        <td class="text-left">
          <a class="btn btn-outline-dark" href="<?php echo site_url($this->router->fetch_class().'/excel/'.$costoSucursal[$i]->id_sucursal); ?>"
             role="button" target="_blank">
             <?php echo icono_excel_reg();?>
          </a>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
<?php echo $this->pagination->create_links(); ?>
<!-- The Modal Nuevo CostoSucursal -->
<div class="modal fade" id="nuevoCostoSucursal">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('CostoSucursal/nuevo'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">
          <?php echo icono_titulo_nuevo();?>
          Registro de nuevo costo por sucursal:
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="container">

            <div class="form-group row">
              <label for="sucursal_n" class="col-2 col-form-label">Sucursal:</label>
              <div class="col-10">
                <select class="custom-select" id="sucursal_n" name="sucursal_n" required>
                  <option value="" selected disabled>Selecciona una sucursal</option>
                  <?php for($i=0; $i<count($sucursal); $i++) { ?>
                    <option value="<?php echo $sucursal[$i]->id; ?>"><?php echo $sucursal[$i]->id.' : '.$sucursal[$i]->nombre; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="sucursal_n" class="col-2 col-form-label">Producto:</label>
              <div class="col-10">
                <select class="custom-select" id="producto_n" name="producto_n" required>
                  <option value="" selected disabled>Selecciona un producto</option>
                  <?php for($i=0; $i<count($producto); $i++) { ?>
                    <option value="<?php echo $producto[$i]->id; ?>"><?php echo $producto[$i]->id.' : '.$producto[$i]->nombre; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="monto_n" class="col-2 col-form-label">Monto: </label>
              <div class="col-10">
                <input class="form-control" type="number" placeholder="000.00" min="0" step=".01" max="999" id="monto_n" name="monto_n" required>
                <small  class="text-muted">
                  El monto debe ser en pesos mexicanos (MXN.).
                </small>
              </div>
            </div>
            <div class="form-group row">
              <label for="fecha_n" class="col-2 col-form-label">Fecha: </label>
              <div class="col-10">
                <input class="form-control" type="date" value="<?php echo mdate('%Y-%m-%d', time());?>" id="fecha_n" name="fecha_n" placeholder="" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="activo_n" class="col-2 col-form-label">Activo: </label>
              <div class="col-10">
                <select class="custom-select" id="activo_n" name="activo_n" required>
                        <option value="1" selected>Registro activo</option>
                        <option value="0">Registro no activo</option>
                </select>
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
<!-- End modal Nuevo costoSucursal -->

<!-- The Modal Actualizar costoSucursal -->
<div class="modal fade" id="actualizarCostoSucursal">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('CostoSucursal/actualizar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-success">
        <h4 class="modal-title">
          <?php echo icono_titulo_actualizar();?>
          Actualizar datos de costo por sucursal
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
              <label for="sucursal_a" class="col-2 col-form-label">Sucursal:</label>
              <div class="col-10">
                <select class="custom-select" id="sucursal_a" name="sucursal_a" required>
                  <option value="" selected disabled>Selecciona una sucursal</option>
                  <?php for($i=0; $i<count($sucursal); $i++) { ?>
                    <option value="<?php echo $sucursal[$i]->id; ?>"><?php echo $sucursal[$i]->id.' : '.$sucursal[$i]->nombre; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="sucursal_a" class="col-2 col-form-label">Producto:</label>
              <div class="col-10">
                <select class="custom-select" id="producto_a" name="producto_a" required>
                  <option value="" selected disabled>Selecciona un producto</option>
                  <?php for($i=0; $i<count($producto); $i++) { ?>
                    <option value="<?php echo $producto[$i]->id; ?>"><?php echo $producto[$i]->id.' : '.$producto[$i]->nombre; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="monto_a" class="col-2 col-form-label">Monto: </label>
              <div class="col-10">
                <input class="form-control" type="number" placeholder="000.00" min="0" step=".01" max="999" id="monto_a" name="monto_a" required>
                <small  class="text-muted">
                  El monto debe ser en pesos mexicanos (MXN.).
                </small>
              </div>
            </div>
            <div class="form-group row">
              <label for="fecha_a" class="col-2 col-form-label">Fecha: </label>
              <div class="col-10">
                <input class="form-control" type="date" value="" id="fecha_a" name="fecha_a" placeholder="" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="activo_a" class="col-2 col-form-label">Activo: </label>
              <div class="col-10">
                <select class="custom-select" id="activo_a" name="activo_a" required>
                        <option value="1">Registro activo</option>
                        <option value="0">Registro no activo</option>
                </select>
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
<!-- End modal Actualizar costoSucursal -->

<!-- The Modal Borrar costoSucursal -->
<div class="modal fade" id="borrarCostoSucursal">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('CostoSucursal/borrar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-danger">
        <h4 class="modal-title">
          <?php echo icono_titulo_borrar();?>
          Borrar costo de sucursal
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
                <label for="id_a" class="col-2 col-form-label">ID: </label>
                <div class="col-10">
                  <input class="form-control" type="text" id="id_b" name="id_b" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="sucursal_b" class="col-2 col-form-label">Sucursal:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="sucursal_b" name="sucursal_b" maxlength="80" placeholder="Nombre del sucursal" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="producto_b" class="col-2 col-form-label">Producto:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="producto_b" name="producto_b" maxlength="80" placeholder="Nombre del producto" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="monto_n" class="col-2 col-form-label">Monto:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="monto_b" name="monto_b" maxlength="80" placeholder="monto" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="fecha_b" class="col-2 col-form-label">Fecha: </label>
                <div class="col-10">
                  <input class="form-control" type="date" value="" id="fecha_b" name="fecha_b" placeholder="" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="activo_b" class="col-2 col-form-label">Activo:</label>
                <div class="col-10">
                <fieldset disabled>
                  <select class="custom-select" id="activo_b" name="activo_b">
                          <option value="1" disabled>Registro activo</option>
                          <option value="0" disabled>Registro no activo</option>
                  </select>
                </fieldset>
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
<!-- End modal Borrar costoSucursal -->
</main>
