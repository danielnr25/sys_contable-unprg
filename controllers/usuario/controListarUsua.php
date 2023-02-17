<?php 

require '../../models/usuarioModelo.php';
$UM = new UsuarioModelo();
$consulta = $UM->listarUsuario();

if(count($consulta) > 0){
   echo json_encode($consulta);
}else{
   echo '{
      "sEcho": 1,
      "iTotalRecords": "0",
      "iTotalDisplayRecords": "0",
      "aaData": []
   }';
}

?>
