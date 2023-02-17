<?php 
   require '../../models/operacionModelo.php';
   $OPM = new operacionModelo();
   $id = mb_strtoupper(htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8'));
   $codigo = mb_strtoupper(htmlspecialchars($_POST['codigo'], ENT_QUOTES, 'UTF-8'));
   $nombre = mb_strtoupper(htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8'));
   $resultado = $OPM->modificarOperacion($id,$codigo, $nombre);
   echo $resultado;

?>