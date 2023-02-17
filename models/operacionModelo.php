<?php 

require_once 'conexionModelo.php';

class operacionModelo extends conexionBD{

   function listarOperacion(){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_listarOperacion()";

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

   function registrarOperacion($codigo, $nombre){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_registrarOperacion(?,?)";

      $query = $c->prepare($sql);
      $query->bindParam(1, $codigo);
      $query->bindParam(2, $nombre);
      $query->execute();
      
      if ($row = $query->fetchColumn()){
         return $row;
      }
      conexionBD::cerrarBD();
   }

   function modificarOperacion($id, $codigo, $nombre){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_modificarOperacion(?,?,?)";

      $query = $c->prepare($sql);
      $query->bindParam(1, $id);
      $query->bindParam(2, $codigo);
      $query->bindParam(3, $nombre);
      $query->execute();
      
      if ($row = $query->fetchColumn()){
         return $row;
      }
      conexionBD::cerrarBD();
   }

}

?>