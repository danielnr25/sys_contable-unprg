<?php 
session_start();
if(isset($_SESSION['S_IDUSUARIO_SC'])){
   header('location: views/index.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sistema Contable | Iniciar Sesion</title>
</head>

<body>

   <div class="background-radial-gradient overflow-hidden">
      <style>
         .background-radial-gradient {
            background-color: hsl(218, 41%, 15%);
            color: hsl(218, 41%, 15%);
            background-image: radial-gradient(650px circle at 0% 0%,
                  hsl(218, 41%, 35%) 15%,
                  hsl(218, 41%, 30%) 35%,
                  hsl(218, 41%, 20%) 75%,
                  hsl(218, 41%, 19%) 80%,
                  transparent 100%),
               radial-gradient(1250px circle at 100% 100%,
                  hsl(218, 41%, 45%) 15%,
                  hsl(218, 41%, 30%) 35%,
                  hsl(218, 41%, 20%) 75%,
                  hsl(218, 41%, 19%) 80%,
                  transparent 100%);
         }

         #radius-shape-1 {
            height: 220px;
            width: 220px;
            top: -60px;
            left: -130px;
            background: radial-gradient(#44006b, #ad1fff);
            overflow: hidden;
         }

         #radius-shape-2 {
            border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
            bottom: -60px;
            right: -110px;
            width: 300px;
            height: 300px;
            background: radial-gradient(#44006b, #ad1fff);
            overflow: hidden;
         }

         .bg-glass {
            background-color: hsla(0, 0%, 100%, 0.9) !important;
            backdrop-filter: saturate(200%) blur(25px);
         }
      </style>

      <div class="container px-4 px-md-5 text-center text-lg-start my-5" style="padding-bottom: 6.7rem;padding-top:5.2rem">
         <div class="row gx-lg-5 align-items-center mb-5">
            <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
               <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                  Bienvenido al Sistema <br />
                  <span style="color: hsl(218, 81%, 75%)">Gestión Contable </span>
               </h1>
               <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                  Temporibus, expedita iusto veniam atque, magni tempora mollitia
                  dolorum consequatur nulla, neque debitis eos reprehenderit quasi
                  ab ipsum nisi dolorem modi. Quos?
               </p>
            </div>

            <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
               <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
               <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

               <div class="card bg-glass">
                  <div class="card-body px-5 py-5 px-md-5">
                     <h3 class="text-center mb-4">Ingresar credenciales</h3>
                     <div class="form-outline mb-4">
                        <input type="text" id="txt_usuario" class="form-control" />
                        <label class="form-label">Usuario</label>
                     </div>
                     <div class="form-outline mb-4">
                        <input type="password" id="txt_contra" class="form-control" />
                        <label class="form-label">Contraseña</label>
                     </div>

                     <!-- Checkbox -->
                     <div class="form-check d-flex mb-4">
                        <input class="form-check-input" type="checkbox" value="" id="customCheckLogin" checked />
                        <label class="form-check-label" for="customCheckLogin">
                           Recordar contraseña
                        </label>
                     </div>

                     <!-- Submit button -->
                     <button type="button" class="btn btn-primary btn-block mb-4" onclick="signup()">
                        Iniciar Sesión
                     </button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Section: Design Block -->
   <script src="dist/js/bootstrap/jquery.min.js"></script>
   <script src="dist/js/bootstrap/bootstrap.bundle.min.js"></script>
   <script src="dist/js/bootstrap/bootstrap.min.js"></script>
   <!-- <script src="dist/js/bootstrap/sweetalert.min.js"></script> -->
   <script src="utils/sweetalert.js"></script>
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
   <script src="js/usuario.js?rev=<?php echo time(); ?>"></script>
   <!-- Google Fonts -->
   <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
   <!-- MDB -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet" />
   <!-- MDB -->
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
   <!-- Requerimientos JS -->
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <script>
      const rmcheck = document.getElementById('customCheckLogin'),
         usuarioinput = document.getElementById('txt_usuario'),
         passinput = document.getElementById('txt_contra');
      if (localStorage.checkbox && localStorage.checkbox !== "") {
         rmcheck.setAttribute("checked", "checked");
         usuarioinput.value = localStorage.usuario;
         passinput.value = localStorage.pass;
      } else {
         rmcheck.removeAttribute("checked");
         usuarioinput.value = "";
         passinput.value = "";

      }
   </script>
</body>

</html>