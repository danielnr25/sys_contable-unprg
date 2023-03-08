<?php
require '../../models/asientoModelo.php';
$UM = new asientoModelo();


$numero = mb_strtoupper(htmlspecialchars($_POST['numero'], ENT_QUOTES ,'UTF-8'));
$fecha = mb_strtoupper(htmlspecialchars($_POST['fecha'], ENT_QUOTES ,'UTF-8'));
$glosa = mb_strtoupper(htmlspecialchars($_POST['glosa'], ENT_QUOTES ,'UTF-8'));
$estado = mb_strtoupper(htmlspecialchars($_POST['estado'], ENT_QUOTES ,'UTF-8'));
$tipo = mb_strtoupper(htmlspecialchars($_POST['tipo'], ENT_QUOTES ,'UTF-8'));
$contador = mb_strtoupper(htmlspecialchars($_POST['contador'], ENT_QUOTES ,'UTF-8'));
$operacion = mb_strtoupper(htmlspecialchars($_POST['operacion'], ENT_QUOTES ,'UTF-8'));
$periodo = mb_strtoupper(htmlspecialchars($_POST['periodo'], ENT_QUOTES ,'UTF-8'));

$resultado = $UM->registrarAsiento($numero,$fecha, $glosa, $estado, $tipo, $contador, $operacion, $periodo);
echo $resultado;

?>