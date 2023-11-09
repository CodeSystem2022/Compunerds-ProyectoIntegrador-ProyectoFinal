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

    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>" >

    <link rel="icon" href="images/favicon_icon.png" type="image/png">

</head>
<body>
    <!--seccion header inicio-->
    <?php include 'components/user_header.php'; ?>
    <!--seccion header fin-->

    <div class="heading">
        <h3>Sobre Nosotros</h3>
        <p><a href="home.php">home</a> <span> / acerca de</span></p>
    </div>

    <!--seccion about inicio-->

    <section class="about">
        <div class="row">
            <div class="image">
                <img src="../images/about_chef2gif.gif" alt="chef">
            </div>

            <div class="content">
                <h3>¿Por qué elegirnos?</h3>

                <p>En CompuNerds, nos dedicamos a ofrecer comida deliciosa y de alta calidad a nuestros clientes. Nos preocupamos por ofrecer un servicio excelente y una experiencia de compra que sea memorable.</p>

                <ul>
                    <li>Comida deliciosa: utilizamos ingredientes frescos y de temporada para crear platos deliciosos que te encantarán.</li>
                    <li>Servicio excelente: nuestro equipo está comprometido a brindarte un servicio excelente y ayudarte a encontrar lo que buscas.</li>
                    <li>Experiencia memorable: queremos que tu experiencia de compra con nosotros sea memorable y satisfactoria.</li>
                </ul>
                <a href="./menu.html" class="btn">¡Chusmea!</a>
            </div>
        </div>
    </section>

    <!--seccion about fin-->    

    <!--seccion pasos inicio-->

    <section class="steps">
        <h1 class="title">Simples pasos</h1>
        <div class="box_container">
            <div class="box">
                <img src="../images/about-step1.png" alt="paso 1">
                <h3>Elige del menú</h3>
                <p>En nuestro menú encontrarás una amplia variedad de platos para elegir, desde platos tradicionales hasta platos internacionales. Tenemos algo para todos los gustos.</p>
                <p>Puedes navegar por nuestro menú por tipo de comida, precio o ingredientes. También puedes buscar platos específicos por nombre.</p>
            </div>
            <div class="box">
                <img src="../images/about-step2.png" alt="paso 1">
                <h3>Delivery súper rápido</h3>
                <p>Sabemos que el tiempo es importante, por eso ofrecemos un servicio de delivery súper rápido. Tu pedido llegará a tu puerta en minutos.</p>
                <p>Nuestros repartidores están capacitados para entregar tu comida de forma rápida y segura.</p>
            </div>
            <div class="box">
                <img src="../images/about-step3.png" alt="paso 1">
                <h3>¡Disfruta tu comida!</h3>
                <p>Una vez que hayas recibido tu pedido, es hora de disfrutarlo. ¡No te olvides de compartir una foto en las redes sociales!</p>
                <p>Nos encanta ver a nuestros clientes disfrutando de nuestra comida.</p>
            </div>
        </div>
    </section>

    <!--seccion pasos fin--> 

    <!--seccion footer inicio-->
    <?php include 'components/footer.php'; ?>
    <!--seccion footer fin-->

    <script src="js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>