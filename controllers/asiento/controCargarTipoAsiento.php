<?php
require '../../models/asientoModelo.php';
$UM = new asientoModelo();
$consultar = $UM->cargarTipoAsiento();
echo json_encode($consultar);
