<?php 
   require '../../models/tipoAsientoModelo.php';
   $TAM = new tipoAsientoModelo();
   $id = mb_strtoupper(htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8'));
   $nombre = mb_strtoupper(htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8'));
   $resultado = $TAM->modificarTipoAsiento($id, $nombre);
   echo $resultado;

?>