<?php 
require '../../models/cuentaModelo.php';

$cuenta = new cuentaModelo();

$identidad = mb_strtoupper(htmlspecialchars($_POST['identidad'], ENT_QUOTES, 'UTF-8'));
$apepat = mb_strtoupper(htmlspecialchars($_POST['apepat'], ENT_QUOTES, 'UTF-8'));
$apemat = mb_strtoupper(htmlspecialchars($_POST['apemat'], ENT_QUOTES, 'UTF-8'));
$nombre = mb_strtoupper(htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8'));
$razon = mb_strtoupper(htmlspecialchars($_POST['razon'], ENT_QUOTES, 'UTF-8'));
$direccion = mb_strtoupper(htmlspecialchars($_POST['direccion'], ENT_QUOTES, 'UTF-8'));
$tipo = mb_strtoupper(htmlspecialchars($_POST['tipo'], ENT_QUOTES, 'UTF-8'));

$resultado = $cuenta->registrarCuenta($identidad, $apepat, $apemat, $nombre,$razon,$direccion,$tipo);
echo $resultado;

?>