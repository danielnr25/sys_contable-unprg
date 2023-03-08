<?php 

require '../../models/asientoModelo.php';

$OPM = new asientoModelo();
$consultar  = $OPM->listarAsiento();

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