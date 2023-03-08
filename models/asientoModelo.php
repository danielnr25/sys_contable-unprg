<?php 

require_once 'conexionModelo.php';

class asientoModelo extends conexionBD{

   function listarAsiento(){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_listarAsiento()";

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

   function cargarTipoAsiento()
   {
      $c = conexionBD::conectarBD();

      $sql = "CALL sp_listarTipoAsiento()";

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

   function cargarUsuario()
   {

      $c = conexionBD::conectarBD();
      $sql = "CALL sp_listarUsuario()";

      $arreglo = array();
      $query = $c->prepare($sql);
      $query->execute();

      $resultado = $query->fetchAll();
      foreach ($resultado as $resp) {
         $arreglo[] = $resp;
      }
      return $arreglo;
      conexionBD::cerrarBD();
   }

   function cargarOperacion(){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_listarOperacion()";

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

   function cargarPeriodo(){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_listarPeriodo()";

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

   function registrarAsiento($numero,$fecha, $glosa, $estado, $tipo, $contador, $operacion, $periodo){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_registrarAsiento(?,?,?,?,?,?,?,?)";

      $query = $c->prepare($sql);
      $query->bindParam(1, $numero);
      $query->bindParam(2, $fecha);
      $query->bindParam(3, $glosa);
      $query->bindParam(4, $estado);
      $query->bindParam(5, $tipo);
      $query->bindParam(6, $contador);
      $query->bindParam(7, $operacion);
      $query->bindParam(8, $periodo);

      $query->execute();
      
      if ($row = $query->fetchColumn()){
         return $row;
      }
      conexionBD::cerrarBD();
   }

   function modificarAsiento($id,$numero,$fecha, $glosa, $estado, $tipo, $contador, $operacion, $periodo){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_modificarAsiento(?,?,?,?,?,?,?,?,?)";

      $query = $c->prepare($sql);
      $query->bindParam(1, $id);
      $query->bindParam(2, $numero);
      $query->bindParam(3, $fecha);
      $query->bindParam(4, $glosa);
      $query->bindParam(5, $estado);
      $query->bindParam(6, $tipo);
      $query->bindParam(7, $contador);
      $query->bindParam(8, $operacion);
      $query->bindParam(9, $periodo);
      $query->execute();
      
      if ($row = $query->fetchColumn()){
         return $row;
      }
      conexionBD::cerrarBD();
   }

}
