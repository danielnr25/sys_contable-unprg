<?php 
   require '../../models/contableModelo.php';
   $OPM = new contableModelo();
   $id = mb_strtoupper(htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8'));
   $numero = mb_strtoupper(htmlspecialchars($_POST['numero'], ENT_QUOTES, 'UTF-8'));
   $nombre = mb_strtoupper(htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8'));
   $moneda = mb_strtoupper(htmlspecialchars($_POST['moneda'], ENT_QUOTES, 'UTF-8'));
   $resultado = $OPM->modificarContable($id,$numero, $nombre,$moneda);
   echo $resultado;

?>