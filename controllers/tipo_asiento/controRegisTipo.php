<?php 
   require '../../models/tipoAsientoModelo.php';

   $TAM = new tipoAsientoModelo();
   $nombre = mb_strtoupper(htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8'));
   $resultado = $TAM->registrarTipoAsiento($nombre);
   echo $resultado;
?>
