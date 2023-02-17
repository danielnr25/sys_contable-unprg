<?php 
   require '../../models/operacionModelo.php';

   $OPM = new operacionModelo();
   $codigo = mb_strtoupper(htmlspecialchars($_POST['codigo'], ENT_QUOTES, 'UTF-8'));
   $nombre = mb_strtoupper(htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8'));
   $resultado = $OPM->registrarOperacion($codigo,$nombre);
   echo $resultado;
?>
