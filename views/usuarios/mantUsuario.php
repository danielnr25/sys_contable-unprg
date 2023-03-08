<script src="../js/usuario.js?>rev<?php echo time(); ?>"></script>

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
            <h3 class="m-2" style="font-size: 1.8rem;color:#000006;">Usuario</h3>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="index.php">Home</a></li>
               <li class="breadcrumb-item active">Usuarios</li>
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
                  <h3 class="card-title text-lg mt-2"><b>Listado de Usuario</b></h3>
                  <div class="card-tools">
                     <button class="btn btn-outline-primary" type="button" onclick="abrirModalRegistrar()">
                        <i class="fa fa-plus fa-fw" aria-hidden="true"></i> Registrar
                     </button>
                  </div>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-12 table-responsive">
                        <table id="tabla_usuario_simple" class="table table-sm text-center table-striped table-hover" width="100%" style="text-align:center;">
                           <style>
                              #tabla_usuario_simple {
                                 text-align: center;
                                 width: 100%;
                                 font-size: 14px;
                                 color: #000000;
                              }
                           </style>
                           <thead>
                              <tr class="text-md" style="font-weight: 800;">
                                 <th>#</th>
                                 <th>DNI</th>
                                 <th>APE PATERNO</th>
                                 <th>APE MATERNO</th>
                                 <th>NOMBRE</th>
                                 <th>ROL</th>
                                 <th>ESTADO</th>
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
            <h5 class="modal-title text-bold text-lg" style="color:#000000;" id="exampleModalLabel">Registro de Usuarios</h5>
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
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">DNI</label>
                  <input type="text" id="txt_dni" placeholder="Ingrese DNI" class="form-control" maxlength="8" onkeypress="return soloNumeros(event);">
               </div>
               <div class="col-6">
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">APELLIDO PATERNO</label>
                  <input type="text" id="txt_apepat" placeholder="Ingrese apellido paterno" class="form-control" onkeypress="return soloLetras(event);">
               </div>
               <div class="col-6">
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">APELLIDO MATERNO</label>
                  <input type="text" id="txt_apemat" placeholder="Ingrese apellido materno" class="form-control" onkeypress="return soloLetras(event);">
               </div>
               <div class="col-6">
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">NOMBRE</label>
                  <input type="text" id="txt_nombre" placeholder="Ingrese el nombre" class="form-control" onkeypress="return soloLetras(event);">
               </div>
               <div class="col-6">
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">CONTRASEÑA</label>
                  <input type="password" id="txt_contra" placeholder="Ingrese contraseña" class="form-control">
               </div>
               <div class="col-6">
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">ROL</label>
                  <select class="form-control js-example-basic-single" id="cbm_rol" style="width: 100%;">
                     <option value="ADMIN">ADMINISTRADOR</option>
                     <option value="CONTADOR">CONTADOR</option>
                  </select>
               </div>
            </div>
         </div>
         <div class="modal-footer" style="background: #ffffff">
            <button type="button" class="btn btn-primary btn-sm" onclick="registrarUsuario()"><i class="fa fa-check"></i> Registrar</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"> <i class="fa fa-undo "></i> Cancelar</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modalModificar" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content bg-default">
         <div class="modal-header">
            <h5 class="modal-title text-bold text-lg" style="color:#000000;" id="exampleModalLabel">Modificar Usuarios</h5>
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
                  <input type="text" id="id_usuario" hidden>
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">DNI</label>
                  <input type="text" id="txt_dniE" placeholder="Ingrese DNI" class="form-control" maxlength="8" onkeypress="return soloNumeros(event);" disabled>
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
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">CONTRASEÑA</label>
                  <input type="password" id="txt_contraE" placeholder="Ingrese contraseña" class="form-control" disabled>
               </div>
               <div class="col-6">
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">ROL</label>
                  <select class="form-control js-example-basic-single" id="cbm_rolE" style="width: 100%;">
                     <option value="ADMIN">ADMIN</option>
                     <option value="CONTADOR">CONTADOR</option>
                  </select>
               </div>
            </div>
         </div>
         <div class="modal-footer" style="background: #ffffff">
            <button type="button" class="btn btn-primary btn-sm" onclick="modificarUsuario()"><i class="fa fa-check"></i> Modificar</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"> <i class="fa fa-undo "></i> Cancelar</button>
         </div>
      </div>
   </div>
</div>



<script>
   listarUsuario();
   $(document).ready(function() {
      $('.js-example-basic-single').select2();
   })
</script>