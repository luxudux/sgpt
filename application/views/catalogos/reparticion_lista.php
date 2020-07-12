<?php echo carga_script_js(pathinfo(__FILE__, PATHINFO_FILENAME)); ?>
<main role="main" >
    <div class="row">
        <div class="col-9 text-left p-2 mt-2">
          <h3 class="font-italic text-dark">
            <?php echo icono_mod_catalogos();?>
            reparticiones</h3>
        </div>
        <div class="col-1 text-center p-1 mt-1">
          <a class="btn btn-outline-dark" href="<?php echo site_url($this->router->fetch_class().'/exportar'); ?>" role="button" target="_blank">
          <?php echo icono_excel();?>
          </a>
        </div>
        <div class="col-2 text-center p-1 mt-1">
          <!-- Button to Open the Modal Nuevo reparticiones-->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoReparticiones">
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
        <th style="display:none">Id Empleado</th>
        <th>Empleado</th>
        <th style="display:none">Id Puesto</th>
        <th>Puesto</th>
        <th style="display:none">Id Sucursal</th>
        <th>Sucursal</th>
        <th style="display:none">Id Ruta</th>
        <th>Ruta</th>
        <th colspan="2"><?php echo accionAE();?></th>
      </tr>
    </thead>
    <tbody>
    <?php for($i=0; $i<count($reparticion); $i++) {?>
      <tr class="text-center" id="fila_<?php echo $i+1;?>">
        <!-- <th scope="row"><?php echo $i+1;?></th> -->
        <td><?php echo $reparticion[$i]->id; ?></td>
        <td style="display:none" class="text-center"><?php echo $reparticion[$i]->id_empleado; ?></td>
        <td class="text-left"><?php echo $reparticion[$i]->empleado; ?></td>
        <td style="display:none" class="text-center"><?php echo $reparticion[$i]->id_puesto; ?></td>
        <td><?php echo $reparticion[$i]->puesto; ?></td>
        <td style="display:none" class="text-center"><?php echo $reparticion[$i]->id_sucursal; ?></td>
        <td><?php echo $reparticion[$i]->sucursal; ?></td>
        <td style="display:none" class="text-center"><?php echo $reparticion[$i]->id_ruta; ?></td>
        <td><?php echo $reparticion[$i]->ruta; ?></td>
        <td class="text-right">
          <button type="button" class="btn btn-outline-dark center-block btnActReparticiones"  data-toggle="modal" data-target="#actualizarReparticiones">
            <?php echo icono_actualizar();?>
          </button>
        </td>
        <td class="text-left">
          <button type="button" class="btn btn-outline-dark center-block btnBorrReparticiones"  data-toggle="modal" data-target="#borrarReparticiones">
            <?php echo icono_borrar();?>
          </button>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
<?php echo $this->pagination->create_links(); ?>
<!-- The Modal Nuevo Reparticiones -->
<div class="modal fade" id="nuevoReparticiones">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Reparticion/nuevo'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">
          <?php echo icono_titulo_nuevo();?>
          Registro de nueva reparticiones:
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="container">
          <div class="form-group row">
            <label for="ruta_n" class="col-2 col-form-label">Ruta:</label>
            <div class="col-10">
              <select class="custom-select" id="ruta_n" name="ruta_n" required>
                <option selected disabled>Seleccione una ruta</option>
                <?php for($i=0; $i<count($ruta); $i++) { ?>
                <option value="<?php echo $ruta[$i]->id; ?>"><?php echo $ruta[$i]->id.' : '.$ruta[$i]->nombre; ?></option>
              <?php } ?>
              </select>
              <small  class="text-muted">
                Una ruta puede tener varios repartidores.
              </small>
            </div>
          </div>
            <div class="form-group row">
              <label for="empleado_n" class="col-2 col-form-label">Empleado:</label>
              <div class="col-10">
                <select class="custom-select" id="empleado_n" name="empleado_n" required>
                  <option selected disabled>Seleccione un empleado</option>
                  <?php for($i=0; $i<count($empleado); $i++) { ?>
                  <option value="<?php echo $empleado[$i]->id; ?>"><?php echo $empleado[$i]->id.' : '.$empleado[$i]->nombre.' ('.$empleado[$i]->puesto.')'; ?></option>
                <?php } ?>
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
<!-- End modal Nuevo reparticiones -->

<!-- The Modal Actualizar reparticiones -->
<div class="modal fade" id="actualizarReparticiones">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Reparticion/actualizar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-success">
        <h4 class="modal-title">
          <?php echo icono_titulo_actualizar();?>
          Actualizar datos de reparticiones
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
              <label for="empleado_a" class="col-2 col-form-label">Empleado:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="empleado_a" name="empleado_a" maxlength="80" placeholder="Nombre del empleado" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="ruta_a" class="col-2 col-form-label">Ruta:</label>
              <div class="col-10">
                <select class="custom-select" id="ruta_a" name="ruta_a" required>
                  <?php for($i=0; $i<count($ruta); $i++) { ?>
                  <option value="<?php echo $ruta[$i]->id; ?>"><?php echo $ruta[$i]->id.' : '.$ruta[$i]->nombre; ?></option>
                <?php } ?>
                </select>
                <small  class="text-muted">
                  Una ruta puede tener varios repartidores.
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
<!-- End modal Actualizar reparticiones -->

<!-- The Modal Borrar reparticiones -->
<div class="modal fade" id="borrarReparticiones">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Reparticion/borrar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-danger">
        <h4 class="modal-title">
          <?php echo icono_titulo_borrar();?>
          Borrar reparticiones
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
                <label for="empleado_b" class="col-2 col-form-label">Empleado:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="empleado_b" name="empleado_b" maxlength="80" placeholder="Nombre del empleado" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="puesto_b" class="col-2 col-form-label">Puesto:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="puesto_b" name="puesto_b" maxlength="80" placeholder="Nombre del puesto" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="sucursal_b" class="col-2 col-form-label">Sucursal:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="sucursal_b" name="sucursal_b" maxlength="80" placeholder="Nombre de la sucursal" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="ruta_b" class="col-2 col-form-label">Ruta:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="ruta_b" name="ruta_b" maxlength="80" placeholder="Nombre de la sucursal" readonly>
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
<!-- End modal Borrar reparticiones -->
</main>
