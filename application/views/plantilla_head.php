
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <!-- Site Properties -->
   <title>Sistema de Gestión de Produccion de Tortilla</title>
   <!-- Stylesheets -->
   <link rel="icon" href="<? echo base_url('favicon.gif'); ?>" type="image/gif">

   <!-- Bootstrap core JavaScript
   ================================================== -->
   <!-- Placed at the end of the document so the pages load faster -->
   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
   <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

   
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   
   <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
   <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script> -->

</head>

<body class="bg-light">

    <header>

      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark">

        <div class="container">

        <a class="navbar-brand text-info" href="<?php echo site_url('Home'); ?>">

            <i class="fab fa-pagelines" aria-hidden="true"></i> SGPT
            <!-- <img src="<? echo base_url('images/barra.png')?>"  width="40" height="30" alt=""> -->
        </a>


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <!-- <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li> -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="catalogos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo icono_menu_catalogos();?> Catálogos</a>
              <div class="dropdown-menu" aria-labelledby="catalogos">
                <a class="dropdown-item" href="<?php echo site_url('Puesto'); ?>">
                  <?php echo icono_menu_catalogos();?>

                  Admón. Puestos
                </a>
                <a class="dropdown-item" href="<?php echo site_url('Merma'); ?>">
                  <?php echo icono_menu_catalogos();?>
                  Admón. Mermas
                </a>
                <a class="dropdown-item" href="<?php echo site_url('Grupop'); ?>">
                  <i class="fa fa-list-ul " aria-hidden="true"></i>
                  Gr. Productos
                </a>
                <a class="dropdown-item" href="<?php echo site_url('Producto'); ?>">
                  <i class="fa fa-list-ul " aria-hidden="true"></i>
                  Admón. Productos
                </a>
                <a class="dropdown-item" href="<?php echo site_url('Sucursal'); ?>">
                  <?php echo icono_menu_catalogos();?>
                  Admón. Sucursales
                </a>
                <a class="dropdown-item" href="<?php echo site_url('Grupom'); ?>">
                  <?php echo icono_menu_catalogos();?>
                  Gr. Materia prima
                </a>
                <a class="dropdown-item" href="<?php echo site_url('MateriaPrima'); ?>">
                  <?php echo icono_menu_catalogos();?>
                  Admón. Materia prima
                </a>
                  <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo site_url('Ruta'); ?>">
                  <?php echo icono_menu_catalogos();?>
                  Admón. Rutas
                </a>
                <a class="dropdown-item" href="<?php echo site_url('Cliente'); ?>">
                  <?php echo icono_menu_catalogos();?>
                  Admón. Clientes
                </a>
                <a class="dropdown-item" href="<?php echo site_url('Empleado'); ?>">
                  <?php echo icono_menu_catalogos();?>
                  Admón. Empleados
                </a>
                <a class="dropdown-item" href="<?php echo site_url('Proveedor'); ?>">
                  <?php echo icono_menu_catalogos();?>
                  Admón. Proveedores
                </a>
                <a class="dropdown-item" href="<?php echo site_url('Reparticion'); ?>">
                  <?php echo icono_menu_catalogos();?>
                  Admón. Reparticiones
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo site_url('Rendimiento'); ?>">
                  <?php echo icono_menu_catalogos();?>
                  Admón. Rendimiento
                </a>
                <a class="dropdown-item" href="<?php echo site_url('Grupo'); ?>">
                  <?php echo icono_menu_catalogos();?>
                  Gr. Gastos.
                </a>
                <a class="dropdown-item" href="<?php echo site_url('Gasto'); ?>">
                  <?php echo icono_menu_catalogos();?>
                  Admón. Gastos
                </a>

              </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="inventarios" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo icono_menu_inventarios();?> Inventarios</a>
                <div class="dropdown-menu" aria-labelledby="inventarios">
                <a class="dropdown-item" href="<?php echo site_url('EntradaAlmacen'); ?>">
                  <?php echo icono_menu_inventarios();?>
                  Admón. Almacén
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo site_url('CostoCliente'); ?>">
                  <?php echo icono_menu_inventarios();?>
                  Admón. Costos clientes
                </a>
                <a class="dropdown-item" href="<?php echo site_url('CostoSucursal'); ?>">
                  <?php echo icono_menu_inventarios();?>
                  Admón. Costos Sucursales
                </a>
              </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="traspasos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <!-- <?php echo icono_menu_ordenes();?> Traspasos</a> -->
                  <?php echo icono_menu_ordenes();?> Órdenes</a>
                <div class="dropdown-menu" aria-labelledby="traspasos">
                <a class="dropdown-item" href="<?php echo site_url('Orden'); ?>">
                  <?php echo icono_menu_ordenes();?>
                  Admón. Órdenes
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo site_url('SuministroCliente'); ?>">
                  <?php echo icono_menu_ordenes();?>
                  Suministro a clientes
                </a>
                <a class="dropdown-item" href="<?php echo site_url('SuministroSucursal'); ?>">
                  <?php echo icono_menu_ordenes();?>
                  Suministro a sucursales
                </a>
                <!-- <a class="dropdown-item" href="#">
                  <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                  Suministro de masa
                </a> -->

              </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="ventas" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <!-- <?php echo icono_menu_cierres();?> Venta, Gastos y Mermas</a> -->
                  <?php echo icono_menu_cierres();?> Cierres</a>
                <div class="dropdown-menu" aria-labelledby="ventas">
                <a class="dropdown-item" href="<?php echo site_url('Cierre'); ?>">
                  <?php echo icono_menu_cierres();?>
                  Admón. Cierres
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo site_url('CierreVenta'); ?>">
                  <?php echo icono_menu_cierres();?>
                  Cierre de Ventas 
                </a>
                <a class="dropdown-item" href="<?php echo site_url('CierreGasto'); ?>">
                  <?php echo icono_menu_cierres();?>
                  Cierre de Gastos 
                </a>
                <a class="dropdown-item" href="<?php echo site_url('CierreMerma'); ?>">
                  <?php echo icono_menu_cierres();?>
                  Cierre de Mermas 
                </a>
                <!-- <a class="dropdown-item disabled" href="<?php echo site_url('CierreDevolucion'); ?>">
                  <?php echo icono_menu_cierres();?>
                  Cierre de Devolucion
                </a>
                <a class="dropdown-item disabled" href="<?php echo site_url('CierreReparticion'); ?>">
                  <?php echo icono_menu_cierres();?>
                  Cierre de Reparticiones
                </a>
                <a class="dropdown-item disabled" href="#">
                  <?php echo icono_menu_cierres();?>
                  Cierre de Devolucion
                </a>
                <a class="dropdown-item disabled" href="#">
                  <?php echo icono_menu_cierres();?>
                  Cierre de Reparticiones
                </a>-->

              </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle " href="" id="ventas" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo icono_menu_reportes();?> Reportes</a>
                <div class="dropdown-menu" aria-labelledby="ventas">
                <a class="dropdown-item" href="<?php echo site_url('GraficaSucursal'); ?>">
                  <?php echo icono_menu_reportes();?>
                  Reporte 1
                </a>
                <a class="dropdown-item" href="<?php echo site_url('GraficaSucursal/gastoAnual'); ?>">
                  <?php echo icono_menu_reportes();?>
                    Grafico de gasto por mes ($)
                </a>
                <a class="dropdown-item" href="<?php echo site_url('GraficaSucursal/ventaAnual'); ?>">
                  <?php echo icono_menu_reportes();?>
                    Grafico de venta por mes ($)
                </a>
                <a class="dropdown-item" href="<?php echo site_url('GraficaSucursal/mermaAnual'); ?>">
                  <?php echo icono_menu_reportes();?>
                    Grafico de merma por mes (Kg.)
                </a>
                <a class="dropdown-item" href="<?php echo site_url('GraficaSucursal/reparticionAnual'); ?>">
                  <?php echo icono_menu_reportes();?>
                    Grafico de reparticiones por mes (Kg.)
                </a>
                <a class="dropdown-item" href="<?php echo site_url('GraficaSucursal/devolucionAnual'); ?>">
                  <?php echo icono_menu_reportes();?>
                  Grafico de devoluciones por mes (Kg.)
                </a>
                <a class="dropdown-item" href="<?php echo site_url('GraficaSucursal/masaproducidaAnual'); ?>">
                  <?php echo icono_menu_reportes();?>
                  Grafico de masa producida por mes (Kg.)
                </a>
              </div>
            </li>

          </ul>
          <a class="nav-linkv text-warning" href="<?php echo site_url('Login/salir'); ?>"><i class="fa fa-sign-out-alt" aria-hidden="true"></i> Salir <?php echo $this->session->nombre_usr; ?></a>
          <!-- <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form> -->

        </div>
      </div>
      </nav>

        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <!-- <li class="breadcrumb-item"><a href="#">Inicio</a></li> -->
            <!-- <li class="breadcrumb-item"><a href="#">Ordenes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Materia prima</li> -->
          </ol>
        </nav>


    </header>

 <div class="container">
