<?php
require '../../models/cuentaModelo.php';
$UM = new cuentaModelo();
$consultar = $UM->cargarIdentidad();
echo json_encode($consultar);
