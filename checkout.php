<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:home.php');
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
        <h3>checkout</h3>
        <p><a href="home.php">home</a> <span> / checkout</span></p>
    </div>

    <!--seccion checkout inicio-->
    <section class="checkout">
        <h1 class="title">resumen del pedido</h1>

        <form action="" method="post">

        <div class="cart-items">
            <h3>cart items</h3>
            <?php
                $grand_total = 0;
                $cart_items[] = '';
                $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $select_cart->execute([$user_id]);
                if($select_cart->rowCount() > 0){
                    while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                    $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
                    $total_products = implode($cart_items);
                    $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
            ?>
            <p><span class="name"><?= $fetch_cart['name']; ?></span><span class="price">$<?= $fetch_cart['price']; ?> x <?= $fetch_cart['quantity']; ?></span></p>
            <?php
                    }
                }else{
                    echo '<p class="empty">your cart is empty!</p>';
                }
            ?>
            <p class="grand-total"><span class="name">grand total :</span><span class="price">$<?= $grand_total; ?></span></p>
            <a href="cart.php" class="btn">veiw cart</a>
        </div>

    <!--seccion checkout fin-->

    <!--seccion footer inicio-->
    <?php include 'components/footer.php'; ?>
    <!--seccion footer fin-->

    <script src="js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>