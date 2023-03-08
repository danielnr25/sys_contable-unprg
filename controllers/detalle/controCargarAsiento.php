<?php
require '../../models/detalleModelo.php';
$UM = new detalleModelo();
$consultar = $UM->cargarAsiento();
echo json_encode($consultar);
