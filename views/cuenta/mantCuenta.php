<script src="../js/cuenta.js?>rev<?php echo time(); ?>"></script>

<style>
   .select2-container .select2-selection--single {
      height: 38px !important;
   }

   .select2-selection__arrow {
      height: 38px !important;
   }
</style>
<style>
   .modal-title {
      color: white;
      font-weight: bold;
      text-align: center;
      margin-left: auto;
   }
</style>

<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h3 class="m-2" style="font-size: 1.8rem;color:#000006;">Cuenta Auxiliar</h3>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="index.php">Home</a></li>
               <li class="breadcrumb-item active">Cuenta Auxiliar</li>
            </ol>
         </div>
      </div>
   </div>
</div>

<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-header border-0">
                  <h3 class="card-title text-lg mt-2"><b>Listado de Periodo Contable</b></h3>
                  <div class="card-tools">
                     <button class="btn btn-outline-primary" type="button" onclick="abrirModalRegistrar()">
                        <i class="fa fa-plus fa-fw" aria-hidden="true"></i> Registrar
                     </button>
                  </div>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-12 table-responsive">
                        <table id="tabla_auxiliar" class="table table-sm text-center table-striped table-hover" width="100%" style="text-align:center;">
                           <style>
                              #tabla_auxiliar {
                                 text-align: center;
                                 width: 100%;
                                 font-size: 14px;
                                 color: #000000;
                              }
                           </style>
                           <thead>
                              <tr class="text-md" style="font-weight: 800;">
                                 <th>#</th>
                                 <th>TIPO</th>
                                 <th>N° IDENTIDAD</th>
                                 <th>NOMBRE</th>
                                 <th>RAZÓN SOCIAL</th>
                                 <th>DIRECCION</th>
                                 <th>OPERACIONES</th>
                              </tr>
                           </thead>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modalRegistrar" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content bg-default">
         <div class="modal-header">
            <h5 class="modal-title text-bold text-lg" style="color:#000000;" id="exampleModalLabel">Registro de Cuenta Auxiliar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <style>
            .form-control {
               margin-bottom: 1rem;
            }
         </style>
         <div class="modal-body" style="background: #ffffff">
            <div class="row">
               <div class="col-6">
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">TIPO DE IDENTIDAD</label>
                  <select class="form-control js-example-basic-single" id="cbm_tipo" style="width: 100%;">
                  </select>
               </div>
               <div class="col-6">
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">N° IDENTIDAD</label>
                  <input type="text" id="txt_identidad" placeholder="Ingrese su número de identidad" class="form-control" maxlength="12" onkeypress="return soloNumeros(event);">
               </div>
               <div class="col-6">
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">APELLIDO PATERNO</label>
                  <input type="text" id="txt_apepat" placeholder="Ingrese apellido paterno" class="form-control">
               </div>
               <div class="col-6">
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">APELLIDO MATERNO</label>
                  <input type="text" id="txt_apemat" placeholder="Ingrese apellido materno" class="form-control">
               </div>
               <div class="col-6">
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">NOMBRE</label>
                  <input type="text" id="txt_nombre" placeholder="Ingrese el nombre" class="form-control">
               </div>
               <div class="col-6">
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">RAZÓN SOCIAL</label>
                  <input type="text" id="txt_razon" placeholder="Ingrese la razón social" class="form-control">
               </div>
               <div class="col-6">
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">DIRECCIÓN</label>
                  <input type="text" id="txt_direccion" placeholder="Ingrese la dirección" class="form-control">
               </div>
            </div>
         </div>
         <div class="modal-footer" style="background: #ffffff">
            <button type="button" class="btn btn-primary btn-sm" onclick="registrarCuenta()"><i class="fa fa-check"></i> Registrar</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"> <i class="fa fa-undo "></i> Cancelar</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modalModificar" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content bg-default">
         <div class="modal-header">
            <h5 class="modal-title text-bold text-lg" style="color:#000000;" id="exampleModalLabel">Modificar Cuenta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <style>
            .form-control {
               margin-bottom: 1rem;
            }
         </style>
         <div class="modal-body" style="background: #ffffff">
            <div class="row">
               <div class="col-6">
                  <input type="text" id="id_tipo" hidden>
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">TIPO DE IDENTIDAD</label>
                  <select class="form-control js-example-basic-single" id="cbm_tipoE" style="width: 100%;">
                  </select>
               </div>
               <div class="col-6">
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">N° IDENTIDAD</label>
                  <input type="text" id="txt_identidadE" placeholder="Ingrese su número de identidad" class="form-control" maxlength="12" onkeypress="return soloNumeros(event);">
               </div>
               <div class="col-6">
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">APELLIDO PATERNO</label>
                  <input type="text" id="txt_apepatE" placeholder="Ingrese apellido paterno" class="form-control">
               </div>
               <div class="col-6">
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">APELLIDO MATERNO</label>
                  <input type="text" id="txt_apematE" placeholder="Ingrese apellido materno" class="form-control">
               </div>
               <div class="col-6">
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">NOMBRE</label>
                  <input type="text" id="txt_nombreE" placeholder="Ingrese el nombre" class="form-control">
               </div>
               <div class="col-6">
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">RAZÓN SOCIAL</label>
                  <input type="text" id="txt_razonE" placeholder="Ingrese la razón social" class="form-control">
               </div>
               <div class="col-6">
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">DIRECCIÓN</label>
                  <input type="text" id="txt_direccionE" placeholder="Ingrese la dirección" class="form-control">
               </div>
            </div>
         </div>
         <div class="modal-footer" style="background: #ffffff">
            <button type="button" class="btn btn-primary btn-sm" onclick="editarCuenta()"><i class="fa fa-check"></i> Modificar</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"> <i class="fa fa-undo "></i> Cancelar</button>
         </div>
      </div>
   </div>
</div>



<script>
   listar_cuenta();
   cargarIdentidad();
   $(document).ready(function() {
      $('.js-example-basic-single').select2();
   });
</script>