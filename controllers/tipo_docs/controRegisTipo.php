<?php 
   require '../../models/identidadModelo.php';

   $TAM = new identidadModelo();
   $nombre = mb_strtoupper(htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8'));
   $resultado = $TAM->registrarIdentidad($nombre);
   echo $resultado;
?>
