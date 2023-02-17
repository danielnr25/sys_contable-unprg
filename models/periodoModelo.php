<?php 

require_once 'conexionModelo.php';

class periodoModelo extends conexionBD{

   function listarPeriodo(){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_listarPeriodo()";

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

   function registrarPeriodo($year, $finicio,$ffin){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_registrarPeriodo(?,?,?)";

      $query = $c->prepare($sql);
      $query->bindParam(1, $year);
      $query->bindParam(2, $finicio);
      $query->bindParam(3, $ffin);
      $query->execute();
      
      if ($row = $query->fetchColumn()){
         return $row;
      }
      conexionBD::cerrarBD();
   }

   function modificarPeriodo($id, $year, $finicio, $ffin, $estado){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_modificarPeriodo(?,?,?,?,?)";

      $query = $c->prepare($sql);
      $query->bindParam(1, $id);
      $query->bindParam(2, $year);
      $query->bindParam(3, $finicio);
      $query->bindParam(4, $ffin);
      $query->bindParam(5, $estado);
      $query->execute();
      
      if ($row = $query->fetchColumn()){
         return $row;
      }
      conexionBD::cerrarBD();
   }

}

?>