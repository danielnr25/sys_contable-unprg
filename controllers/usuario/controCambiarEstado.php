<?php 
require '../../models/usuarioModelo.php';
$UM = new UsuarioModelo();

$id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
$estado = htmlspecialchars($_POST['estado'], ENT_QUOTES, 'UTF-8');

$consulta = $UM->modificarEstado($id, $estado);
echo $consulta;

?>