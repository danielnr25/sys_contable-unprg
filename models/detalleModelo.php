<?php 

require_once 'conexionModelo.php';

class detalleModelo extends conexionBD{

   function listardetalle(){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_listardetalle()";

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

   function registrardetalle($haber,$debe, $asiento,$doc,$cuenta){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_registrardetalle(?,?,?,?,?)";

      $query = $c->prepare($sql);
      //$query->bindParam(1, $moneda);
      $query->bindParam(1, $haber);
      $query->bindParam(2, $debe);
      $query->bindParam(3, $asiento);
      $query->bindParam(4, $doc);
      $query->bindParam(5, $cuenta);
      $query->execute();
      
      if ($row = $query->fetchColumn()){
         return $row;
      }
      conexionBD::cerrarBD();
   }

   function modificardetalle($id, $numero, $nombre,$moneda){

      $c = conexionBD::conectarBD();

      $sql = "CALL sp_modificardetalle(?,?,?,?)";

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

   function cargarAsiento()
   {
      $c = conexionBD::conectarBD();

      $sql = "CALL sp_listarAsiento()";

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

   function cargarDoc()
   {
      $c = conexionBD::conectarBD();

      $sql = "CALL sp_listarDocumento()";

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

   function cargarTipoCambio()
   {
      $c = conexionBD::conectarBD();

      $sql = "CALL sp_listarCambio()";

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

   function cargarCuenta()
   {
      $c = conexionBD::conectarBD();

      $sql = "CALL sp_listarContable()";

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
}

?>