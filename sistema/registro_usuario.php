<?php 
  session_start();
  if ($_SESSION['rol'] != 1)
  {
    header ("location: ./");
  }
  
  include "../conexion.php";
  
  if (!empty($_POST))
  {
    $alert = '';
    if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) ||  empty($_POST['rol']))  
    {
      $alert = '<p class="msg_error">Todos los campos son obligatorios </p>';
    }
    else
    {          
      $nombre = $_POST['nombre'];
      $correo = $_POST['correo'];
      $usuario = $_POST['usuario'];
      $clave = MD5($_POST['clave']);
      $rol = $_POST['rol'];

      // Verificar si existe correo y usuario 
      $query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario = '$usuario' OR correo = '$correo'");
      mysqli_close($conection);

      $result = mysqli_fetch_array($query);
      if ($result > 0)
      {
        $alert = '<p class="msg_error">El correo o el usuario ya existe</p>';
      }
      else
      {
        $query_insert = mysqli_query($conection, "INSERT INTO usuario(idusuario,nombre,correo,usuario,clave,rol) VALUES (0,'$nombre','$correo','$usuario','$clave','$rol')");
        if ($query_insert)
        {
          $alert = '<p class="msg_save">Usuario creado correctamente</p>';          
        }
        else
        {
          $alert = '<p class="msg_error">Error Al Crear El Usuario</p>';
        }
      }

    }
  }
?>

<!DOCTYPE html>
<!-- Se agrega este archivo a cada opción del Menu. -->
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "include/scripts.php"; ?>
	<title>Registro Usuarios</title>
</head>
<body>
	<?php include "include/header.php" ?>

	<section id="container">
		<!-- Es el contenido del registro de Usuarios -->
    <div class="form_register">
      <h1>Registro Usuarios</h1>
      <hr>
      <div class="alert"><?php echo isset($alert)? $alert : ''?></div>
      <!-- Con "action" vacio se autoprocesara el formulario, es decir se iniciara desde el incio del archivo cuando se oprime el boton "Crear Usuario" -->
      <form action ="" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id = "nombre" placeholder="Nombre Completo">
        <label for="correo">Correo Electrónico</label>
        <input type="email" name="correo" id = "correo" placeholder="Correo Electrónico">
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" id = "usuario" placeholder="Usuario">
        <label for="clave">Clave</label>
        <input type="password" name="clave" id = "clave" placeholder="Clave de Acceso">
        <label for="rol">Tipo Usuario</label>

        <?php 
          $query_rol = mysqli_query($conection,"SELECT * FROM rol");
          mysqli_close($conection);
          $result_rol = mysqli_num_rows($query_rol);
        ?>
        <select name="rol" id="rol">
          <?php 
          //print ($result_rol);
          //exit;

            if ($result_rol >0)
            {
              while ($rol = mysqli_fetch_array($query_rol))
              {
          ?>
                <!-- <option value="2">Supervisor</option> -->
                <option value="<?php echo $rol['idrol'];?>"><?php echo $rol['rol']; ?></option>
          <?php 
              } // while ($rol = mysqli_fetch_array($query_rol)) 

            } // if ($result_rol >0)

          ?>
          
        </select>

        <input type="submit" value="Crear Usuario" class="btn_save">

      </form>
    </div>

	</section>
	
	<?php include "include/footer.php"; ?>

</body>
</html>