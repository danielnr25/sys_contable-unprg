<?php
session_start();
?>
<script src="../js/usuario.js?rev=<?php echo time() ?>"></script>
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
<div class="col-lg-12">
   <br>
   <div class="card">
      <div class="card-header">
         <strong class="card-title"><b style="color:rgb(79, 70, 229);">BIENVENIDO A SU PERFIL <?php echo $_SESSION['S_NUSUARIO_SC']; ?></b></strong>
      </div>
   </div>
   <div class="row">
      <div class="col-md-3">
         <div class="card card-secondary card-outline">
            <div class="card-body box-profile">
               <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="../templates/dist/img/user1-128x128.jpg" alt="User profile">
               </div>
               <h3 class="profile-username text-center"><?php echo $_SESSION['S_NUSUARIO_SC']; ?></h3>
               <p class="text-center"><b><?php echo $_SESSION['S_USUARIO_SC']; ?></b></p>
               <ul class="list-group list-group mb-2">
                  <li class="list-group-item list-group-item-light">
                     <b style="color:#1b2c39;">DNI</b> <a class="float-right" style="color:rgb(79, 70, 229);"><?php echo $_SESSION['S_USUARIO_SC']; ?></a>
                  </li>
                  <li class="list-group-item list-group-item-light">
                     <b style="color:#1b2c39;">NIVEL</b> <a class="float-right" style="color:rgb(79, 70, 229);"><?php echo $_SESSION['S_ROL_SC']; ?></a>
                  </li>
               </ul>
            </div>
         </div>
      </div>

      <div class="col-md-9">
         <div class="card  card-secondary card-outline">
            <div class="card-header">
               <strong class="car-title" style="color:black; text-align:center">INFORMACIÓN PERSONAL</strong>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-6">
                     <label for="">DNI:</label>
                     <input type="text" hidden>
                     <input type="text" value="<?php echo $_SESSION['S_USUARIO_SC']; ?>" readonly class="form-control">
                  </div>
                  <div class="col-6">
                     <label for="">NOMBRE:</label>
                     <input type="text" value="<?php echo $_SESSION['S_NOMBRE_SC']; ?>" readonly class="form-control">

                  </div>
                  <div class="col-6">
                     <label for="">APELLIDO PATERNO:</label>
                     <input type="text" value="<?php echo $_SESSION['S_APEPAT_SC'] ?>" readonly class="form-control">

                  </div>

                  <div class="col-6">
                     <label for="">APELLIDO MATERNO:</label>
                     <input type="text" value="<?php echo $_SESSION['S_APEMAT_SC']; ?>" readonly class="form-control">
                  </div>
                  <div class="col-6">
                     <label for="">ROL:</label>
                     <input type="text" value="<?php echo $_SESSION['S_ROL_SC']; ?>" readonly class="form-control">
                  </div>
                  <div class="col-3">
                     <label for="">CONTRASEÑA:</label>
                     <input type="password" value="<?php echo $_SESSION['S_PASS_SC']; ?>" readonly class="form-control">
                  </div>

                  <div class="col-3">
                     <label for="">&nbsp;</label>
                     <button class='btn btn-outline-success btn-sm' style="width:100%; height:52%" onclick="abrirEditarContra()"> <i class='fa-solid fa-pen-to-square'></i> Editar
                     </button>
                  </div>
               </div>
            </div>
         </div>

      </div>

      <div class="modal fade" id="modalEditarContraUsua" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: #154170">
               <div class="modal-header">
                  <h5 class="modal-title text-bold" id="exampleModalLabel" style="color:white;">Editar Contraseña
                     <label for="" id="lbl_usuario_contra"></label>
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body" style="background: #ffffff">
                  <div class="row">
                     <div class="col-12">
                        <input type="text" value="<?php echo $_SESSION['S_IDUSUARIO_SC']; ?>" id="id_usuap_edit" hidden>
                        <input type="text" value="<?php echo $_SESSION['S_USUARIO_SC']; ?>" readonly id="id_dni_validar" hidden>
                        <label for="">Contraseña actual</label>
                        <input type="password" id="txtContraAc" class="form-control">
                     </div>
                     <div class="col-12">
                        <label for="">Contraseña nueva </label>
                        <input type="password" id="txtContraNu" class="form-control">
                     </div>
                     <div class="col-12">
                        <label for="">Repita contraseña </label>
                        <input type="password" id="txtContraRe" class="form-control">
                     </div>
                  </div>
               </div>
               <div class="modal-footer" style="background: #ffffff">
                  <button type="button" class="btn btn-primary btn-sm" onclick="cambiarContra()"><i class="fa fa-check"> </i> Cambiar</button>
                  <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"> <i class="fa fa-undo "></i> Cancelar</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
   $(document).ready(function() {
      $('.js-example-basic-single').select2();
   });
</script>