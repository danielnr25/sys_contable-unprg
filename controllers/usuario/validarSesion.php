<?php 

$id_usu  = htmlspecialchars($_POST['id_usu'], ENT_QUOTES, 'UTF-8');
$usuario = htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8');
$rol     = htmlspecialchars($_POST['rol'], ENT_QUOTES, 'UTF-8');
$apemat  = htmlspecialchars($_POST['apemat'], ENT_QUOTES, 'UTF-8');
$apepat  = htmlspecialchars($_POST['apepat'], ENT_QUOTES, 'UTF-8');
$nombre  = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
$pass    = htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8');
$nusuario= htmlspecialchars($_POST['nusuario'], ENT_QUOTES, 'UTF-8');

session_start();
$_SESSION['S_IDUSUARIO_SC'] = $id_usu;
$_SESSION['S_USUARIO_SC']   = $usuario; // This is the dni
$_SESSION['S_ROL_SC']       = $rol; // This is the rol
$_SESSION['S_APEMAT_SC']    = $apemat; // This is the last name
$_SESSION['S_APEPAT_SC']    = $apepat; // This is the last name
$_SESSION['S_NOMBRE_SC']    = $nombre; // This is the name
$_SESSION['S_PASS_SC']      = $pass; // This is the pass
$_SESSION['S_NUSUARIO_SC']  = $nusuario; // This is the name of the user
?>

