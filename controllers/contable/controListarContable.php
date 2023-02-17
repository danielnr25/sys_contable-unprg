<?php 

require '../../models/contableModelo.php';

$OPM = new contableModelo();
$consultar  = $OPM->listarContable();

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