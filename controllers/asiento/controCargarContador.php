<?php
require '../../models/asientoModelo.php';
$UM = new asientoModelo();
$consultar = $UM->cargarUsuario();
echo json_encode($consultar);
