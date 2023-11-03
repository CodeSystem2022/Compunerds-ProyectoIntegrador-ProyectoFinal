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
   $address = $_POST['país'] .', '.$_POST['provincia'].', '.$_POST['localidad'].', '.$_POST['dirección'] .', '. $_POST['número'] .' - '. $_POST['código'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $update_address = $conn->prepare("UPDATE `users` set address = ? WHERE id = ?");
   $update_address->execute([$address, $user_id]);

   $message[] = 'dirección guardada!';

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
         justify-content: center;
         align-items: center;
         min-height: 80vh;
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

      .form-container form input[type="submit"]:hover {
         background-color: var(--yellow);
      }
   </style>
</head>
<body>
   
<!-- Header seccion -->
<?php include 'components/user_header.php'; ?>

<section class="form-container">
   <form action="" method="post">
      <h3>Su dirección</h3>
      <input type="text" class="box" placeholder="País." required maxlength="50" name="país">
      <input type="text" class="box" placeholder="Provincia." required maxlength="50" name="provincia">
      <input type="text" class="box" placeholder="Localidad" required maxlength="50" name="localidad">
      <input type="text" class="box" placeholder="Dirección" required maxlength="50" name="dirección">
      <input type="text" class="box" placeholder="Número" required maxlength="50" name="número">
      <input type="number" class="box" placeholder="Código postal" required max="999999" min="0" maxlength="6" name="código">
      <input type="submit" value="Guardar dirección" name="submit" class="btn">
   </form>
</section>

<!-- Footer seccion -->
<?php include 'components/footer.php'; ?>
<!-- Footer seccion  -->

<script src="js/script.js"></script>

</body>
</html>