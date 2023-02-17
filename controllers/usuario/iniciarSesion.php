<?php 
require '../../models/usuarioModelo.php';

$UM = new UsuarioModelo();
$usuario = htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8');
$contra = htmlspecialchars($_POST['contra'], ENT_QUOTES, 'UTF-8');
$datos = $UM->verificarUsuario($usuario, $contra);

if(count($datos) > 0){
   echo json_encode($datos);
}else{
   echo 0;
}

?>



