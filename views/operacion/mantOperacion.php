<script src="../js/operacion.js?>rev<?php echo time(); ?>"></script>

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
            <h3 class="m-2" style="font-size: 1.8rem;color:#000006;">Tipo de  Operación Contable</h3>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="index.php">Home</a></li>
               <li class="breadcrumb-item active">Operación</li>
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
                  <h3 class="card-title text-lg mt-2"><b>Listado de Tipos de Operaciones Contables</b></h3>
                  <div class="card-tools">
                     <button class="btn btn-outline-primary" type="button" onclick="abrirModalRegistrar()">
                        <i class="fa fa-plus fa-fw" aria-hidden="true"></i> Registrar
                     </button>
                  </div>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-12 table-responsive">
                        <table id="tabla_operacion" class="table table-sm text-center table-striped table-hover" width="100%" style="text-align:center;">
                           <style>
                              #tabla_operacion {
                                 text-align: center;
                                 width: 100%;
                                 font-size: 14px;
                                 color: #000000;
                              }
                           </style>
                           <thead>
                              <tr class="text-md" style="font-weight: 800;">
                                 <th>#</th>
                                 <th>CODIGO</th>
                                 <th>NOMBRE</th>
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
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content bg-default">
         <div class="modal-header">
            <h5 class="modal-title text-bold text-lg" style="color:#000000;" id="exampleModalLabel">Registro de Tipo de Operación Contable</h5>
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
               <div class="col-12">
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">CODIGO</label>
                  <input type="text" id="txt_codigo" placeholder="Ingrese el código" class="form-control" maxlength="10">
               </div>
               <div class="col-12">
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">NOMBRE</label>
                  <input type="text" id="txt_nombre" placeholder="Ingrese el nombre" class="form-control">
               </div>
            </div>
         </div>
         <div class="modal-footer" style="background: #ffffff">
            <button type="button" class="btn btn-primary btn-sm" onclick="registrarOperacion()"><i class="fa fa-check"></i> Registrar</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"> <i class="fa fa-undo "></i> Cancelar</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modalModificar" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content bg-default">
         <div class="modal-header">
            <h5 class="modal-title text-bold text-lg" style="color:#000000;" id="exampleModalLabel">Modificar Tipo de Operación Contable</h5>
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
               <div class="col-12">
                  <input type="text" id="id_tipo" hidden>
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">CODIGO</label>
                  <input type="text" id="txt_codigoE" placeholder="Ingrese el código" class="form-control" maxlength="10">
               </div>
               <div class="col-12">
                  <label for="" class="text-md" style="color:#000000;font-weight: 700;">NOMBRE</label>
                  <input type="text" id="txt_nombreE" placeholder="Ingrese el nombre" class="form-control">
               </div>
            </div>
         </div>
         <div class="modal-footer" style="background: #ffffff">
            <button type="button" class="btn btn-primary btn-sm" onclick="modificarOperacion()"><i class="fa fa-check"></i> Modificar</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"> <i class="fa fa-undo "></i> Cancelar</button>
         </div>
      </div>
   </div>
</div>



<script>
   listar_operacion();
/*    $(document).ready(function() {
      $('.js-example-basic-single').select2();
   }); */
</script>