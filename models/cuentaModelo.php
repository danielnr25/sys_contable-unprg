<?php 

require_once 'conexionModelo.php';

class cuentaModelo extends conexionBD{

   function listarCuenta(){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_listarCuenta()";

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

   function cargarIdentidad()
   {
      $c = conexionBD::conectarBD();

      $sql = "CALL sp_cargarIdentidad()";

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

   function registrarCuenta($identidad, $apepat, $apemat, $nombre,$razon,$direccion,$tipo){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_registrarCuenta(?,?,?,?,?,?,?)";

      $query = $c->prepare($sql);
      $query->bindParam(1, $identidad);
      $query->bindParam(2, $apepat);
      $query->bindParam(3, $apemat);
      $query->bindParam(4, $nombre);
      $query->bindParam(5, $razon);
      $query->bindParam(6, $direccion);
      $query->bindParam(7, $tipo);
      $query->execute();
      
      if ($row = $query->fetchColumn()){
         return $row;
      }
      conexionBD::cerrarBD();
   }

   function modificarCuenta($id, $identidad, $apepat, $apemat, $nombre,$razon,$direccion,$tipo){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_modificarCuenta(?,?,?,?,?,?,?,?)";

      $query = $c->prepare($sql);
      $query->bindParam(1, $id);
      $query->bindParam(2, $identidad);
      $query->bindParam(3, $apepat);
      $query->bindParam(4, $apemat);
      $query->bindParam(5, $nombre);
      $query->bindParam(6, $razon);
      $query->bindParam(7, $direccion);
      $query->bindParam(8, $tipo);

      $query->execute();
      
      if ($row = $query->fetchColumn()){
         return $row;
      }
      conexionBD::cerrarBD();
   }

}
