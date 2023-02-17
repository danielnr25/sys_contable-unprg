<?php 

require '../../models/operacionModelo.php';

$OPM = new operacionModelo();
$consultar  = $OPM->listarOperacion();

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