<?php echo carga_script_js(pathinfo(__FILE__, PATHINFO_FILENAME)); ?>
<main role="main" >
    <div class="row">
        <div class="col-9 text-left p-2 mt-2">
          <h3 class="font-italic text-dark">
            <?php echo icono_mod_cierres();?>
            cierres</h3>
        </div>
        <div class="col-1 text-center p-1 mt-1">
          <a class="btn btn-outline-dark" href="<?php echo site_url($this->router->fetch_class().'/exportar'); ?>" role="button" target="_blank">
            <?php echo icono_excel();?>
          </a>
        </div>
        <div class="col-2 text-center p-1 mt-1">
          <!-- Button to Open the Modal Nuevo cierre-->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoClien">
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
        <th>No.</th>
        <th style="display:none">Id_Sucursal</th>
        <th>Sucursal</th>
        <th style="display:none">Nota</th>
        <th>Fecha del Cierre</th>
        <th style="display:none">Ventas (#)</th>
        <th style="display:none">Reparto (#)</th>
        <th>Mermas (#)</th>
        <th style="display:none">Devolución (#)</th>
        <th>Gasto ($)</th>
        <th>Venta ($)</th>
        <th>Reparto ($)</th>
        <th title="Gasto-(Venta+Reparto)">Utilidad ($)</th>
        <th style="display:none">Uso Cierres</th>
        <th title="Numero de cierres">Uso Cierres</th>
        <th style="display:none">Uso Ordenes</th>
        <th title="Numero de órdenes">Uso Ordenes</th>
        <th style="display:none">Bloqueado</th>
        <th>Bloqueado</th>
        <th colspan="3"><?php echo accionAER(); ?></th>
      </tr>
    </thead>
    <tbody>
    <?php for($i=0; $i<count($cierre); $i++) {?>
      <tr class="text-center" id="fila_<?php echo $i+1;?>">
        <th style="display:none" scope="row"><?php echo $i+1;?></th>
        <td class="text-center"><?php echo $cierre[$i]->id; ?></td>
        <td style="display:none" class="text-center"><?php echo $cierre[$i]->id_sucursal; ?></td>
        <td class="text-left"><?php echo $cierre[$i]->sucursal; ?></td>
        <td style="display:none" class="text-right"><?php echo $cierre[$i]->nota; ?></td>
        <td><?php echo nice_date($cierre[$i]->fecha_reg, 'd-m-Y'); ?></td>
        <td style="display:none" class="text-center"><?php echo $cierre[$i]->cant_vta; ?></td>
        <td style="display:none" class="text-center"><?php echo $cierre[$i]->cant_rep; ?></td>
        <td class="text-center"><?php echo $cierre[$i]->cant_merm; ?></td>
        <td style="display:none" class="text-center"><?php echo $cierre[$i]->cant_dev; ?></td>
        <td class="text-right"><?php echo number_format($cierre[$i]->gasto,2); ?></td>
        <td class="text-right"><?php echo number_format($cierre[$i]->mto_vta,2); ?></td>
        <td class="text-right"><?php echo number_format($cierre[$i]->mto_rep,2); ?></td>
        <td class="text-right"><?php echo number_format(($cierre[$i]->mto_vta+$cierre[$i]->mto_rep)-$cierre[$i]->gasto,2); ?></td>


        <td style="display:none"><?php echo $cierre[$i]->uso; ?></td>
        <td class="text-center"><?php echo icono_reg_uso($cierre[$i]->uso); ?></td>
        <td style="display:none"><?php echo $cierre[$i]->ouso; ?></td>
        <td class="text-center"><?php echo icono_reg_uso($cierre[$i]->ouso); ?></td>
        <td style="display:none"  class="text-center"><?php echo $cierre[$i]->bloqueado; ?></td>
        <td class="text-center"><?php echo icono_reg_bloqueado($cierre[$i]->bloqueado); ?></td>

        <td>
          <button type="button" class="btn btn-outline-dark center-block btnActCierre"  data-toggle="modal" data-target="#actualizarClien">
            <?php echo icono_actualizar();?>
          </button>
        </td>
        <td>
          <button type="button" class="btn btn-outline-dark center-block btnBorrCierre"  data-toggle="modal" data-target="#borrarClien">
            <?php echo icono_borrar();?>
          </button>
        </td>
        <td>
          <a class="btn btn-outline-dark" href="<?php echo site_url($this->router->fetch_class().'/excel/'.$cierre[$i]->id); ?>" role="button"
              target="_blank">
            <?php echo icono_excel_reg();?>
          </a>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  <?php echo $this->pagination->create_links(); ?>
<!-- The Modal Nuevo Cierre -->
<div class="modal fade" id="nuevoClien">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Cierre/nuevo'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">
          <?php echo icono_titulo_nuevo();?>
          Registro de un nuevo cierre:
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="container">
          <div class="form-group row">
            <label for="sucursal_n" class="col-2 col-form-label">Sucursal: </label>
            <div class="col-10">
              <select class="custom-select" id="sucursal_n" name="sucursal_n" required>
                <option selected disabled>Seleccione una sucursal</option>
                <?php for($i=0; $i<count($sucursal); $i++) { ?>
                  <option value="<?php echo $sucursal[$i]->id; ?>"><?php echo $sucursal[$i]->id.' : '.$sucursal[$i]->nombre; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

            <div class="form-group row">
              <label for="nota_n" class="col-2 col-form-label">Nota: </label>
              <div class="col-10">
                <input class="form-control" type="text" id="nota_n" name="nota_n" maxlength="80" placeholder="Nota de la cierre" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="fecha_reg_n" class="col-2 col-form-label">Fecha: </label>
              <div class="col-10">
                <input class="form-control" type="date" value="<?php echo mdate('%Y-%m-%d', time());?>" id="fecha_reg_n" name="fecha_reg_n" placeholder="" required>
              </div>
            </div>

            <div class="form-group row d-none">
              <label for="ordensin_n" class="col-2 col-form-label">Ordenes sin cierres: </label>
              <div class="col-10">
                <select class="form-control" id="ordensin_n" name="ordensin_n">
                  <?php for($i=0; $i<count($sincierre); $i++) { ?>
                  <option value="<?php echo $sincierre[$i]->id; ?>" rel="<?php echo $sincierre[$i]->id_sucursal; ?>"><?php echo $sincierre[$i]->id.' : '.$sincierre[$i]->nota; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="orden_n" class="col-2 col-form-label">Ordenes: </label>
              <div class="col-10">
                <select multiple class="form-control orden_n" id="orden_n[]" name="orden_n[]" required>

                </select>
                <small  class="text-muted">
                  Puede seleccionar varias ordenes para el cierre con Crl. + el cursor. * Sin ordenes no se puede generar el cierre.
                </small>
              </div>
            </div>
            <div class="form-group row">
              <label for="bloqueado_n" class="col-2 col-form-label">Estatus: </label>
              <div class="col-10">
                <select class="custom-select" id="bloqueado_n" name="bloqueado_n" required>
                        <option value="1">Registro bloqueado</option>
                        <option value="0" selected>Registro no bloqueado</option>
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
<!-- End modal Nuevo cierre -->

<!-- The Modal Actualizar cierre -->
<div class="modal fade" id="actualizarClien">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Cierre/actualizar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-success">
        <h4 class="modal-title">
          <?php echo icono_titulo_actualizar();?>
          Actualizar datos del cierre
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
          <fieldset disabled>
            <div class="form-group row">
              <label for="sucursal_a" class="col-2 col-form-label">Sucursal: </label>
              <div class="col-10">
                <select class="custom-select" id="sucursal_a" name="sucursal_a">
                  <?php for($i=0; $i<count($sucursal); $i++) { ?>
                    <option value="<?php echo $sucursal[$i]->id; ?>"><?php echo $sucursal[$i]->id.' : '.$sucursal[$i]->nombre; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </fieldset>
              <div class="form-group row">

                <label for="nota_a" class="col-2 col-form-label">Nota: </label>
                <div class="col-10">
                    <input class="form-control" type="text" id="nota_a" name="nota_a" maxlength="80" placeholder="Nota de la cierre" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="fecha_reg_a" class="col-2 col-form-label">Fecha: </label>
                <div class="col-10">
                    <input class="form-control" type="date" value="<?php echo mdate('%Y-%m-%d', time());?>" id="fecha_reg_a" name="fecha_reg_a" placeholder="" required>
                </div>
              </div>
              <div class="form-group row d-none">
                <label for="orden_a" class="col-2 col-form-label">Ordenes con cierres: </label>
                <div class="col-10">
                  <select class="form-control" id="orden_a" name="orden_a" required>
                    <?php for($i=0; $i<count($concierre); $i++) { ?>
                    <!-- <option value="<?php echo $concierre[$i]->id_cierre; ?>"><?php echo $concierre[$i]->id_cierre.' : '.$concierre[$i]->id_sucursal.' : '.$concierre[$i]->nota; ?></option> -->
                    <option value="<?php echo $concierre[$i]->id_cierre; ?>"><?php echo $concierre[$i]->id_sucursal.' : '.$concierre[$i]->nota; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <fieldset disabled>
              <div class="form-group row">
                <label for="ordensel_a" class="col-2 col-form-label">Ordenes: </label>
                <div class="col-10">
                  <select multiple class="form-control" id="ordensel_a" name="ordensel_a">
                  </select>
                  <small  class="text-muted">
                    Ordenes integradas a la lista de cierre.
                  </small>
                </div>
              </div>
              </fieldset>
              <div class="form-group row">
                <label for="bloqueado_a" class="col-2 col-form-label">Estatus: </label>
                <div class="col-10">
                  <select class="custom-select" id="bloqueado_a" name="bloqueado_a" required>
                          <option value="1">Registro bloqueado</option>
                          <option value="0">Registro no bloqueado</option>
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
<!-- End modal Actualizar cierre -->

<!-- The Modal Borrar cierre -->
<div class="modal fade" id="borrarClien">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Cierre/borrar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-danger">
        <h4 class="modal-title">
          <?php echo icono_titulo_borrar();?>
          Borrar cierre
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
                <label for="sucursal_b" class="col-2 col-form-label">Sucursal:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="sucursal_b" name="sucursal_b" maxlength="80" placeholder="" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="nota_b" class="col-2 col-form-label">Nota: </label>
                <div class="col-10">
                  <input class="form-control" type="text" value="" id="nota_b" name="nota_b" maxlength="100" placeholder="" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="fecha_reg_b" class="col-2 col-form-label">Fecha:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="fecha_reg_b" name="fecha_reg_b" maxlength="15" placeholder="" readonly>
                </div>
              </div>
              <fieldset disabled>
                <div class="form-group row">
                  <label for="ordensel_b" class="col-2 col-form-label">Ordenes: </label>
                  <div class="col-10">
                    <select multiple class="form-control" id="ordensel_b" name="ordensel_b">

                    </select>
                    <small  class="text-muted">
                      Ordenes integradas a la lista de cierre.
                    </small>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="bloqueado_b" class="col-2 col-form-label">Estatus: </label>
                  <div class="col-10">
                    <select class="custom-select" id="bloqueado_b" name="bloqueado_b">
                            <option value="1">Registro bloqueado</option>
                            <option value="0">Registro no bloqueado</option>
                    </select>
                  </div>
                </div>
              </fieldset>
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
<!-- End modal Borrar cierre -->
</main>
