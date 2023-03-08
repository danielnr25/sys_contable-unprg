<?php 

require_once 'conexionModelo.php';

class reporteModelo extends conexionBD{


     public function Listar_Deta_Reporte()
     {
 
         $c = conexionBD::conectarBD();
  
         $sql = "CALL sp_listardetalle()";
         $arreglo = array();
         $query = $c->prepare($sql);
         $query->execute();
         $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
         foreach ($resultado as $rpta) {
             $arreglo[] = $rpta;
         }
         // echo $arreglo;
         return $arreglo;
          
         conexionBD::cerrarBD();
     }

}
