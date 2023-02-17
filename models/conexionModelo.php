<?php

class conexionBD
{
   private $host   = "localhost";
   private $user   = "root";
   private $pass   = "";
   private $bdname = "db_syscontable";
   private $pdo;

   public function conectarBD()
   {
      try {
         $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->bdname", $this->user, $this->pass);
         $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $this->pdo->exec("SET NAMES 'UTF8'");
         /* echo 'Conectado a la base de datos'; */
         return $this->pdo;
      } catch (PDOException $e) {
         echo 'Falló la conexion: ' . $e;
      }
   }
   function cerrarBD()
   {
      $this->pdo = null;
   }
}
