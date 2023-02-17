<?php 

require '../../models/usuarioModelo.php';
$UM = new UsuarioModelo();

$idUsu   = mb_strtoupper(htmlspecialchars($_POST['idUsu'],ENT_QUOTES ,'UTF-8'));
$codigoE = mb_strtoupper(htmlspecialchars($_POST['codigoE'],ENT_QUOTES ,'UTF-8'));
$apepatE = mb_strtoupper(htmlspecialchars($_POST['apepatE'],ENT_QUOTES ,'UTF-8'));
$apematE = mb_strtoupper(htmlspecialchars($_POST['apematE'],ENT_QUOTES ,'UTF-8'));
$nombreE = mb_strtoupper(htmlspecialchars($_POST['nombreE'],ENT_QUOTES ,'UTF-8'));
$rolE    = mb_strtoupper(htmlspecialchars($_POST['rolE'],ENT_QUOTES ,'UTF-8'));

$consulta = $UM->modificarUsuario($idUsu, $codigoE,$apepatE, $apematE, $nombreE, $rolE);
echo $consulta;

?>