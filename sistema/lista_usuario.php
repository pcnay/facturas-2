<?php
  include "../conexion.php"

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "include/scripts.php"; ?>
	<title>Lista De Usuarios</title>
</head>
<body>
	<?php include "include/header.php" ?>

	<section id="container">
		<h1>LISTA DE USUARIOS</h1>
    <a href="registro_usuario.php" class="btn_new">Crear Usuario</a>
    <table>
      <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>CORREO</th>
        <th>USUARIO</th>
        <th>ROL</th>
        <th>ACCIONES</th>        
      </tr>

      <?php

        // Seccion del paginador 
        $sql_registe = mysqli_query ($conection,"SELECT COUNT(*) AS total_registro FROM usuario WHERE estatus=1");
        $result_register = mysqli_fetch_array($sql_registe);
        $total_registro = $result_register['total_registro'];
        $por_pagina = 5;

        // Este valor es que se pasara por la URL, cuando se oprime un número del paginador.
        if (empty ($_GET['pagina']))
        {
          $pagina = 1;
        }
        else
        {
          $pagina = $_GET['pagina'];
        }
        $desde = ($pagina-1)*$por_pagina;
        $total_paginas = ceil($total_registro/$por_pagina);        
        
        $query = mysqli_query($conection,"SELECT u.idusuario,u.nombre,u.correo,u.usuario,r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE u.estatus = 1 ORDER BY u.nombre ASC LIMIT $desde,$por_pagina");


        $result = mysqli_num_rows($query);
        if ($result >0)
        {
          while ($data = mysqli_fetch_array($query))
          {
       ?>
            <tr>
              <td><?php echo $data['idusuario']; ?></td>
              <td><?php echo $data['nombre']; ?></td>
              <td><?php echo $data['correo']; ?></td>
              <td><?php echo $data['usuario']; ?></td>
              <td><?php echo $data['rol']; ?></td>
              <td>
                <!-- Se pasa el "Id" del usuario al archivo "editar_usuario"-->
                <a class="link_edit" href="editar_usuario.php?id=<?php echo $data['idusuario']; ?>">Editar</a>
                
                <!-- NO permite borrar al Usuario Administrador principal. -->
                <?php if ($data['idusuario'] != 1) { ?>
                    |              
                    <a class="link_delete" href="eliminar_usuario.php?id=<?php echo $data['idusuario']; ?>">Eliminar</a>
                <?php } ?>
              </td>
            </tr>
      <?php      
          } // if ($result >0)

        } // while ($data = mysqli_fetch_array($query))
      ?>

    </table>

    <!-- Es la sección de Páginador. -->
    <div class="paginador">
      <ul>
        <li><a href="#">|<</a></li>
        <li><a href="#"><<</a></li>
        <li class="pageSelected" >1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">>></a></li>
        <li><a href="#">>|</a></li>
      </ul>
    </div>

	</section>
	
	<?php include "include/footer.php"; ?>

</body>
</html>