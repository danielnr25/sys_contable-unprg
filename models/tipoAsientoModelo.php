<?php 

require_once 'conexionModelo.php';

class tipoAsientoModelo extends conexionBD{

   function listarTipoAsiento(){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_listarTipoAsiento()";

      $arreglo = array();

      $query = $c->prepare($sql);
      $query->execute();

      $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
      foreach ($resultado as $resu) {
         $arreglo["data"][] = $resu;
      }
      return $arreglo;
      
      conexionBD::cerrarBD();

   }

   function registrarTipoAsiento($nombre){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_registrarTipoAsiento(?)";

      $query = $c->prepare($sql);
      $query->bindParam(1, $nombre);
      $query->execute();
      
      if ($row = $query->fetchColumn()){
         return $row;
      }
      conexionBD::cerrarBD();
   }

   function modificarTipoAsiento($id, $nombre){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_modificarTipoAsiento(?, ?)";

      $query = $c->prepare($sql);
      $query->bindParam(1, $id);
      $query->bindParam(2, $nombre);
      $query->execute();
      
      if ($row = $query->fetchColumn()){
         return $row;
      }
      conexionBD::cerrarBD();
   }

}

?>