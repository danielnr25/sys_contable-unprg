<?php 
   require '../../models/cambioModelo.php';

   $OPM = new cambioModelo();
   $fecha = mb_strtoupper(htmlspecialchars($_POST['fecha'], ENT_QUOTES, 'UTF-8'));
   $compra = mb_strtoupper(htmlspecialchars($_POST['compra'], ENT_QUOTES, 'UTF-8'));
   $venta = mb_strtoupper(htmlspecialchars($_POST['venta'], ENT_QUOTES, 'UTF-8'));
   
   $resultado = $OPM->registrarCambio($fecha,$compra,$venta);
   echo $resultado;
?>
