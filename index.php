<?php
  // En "Form" no se coloca "action" se autoprocesa el archivo, es decir vuelve empezar desde el inicio.
  // Verifica si el usario oprimio el boton Submit INGRESAR.
  $alert = '';
  session_start();  
  // Esta linea es para que no muestre de nuevo la pantalla de Login cuando se haya iniciado la session.
  if (!empty($_SESSION['active']))
  {
    header('location: sistema/');
  }
  else
  {  
    if (!empty($_POST))
    {
      if (empty($_POST['usuario']) || empty($_POST['clave']))
      {
        $alert = 'Ingrese su usuario Y/o Contraseña ';
      }
      else
      {
        require_once "conexion.php";
        // mysqli_real_escape_string = Para pasar todo lo que se teclea a Texto, evita inyeccion de SQL, caracter "", 
        
        $user = mysqli_real_escape_string($conection,$_POST['usuario']);
        $pass = MD5(mysqli_real_escape_string($conection,$_POST['clave']));

        $query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario = '$user' AND clave = '$pass' ");
        mysqli_close($conection);
        
        $result = mysqli_num_rows($query);

        //Encontro el usario
        if ($result > 0)
        {
          // pasa a arreglo lo que resulto de la consulta.
          $data = mysqli_fetch_array($query);
          // Muestra en pantalla del navegador el contenido de la variable $data(Arreglo)
          // print_r($data);

          $_SESSION['active'] = true;
          $_SESSION['idUser'] = $data['idusuario'];
          $_SESSION['nombre'] = $data['nombre'];
          $_SESSION['correo'] = $data['correo'];
          $_SESSION['usuario'] = $data['usuario'];
          $_SESSION['rol'] = $data['rol'];

          header('location: sistema/');
        }
        else
        {
          $alert = 'El usuario y/o clave son incorrectos';
          session_destroy();
        }

      } // if (empty($_POST['usuario']) || empty($_POST['clave']))

    } // if (!empty($_POST))

  } // else if (!empty($_SESSION['active']))

?>
<!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset = "UTF-8">
    <title>Login Sistema De Facturacion</title>
    <link rel="stylesheet" type ="text/css" href="css/style.css">
  </head>
  <body>
    <section id = "container">
      <form action = "" method ="post">
        <h3>Iniciar Sesion</h3>
        <img src="img/login.png" alt = "Login">
        <input type="text" name= "usuario" placeholder="Usuario">
        <input type="password" name= "clave" placeholder="Contraseña">
        <div class="alert"><?php echo (isset($alert)? $alert : ''); ?></div>
        <input type="submit" value ="INGRESAR">

      </form>
    </section>

  </body>

</html>