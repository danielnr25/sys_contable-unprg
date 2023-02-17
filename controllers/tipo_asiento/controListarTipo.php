<?php 

require '../../models/tipoAsientoModelo.php';

$TAM = new tipoAsientoModelo();
$consultar  = $TAM->listarTipoAsiento();

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