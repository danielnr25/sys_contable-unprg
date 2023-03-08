<?php
require '../../models/detalleModelo.php';
$UM = new detalleModelo();
$consultar = $UM->cargarCuenta();
echo json_encode($consultar);
