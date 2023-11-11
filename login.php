<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id'];
      header('location:home.php');
   }else{
      $message[] = 'incorrect username or password!';
   }
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
   
</head>
<body>
   
<!-- Header seccion -->
<?php include 'components/user_header.php'; ?>

<section class="form-container">
   <form action="" method="POST">
      <h3>Inicia sesión</h3>
      <input type="email" name="email" required placeholder="Ingrese su email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="Ingrese su contraseña" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
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