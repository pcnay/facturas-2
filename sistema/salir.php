<?php
  session_start();
  session_destroy();
  // Regresa un nivel, para ejecutar de forma automatica el archivo "index.php"
  header('location: ../');
?> 