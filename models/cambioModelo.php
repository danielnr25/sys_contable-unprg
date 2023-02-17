<?php 

require_once 'conexionModelo.php';

class cambioModelo extends conexionBD{

   function listarCambio(){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_listarCambio()";

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

   function registrarCambio($fecha, $compra, $venta){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_registrarCambio(?,?,?)";

      $query = $c->prepare($sql);
      $query->bindParam(1, $fecha);
      $query->bindParam(2, $compra);
      $query->bindParam(3, $venta);
      $query->execute();
      
      if ($row = $query->fetchColumn()){
         return $row;
      }
      conexionBD::cerrarBD();
   }

   function modificarCambio($id, $fecha, $compra, $venta){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_modificarCambio(?,?,?,?)";

      $query = $c->prepare($sql);
      $query->bindParam(1, $id);
      $query->bindParam(2, $fecha);
      $query->bindParam(3, $compra);
      $query->bindParam(4, $venta);
      $query->execute();
      
      if ($row = $query->fetchColumn()){
         return $row;
      }
      conexionBD::cerrarBD();
   }

}
