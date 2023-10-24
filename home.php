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
    
    <!--seccion portada inicio-->
    <div class="home" id="home">
        <div class="content">
            <h3>Más sabor, menos espera</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, dolorem? 
                Vel nisi nesciunt dicta quisquam porro, praesentium amet at placeat sint explicabo? 
                Atque maiores illum dolor at fugit ullam quidem?</p>
            <a href="#" class="btn">Ordena Ya!</a>
        </div>
        <div class="image">
            <img src="images/home_burger.png" alt="burger">
        </div>

    </div>
    <!--seccion portada fin-->

    <!--seccion categorias inicio-->
    <section class="category">
        <h1 class="title">Categorías</h1>
            <div class="box_container">
                <a href="#" class="box">
                    <img src="images/category_icon1.png" alt="burger icono">
                    <h3>Burgers</h3>
                </a>
                
                <a href="#" class="box">
                    <img src="images/category_icon2.png" alt="pizza icono">
                    <h3>Pizzas</h3>
                </a>
                
                <a href="#" class="box">
                    <img src="images/category_icon3.png" alt="vegano icono">
                    <h3>Vegano</h3>
                </a>

                <a href="#" class="box">
                    <img src="images/category_icon4.png" alt="no gluten icono">
                    <h3>Sin gluten</h3>
                </a>

            </div>
        </h1>
    </section>
    <!--seccion categorias fin-->


    <!--seccion footer inicio-->
    <?php include 'components/footer.php'; ?>
    <!--seccion footer fin-->

    <script src="js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>

