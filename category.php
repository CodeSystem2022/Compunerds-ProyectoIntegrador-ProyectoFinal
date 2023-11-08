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

    <!--seccion categoria inicio-->
    <section class="products">
    <h1 class="title">El menu</h1>
    <div class="box-container">
        <?php
            $category = $_GET['category'];
            $select_products = $conn -> prepare("SELECT * FROM `products` WHERE category = ?");
            $select_products -> execute([$category]);
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
            <div class="name"><?= $fetch_products['name']; ?></div>
            <div class="flex">
                <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
                <input type="number" name="qty" class="qty" value="1" min="1" max="99" maxlength="2">
            </div>
        </form>
        <?php
                }
            }else{
                echo '<div class="empty">no se eligieron productos!</div>';
            }
        ?>
    </div>
    </section>
    <!--seccion categoria fin-->

    <!--seccion footer inicio-->
    <?php include 'components/footer.php'; ?>
    <!--seccion footer fin-->

    <script src="js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>