<?php echo carga_script_js(pathinfo(__FILE__, PATHINFO_FILENAME)); ?>
<main role="main" >
    <div class="row">
        <div class="col-9 text-left p-2 mt-2">
          <h3 class="font-italic text-dark">
            <?php echo icono_mod_cierres();?>
            cierre de mermas</h3>
        </div>
        <div class="col-1 text-center p-1 mt-1">
          <a class="btn btn-outline-dark" href="<?php echo site_url($this->router->fetch_class().'/exportar'); ?>" role="button" target="_blank">
            <?php echo icono_excel();?>
          </a>
        </div>
        <div class="col-2 text-center p-1 mt-1">
          <!-- Button to Open the Modal Nuevo cierreMerma-->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoCierreMerma">
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
        <th style="display:nones">Id</th>
        <th>Id Cierre</th>
        <th style="display:none">Nota Cierre</th>
        <th  style="display:none">Id Sucursal</th>
        <th>Nombre Sucursal</th>
        <th style="display:nones">Id Merma</th>
        <th>Merma</th>
        <th>Cantidad (Kg.)</th>
        <th style="display:none">Bloqueado</th>
        <th>Bloqueado</th>
        <th colspan="2"><?php echo accionAE();?></th>
      </tr>
    </thead>
    <tbody>
    <?php for($i=0; $i<count($cierreMerma); $i++) {?>
      <tr class="text-center" id="fila_<?php echo $i+1;?>">
        <!-- <th scope="row"><?php echo $i+1;?></th> -->
        <td style="display:nones"><?php echo $cierreMerma[$i]->id; ?></td>
        <td><?php echo $cierreMerma[$i]->id_cierre; ?></td>
        <td  style="display:none" class="text-left"><?php echo $cierreMerma[$i]->cierre; ?></td>
        <td  style="display:none" class="text-left"><?php echo $cierreMerma[$i]->id_sucursal; ?></td>
        <td class="text-left"><?php echo $cierreMerma[$i]->sucursal; ?></td>
        <td style="display:nones"><?php echo $cierreMerma[$i]->id_merma; ?></td>
        <td class="text-left"><?php echo $cierreMerma[$i]->merma; ?></td>
        <td class="text-right"><?php echo $cierreMerma[$i]->cantidad; ?></td>
        <td style="display:none"  class="text-center"><?php echo $cierreMerma[$i]->bloqueado; ?></td>
        <td class="text-center"><?php echo icono_reg_bloqueado($cierreMerma[$i]->bloqueado); ?></td>
        <td class="text-right">
          <button type="button" class="btn btn-outline-dark center-block btnActCierreMerma"  data-toggle="modal" data-target="#actualizarCierreMerma">
            <?php echo icono_actualizar();?>
          </button>
        </td>
        <td class="text-left">
          <button type="button" class="btn btn-outline-dark center-block btnBorrCierreMerma"  data-toggle="modal" data-target="#borrarCierreMerma">
            <?php echo icono_borrar();?>
          </button>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  <?php echo $this->pagination->create_links(); ?>
<!-- The Modal Nuevo CierreMerma -->
<div class="modal fade" id="nuevoCierreMerma">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('CierreMerma/nuevo'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">
          <?php echo icono_titulo_nuevo();?>
          Registro del cierre de merma:
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

            <div class="form-group row">
              <label for="merma_n" class="col-2 col-form-label">Merma:</label>
              <div class="col-10">
                <select class="custom-select" id="merma_n" name="merma_n" required>
                  <option value="" selected disabled>Selecciona la merma</option>
                  <?php for($i=0; $i<count($merma); $i++) { ?>
                        <option value="<?php echo $merma[$i]->id; ?>"><?php echo $merma[$i]->id.' : '.$merma[$i]->nombre; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="cantidad_n" class="col-2 col-form-label">Cantidad: </label>
              <div class="col-10">
                <input class="form-control" type="number" placeholder="0000.00" min="0" step=".01" max="9999" id="cantidad_n" name="cantidad_n" required>
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
<!-- End modal Nuevo cierreMerma -->

<!-- The Modal Actualizar cierreMerma -->
<div class="modal fade" id="actualizarCierreMerma">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('CierreMerma/actualizar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-success">
        <h4 class="modal-title">
          <?php echo icono_titulo_actualizar();?>
          Actualizar cierre de merma:
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
              <label for="merma_a" class="col-2 col-form-label">Merma:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="merma_a" name="merma_a" maxlength="80" placeholder="Nombre de merma" readonly>
              </div>
            </div>
            <fieldset class='enuso'>
              <div class="form-group row">
                <label for="cantidad_a" class="col-2 col-form-label">Cantidad:</label>
                <div class="col-10">
                  <input class="form-control" type="number" placeholder="000.00" min="0" step=".01" max="9999" id="cantidad_a" name="cantidad_a" required>
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
<!-- End modal Actualizar cierreMerma -->

<!-- The Modal Borrar cierreMerma -->
<div class="modal fade" id="borrarCierreMerma">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('CierreMerma/borrar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-danger">
        <h4 class="modal-title">
          <?php echo icono_titulo_borrar();?>
          Borrar cierre de merma:
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
              <label for="merma_b" class="col-2 col-form-label">Merma:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="merma_b" name="merma_b" maxlength="80" placeholder="Nombre de merma" readonly>
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
<!-- End modal Borrar cierreMerma -->
</main>
