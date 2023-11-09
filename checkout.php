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

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $method = $_POST['method'];
    $method = filter_var($method, FILTER_SANITIZE_STRING);
    $address = $_POST['address'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $total_products = $_POST['total_products'];
    $total_price = $_POST['total_price'];

    $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $check_cart->execute([$user_id]);

    if($check_cart->rowCount() > 0){

        if($address == ''){
            $message[] = 'por favor agrega tu dirección!';
        }else{
            
            $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
            $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

            $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
            $delete_cart->execute([$user_id]);

            $message[] = 'pedido realizado con éxito!';
        }
        
    }else{
        $message[] = 'tu carrito está vacío';
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

        <form action="" method="POST">
            <div class="cart-items">
                <h3>productos</h3>
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
                        echo '<p class="empty">oh no! tu carrito está vacío!</p>';
                    }
                ?>
                <p class="grand-total"><span class="name">total :</span><span class="price">$<?= $grand_total; ?></span></p>
                <a href="cart.php" class="btn">carrito</a>
            </div>
            <input type="hidden" name="total_products" value="<?= $total_products; ?>">
            <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
            <input type="hidden" name="name" value="<?= $fetch_profile['name'] ?>">
            <input type="hidden" name="number" value="<?= $fetch_profile['number'] ?>">
            <input type="hidden" name="email" value="<?= $fetch_profile['email'] ?>">
            <input type="hidden" name="address" value="<?= $fetch_profile['address'] ?>">

            <div class="user-info">
                <h3>tu info</h3>
                <p><i class="fas fa-user"></i><span><?= $fetch_profile['name'] ?></span></p>
                <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number'] ?></span></p>
                <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email'] ?></span></p>
                <a href="update_profile.php" class="btn">actualizar info</a>
                <h3>dirección de entrega</h3>
                <p><i class="fas fa-map-marker-alt"></i><span><?php if($fetch_profile['address'] == ''){echo 'por favor, ingrese su dirección';}else{echo $fetch_profile['address'];} ?></span></p>
                <a href="update_address.php" class="btn">actualizar dirección</a>
                <select name="method" class="box" required>
                    <option value="" disabled selected>selecciona un método de pago --</option>
                    <option value="pago al delivery">pago al delivery</option>
                    <option value="tarjeta de crédito">tarjeta de crédito</option>
                    <option value="paypal">paypal</option>
                </select>
                <input type="submit" value="realizar pedido" class="btn <?php if($fetch_profile['address'] == ''){echo 'disabled';} ?>" style="width:100%; background:var(--red); color:var(--white);" name="submit">
            </div>
        </form>
    </section>

    <!--seccion checkout fin-->

    <!--seccion footer inicio-->
    <?php include 'components/footer.php'; ?>
    <!--seccion footer fin-->

    <script src="js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>