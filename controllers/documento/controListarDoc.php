<?php 

require '../../models/documentoModelo.php';

$OPM = new documentoModelo();
$consultar  = $OPM->listarDocumento();

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