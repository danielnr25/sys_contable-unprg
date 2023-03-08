<?php 
   require '../../models/detalleModelo.php';

   $OPM = new detalleModelo();

   $debe = mb_strtoupper(htmlspecialchars($_POST['debe'], ENT_QUOTES, 'UTF-8'));
   $haber = mb_strtoupper(htmlspecialchars($_POST['haber'], ENT_QUOTES, 'UTF-8'));
   //$sol = mb_strtoupper(htmlspecialchars($_POST['sol'], ENT_QUOTES, 'UTF-8'));
   //$dol = mb_strtoupper(htmlspecialchars($_POST['dol'], ENT_QUOTES, 'UTF-8'));
   //$moneda = mb_strtoupper(htmlspecialchars($_POST['moneda'], ENT_QUOTES, 'UTF-8'));
   $asiento = mb_strtoupper(htmlspecialchars($_POST['asiento'], ENT_QUOTES, 'UTF-8'));
   $doc = mb_strtoupper(htmlspecialchars($_POST['doc'], ENT_QUOTES, 'UTF-8'));
   $cuenta = mb_strtoupper(htmlspecialchars($_POST['cuenta'], ENT_QUOTES, 'UTF-8'));
   //$tipo = mb_strtoupper(htmlspecialchars($_POST['tipo'], ENT_QUOTES, 'UTF-8'));

   $resultado = $OPM->registrardetalle($haber,$debe, $asiento,$doc,$cuenta);
   echo $resultado;
?>
