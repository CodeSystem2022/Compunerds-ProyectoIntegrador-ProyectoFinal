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
      $message[] = 'el email o número ya existe!';
   }else{
      if($pass != $cpass){
         $message[] = 'no coincide las contraseñas!';
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

</head>
<body>
   
<!-- header seccion inicio  -->
<?php include 'components/user_header.php'; ?>
<!-- header seccion fin -->

<section class="form-container">
   <form action="" method="post">
      <h3>Regístrate</h3>
      <input type="text" name="name" required placeholder="Ingrese su nombre" class="box" maxlength="50">
      <input type="email" name="email" required placeholder="Ingrese su email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="number" name="number" required placeholder="Ingrese su número" class="box" min="0" max="9999999999" maxlength="10">
      <input type="password" name="pass" required placeholder="Ingrese su contraseña" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="Confirma su contraseña" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
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

