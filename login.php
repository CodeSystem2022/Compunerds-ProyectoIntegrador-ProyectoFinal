<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>UTN - final project CompuNerds</title>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

   <link rel="icon" href="images/favicon_icon.png" type="image/png">


   <style>
      /* Estilos para el formulario */
      .form-container {
         display: flex;
         flex-direction: column;
         align-items: center;
      }

      .form-container form {
         max-width: 400px;
         margin: 0 auto;
         padding: 20px;
         border: 1px solid var(--light-gray);
         border-radius: 10px;
      }

      .form-container form h3 {
         font-size: 24px;
         text-align: center;
         margin-bottom: 20px;
      }

      .form-container form input {
         margin: 10px 0;
         padding: 10px;
         border: 1px solid var(--light-gray);
         border-radius: 5px;
         width: 100%;
         font-size: 16px;
      }

      .form-container form input[type="submit"] {
         background-color: var(--red);
         color: var(--white);
         cursor: pointer;
         font-weight: bold;
      }

      .form-container form p {
         font-size: 16px;
         text-align: center;
         margin-top: 10px;
      }
   </style>
</head>
<body>
   
<!-- Header seccion -->
<?php include 'components/user_header.php'; ?>

<section class="form-container">
   <form action="" method="post">
      <h3>Inicia sesión</h3>
      <input type="email" name="email" required placeholder="Ingrese su email" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="password" required placeholder="Ingrese su contraseña" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Iniciar sesión" name="submit" class="btn">
      <p>¿No tienes una cuenta? <a href="register.php">Regístrate ahora!</a></p>
   </form>
</section>

<!-- Footer seccion -->
<?php include 'components/footer.php'; ?>
<!-- Footer seccion -->

<script src="js/script.js"></script>

</body>
</html>