<?php 
require '../../models/usuarioModelo.php';

$UM = new UsuarioModelo();

$codigo = mb_strtoupper(htmlspecialchars($_POST['codigo'], ENT_QUOTES, 'UTF-8'));
$apepat = mb_strtoupper(htmlspecialchars($_POST['apepat'], ENT_QUOTES, 'UTF-8'));
$apemat = mb_strtoupper(htmlspecialchars($_POST['apemat'], ENT_QUOTES, 'UTF-8'));
$nombre = mb_strtoupper(htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8'));
$contra = password_hash(htmlspecialchars($_POST['contra'], ENT_QUOTES, 'UTF-8'), PASSWORD_DEFAULT,['cost'=>12]);
$rol = mb_strtoupper(htmlspecialchars($_POST['rol'], ENT_QUOTES, 'UTF-8'));

$respuesta = $UM->registrarUsuario($codigo, $apepat, $apemat, $nombre, $contra, $rol);
echo $respuesta;

?>