<?php echo carga_script_js(pathinfo(__FILE__, PATHINFO_FILENAME)); ?>
<main role="main" >
    <div class="row">
        <div class="col-9 text-left p-2 mt-2">
          <h3 class="font-italic text-dark">
            <?php echo icono_mod_catalogos();?>
            rendimientos</h3>
        </div>
        <div class="col-1 text-center p-1 mt-1">
          <a class="btn btn-outline-dark" href="<?php echo site_url($this->router->fetch_class().'/exportar'); ?>" role="button" target="_blank">
            <?php echo icono_excel();?>
          </a>
        </div>
        <div class="col-2 text-center p-1 mt-1">
          <!-- Button to Open the Modal Nuevo rendimiento-->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoRendimiento">
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
        <th>Id</th>
        <th>Nombre</th>
        <th>Saco maíz(Kg.)</th>
        <th style="display:none">Agua maíz(Lts.)</th>
        <th>Saco harina(Kg.)</th>
        <th style="display:none">Agua harina(Lts.)</th>
        <th>Rendimiento masa(Kg.)</th>
        <th>Deshidratación</th>
        <th>Rendimiento tortilla M(Kg.)</th>
        <th>Rendimiento tortilla H(Kg.)</th>
        <th>Activo</th>
        <th style="display:none">Activo</th>
        <th style="display:none">Uso</th>
        <th>Uso</th>
        <th style="display:none">Bloqueado</th>
        <th>Bloqueado</th>
        <th colspan="2"><?php echo accionAE();?></th>
      </tr>
    </thead>
    <tbody>
    <?php for($i=0; $i<count($rendimiento); $i++) {?>
      <tr class="text-center" id="fila_<?php echo $i+1;?>">
        <td><?php echo $rendimiento[$i]->id; ?></td>
        <td class="text-left"><?php echo $rendimiento[$i]->nombre; ?></td>
        <td class="text-center"><?php echo $rendimiento[$i]->psaco_m; ?></td>
        <td style="display:none" class="text-center"><?php echo $rendimiento[$i]->agua_m; ?></td>
        <td class="text-center"><?php echo $rendimiento[$i]->psaco_h; ?></td>
        <td style="display:none" class="text-center"><?php echo $rendimiento[$i]->agua_h; ?></td>
        <td class="text-center"><?php echo $rendimiento[$i]->rmasa; ?></td>
        <td class="text-center"><?php echo $rendimiento[$i]->deshidrata; ?></td>
        <td class="text-center"><?php echo $rendimiento[$i]->rtortilla_m; ?></td>
        <td class="text-center"><?php echo $rendimiento[$i]->rtortilla_h; ?></td>
        <td style="display:none" class="text-center"><?php echo $rendimiento[$i]->activo; ?></td>
        <td class="text-center"><?php echo icono_activo($rendimiento[$i]->activo); ?></td>
        <td style="display:none" class="text-center"><?php echo $rendimiento[$i]->uso; ?></td>
        <td class="text-center"><?php echo icono_reg_uso($rendimiento[$i]->uso); ?></td>
        <td style="display:none" class="text-center"><?php echo $rendimiento[$i]->bloqueado; ?></td>
        <td class="text-center"><?php echo icono_reg_bloqueado($rendimiento[$i]->bloqueado); ?></td>
        <td class="text-right">
          <button type="button" class="btn btn-outline-dark center-block btnActRendimiento"  data-toggle="modal" data-target="#actualizarRendimiento">
            <?php echo icono_actualizar();?>
          </button>
        </td>
        <td class="text-left">
          <button type="button" class="btn btn-outline-dark center-block btnBorrRendimiento"  data-toggle="modal" data-target="#borrarRendimiento">
            <?php echo icono_borrar();?>
          </button>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  <?php echo $this->pagination->create_links(); ?>
<!-- The Modal Nuevo Rendimiento -->
<div class="modal fade" id="nuevoRendimiento">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Rendimiento/nuevo'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">
          <?php echo icono_titulo_nuevo();?>
          Registro de nuevo rendimiento:
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="container">
            <div class="form-group row">
              <label for="nombre_n" class="col-2 col-form-label">Nombre:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="nombre_n" name="nombre_n" maxlength="80" placeholder="Nombre del registro del rendimiento" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="sacoMaiz_n" class="col-2 col-form-label">Maíz:</label>
              <div class="col-10">
                <input class="form-control" type="number" id="sacoMaiz_n" name="sacoMaiz_n" min="0" step=".01" max="100" placeholder="Peso del saco de maíz en Kg." required>
              </div>
            </div>
            <div class="form-group row">
              <label for="aguaMaiz_n" class="col-2 col-form-label">AguaM:</label>
              <div class="col-10">
                <input class="form-control" type="number" id="aguaMaiz_n" name="aguaMaiz_n" min="0" step=".01" max="200" placeholder="Agua para el saco de maíz Lts." required>
              </div>
            </div>
            <div class="form-group row">
              <label for="sacoHarina_n" class="col-2 col-form-label">Harina:</label>
              <div class="col-10">
                <input class="form-control" type="number" id="sacoHarina_n" name="sacoHarina_n" min="0" step=".01" max="100" placeholder="Peso del saco de harina en Kg." required>
              </div>
            </div>
            <div class="form-group row">
              <label for="aguaHarina_n" class="col-2 col-form-label">AguaH:</label>
              <div class="col-10">
                <input class="form-control" type="number" id="aguaHarina_n" name="aguaHarina_n" min="0" step=".01" max="200" placeholder="Agua para el saco de harina Lts." required>
              </div>
            </div>
            <div class="form-group row">
              <label for="masa_n" class="col-2 col-form-label ">Masa:</label>
              <div class="col-10">
                <input class="form-control" type="number" id="masa_n" name="masa_n" min="1" step=".01" max="100" placeholder="Rendimiento de masa por saco de maíz Kg." required>
              </div>
            </div>
            <div class="form-group row">
              <label for="deshidrata_n" class="col-2 col-form-label">%:</label>
              <div class="col-10">
                <input class="form-control calcula_n" type="number" id="deshidrata_n" name="deshidrata_n" step=".01" min="1" max="100" placeholder="Porcentaje de deshidratación." required>
              </div>
            </div>
            <div class="form-group row">
              <label for="tortillaM_n" class="col-2 col-form-label">TortillaM:</label>
              <div class="col-10">
                <input class="form-control" type="number" id="tortillaM_n" name="tortillaM_n" min="0" step=".01" max="100" placeholder="Rendimiento de tortilla de maíz Kg." readonly>
                <small  class="text-muted">
                  Rendimiento de la tortilla de maíz
                </small>
              </div>
            </div>
            <div class="form-group row">
              <label for="tortillaH_n" class="col-2 col-form-label">TortillaH:</label>
              <div class="col-10">
                <input class="form-control" type="number" id="tortillaH_n" name="tortillaH_n" min="0" step=".01" max="100" placeholder="Rendimiento de tortilla de harina Kg." required>
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
<!-- End modal Nuevo rendimiento -->

<!-- The Modal Actualizar rendimiento -->
<div class="modal fade" id="actualizarRendimiento">
  <div class="modal-dialog">
    <div class="modal-content">

      <?php echo form_open('Rendimiento/actualizar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-success">
        <h4 class="modal-title">
          <?php echo icono_titulo_actualizar();?>
          Actualizar datos del rendimiento
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <div class="container">
          <fieldset class='enuso'>
            <div class="form-group row">
              <label for="id_a" class="col-2 col-form-label">ID: </label>
              <div class="col-10">
                <input class="form-control" type="text" id="id_a" name="id_a" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="nombre_a" class="col-2 col-form-label">Nombre:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="nombre_a" name="nombre_a" maxlength="80" placeholder="Nombre del registro del rendimiento" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="sacoMaiz_a" class="col-2 col-form-label">Maíz:</label>
              <div class="col-10">
                <input class="form-control" type="number" id="sacoMaiz_a" name="sacoMaiz_a" min="0" step=".01" max="100" placeholder="Peso del saco de maíz en Kg." required>
              </div>
            </div>
            <div class="form-group row">
              <label for="aguaMaiz_a" class="col-2 col-form-label">AguaM:</label>
              <div class="col-10">
                <input class="form-control" type="number" id="aguaMaiz_a" name="aguaMaiz_a" min="0" step=".01" max="200" placeholder="Agua para el saco de maíz Lts." required>
              </div>
            </div>
            <div class="form-group row">
              <label for="sacoHarina_a" class="col-2 col-form-label">Harina:</label>
              <div class="col-10">
                <input class="form-control" type="number" id="sacoHarina_a" name="sacoHarina_a" min="0" step=".01" max="100" placeholder="Peso del saco de harina en Kg." required>
              </div>
            </div>
            <div class="form-group row">
              <label for="aguaHarina_a" class="col-2 col-form-label">AguaH:</label>
              <div class="col-10">
                <input class="form-control" type="number" id="aguaHarina_a" name="aguaHarina_a" min="0" step=".01" max="200" placeholder="Agua para el saco de harina Lts." required>
              </div>
            </div>
            <div class="form-group row">
              <label for="masa_a" class="col-2 col-form-label ">Masa:</label>
              <div class="col-10">
                <input class="form-control" type="number" id="masa_a" name="masa_a" min="1" step=".01" max="100" placeholder="Rendimiento de masa por saco de maíz Kg." required>
              </div>
            </div>
            <div class="form-group row">
              <label for="deshidrata_a" class="col-2 col-form-label">%:</label>
              <div class="col-10">
                <input class="form-control calcula_a" type="number" id="deshidrata_a" name="deshidrata_a" step=".01" min="1" max="100" placeholder="Porcentaje de deshidratación." required>
              </div>
            </div>
            <div class="form-group row">
              <label for="tortillaM_a" class="col-2 col-form-label">TortillaM:</label>
              <div class="col-10">
                <input class="form-control" type="number" id="tortillaM_a" name="tortillaM_a" min="0" step=".01" max="100" placeholder="Rendimiento de tortilla de maíz Kg." readonly>
                <small  class="text-muted">
                Rendimiento de la tortilla de maíz
                </small>
              </div>
            </div>
            <div class="form-group row">
              <label for="tortillaH_a" class="col-2 col-form-label">TortillaH:</label>
              <div class="col-10">
                <input class="form-control" type="number" id="tortillaH_a" name="tortillaH_a" min="0" step=".01" max="100" placeholder="Rendimiento de tortilla de harina Kg." required>
              </div>
            </div>
            <div class="form-group row">
              <label for="activo_a" class="col-2 col-form-label">Activo: </label>
              <div class="col-10">
                <select class="custom-select" id="activo_a" name="activo_a" required>
                        <option value="1" selected>Registro activo</option>
                        <option value="0">Registro no activo</option>
                </select>
              </div>
            </div>
            <input type="hidden" value="<?php echo $pagina; ?>" id="pagina_a" name="pagina_a">
          </fieldset>
        </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <fieldset class='enuso'>
          <button type="submit" class="btn btn-success" >
            <?php echo icono_guardar(); ?>
            Guardar
          </button>
        </fieldset>
      </div>
      <?php echo form_close(); ?>

    </div>
  </div>
</div>
<!-- End modal Actualizar rendimiento -->

<!-- The Modal Borrar rendimiento -->
<div class="modal fade" id="borrarRendimiento">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Rendimiento/borrar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-danger">
        <h4 class="modal-title">
          <?php echo icono_titulo_borrar();?>
          Borrar rendimiento
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
                <label for="nombre_b" class="col-2 col-form-label">Nombre:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="nombre_b" name="nombre_b" maxlength="80" placeholder="Nombre del rendimiento" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label for="sacoMaiz_b" class="col-2 col-form-label">Maíz:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="sacoMaiz_b" name="sacoMaiz_b" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="aguaMaiz_b" class="col-2 col-form-label">AguaM:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="aguaMaiz_b" name="aguaMaiz_b" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="sacoHarina_b" class="col-2 col-form-label">Harina:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="sacoHarina_b" name="sacoHarina_b" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="aguaHarina_b" class="col-2 col-form-label">AguaH:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="aguaHarina_b" name="aguaHarina_b" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="masa_b" class="col-2 col-form-label">Masa:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="masa_b" name="masa_b" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="deshidrata_b" class="col-2 col-form-label">% :</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="deshidrata_b" name="deshidrata_b" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="tortillaM_b" class="col-2 col-form-label">TortillaM:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="tortillaM_b" name="tortillaM_b" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="tortillaH_b" class="col-2 col-form-label">TortillaH:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="tortillaH_b" name="tortillaH_b" readonly>
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
<!-- End modal Borrar rendimiento -->
</main>
