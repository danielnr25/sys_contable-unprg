<?php
session_start();
if (!isset($_SESSION['S_IDUSUARIO_SC'])) {
  header('Location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema Contable | Dashboard</title>
  <link href="../dist/fontawesome/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="../dist/fontawesome/css/brands.css">
  <link rel="stylesheet" href="../dist/fontawesome/css/fontawesome.css">
  <link rel="stylesheet" href="../dist/fontawesome/css/solid.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../templates/plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <!-- Utilitarios -->
  <link rel="stylesheet" type="text/css" href="../utils/dataTables.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../utils/dataTables.bootstrap5.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" type="text/css" href="../utils/select2/css/select2.min.css" />
  <link rel="stylesheet" type="text/css" href="../utils/select2-bootstrap4-theme/select2-bootstrap4.css" />
  <link rel="stylesheet" href="../templates/dist/css/adminlte.min.css">
  <!-- Logo -->
  <link rel="icon" href="../templates/dist/img/AdminLTELogo.png">
</head>

<body class="layout-fixed sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">

          <div class="nav-link user-panel d-flex" data-toggle="dropdown">
            <div class="info">
              <a href="#" class="d-block font-weight-500"><?php echo $_SESSION['S_NUSUARIO_SC'] ?></a>
            </div>
            <div class="image">
              <img src="../templates/dist/img/user1-128x128.jpg" class="img-circle" alt="User Image">
            </div>
          </div>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-dark m-0">Welcome!</h6>
            </div>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item" onclick="mostrarContenido('contenido-principal','usuarios/mantPerfil.php')">
              <i class="fas fa-user-cog mr-2"></i>
              <span>Configuración</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="../controllers/usuario/cerrarSesion.php" class="dropdown-item">
              <i class="fas fa-snowboarding text-red mr-3"></i>
              <span>Salir</span>
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-secondary elevation-4 bg-black">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link">
        <img src="../templates/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light ml-2"><strong style="font-size: 17px;">Sistema Contable</strong></span>
      </a>

      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../templates/dist/img/user1-128x128.jpg" class="img-circle elevation-2" alt="User Image" style="position: sticky; top: 10px;">
          </div>
          <div class="info">
            <a href="#" class="d-block">
              <div class="text-bold" style="color:aliceblue; font-size:14px"><?php echo $_SESSION['S_NUSUARIO_SC'] ?></div>
              <small style="color:coral;"><?php echo $_SESSION['S_ROL_SC'] ?></small>
            </a>
          </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
              <a href="index.php" class="nav-link active">
                <i class="nav-icon fa-solid fa-gauge"></i>
                <p>Inicio</p>
              </a>
            </li>
            <li class="nav-header text-red">MANTENIMIENTO</li>
            <?php if ($_SESSION['S_ROL_SC'] == "ADMIN") { ?>
              <li class="nav-item">
                <a href="#" onclick="mostrarContenido('contenido-principal','usuarios/mantUsuario.php')" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>
                    Usuarios
                  </p>
                </a>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a href="#" class="nav-link" onclick="mostrarContenido('contenido-principal','periodo/mantPeriodo.php')">
                <i class="nav-icon 	fas fa-book"></i>
                <p>
                  Periodo Contable
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link" onclick="mostrarContenido('contenido-principal','operacion/mantOperacion.php')">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  Tipo de Operacion
                </p>
              </a>
            </li>
            <?php if ($_SESSION['S_ROL_SC'] == "ADMIN") { ?>
              <li class="nav-item">
                <a href="#" class="nav-link" onclick="mostrarContenido('contenido-principal','tipo_asiento/mantAsiento.php')">
                  <i class="nav-icon fas fa-file-signature"></i>
                  <p>
                    Tipo de asiento
                  </p>
                </a>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a href="#" class="nav-link" onclick="mostrarContenido('contenido-principal','asiento/mantContable.php')">
                <i class="nav-icon fas fa-file-signature"></i>
                <p>
                  Asiento Contable
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link" onclick="mostrarContenido('contenido-principal','contable/mantContable.php')">
                <i class="nav-icon fa-solid fa-file-invoice"></i>
                <p>
                  Cuenta Contable
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link" onclick="mostrarContenido('contenido-principal','cambio/mantCambio.php')">
                <i class="nav-icon fa-solid fa-dollar-sign"></i>
                <p>
                  Tipo de Cambio
                </p>
              </a>
            </li>
            <?php if ($_SESSION['S_ROL_SC'] == "ADMIN") { ?>
              <li class="nav-item">
                <a href="#" class="nav-link" onclick="mostrarContenido('contenido-principal','tipo_docs/mantIdentidad.php')">
                  <i class="nav-icon fa-solid fa-address-card"></i>
                  <p>
                    Tipo de Identidad
                  </p>
                </a>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a href="#" class="nav-link" onclick="mostrarContenido('contenido-principal','cuenta/mantCuenta.php')">
                <i class="nav-icon fa-solid fa-file-invoice"></i>
                <p>
                  Cuenta Auxiliar
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link" onclick="mostrarContenido('contenido-principal','documento/mantDocs.php')">
                <i class="nav-icon fa-solid fa-file-invoice"></i>
                <p>
                  Documento
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link" onclick="mostrarContenido('contenido-principal','documento/mantDocs.php')">
                <i class="nav-icon fas fa-file-signature"></i>
                <p>
                  Detalle de Asiento
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="contenido-principal">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-8">
              <h1 class="m-0 text-center">BIENVENIDO <?php echo $_SESSION['S_NUSUARIO_SC'] ?> AL SISTEMA CONTABLE</h1>
            </div><!-- /.col -->
            <div class="col-sm-4">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v3</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6">
              <div class="card">

              </div>

              <div class="card">


              </div>
            </div>

          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <strong>Copyright &copy;2023 <a href="https://adminlte.io">Sistema Contable.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <img src="../templates/dist/img/AdminLTELogo.png" alt="" style="width: 30px;">
      </div>
    </footer>
  </div>
  <!-- jQuery -->

  <script src="../templates/plugins/jquery/jquery.min.js"></script>
  <script src="../utils/sweetalert.js"></script>
  <!-- dataTables -->
  <script type="text/javascript" src="../utils/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="../utils/dataTables.bootstrap5.min.js"></script>
  <!-- select2 -->
  <script type="text/javascript" src="../utils/select2/js/select2.full.min.js"></script>
  <!-- Bootstrap -->
  <script src="../templates/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE -->
  <script src="../templates/dist/js/adminlte.js"></script>

  <script>
    function mostrarContenido(id, vista) {
      $("#" + id).load(vista);
    }
    var idioma_espanol = {
      select: {
        rows: ""
      },
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrar _MENU_ registros",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ning&uacute;n dato disponible en esta tabla",
      "sInfo": "Mostrando <b style='color:#1b2c39'>(_START_ al _END_)</b> de <b style= 'color:#7067EB'>_TOTAL_</b> registros",
      "sInfoEmpty": "Registro del (0 al 0) total 0 registros",
      "sInfoFiltered": "(Filtrado de un total de <b style='color:blue'>_MAX_</b> registros)",
      "sInfoPostFix": "",
      "sSearch": "<b>Buscar:</b>",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "<b> No se encontraron datos </b>",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "<small style='color:blue'>Siguiente</small>",
        "sPrevious": "<small style='color:#000006'>Anterior</small>"
      },
      "oAria": {
        "sSortAscending": ":Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ":Activar para ordenar la columna de manera descendente"
      }

    }
    $(function() {
      var menues = $(".nav-link");
      menues.click(function() {
        menues.removeClass("active");
        $(this).addClass("active");
      });
    })

    function soloNumeros(e) {
      tecla = (document.all) ? e.keyCode : e.which;
      if (tecla == 8) {
        return true;
      }
      // Patron de entrada, en este caso solo acepta numeros
      patron = /[0-9]/;
      tecla_final = String.fromCharCode(tecla);
      return patron.test(tecla_final);
    }

    function validar_email(email) {
      var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email) ? true : false;
    }

    function soloDecimal(e) {
      tecla = (document.all) ? e.keyCode : e.which;
      if (tecla == 8) {
        return true;
      }
      // Patron de entrada, en este caso solo acepta numeros
      decimal = /[0-9 , "."]/;
      tecla_final = String.fromCharCode(tecla);
      return decimal.test(tecla_final);
    }

    function soloLetras(e) {
      key = e.keyCode || e.which;
      tecla = String.fromCharCode(key).toLowerCase();
      letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
      especiales = "8-37-39-46";
      tecla_especial = false
      for (var i in especiales) {
        if (key == especiales[i]) {
          tecla_especial = true;
          break;
        }
      }
      if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return false;
      }
    }

    function filterFloat(evt, input) {
      var key = window.Event ? evt.which : evt.keyCode;
      var chark = String.fromCharCode(key);
      var tempValue = input.value + chark;
      if (key >= 48 && key <= 57) {
        if (filter(tempValue) === false) {
          return false;
        } else {
          return true;
        }
      } else {
        if (key == 8 || key == 13 || key == 0) {
          return true;
        } else if (key == 46) {
          if (filter(tempValue) === false) {
            return false;
          } else {
            return true;
          }
        } else {
          return false;
        }
      }
    }

    function filter(__val__) {
      var preg = /^([0-9]+\.?[0-9]{0,2})$/;
      if (preg.test(__val__) === true) {
        return true;
      } else {
        return false;
      }
    }
  </script>
</body>

</html>