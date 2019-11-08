<?php
  require_once('Modelo.php');
   
  class ConexionBD extends Modelo
  {
    public function __construct()
    {
      $this->db_name = 'facturacion';
    }
    
  }
  $conexion = new ConexionBD();
  $this->set_query();

?>