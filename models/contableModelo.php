<?php 

require_once 'conexionModelo.php';

class contableModelo extends conexionBD{

   function listarContable(){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_listarContable()";

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

   function registrarContable($numero, $nombre,$moneda){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_registrarContable(?,?,?)";

      $query = $c->prepare($sql);
      $query->bindParam(1, $numero);
      $query->bindParam(2, $nombre);
      $query->bindParam(3, $moneda);
      $query->execute();
      
      if ($row = $query->fetchColumn()){
         return $row;
      }
      conexionBD::cerrarBD();
   }

   function modificarContable($id, $numero, $nombre,$moneda){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_modificarContable(?,?,?,?)";

      $query = $c->prepare($sql);
      $query->bindParam(1, $id);
      $query->bindParam(2, $numero);
      $query->bindParam(3, $nombre);
      $query->bindParam(4, $moneda);
      $query->execute();
      
      if ($row = $query->fetchColumn()){
         return $row;
      }
      conexionBD::cerrarBD();
   }

}

?>