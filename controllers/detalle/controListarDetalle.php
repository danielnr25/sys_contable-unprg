<?php 

require '../../models/detalleModelo.php';

$OPM = new detalleModelo();
$consultar  = $OPM->listardetalle();

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