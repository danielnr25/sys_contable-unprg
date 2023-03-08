<?php
require '../../models/detalleModelo.php';
$UM = new detalleModelo();
$consultar = $UM->cargarTipoCambio();
echo json_encode($consultar);
