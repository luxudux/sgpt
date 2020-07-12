<?php echo carga_script_js(pathinfo(__FILE__, PATHINFO_FILENAME)); ?>
<main role="main" >
    <div class="row">
        <div class="col-9 text-left p-2 mt-2">
          <h3 class="font-italic text-dark">
            <?php echo icono_mod_catalogos();?>
            proveedores</h3>
        </div>
        <div class="col-1 text-center p-1 mt-1">
          <a class="btn btn-outline-dark" href="<?php echo site_url($this->router->fetch_class().'/exportar'); ?>" role="button" target="_blank">
            <?php echo icono_excel();?>
          </a>
        </div>
        <div class="col-2 text-center p-1 mt-1">
          <!-- Button to Open the Modal Nuevo proveedor-->
          <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#nuevoProv">
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
        <th>Correo</th>
        <th>Teléfono</th>
        <th style="display:none">Activo</th>
        <th>Activo</th>
        <th colspan="2"><?php echo accionAE();?></th>
      </tr>
    </thead>
    <tbody>
    <?php for($i=0; $i<count($proveedor); $i++) {?>
      <tr class="text-center" id="fila_<?php echo $i+1;?>">
        <th scope="row"><?php echo $i+1;?></th>
        <td><?php echo $proveedor[$i]->id; ?></td>
        <td class="text-left"><?php echo $proveedor[$i]->nombre; ?></td>
        <td><?php echo $proveedor[$i]->correo; ?></td>
        <td><?php echo $proveedor[$i]->telefono; ?></td>
        <td style="display:none"><?php echo $proveedor[$i]->activo; ?></td>
        <td><?php echo icono_activo($proveedor[$i]->activo); ?></td>
        <td class="text-right">
          <button type="button" class="btn btn-outline-dark center-block btnActProv"  data-toggle="modal" data-target="#actualizarProv">
            <?php echo icono_actualizar();?>
          </button>
        </td>
        <td class="text-left">
          <button type="button" class="btn btn-outline-dark center-block btnBorrProv"  data-toggle="modal" data-target="#borrarProv">
            <?php echo icono_borrar();?>
          </button>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  <?php echo $this->pagination->create_links(); ?>
<!-- The Modal Nuevo proveedor -->
<div class="modal fade" id="nuevoProv">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Proveedor/nuevo'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">
          <?php echo icono_titulo_nuevo();?>
          Registro de un nuevo proveedor:
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="container">
            <div class="form-group row">
              <label for="nombre_n" class="col-2 col-form-label">Nombre:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="nombre_n" name="nombre_n" maxlength="80" placeholder="Nombre del proveedor" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="correo_n" class="col-sm-2 col-form-label">Correo:</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="correo_n"  name="correo_n" maxlength="30" placeholder="ejemplo@correo.com" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="telefono_n" class="col-2 col-form-label">Telefono:</label>
              <div class="col-10">
                <input class="form-control" type="tel" id="telefono_n" name="telefono_n" maxlength="15" placeholder="312-000-00-00" required>
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
        <button type="submit" class="btn btn-primary">
          <?php echo icono_guardar(); ?>
          Guardar
        </button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- End modal Nuevo proveedor -->

<!-- The Modal Actualizar proveedor -->
<div class="modal fade" id="actualizarProv">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Proveedor/actualizar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-success">
        <h4 class="modal-title">
          <?php echo icono_titulo_actualizar();?>
          Actualizar datos del proveedor
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
              <label for="nombre_a" class="col-2 col-form-label">Nombre:</label>
              <div class="col-10">
                <input class="form-control" type="text" id="nombre_a" name="nombre_a" maxlength="80" placeholder="Nombre del proveedor" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="correo_a" class="col-sm-2 col-form-label">Correo:</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="correo_a"  name="correo_a" maxlength="30" placeholder="ejemplo@correo.com" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="telefono_a" class="col-2 col-form-label">Telefono:</label>
              <div class="col-10">
                <input class="form-control" type="tel" id="telefono_a" name="telefono_a" maxlength="15" placeholder="312-000-00-00" required>
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
<!-- End modal Actualizar proveedor -->

<!-- The Modal Borrar proveedor -->
<div class="modal fade" id="borrarProv">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('Proveedor/borrar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-danger">
        <h4 class="modal-title">
          <?php echo icono_titulo_borrar();?>
          Borrar proveedor
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
                <label for="nombre_b" class="col-2 col-form-label">Nombre:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="nombre_b" name="nombre_b" maxlength="80" placeholder="Nombre del proveedor" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="correo_b" class="col-sm-2 col-form-label">Correo:</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="correo_b"  name="correo_b" maxlength="30" placeholder="ejemplo@correo.com" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="telefono_b" class="col-2 col-form-label">Telefono:</label>
                <div class="col-10">
                  <input class="form-control" type="tel" id="telefono_b" name="telefono_b" maxlength="15" placeholder="312-000-00-00" readonly>
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
<!-- End modal Borrar proveedor -->
</main>
