<?php echo carga_script_js(pathinfo(__FILE__, PATHINFO_FILENAME)); ?>
<main role="main" >
    <div class="row">
        <div class="col-9 text-left p-2 mt-2">
          <h3 class="font-italic text-dark">
            <?php echo icono_mod_ordenes();?>
            órdenes</h3>
        </div>
        <div class="col-1 text-center p-1 mt-1">
          <a class="btn btn-outline-dark" href="<?php echo site_url($this->router->fetch_class().'/exportar'); ?>" role="button" target="_blank">
            <?php echo icono_excel();?>
          </a>
        </div>
        <div class="col-2 text-center p-1 mt-1">
          <!-- Button to Open the Modal Nuevo orden-->
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
        <th style="display:none" title="Reparto de tortilla de maíz">TM de Reparto</th>
        <th style="display:none" title="Reparto de de masa">Masa de Reparto</th>
        <th style="display:none">Fecha Registro</th>
        <th style="display:none">Fecha Ejecución</th>
        <th style="display:none">Hora Ejecución</th>
        <th style="display:none">Cierre</th>
        <th>Cierre</th>
        <th style="display:none">Id Rendimiento</th>
        <th>Rendimiento</th>
        <th title="Kilogramos de masa producida">Kg. Masa Producida</th>
        <th title="Kilogramos de tortilla de maíz producida">Kg. T-M Producida</th>
        <th style="display:none" title="Litros de agua usada para la producción de tortilla de maíz">Lts. Agua-M</th>
        <th title="Kilogramos de tortilla de harina producida">Kg. T-H Producida</th>
        <th style="display:none" title="Litros de agua usada para la producción de tortilla de harina">Lts. Agua-H</th>
        <th title="Devoluciones">Dev.</th>
        <th title="Repartos efectivos = (Reparto programado-Devoluciones)">Rep.</th>
        <th title="Montos de repartos efectivos">Monto Reparto</th>
        <th style="display:none">Uso</th>
        <th>Uso</th>
        <th colspan="3"><?php echo accionAER(); ?></th>
      </tr>
    </thead>
    <tbody>
    <?php for($i=0; $i<count($orden); $i++) {?>
      <tr class="text-center" id="fila_<?php echo $i+1;?>">
        <th style="display:none" scope="row"><?php echo $i+1;?></th>
        <td><?php echo $orden[$i]->id; ?></td>
        <td style="display:none" class="text-left"><?php echo $orden[$i]->id_sucursal; ?></td>
        <td class="text-left"><?php echo $orden[$i]->sucursal; ?></td>
        <td style="display:none" class="text-left"><?php echo $orden[$i]->nota; ?></td>
        <td style="display:none" class="text-center"><?php echo $orden[$i]->cant_rep_tm; ?></td>
        <td style="display:none" class="text-center"><?php echo $orden[$i]->cant_rep_m; ?></td>
        <td style="display:none"><?php echo nice_date($orden[$i]->fecha_reg, 'd-m-Y'); ?></td>
        <td style="display:none"><?php echo nice_date($orden[$i]->fecha_ejec, 'd-m-Y'); ?></td>
        <td style="display:none"><?php echo $orden[$i]->hora_ejec; ?></td>
        <td style="display:none" class="text-center"><?php echo $orden[$i]->id_cierre; ?></td>
        <td class="text-center"><?php echo icono_tiene_cierre($orden[$i]->id_cierre); ?></td>
        <td style="display:none" class="text-center"><?php echo $orden[$i]->id_rendimiento; ?></td>
        <td class="text-center"><?php echo $orden[$i]->rendimiento; ?></td>
        <td class="text-center"><?php echo $orden[$i]->masa_producida; ?></td>
        <td class="text-center"><?php echo $orden[$i]->tm_producida; ?></td>
        <td style="display:none" class="text-center"><?php echo $orden[$i]->tm_agua; ?></td>
        <td class="text-center"><?php echo $orden[$i]->th_producida; ?></td>
        <td style="display:none" class="text-center"><?php echo $orden[$i]->th_agua; ?></td>
        <td class="text-center"><?php echo $orden[$i]->cant_dev; ?></td>
        <td class="text-center"><?php echo $orden[$i]->cant_rep-$orden[$i]->cant_dev; ?></td>
        <td class="text-right"><?php echo number_format($orden[$i]->mto_rep,2); ?></td>

        <td style="display:none" class="text-center"><?php echo $orden[$i]->uso; ?></td>
        <td class="text-center"><?php echo icono_reg_uso($orden[$i]->uso); ?></td>
        <td>
          <button type="button" class="btn btn-outline-dark center-block btnActOrden"  data-toggle="modal" data-target="#actualizarClien">
            <?php echo icono_actualizar();?>
          </button>
        </td>
        <td>
          <button type="button" class="btn btn-outline-dark center-block btnBorrOrden"  data-toggle="modal" data-target="#borrarClien">
            <?php echo icono_borrar();?>
          </button>
        </td>
        <td>
          <a class="btn btn-outline-dark" href="<?php echo site_url($this->router->fetch_class().'/excel/'.$orden[$i]->id.'') ?>" role="button"
              target="_blank">
            <?php echo icono_excel_reg();?>
          </a>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
<?php echo $this->pagination->create_links(); ?>
<!-- The Modal Nuevo Orden -->
<div class="modal fade" id="nuevoClien">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Orden/nuevo'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">
          <?php echo icono_titulo_nuevo();?>
          Registro de una nueva orden:
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
                <option selected disabled>Seleccione una orden</option>
                <?php for($i=0; $i<count($sucursal); $i++) { ?>
                  <option value="<?php echo $sucursal[$i]->id; ?>"><?php echo $sucursal[$i]->id.' : '.$sucursal[$i]->nombre; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="rendimiento_n" class="col-2 col-form-label">Margen: </label>
            <div class="col-10">
              <select class="custom-select" id="rendimiento_n" name="rendimiento_n" required>
                <option selected disabled>Seleccione el margen del rendimiento</option>
                <?php for($i=0; $i<count($rendimiento); $i++) { ?>
                  <option value="<?php echo $rendimiento[$i]->id; ?>"><?php echo $rendimiento[$i]->id.' : '.$rendimiento[$i]->nombre; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
            <div class="form-group row">
              <label for="nota_n" class="col-2 col-form-label">Nota: </label>
              <div class="col-10">
                <input class="form-control" type="text" id="nota_n" name="nota_n" maxlength="80" placeholder="Nota de la orden" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="fecha_ejec_n" class="col-2 col-form-label">Fecha: </label>
              <div class="col-10">
                <input class="form-control" type="date" value="<?php echo mdate('%Y-%m-%d', time());?>" id="fecha_ejec_n" name="fecha_ejec_n" placeholder="" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="hora_ejec_n" class="col-2 col-form-label">Hora: </label>
              <div class="col-10">
                <input class="form-control" type="time" value="<?php echo mdate('%H:%i', time());?>" id="hora_ejec_n" name="hora_ejec_n" placeholder="" required>
                <small  class="text-muted">
                  La hora debe ser en formato de 24Hrs.
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
<!-- End modal Nuevo orden -->

<!-- The Modal Actualizar orden -->
<div class="modal fade" id="actualizarClien">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Orden/actualizar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-success">
        <h4 class="modal-title">
          <?php echo icono_titulo_actualizar();?>
          Actualizar datos de la orden
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
              <label for="sucursal_a" class="col-2 col-form-label">Sucursal: </label>
              <div class="col-10">
                <select class="custom-select" id="sucursal_a" name="sucursal_a">
                  <?php for($i=0; $i<count($sucursal); $i++) { ?>
                    <option value="<?php echo $sucursal[$i]->id; ?>"><?php echo $sucursal[$i]->id.' : '.$sucursal[$i]->nombre; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="rendimiento_a" class="col-2 col-form-label">Margen: </label>
              <div class="col-10">
                  <select class="custom-select" id="rendimiento_a" name="rendimiento_a" required>
                    <option selected disabled>Seleccione el margen del rendimiento</option>
                    <?php for($i=0; $i<count($rendimiento); $i++) { ?>
                      <option value="<?php echo $rendimiento[$i]->id; ?>"><?php echo $rendimiento[$i]->id.' : '.$rendimiento[$i]->nombre; ?></option>
                    <?php } ?>
                  </select>
                  <small  class="text-muted">
                    No se puede modificar si está en uso.
                  </small>
              </div>
            </div>
              <div class="form-group row">

                <label for="nota_a" class="col-2 col-form-label">Nota: </label>
                <div class="col-10">
                    <input class="form-control" type="text" id="nota_a" name="nota_a" maxlength="80" placeholder="Nota de la orden" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="fecha_ejec_a" class="col-2 col-form-label">Fecha: </label>
                <div class="col-10">
                  <input class="form-control" type="date" value="<?php echo mdate('%Y-%m-%d', time());?>" id="fecha_ejec_a" name="fecha_ejec_a" placeholder="" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="hora_ejec_a" class="col-2 col-form-label">Hora: </label>
                <div class="col-10">
                  <input class="form-control" type="time" value="<?php echo mdate('%H:%i', time());?>" id="hora_ejec_a" name="hora_ejec_a" placeholder="" required>
                  <small  class="text-muted">
                    La hora debe ser en formato de 24Hrs.
                  </small>
                </div>
              </div>
              <div class="form-group row">
                <label for="cierre_a" class="col-2 col-form-label">Cierre: </label>
                <div class="col-10">
                  <select class="custom-select" id="cierre_a" name="cierre_a">
                    <option value="">Sin cierre de sucursal asignado</option>
                    <?php for($i=0; $i<count($cierre); $i++) { ?>
                      <option value="<?php echo $cierre[$i]->id; ?>"><?php echo $cierre[$i]->id.' : '.$cierre[$i]->nota; ?></option>
                    <?php } ?>
                  </select>
                  <small  class="text-muted">
                    Cada cierre puede contener varias ordenes.
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
<!-- End modal Actualizar orden -->

<!-- The Modal Borrar orden -->
<div class="modal fade" id="borrarClien">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Orden/borrar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-danger">
        <h4 class="modal-title">
          <?php echo icono_titulo_borrar();?>
          Borrar orden
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
                <label for="rendimiento_b" class="col-2 col-form-label">Margen:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="rendimiento_b" name="rendimiento_b" maxlength="80" placeholder="" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="nota_b" class="col-2 col-form-label">Nota: </label>
                <div class="col-10">
                  <input class="form-control" type="text" value="" id="nota_b" name="nota_b" maxlength="100" placeholder="" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="fecha_ejec_b" class="col-2 col-form-label">Fecha:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="fecha_ejec_b" name="fecha_ejec_b" maxlength="15" placeholder="" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="cierre_b" class="col-2 col-form-label">Cierre: </label>
                <div class="col-10">
                    <fieldset disabled>
                      <select class="custom-select" id="cierre_b" name="cierre_b">
                        <option value="">Sin cierre de sucursal asignado</option>
                        <?php for($i=0; $i<count($cierre); $i++) { ?>
                          <option value="<?php echo $cierre[$i]->id; ?>"><?php echo $cierre[$i]->id.' : '.$cierre[$i]->nota; ?></option>
                        <?php } ?>
                      </select>
                      <small  class="text-muted">
                        Cada cierre puede contener varias ordenes.
                      </small>
                  </fieldset>
                </div>
              </div>
              <input type="hidden" value="<?php echo $pagina; ?>" id="pagina_b" name="pagina_b">
          </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <fieldset  class="enuso">
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
<!-- End modal Borrar orden -->
</main>
