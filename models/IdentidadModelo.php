<?php 

require_once 'conexionModelo.php';

class identidadModelo extends conexionBD{

   function listarIdentidad(){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_listarIdentidad()";

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

   function registrarIdentidad($nombre){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_registrarIdentidad(?)";

      $query = $c->prepare($sql);
      $query->bindParam(1, $nombre);
      $query->execute();
      
      if ($row = $query->fetchColumn()){
         return $row;
      }
      conexionBD::cerrarBD();
   }

   function modificarIdentidad($id, $nombre){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_modificarIdentidad(?, ?)";

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