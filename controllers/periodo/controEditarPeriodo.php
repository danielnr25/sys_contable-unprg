<?php 
   require '../../models/periodoModelo.php';
   $TAM = new periodoModelo();
   $id = mb_strtoupper(htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8'));
   $year = mb_strtoupper(htmlspecialchars($_POST['year'], ENT_QUOTES, 'UTF-8'));
   $finicio = htmlspecialchars($_POST['finicio'], ENT_QUOTES, 'UTF-8');
   $ffin = htmlspecialchars($_POST['ffin'], ENT_QUOTES, 'UTF-8');
   $estado = mb_strtoupper(htmlspecialchars($_POST['estado'], ENT_QUOTES, 'UTF-8'));
   $resultado = $TAM->modificarPeriodo($id, $year, $finicio, $ffin, $estado);
   echo $resultado;

?>