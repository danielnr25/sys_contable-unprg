<?php
require_once 'conexionModelo.php';

class UsuarioModelo extends conexionBD
{

   public function verificarUsuario($usuario, $pass)
   {

      $c = conexionBD::conectarBD();
      $sql = "CALL sp_verificarUsuario(?)";
      $arreglo = array();
      $query = $c->prepare($sql);
      $query->bindParam(1, $usuario);
      $query->execute();
      $resultado = $query->fetchAll();
      foreach ($resultado as $resp) {
         if (password_verify($pass, $resp['usu_contra'])) {
            $arreglo[] = $resp;
         }
      }
      return $arreglo;
      conexionBD::cerrarBD();
   }

   function listarUsuario()
   {

      $c = conexionBD::conectarBD();
      $sql = "CALL sp_listarUsuario()";

      $arreglo = array();
      $query = $c->prepare($sql);
      $query->execute();

      $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
      foreach ($resultado as $resp) {
         $arreglo["data"][] = $resp;
      }
      return $arreglo;
      conexionBD::cerrarBD();
   }

   function registrarUsuario($codigo, $apepat, $apemat, $nombre, $contra, $rol)
   {

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_registrarUsuario(?,?,?,?,?,?)";

      $query = $c->prepare($sql);
      $query->bindParam(1, $codigo);
      $query->bindParam(2, $apepat);
      $query->bindParam(3, $apemat);
      $query->bindParam(4, $nombre);
      $query->bindParam(5, $contra);
      $query->bindParam(6, $rol);
      $query->execute();

      $resultado = $query->rowCount();
      return $resultado;

      conexionBD::cerrarBD();
   }

   function modificarUsuario($idUsu, $codigoE, $apepatE, $apematE, $nombreE, $rolE)
   {

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_modificarUsuario(?,?,?,?,?,?)";

      $query = $c->prepare($sql);
      $query->bindParam(1, $idUsu);
      $query->bindParam(2, $codigoE);
      $query->bindParam(3, $apepatE);
      $query->bindParam(4, $apematE);
      $query->bindParam(5, $nombreE);
      $query->bindParam(6, $rolE);
      $query->execute();

      if ($row = $query->fetchColumn()) {
         return $row;
      }

      conexionBD::cerrarBD();
   }

   public function modificarEstado($id, $estado)
   {
      $c = conexionBD::conectarBD();

      $sql = "CALL sp_modificarEstado(?,?)";

      $query = $c->prepare($sql);
      $query->bindParam(1, $id);
      $query->bindParam(2, $estado);
      $resul = $query->execute();

      if ($resul) {
         return 1;
      } else {
         return 0;
      }

      conexionBD::cerrarBD();
   }

   function modContraUsuario($id, $contra)
   {

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_modificarContraUsuarios(?,?) ";


      $query = $c->prepare($sql);
      $query->bindParam(1, $id);
      $query->bindParam(2, $contra);

      $query->execute();
      if ($row = $query->fetchColumn()) {
         return $row;
      }

      conexionBD::cerrarBD();
   }
}

?>