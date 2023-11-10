<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>about</title>

        <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

        <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>" >

    </head>
    <body>
        
        <!-- header section starts  -->
        <?php include 'components/user_header.php'; ?>
        <!-- header section ends -->

        <div class="heading">
            <h3>about us</h3>
            <p><a href="home.php">home</a> <span> / about</span></p>
        </div>

        
        <!--seccion about inicio-->    
        <section class="about">
            <div class="row">
                <div class="image">
                    <img src="images/about_chef2gif.gif" alt="">
                </div>

                <div class="content">
                    <h3>¿Por qué elegirnos?</h3>
                    <p>En Burgizza, nos dedicamos a brindar una experiencia culinaria excepcional con un enfoque especial en la entrega rápida. Nuestro compromiso es llevar delicias frescas directamente a tu puerta, combinando sabores extraordinarios con la conveniencia de un servicio ágil. ¡Descubre la excelencia en cada bocado con Burgizza!</p>
                    <a href="menu.php" class="btn">¡Chusmea!</a>
                </div>
            </div>
        </section>
        <!--seccion about fin-->        

        <!--seccion pasos inicio-->

        <section class="steps">
            <h1 class="title">Simples pasos</h1>
            <div class="box_container">
                <div class="box">
                    <img src="images/about-step1.png" alt="paso 1">
                    <h3>Elige del menú</h3>
                    <p>En nuestro menú encontrarás una amplia variedad de platos para elegir. Tenemos algo para todos los gustos.</p>
                </div>
                <div class="box">
                    <img src="images/about-step2.png" alt="paso 1">
                    <h3>Delivery súper rápido</h3>
                    <p>Sabemos que el tiempo es importante, por eso ofrecemos un servicio de delivery súper rápido. Tu pedido llegará a tu puerta en minutos.</p>
                </div>
                <div class="box">
                    <img src="images/about-step3.png" alt="paso 1">
                    <h3>¡Disfruta tu comida!</h3>
                    <p>Una vez que hayas recibido tu pedido, es hora de disfrutarlo. ¡No te olvides de compartir una foto en las redes sociales!</p>
                </div>
            </div>
        </section>      
        <!--seccion pasos fin-->

        <!-- footer section starts  -->
        <?php include 'components/footer.php'; ?>
        <!-- footer section ends -->=

        <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

        <!-- custom js file link  -->
        <script src="js/script.js?v=<?php echo time(); ?>"></script>

    </body>
</html>