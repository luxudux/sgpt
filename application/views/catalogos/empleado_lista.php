<?php echo carga_script_js(pathinfo(__FILE__, PATHINFO_FILENAME)); ?>
<main role="main" >
    <div class="row">
        <div class="col-9 text-left p-2 mt-2">
          <h3 class="font-italic text-dark">
            <?php echo icono_mod_catalogos();?>
            empleados</h3>
        </div>
        <div class="col-1 text-center p-1 mt-1">
          <a class="btn btn-outline-dark" href="<?php echo site_url($this->router->fetch_class().'/exportar'); ?>" role="button" target="_blank">
            <?php echo icono_excel();?>
          </a>
        </div>
        <div class="col-2 text-center p-1 mt-1">
          <!-- Button to Open the Modal Nuevo empleado-->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoEmpl">
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
        <th>Nombre Completo</th>
        <th>Dirección</th>
        <th>Teléfono</th>
        <th>Nacimiento</th>
        <th style="display:none">Id_Puesto</th>
        <th>Puesto</th>
        <th style="display:none">Id_Sucursal</th>
        <th>Sucursal</th>
        <th style="display:none">Activo</th>
        <th>Activo</th>
        <th colspan="2"><?php echo accionAE();?></th>
      </tr>
    </thead>
    <tbody>
    <?php for($i=0; $i<count($empleado); $i++) {?>
      <tr class="text-center" id="fila_<?php echo $i+1;?>">
        <th scope="row"><?php echo $i+1;?></th>
        <td><?php echo $empleado[$i]->id; ?></td>
        <td class="text-left"><?php echo $empleado[$i]->nombre; ?></td>
        <td class="text-left"><?php echo $empleado[$i]->direccion; ?></td>
        <td><?php echo $empleado[$i]->telefono; ?></td>
        <td><?php echo nice_date($empleado[$i]->nacimiento, 'd-m-Y'); ?></td>
        <td style="display:none"><?php echo $empleado[$i]->id_puesto; ?></td>
        <td><?php echo $empleado[$i]->puesto; ?></td>
        <td style="display:none"><?php echo $empleado[$i]->id_sucursal; ?></td>
        <td><?php echo $empleado[$i]->sucursal; ?></td>
        <td style="display:none"><?php echo $empleado[$i]->activo; ?></td>
        <td><?php echo icono_activo($empleado[$i]->activo); ?></td>
        <td class="text-right">
          <button type="button" class="btn btn-outline-dark center-block btnActEmpl"  data-toggle="modal" data-target="#actualizarEmpl">
            <?php echo icono_actualizar();?>
          </button>
        </td>
        <td class="text-left">
          <button type="button" class="btn btn-outline-dark center-block btnBorrEmpl"  data-toggle="modal" data-target="#borrarEmpl">
            <?php echo icono_borrar();?>
          </button>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  <?php echo $this->pagination->create_links(); ?>
<!-- The Modal Nuevo Empleado -->
<div class="modal fade" id="nuevoEmpl">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Empleado/nuevo'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">
          <?php echo icono_titulo_nuevo();?>
          Registro de un nuevo empleado:
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="container">
            <div class="form-group row">
              <label for="nombre_n" class="col-2 col-form-label">Nombre:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="nombre_n" name="nombre_n" maxlength="80" placeholder="Nombre del empleado" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="direccion_n" class="col-2 col-form-label">Dirección: </label>
              <div class="col-10">
                <input class="form-control" type="text" value="" id="direccion_n" name="direccion_n" maxlength="100" placeholder="Dirección del empleado" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="telefono_n" class="col-2 col-form-label">Telefono:</label>
              <div class="col-10">
                <input class="form-control" type="tel" id="telefono_n" name="telefono_n" maxlength="15" placeholder="312-000-00-00" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="nacimiento_n" class="col-2 col-form-label">Fecha: </label>
              <div class="col-10">
                <input class="form-control" type="date" value="<?php echo mdate('%Y-%m-%d', time());?>" id="nacimiento_n" name="nacimiento_n" placeholder="" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="puesto_n" class="col-2 col-form-label">Puesto:</label>
              <div class="col-10">
                <select class="custom-select" id="puesto_n" name="puesto_n" required>
                  <option selected disabled>Selecciona un puesto</option>
                  <?php for($i=0; $i<count($puesto); $i++) { ?>
                  <option value="<?php echo $puesto[$i]->id; ?>"><?php echo $puesto[$i]->id.' : '.$puesto[$i]->nombre; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="sucursal_n" class="col-2 col-form-label">Sucursal:</label>
              <div class="col-10">
                <select class="custom-select" id="sucursal_n" name="sucursal_n" required>
                  <option selected disabled>Selecciona una sucursal</option>
                  <?php for($i=0; $i<count($sucursal); $i++) { ?>
                  <option value="<?php echo $sucursal[$i]->id; ?>"><?php echo $puesto[$i]->id.' : '.$sucursal[$i]->nombre; ?></option>
                <?php } ?>
                </select>
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
<!-- End modal Nuevo empleado -->

<!-- The Modal Actualizar empleado -->
<div class="modal fade" id="actualizarEmpl">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Empleado/actualizar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-success">
        <h4 class="modal-title">
          <?php echo icono_titulo_actualizar();?>
          Actualizar datos del empleado
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
                <input class="form-control" type="text" id="nombre_a" name="nombre_a" maxlength="80" placeholder="Nombre del empleado" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="direccion_a" class="col-2 col-form-label">Dirección: </label>
              <div class="col-10">
                <input class="form-control" type="text" value="" id="direccion_a" name="direccion_a" maxlength="100" placeholder="Dirección del empleado" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="telefono_a" class="col-2 col-form-label">Telefono:</label>
              <div class="col-10">
                <input class="form-control" type="tel" id="telefono_a" name="telefono_a" maxlength="15" placeholder="312-000-00-00" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="nacimiento_a" class="col-2 col-form-label">Fecha: </label>
              <div class="col-10">
                <input class="form-control" type="date" value="" id="nacimiento_a" name="nacimiento_a" placeholder="" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="puesto_a" class="col-2 col-form-label">Puesto:</label>
              <div class="col-10">
                <select class="custom-select" id="puesto_a" name="puesto_a">
                  <?php for($i=0; $i<count($puesto); $i++) { ?>
                  <option value="<?php echo $puesto[$i]->id; ?>"><?php echo $puesto[$i]->id.' : '.$puesto[$i]->nombre; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="sucursal_a" class="col-2 col-form-label">Sucursal:</label>
              <div class="col-10">
                <select class="custom-select" id="sucursal_a" name="sucursal_a">
                  <?php for($i=0; $i<count($sucursal); $i++) { ?>
                  <option value="<?php echo $sucursal[$i]->id; ?>"><?php echo $sucursal[$i]->id.' : '.$sucursal[$i]->nombre; ?></option>
                <?php } ?>
                </select>
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
<!-- End modal Actualizar empleado -->

<!-- The Modal Borrar empleado -->
<div class="modal fade" id="borrarEmpl">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Empleado/borrar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-danger">
        <h4 class="modal-title">
          <?php echo icono_titulo_borrar();?>
          Borrar empleado
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
                  <input class="form-control" type="text" id="nombre_b" name="nombre_b" maxlength="80" placeholder="Nombre del empleado" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="direccion_a" class="col-2 col-form-label">Dirección: </label>
                <div class="col-10">
                  <input class="form-control" type="text" value="" id="direccion_b" name="direccion_b" maxlength="100" placeholder="Dirección del empleado" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="telefono_n" class="col-2 col-form-label">Telefono:</label>
                <div class="col-10">
                  <input class="form-control" type="tel" id="telefono_b" name="telefono_b" maxlength="15" placeholder="312-000-00-00" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="nacimiento_b" class="col-2 col-form-label">Fecha: </label>
                <div class="col-10">
                  <input class="form-control" type="date" value="" id="nacimiento_b" name="nacimiento_b" placeholder="" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="puesto_b" class="col-2 col-form-label">Puesto:</label>
                <div class="col-10">
                  <input class="form-control" type="text" value="" id="puesto_b" name="puesto_b" placeholder="" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="sucursal_b" class="col-2 col-form-label">Sucursal:</label>
                <div class="col-10">
                  <input class="form-control" type="text" value="" id="sucursal_b" name="sucursal_b" placeholder="" readonly>
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
        <button type="submit" class="btn btn-danger">
          <?php echo icono_guardar(); ?>
          Borrar
        </button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- End modal Borrar empleado -->
</main>
