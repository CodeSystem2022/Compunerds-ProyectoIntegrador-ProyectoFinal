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
    <!-- header inicio  -->
<?php include 'components/user_header.php'; ?>
<!-- header fin -->

<div class="heading">
   <h3>Nuestro menú</h3>
   <p><a href="home.php">home</a> <span> / menu</span></p>
</div>

<!-- sección menú inicio  -->

<section class="products">

    <h1 class="title">Últimos platos</h1>

    <div class="box-container">

        <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            if($select_products->rowCount() > 0){
                while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
        ?>
        <form action="" method="post" class="box">
            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
            <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
            <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
            <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
            <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
            <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
            <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
            <div class="name"><?= $fetch_products['name']; ?></div>
            <div class="flex">
                <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
                <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2"">
            </div>
        </form>
        <?php
            }
            }else{
                echo '<p class="empty">Aún no se han añadido productos!</p>';
            }
        ?>

    </div>

</section>

<!-- sección menu final -->

    <!--seccion footer inicio-->
    <?php include 'components/footer.php'; ?>
    <!--seccion footer fin-->

    <script src="js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>