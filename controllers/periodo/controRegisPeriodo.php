<?php 
   require '../../models/periodoModelo.php';

   $TAM = new periodoModelo();
   $year = mb_strtoupper(htmlspecialchars($_POST['year'], ENT_QUOTES, 'UTF-8'));
   $finicio = htmlspecialchars($_POST['finicio'], ENT_QUOTES, 'UTF-8');
   $ffin = htmlspecialchars($_POST['ffin'], ENT_QUOTES, 'UTF-8');
   $resultado = $TAM->registrarPeriodo($year, $finicio,$ffin);
   echo $resultado;
?>
