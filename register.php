<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR number = ?");
   $select_user->execute([$email, $number]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'email or number already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, number, password) VALUES(?,?,?,?)");
         $insert_user->execute([$name, $email, $number, $cpass]);
         $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
         $select_user->execute([$email, $pass]);
         $row = $select_user->fetch(PDO::FETCH_ASSOC);
         if($select_user->rowCount() > 0){
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>UTN - final project CompuNerds</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

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
   
<!-- header seccion inicio  -->
<?php include 'components/user_header.php'; ?>
<!-- header seccion fin -->

<section class="form-container">
   <form action="" method="post">
      <h3>Regístrate</h3>
      <input type="text" name="name" required placeholder="Ingrese su nombre">
      <input type="email" name="email" required placeholder="Ingrese su email" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="number" name="number" required placeholder="Ingrese su numero" min="0" max="9999999999">
      <input type="password" name="pass" required placeholder="Ingrese su contraseña" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="Confirme su contraseña" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Registrarte" name="submit" class="btn">
      <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión ahora!</a></p>
   </form>
</section>
<!--seccion footer inicio-->
<?php include 'components/footer.php'; ?>
<!--seccion footer fin-->
<script src="js/script.js"></script>

</body>
</html>

