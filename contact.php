<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if($select_message->rowCount() > 0){
      $message[] = 'mensaje ya enviado!';
   }else{

      $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);

      $message[] = 'mensaje enviado exitosamente!';

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

    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>" >

    <link rel="icon" href="images/favicon_icon.png" type="image/png">

</head>
<body>
   
<!-- comienza la sección del encabezado  -->
<?php include 'components/user_header.php'; ?>
<!-- termina la sección del encabezado -->

<div class="heading">
   <h3>Contacta con nosotros</h3>
   <p><a href="home.php">home</a> <span> / contacto</span></p>
</div>

<!-- inicia la sección de contacto  -->

<section class="contact">

   <div class="row">

      <div class="image">
         <img src="images/contact-img.svg" alt="">
      </div>

      <form action="" method="post">
         <h3>Cuéntanos algo!</h3>
         <input type="text" name="name" maxlength="50" class="box" placeholder="ingresa tu nombre" required>
         <input type="number" name="number" min="0" max="9999999999" class="box" placeholder="ingresa tu número" required maxlength="10">
         <input type="email" name="email" maxlength="50" class="box" placeholder="ingresa tu correo" required>
         <textarea name="msg" class="box" required placeholder="escribe tu mensaje" maxlength="500" cols="30" rows="10"></textarea>
         <input type="submit" value="Enviar mensaje" name="send" class="btn">
      </form>

   </div>

</section>

<!-- termina la sección de contacto -->

<!-- inicio footer -->
<?php include 'components/footer.php'; ?>
<!-- fin footer -->

<!-- custom js file link  -->
<script src="js/script.js?v=<?php echo time(); ?>"></script>

</body>
</html>