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
        <th>ROL</th>
        <th>ACCIONES</th>        
      </tr>

      <?php
        $query = mysqli_query($conection,"SELECT u.idusuario,u.nombre,u.correo,u.usuario,r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol");
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
              <td><?php echo $data['rol']; ?></td>
              <td>
              <a class="link_edit" href="">Editar</a>
              |
              <a class="link_delete" href="">Eliminar</a>
              </td>
            </tr>
      <?php      
          } // if ($result >0)

        } // while ($data = mysqli_fetch_array($query))
      ?>

    </table>

	</section>
	
	<?php include "include/footer.php"; ?>

</body>
</html>