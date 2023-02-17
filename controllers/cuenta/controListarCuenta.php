<?php 

require '../../models/cuentaModelo.php';

$OPM = new cuentaModelo;
$consultar  = $OPM->listarCuenta();

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