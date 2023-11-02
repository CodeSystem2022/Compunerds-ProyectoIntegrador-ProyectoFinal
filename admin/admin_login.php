<?php

include '../components/connect.php';

session_start();

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);
   
   if($select_admin->rowCount() > 0){
      $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
      $_SESSION['admin_id'] = $fetch_admin_id['id'];
      header('location:dashboard.php');
   }else{
      $message[] = 'usuario o contraseña incorrecta!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css?v=<?php echo time(); ?> ">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<!-- adming login inicio  -->
<section class="form-container">
   <form action="" method="POST">
      <h3>¡bienvenido!</h3>
      <p>default usuario = <span>adminutn</span> | contraseña = <span>utn2023</span></p>
      <input type="text" name="name" maxlength="20" required placeholder="ingresa tu usuario" class="box" oninput="this.value = this.value.replace(/\s/g, '')" autocomplete="off">
      <input type="password" name="pass" maxlength="20" required placeholder="ingresa tu contraseña" class="box" oninput="this.value = this.value.replace(/\s/g, '')" autocomplete="off">
      <input type="submit" value="login now" name="submit" class="btn">
   </form>
</section>
<!-- adming login fin -->

</body>
</html>