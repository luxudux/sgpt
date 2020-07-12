<?php echo carga_script_js(pathinfo(__FILE__, PATHINFO_FILENAME)); ?>
<main role="main" >
    <div class="row">
        <div class="col-9 text-left p-2 mt-2">
          <h3 class="font-italic text-dark">
            <?php echo icono_mod_inventarios();?>
            entradas en almacén</h3>
        </div>
        <div class="col-1 text-center p-1 mt-1">
          <a class="btn btn-outline-dark" href="<?php echo site_url($this->router->fetch_class().'/exportar'); ?>" role="button" target="_blank">
          <?php echo icono_excel();?>
          </a>
        </div>
        <div class="col-2 text-center p-1 mt-1">
          <!-- Button to Open the Modal Nuevo entradaAlmacen-->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoEntradaAlmacen">
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
        <th style="display:none">Id Materia prima</th>
        <th>Materia prima</th>
        <th style="display:none">Id Proveedor</th>
        <th>Proveedor</th>
        <th>Cantidad Ingresada</th>
        <th>Fecha registro</th>
        <th>Cantidad Usada</th>
        <th style="display:none">Stock</th>
        <th>Stock</th>
        <th colspan="2"><?php echo accionAE();?></th>
      </tr>
    </thead>
    <tbody>
    <?php for($i=0; $i<count($entradaAlmacen); $i++) {?>
      <tr class="text-center" id="fila_<?php echo $i+1;?>">
        <th scope="row"><?php echo $i+1;?></th>
        <td><?php echo $entradaAlmacen[$i]->id; ?></td>
        <td style="display:none"><?php echo $entradaAlmacen[$i]->id_matprima; ?></td>
        <td class="text-left"><?php echo $entradaAlmacen[$i]->materiaPrima; ?></td>
        <td style="display:none"><?php echo $entradaAlmacen[$i]->id_proveedor; ?></td>
        <td class="text-left"><?php echo $entradaAlmacen[$i]->proveedor; ?></td>
        <td class="text-right"><?php echo $entradaAlmacen[$i]->cantidad; ?></td>
        <td ><?php echo nice_date($entradaAlmacen[$i]->fecha_reg, 'd-m-Y'); ?></td>
        <td class="text-right"><?php echo $entradaAlmacen[$i]->cantidad_usada; ?></td>
        <td style="display:none" class="text-right"><?php echo $entradaAlmacen[$i]->stock; ?></td>
        <td class="text-right"><?php echo icono_tiene_matprima($entradaAlmacen[$i]->stock); ?></td>
        <td class="text-right">
          <button type="button" class="btn btn-outline-dark center-block btnActEntradaAlmacen"  data-toggle="modal" data-target="#actualizarEntradaAlmacen">
            <?php echo icono_actualizar();?>
          </button>
        </td>
        <td class="text-left">
          <button type="button" class="btn btn-outline-dark center-block btnBorrEntradaAlmacen"  data-toggle="modal" data-target="#borrarEntradaAlmacen">
            <?php echo icono_borrar();?>
          </button>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
<?php echo $this->pagination->create_links(); ?>
<!-- The Modal Nuevo EntradaAlmacen -->
<div class="modal fade" id="nuevoEntradaAlmacen">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('EntradaAlmacen/nuevo'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">
          <?php echo icono_titulo_nuevo();?>
          Registro de entrada a almacén:
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="container">

            <div class="form-group row">
              <label for="materiaPrima_n" class="col-2 col-form-label">Materia: </label>
              <div class="col-10">
                <select class="custom-select" id="materiaPrima_n" name="materiaPrima_n" required>
                  <option value="" selected disabled>Selecciona la materia prima</option>
                  <?php for($i=0; $i<count($materiaPrima); $i++) { ?>
                    <option value="<?php echo $materiaPrima[$i]->id; ?>"><?php echo $materiaPrima[$i]->id.' : '.$materiaPrima[$i]->nombre; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="materiaPrima_n" class="col-2 col-form-label">Proveedor: </label>
              <div class="col-10">
                <select class="custom-select" id="proveedor_n" name="proveedor_n" required>
                  <option value="" selected disabled>Selecciona un proveedor</option>
                  <?php for($i=0; $i<count($proveedor); $i++) { ?>
                    <option value="<?php echo $proveedor[$i]->id; ?>"><?php echo $proveedor[$i]->id.' : '.$proveedor[$i]->nombre; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="cantidad_n" class="col-2 col-form-label">Cantidad: </label>
              <div class="col-10">
                <input class="form-control" type="number" placeholder="000.00" min="0" step=".01" max="999" id="cantidad_n" name="cantidad_n" required>
                <small  class="text-muted">
                  La cantidad debe ser en Kilogramos (Kg.).
                </small>
              </div>
            </div>
            <div class="form-group row">
              <label for="fecha_n" class="col-2 col-form-label">Fecha: </label>
              <div class="col-10">
                <input class="form-control" type="date" value="<?php echo mdate('%Y-%m-%d', time());?>" id="fecha_n" name="fecha_n" placeholder="" required>
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
<!-- End modal Nuevo entradaAlmacen -->

<!-- The Modal Actualizar entradaAlmacen -->
<div class="modal fade" id="actualizarEntradaAlmacen">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('EntradaAlmacen/actualizar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-success">
        <h4 class="modal-title">
          <?php echo icono_titulo_actualizar();?>
          Actualizar datos de almacén:
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
              <label for="materiaPrima_a" class="col-2 col-form-label">Materia: </label>
              <div class="col-10">
                <select class="custom-select" id="materiaPrima_a" name="materiaPrima_a" disabled>
                  <option value="" selected disabled>Selecciona la materia prima 1</option>
                  <?php for($i=0; $i<count($materiaPrima); $i++) { ?>
                    <option value="<?php echo $materiaPrima[$i]->id; ?>"><?php echo $materiaPrima[$i]->id.' : '.$materiaPrima[$i]->nombre; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="materiaPrima_a" class="col-2 col-form-label">Proveedor: </label>
              <div class="col-10">
                    <select class="custom-select" id="proveedor_a" name="proveedor_a" required>
                      <option value="" selected disabled>Selecciona un proveedor</option>
                      <?php for($i=0; $i<count($proveedor); $i++) { ?>
                        <option value="<?php echo $proveedor[$i]->id; ?>"><?php echo $proveedor[$i]->id.' : '.$proveedor[$i]->nombre; ?></option>
                      <?php } ?>
                    </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="cantidad_a" class="col-2 col-form-label">Cantidad: </label>
              <div class="col-10">
                <input class="form-control" type="number" placeholder="000.00" min="0" step=".01" max="999" id="cantidad_a" name="cantidad_a" required>
                <small  class="text-muted">
                  La cantidad debe ser en Kilogramos (Kg.).
                </small>
              </div>
            </div>
            <div class="form-group row">
              <label for="fecha_a" class="col-2 col-form-label">Fecha: </label>
              <div class="col-10">
                  <input class="form-control" type="date" value="" id="fecha_a" name="fecha_a" placeholder="" required>
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
<!-- End modal Actualizar entradaAlmacen -->

<!-- The Modal Borrar entradaAlmacen -->
<div class="modal fade" id="borrarEntradaAlmacen">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo form_open('EntradaAlmacen/borrar'); ?>
      <!-- Modal Header -->
      <div class="modal-header bg-danger">
        <h4 class="modal-title">
          <?php echo icono_titulo_borrar();?>
          Borrar entrada de almacén:
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
                <label for="materiaPrima_b" class="col-2 col-form-label">Materia prima:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="materiaPrima_b" name="materiaPrima_b" maxlength="80" placeholder="Nombre del materiaPrima" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="proveedor_b" class="col-2 col-form-label">Proveedor:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="proveedor_b" name="proveedor_b" maxlength="80" placeholder="Nombre del proveedor" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="cantidad_n" class="col-2 col-form-label">Cantidad:</label>
                <div class="col-10">
                  <input class="form-control" type="text" id="cantidad_b" name="cantidad_b" maxlength="80" placeholder="cantidad" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="fecha_b" class="col-2 col-form-label">Fecha: </label>
                <div class="col-10">
                  <input class="form-control" type="date" value="" id="fecha_b" name="fecha_b" placeholder="" readonly>
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
        <fieldset>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- End modal Borrar entradaAlmacen -->
</main>
