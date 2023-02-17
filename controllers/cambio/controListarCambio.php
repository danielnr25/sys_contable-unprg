<?php 

require '../../models/cambioModelo.php';

$OPM = new cambioModelo();
$consultar  = $OPM->listarCambio();

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