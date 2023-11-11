<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

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

    <!-- sección del formulario de búsqueda  -->

    <section class="search-form">
    <form method="post" action="">
        <input type="text" name="search_box" placeholder="busca aquí..." class="box">
        <button type="submit" name="search_btn" class="fas fa-search"></button>
    </form>
    </section>

<!-- sección del formulario de búsqueda fin -->


<section class="products" style="min-height: 100vh; padding-top:0;">

    <div class="box-container">

        <?php
            if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
                $search_box = $_POST['search_box'];
                $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search_box}%'");
                $select_products->execute();
                if($select_products->rowCount() > 0){
                    while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form action="" method="POST" class="box">
                <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                <img src="images/<?= $fetch_products['image']; ?>" alt="" class="image">
                <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
                <div class="name"><?= $fetch_products['name']; ?></div>
                <div class="flex">
                    <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
                    <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                </div>
            </form>
            <?php
                }
            }else{
                    echo '<p class="empty">Aún no se han añadido productos!</p>';
                }
            }
        ?>

    </div>

</section>

    <!--seccion footer inicio-->
    <?php include 'components/footer.php'; ?>
    <!--seccion footer fin-->

    <script src="js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>