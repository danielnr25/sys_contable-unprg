<?php 
   require '../../models/IdentidadModelo.php';
   $TAM = new identidadModelo();
   $id = mb_strtoupper(htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8'));
   $nombre = mb_strtoupper(htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8'));
   $resultado = $TAM->modificarIdentidad($id, $nombre);
   echo $resultado;

?>