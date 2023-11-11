<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
}

include 'components/add_cart.php';

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
            <p>Saborea la rapidez de la deliciosa comida en tu puerta. Cada plato está cuidadosamente preparado para brindarte un festín de sabores en el menor tiempo posible. ¡No esperes, disfruta!</p>
            <a href="menu.php" class="btn">Ordena Ya!</a>
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
                <a href="http://localhost/Compunerds-ProyectoIntegrador-ProyectoFinal/category.php?category=burgers" class="box">
                    <img src="images/category_icon1.png" alt="burger icono">
                    <h3>Burgers</h3>
                </a>
                
                <a href="http://localhost/Compunerds-ProyectoIntegrador-ProyectoFinal/category.php?category=pizzas" class="box">
                    <img src="images/category_icon2.png" alt="pizza icono">
                    <h3>Pizzas</h3>
                </a>
                
                <a href="http://localhost/Compunerds-ProyectoIntegrador-ProyectoFinal/category.php?category=vegano" class="box">
                    <img src="images/category_icon3.png" alt="vegano icono">
                    <h3>Vegano</h3>
                </a>

                <a href="http://localhost/Compunerds-ProyectoIntegrador-ProyectoFinal/category.php?category=singluten" class="box">
                    <img src="images/category_icon4.png" alt="no gluten icono">
                    <h3>Sin gluten</h3>
                </a>
            </div>
        </h1>
    </section>
    <!--seccion categorias fin-->

    
    <!--seccion top 3 inicio-->

    <section class="products">
    <h1 class="title">Los favoritos del menú</h1>
    <div class="box-container">
        <?php
            $select_products = $conn -> prepare("SELECT * FROM `products` LIMIT 3");
            $select_products -> execute();
            if($select_products -> rowcount() > 0){
                while($fetch_products = $select_products -> fetch(PDO::FETCH_ASSOC)){

        ?>
        <form action = "" method="POST" class="box">
            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">            
            <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
            <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
            <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
            <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
            <button type="submit" name="add_to_cart" class="fas fa-shopping-cart"></button>
            <img src="images/<?= $fetch_products['image']; ?>" alt="producto" class="image">
            <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
            <div class="name"><?= $fetch_products['name']; ?></div>
            <div class="flex">
                <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
                <input type="number" name="qty" class="qty" value="1" min="1" max="99" maxlength="2">
            </div>
        </form>
        <?php
                }
            }else{
                echo '<div class="empty">aún no se han añadido productos!</div>';
            }
        ?>
    </div>
    </section>
    <!--seccion top 3 fin-->


    <!--seccion footer inicio-->
    <?php include 'components/footer.php'; ?>
    <!--seccion footer fin-->

    <script src="js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>

