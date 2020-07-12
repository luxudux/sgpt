<?php echo carga_script_js(pathinfo(__FILE__, PATHINFO_FILENAME)); ?>
<main role="main" >
    <div class="row">
        <div class="col-9 text-left p-2 mt-2">
          <h3 class="font-italic text-dark">
            <?php echo icono_mod_catalogos();?>
            gastos</h3>
        </div>
        <div class="col-1 text-center p-1 mt-1">
          <a class="btn btn-outline-dark" href="<?php echo site_url($this->router->fetch_class().'/exportar'); ?>" role="button" target="_blank">
            <?php echo icono_excel();?>
          </a>
        </div>
        <div class="col-2 text-center p-1 mt-1">
          <!-- Button to Open the Modal Nuevo gasto-->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoGasto">
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
        <th>Nombre</th>
        <th>Id Grupo</th>
        <th>Grupo</th>
        <th colspan="2"><?php echo accionAE();?></th>
      </tr>
    </thead>
    <tbody>
    <?php for($i=0; $i<count($gasto); $i++) {?>
      <tr class="text-center" id="fila_<?php echo $i+1;?>">
        <th style="display:none" scope="row"><?php echo $i+1;?></th>
        <td><?php echo $gasto[$i]->id; ?></td>
        <td class="text-left"><?php echo $gasto[$i]->nombre; ?></td>
        <td><?php echo $gasto[$i]->id_grupo; ?></td>
        <td class="text-left"><?php echo $gasto[$i]->grupo; ?></td>
        <td class="text-right">
          <button type="button" class="btn btn-outline-dark center-block btnActGasto"  data-toggle="modal" data-target="#actualizarGasto">
            <?php echo icono_actualizar();?>
          </button>
        </td>
        <td class="text-left">
          <button type="button" class="btn btn-outline-dark center-block btnBorrGasto"  data-toggle="modal" data-target="#borrarGasto">
            <?php echo icono_borrar();?>
          </button>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
<?php echo $this->pagination->create_links(); ?>

<!-- The Modal Nuevo Gasto -->
<div class="modal fade" id="nuevoGasto">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Gasto/nuevo'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">
          <?php echo icono_titulo_nuevo();?>
          Registro del nuevo gasto:
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="container">
            <div class="form-group row">
              <label for="nombre_n" class="col-2 col-form-label">Nombre:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="nombre_n" name="nombre_n" maxlength="80" placeholder="Nombre del gasto" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="grupo_n" class="col-2 col-form-label">Grupo:</label>
              <div class="col-10">
                <select class="custom-select" id="grupo_n" name="grupo_n">
                  <option selected disabled>Seleccione un grupo del gasto</option>
                  <?php for($i=0; $i<count($grupo); $i++) { ?>
                    <option value="<?php echo $grupo[$i]->id; ?>"><?php echo $grupo[$i]->id.' : '.$grupo[$i]->nombre; ?></option>
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
<!-- End modal Nuevo gasto -->

<!-- The Modal Actualizar gasto -->
<div class="modal fade" id="actualizarGasto">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Gasto/actualizar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-success">
        <h4 class="modal-title">
          <?php echo icono_titulo_actualizar();?>
          Actualizar datos de gasto
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
              <label for="nombre_n" class="col-2 col-form-label">Nombre:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="nombre_a" name="nombre_a" maxlength="80" placeholder="Nombre del gasto" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="grupo_a" class="col-2 col-form-label">Grupo:</label>
              <div class="col-10">
                <select class="custom-select" id="grupo_a" name="grupo_a" required>
                  <?php for($i=0; $i<count($grupo); $i++) { ?>
                    <option value="<?php echo $grupo[$i]->id; ?>"><?php echo $grupo[$i]->id.' : '.$grupo[$i]->nombre; ?></option>
                  <?php } ?>
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
<!-- End modal Actualizar gasto -->

<!-- The Modal Borrar gasto -->
<div class="modal fade" id="borrarGasto">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Gasto/borrar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-danger">
        <h4 class="modal-title">
          <?php echo icono_titulo_borrar();?>
          Borrar gasto
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
                <label for="nombre_n" class="col-2 col-form-label">Nombre:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="nombre_b" name="nombre_b" maxlength="80" placeholder="Nombre del gasto" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="grupo_b" class="col-2 col-form-label">Grupo:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="grupo_b" name="grupo_b" maxlength="80" placeholder="Nombre del grupo" readonly>
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
<!-- End modal Borrar gasto -->
</main>
