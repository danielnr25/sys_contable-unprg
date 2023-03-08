<?php
require '../../models/asientoModelo.php';
$UM = new asientoModelo();
$consultar = $UM->cargarOperacion();
echo json_encode($consultar);
