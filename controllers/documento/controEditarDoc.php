<?php 
require '../../models/documentoModelo.php';

$DM = new documentoModelo();

$id = mb_strtoupper(htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8'));
$tipo = mb_strtoupper(htmlspecialchars($_POST['tipo'],ENT_QUOTES ,'UTF-8'));
$serie = mb_strtoupper(htmlspecialchars($_POST['serie'],ENT_QUOTES ,'UTF-8'));
$correlativo = mb_strtoupper(htmlspecialchars($_POST['correlativo'],ENT_QUOTES ,'UTF-8'));
$femi = mb_strtoupper(htmlspecialchars($_POST['femision'],ENT_QUOTES ,'UTF-8'));
$concepto = mb_strtoupper(htmlspecialchars($_POST['concepto'],ENT_QUOTES ,'UTF-8'));
$cuenta = mb_strtoupper(htmlspecialchars($_POST['cuenta'],ENT_QUOTES ,'UTF-8'));

$resultado = $DM->modificarDocumento($id, $tipo, $serie, $correlativo,$femi,$concepto,$cuenta);
echo $resultado;

?>