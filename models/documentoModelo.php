<?php 

require_once 'conexionModelo.php';

class documentoModelo extends conexionBD{

   function listarDocumento(){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_listarDocumento()";

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

   function cargarDocumento()
   {
      $c = conexionBD::conectarBD();

      $sql = "CALL sp_cargarDocumento()";

      $arreglo = array();
      $query = $c->prepare($sql);
      $query->execute();

      $resultado = $query->fetchAll();
      foreach ($resultado as $resu) {
         $arreglo[] = $resu;
      }
      return $arreglo;

      conexionBD::cerrarBD();
   }

   function registrarDocumento($tipo, $serie, $correlativo,$femision,$concepto,$cuenta){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_registrarDocumento(?,?,?,?,?,?)";

      $query = $c->prepare($sql);
      $query->bindParam(1, $tipo);
      $query->bindParam(2, $serie);
      $query->bindParam(3, $correlativo);
      $query->bindParam(4, $femision);
      $query->bindParam(5, $concepto);
      $query->bindParam(6, $cuenta);

      $query->execute();
      
      if ($row = $query->fetchColumn()){
         return $row;
      }
      conexionBD::cerrarBD();
   }

   function modificarDocumento($id,$tipo, $serie, $correlativo,$femision,$concepto,$cuenta ){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_modificarDocumento(?,?,?,?,?,?,?)";

      $query = $c->prepare($sql);
      $query->bindParam(1, $id);
      $query->bindParam(2, $tipo);
      $query->bindParam(3, $serie);
      $query->bindParam(4, $correlativo);
      $query->bindParam(5, $femision);
      $query->bindParam(6, $concepto);
      $query->bindParam(7, $cuenta);
      
      $query->execute();
      
      if ($row = $query->fetchColumn()){
         return $row;
      }
      conexionBD::cerrarBD();
   }

}
