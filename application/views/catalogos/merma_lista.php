<?php echo carga_script_js(pathinfo(__FILE__, PATHINFO_FILENAME)); ?>
<main role="main" >
    <div class="row">
        <div class="col-9 text-left p-2 mt-2">
          <h3 class="font-italic text-dark">
            <?php echo icono_mod_catalogos();?>
            mermas</h3>
        </div>
        <div class="col-1 text-center p-1 mt-1">
          <a class="btn btn-outline-dark" href="<?php echo site_url($this->router->fetch_class().'/exportar'); ?>" role="button" target="_blank">
            <?php echo icono_excel();?>
          </a>
        </div>
        <div class="col-2 text-center p-1 mt-1">
          <!-- Button to Open the Modal Nuevo merma-->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoMerma">
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
        <th>Nombre</th>
        <th>Id Grupo</th>
        <th>Grupo</th>
        <th style="display:none">Bloqueado</th>
        <th>Bloqueado</th>
        <th colspan="2"><?php echo accionAE();?></th>
      </tr>
    </thead>
    <tbody>
    <?php for($i=0; $i<count($merma); $i++) {?>
      <tr class="text-center" id="fila_<?php echo $i+1;?>">
        <th scope="row"><?php echo $i+1;?></th>
        <td><?php echo $merma[$i]->id; ?></td>
        <td class="text-left"><?php echo $merma[$i]->nombre; ?></td>
        <td class="text-center"><?php echo $merma[$i]->id_grupop; ?></td>
        <td class="text-center"><?php echo $merma[$i]->grupop; ?></td>
        <td style="display:none" class="text-center"><?php echo $merma[$i]->bloqueado; ?></td>
        <td class="text-center"><?php echo icono_reg_bloqueado($merma[$i]->bloqueado); ?></td>
        <td class="text-right">
          <button type="button" class="btn btn-outline-dark center-block btnActMerma"  data-toggle="modal" data-target="#actualizarMerma">
            <?php echo icono_actualizar();?>
          </button>
        </td>
        <td class="text-left">
          <button type="button" class="btn btn-outline-dark center-block btnBorrMerma"  data-toggle="modal" data-target="#borrarMerma">
            <?php echo icono_borrar();?>
          </button>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  <?php echo $this->pagination->create_links(); ?>
<!-- The Modal Nuevo Merma -->
<div class="modal fade" id="nuevoMerma">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Merma/nuevo'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">
          <?php echo icono_titulo_nuevo();?>
          Registro de nueva merma:
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="container">
            <div class="form-group row">
              <label for="nombre_n" class="col-2 col-form-label">Nombre:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="nombre_n" name="nombre_n" maxlength="80" placeholder="Nombre del merma" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="grupop_n" class="col-2 col-form-label">Grupo:</label>
              <div class="col-10">
                <select class="custom-select" id="grupop_n" name="grupop_n" required>
                  <option selected disabled>Seleccione un grupo del gasto</option>
                  <?php for($i=0; $i<count($grupop); $i++) { ?>
                    <option value="<?php echo $grupop[$i]->id; ?>"><?php echo $grupop[$i]->id.' : '.$grupop[$i]->nombre; ?></option>
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
<!-- End modal Nuevo merma -->

<!-- The Modal Actualizar merma -->
<div class="modal fade" id="actualizarMerma">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Merma/actualizar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-success">
        <h4 class="modal-title">
          <?php echo icono_titulo_actualizar();?>
          Actualizar datos de merma
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <div class="container">
          <fieldset class="enuso">
            <div class="form-group row">
              <label for="id_a" class="col-2 col-form-label">ID: </label>
              <div class="col-10">
                <input class="form-control" type="text" id="id_a" name="id_a" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="nombre_n" class="col-2 col-form-label">Nombre:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="nombre_a" name="nombre_a" maxlength="80" placeholder="Nombre del merma" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="grupop_a" class="col-2 col-form-label">Grupo:</label>
              <div class="col-10">
                <select class="custom-select" id="grupop_a" name="grupop_a">
                  <?php for($i=0; $i<count($grupop); $i++) { ?>
                    <option value="<?php echo $grupop[$i]->id; ?>"><?php echo $grupop[$i]->id.' : '.$grupop[$i]->nombre; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <input type="hidden" value="<?php echo $pagina; ?>" id="pagina_a" name="pagina_a">
          </fieldset>
        </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <fieldset class="enuso">
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
<!-- End modal Actualizar merma -->

<!-- The Modal Borrar merma -->
<div class="modal fade" id="borrarMerma">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Merma/borrar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-danger">
        <h4 class="modal-title">
          <?php echo icono_titulo_borrar();?>
          Borrar merma
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
                  <input class="form-control" type="text" id="nombre_b" name="nombre_b" maxlength="80" placeholder="Nombre del merma" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="grupop_b" class="col-2 col-form-label">Grupo:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="grupop_b" name="grupop_b" maxlength="80" placeholder="Nombre del grupo" readonly>
                </div>
              </div>
              <input type="hidden" value="<?php echo $pagina; ?>" id="pagina_b" name="pagina_b">
          </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
          <fieldset class="enuso">
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
<!-- End modal Borrar merma -->
</main>
