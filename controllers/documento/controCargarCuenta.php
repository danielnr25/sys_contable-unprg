<?php
require '../../models/documentoModelo.php';
$UM = new documentoModelo();
$consultar = $UM->cargarDocumento();
echo json_encode($consultar);
