<?php
  $host = 'localhost';
  $user = 'root';
  $password = 'pcnay2003';
  $db = 'facturacion';
  $conection = @mysqli_connect($host,$user,$password,$db);
  if (!$conection)
  {
    echo "Error en la conexion";
  }

?>