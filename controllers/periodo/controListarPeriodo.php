<?php 

require '../../models/periodoModelo.php';

$TAM = new periodoModelo();
$consultar  = $TAM->listarPeriodo();

if (count($consultar) > 0) {
   echo json_encode($consultar);
} else {
   echo '{
      "sEcho": 1,
      "iTotalRecords": "0",
      "iTotalDisplayRecords": "0",
      "aaData": []
   }';
}

?>