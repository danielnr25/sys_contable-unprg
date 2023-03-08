<?php
require '../../models/detalleModelo.php';
$UM = new detalleModelo();
$consultar = $UM->cargarDoc();
echo json_encode($consultar);
