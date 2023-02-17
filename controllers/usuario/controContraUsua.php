<?php 
   require "../../models/usuarioModelo.php";
   $MU = new UsuarioModelo();

   $id =  htmlspecialchars($_POST['idusu'], ENT_QUOTES, 'UTF-8');

$contra =  password_hash($_POST['contran'], PASSWORD_DEFAULT, ['cost' => 12]);

$consultar = $MU->modContraUsuario($id, $contra);
echo $consultar;
?>