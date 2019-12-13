<?php
	// session_start();
  
  // Valida que existe sesion para mostrar el menu del sistema. 
  if (empty($_SESSION['active']))
  {
    // Regresa un nivel para ejecutar el archivo "index.php"
    header('location: ../index.php');
  }

?>
<header>
		<div class="header">
			
			<h1>Sistema Facturación</h1>
			<div class="optionsBar">
				<p>Tijuana, <?php echo fechaC(); ?> </p>
				<span>|</span>
				<span class="user"><?php echo $_SESSION['usuario'].' - '.$_SESSION['rol']; ?></span>
				<img class="photouser" src="img/user.png" alt="Usuario">
				<a href="salir.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Salir"></a>
			</div>
		</div>
    <!-- Muestra las opciones del menu. -->
    <?php include "nav.php"?>
	</header>
