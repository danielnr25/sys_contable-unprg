<?php 

require '../../models/identidadModelo.php';

$TAM = new identidadModelo();
$consultar  = $TAM->listarIdentidad();

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