<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);

   if(!empty($name)){
      $update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?");
      $update_name->execute([$name, $user_id]);
   }

   if(!empty($email)){
      $select_email = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
      $select_email->execute([$email]);
      if($select_email->rowCount() > 0){
         $message[] = 'Correo electrónico ya utilizado!';
      }else{
         $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id = ?");
         $update_email->execute([$email, $user_id]);
      }
   }

   if(!empty($number)){
      $select_number = $conn->prepare("SELECT * FROM `users` WHERE number = ?");
      $select_number->execute([$number]);
      if($select_number->rowCount() > 0){
         $message[] = 'Número ya utilizado!';
      }else{
         $update_number = $conn->prepare("UPDATE `users` SET number = ? WHERE id = ?");
         $update_number->execute([$number, $user_id]);
      }
   }
   
   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $select_prev_pass = $conn->prepare("SELECT password FROM `users` WHERE id = ?");
   $select_prev_pass->execute([$user_id]);
   $fetch_prev_pass = $select_prev_pass->fetch(PDO::FETCH_ASSOC);
   $prev_pass = $fetch_prev_pass['password'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = sha1($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if($old_pass != $empty_pass){
      if($old_pass != $prev_pass){
         $message[] = 'La contraseña antigua no coincide!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'Confirmar contraseña no coincide!';
      }else{
         if($new_pass != $empty_pass){
            $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
            $update_pass->execute([$confirm_pass, $user_id]);
            $message[] = 'Contraseña actualizada exitosamente!';
         }else{
            $message[] = 'Ingrese una nueva contraseña!';
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
      .update-form {
         display: flex;
         justify-content: center;
         align-items: center;
         min-height: 80vh;
      }

      .update-form form {
         max-width: 400px;
         margin: 0 auto;
         padding: 20px;
         border: 1px solid var(--light-gray);
         border-radius: 10px;
      }

      .update-form form h3 {
         font-size: 24px;
         text-align: center;
         margin-bottom: 20px;
      }

      .update-form form input {
         margin: 10px 0;
         padding: 10px;
         border: 1px solid var(--light-gray);
         border-radius: 5px;
         width: 100%;
         font-size: 16px;
      }

      .update-form form input[type="submit"] {
         background-color: var(--red);
         color: var(--white);
         cursor: pointer;
         font-weight: bold;
      }

      .update-form form input[type="submit"]:hover {
         background-color: var(--yellow);
      }
   </style>
</head>
<body>
   
<!-- Header seccion -->
<?php include 'components/user_header.php'; ?>

<section class="form-container update-form">
   <form action="" method="post">
      <h3>Actualización del perfil</h3>
      <input type="text" name="name" placeholder="<?= $fetch_profile['name']; ?>" class="box" maxlength="50">
      <input type="email" name="email" placeholder="<?= $fetch_profile['email']; ?>" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="number" name="number" placeholder="<?= $fetch_profile['number']; ?>" class="box" min="0" max="9999999999" maxlength="10">
      <input type="password" name="old_pass" placeholder="Ingrese su antigua contraseña" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" placeholder="Introduzca su nueva contraseña" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="confirm_pass" placeholder="Confirme su nueva contraseña" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Actualizar ahora" name="submit" class="btn">
   </form>
</section>

<!-- Footer seccion -->
<?php include 'components/footer.php'; ?>
<!-- Footer seccion -->

<script src="js/script.js"></script>

</body>
</html> 