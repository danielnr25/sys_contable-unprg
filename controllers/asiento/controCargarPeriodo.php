<?php
require '../../models/asientoModelo.php';
$UM = new asientoModelo();
$consultar = $UM->cargarPeriodo();
echo json_encode($consultar);
