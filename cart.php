<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id']; 
}else{
    $user_id = '';
    header('location:home.php');
};

if(isset($_POST['delete'])){
    $cart_id = $_POST['cart_id'];
    $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
    $delete_cart_item->execute([$cart_id]);
    $message[] = 'producto quitado!';
}

if(isset($_POST['delete_all'])){
    $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart_item->execute([$user_id]);
    // header('location:cart.php');
    $message[] = 'se vació el carrito!';
}

if(isset($_POST['update_qty'])){
    $cart_id = $_POST['cart_id'];
    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);
    $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
    $update_qty->execute([$qty, $cart_id]);
    $message[] = 'cantidad modificada!';
}

$grand_total = 0;

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
        <h3>carrito</h3>
        <p><a href="../home.html">home</a><span> / carrito</span></p>
    </div>
    
    <!--seccion carrito inicio-->
    <section class="products">
        <h1 class="title">haz elegido...</h1>

        <div class="box-container">
            <?php
                $grand_total = 0;
                $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $select_cart->execute([$user_id]);
                if($select_cart->rowCount() > 0){
                    while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form action="" method="POST" class="box">
                <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                <a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
                <button type="submit" class="fas fa-times" name="delete" onclick="return confirm('deseas quitar este producto?');"></button>
                <img src="images/<?= $fetch_cart['image']; ?>" alt="" class="image">
                <div class="name"><?= $fetch_cart['name']; ?></div>
                <div class="flex">
                    <div class="price"><span>$</span><?= $fetch_cart['price']; ?></div>
                    <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>" maxlength="2">
                    <button type="submit" class="fas fa-edit" name="update_qty"></button>
                </div>
                <div class="sub-total"> sub total : <span>$<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</span> </div>
            </form>
            <?php
                    $grand_total += $sub_total;
                    }
                }else{
                    echo '<p class="empty">tu carrito está vacío</p>';
                }
            ?>

        </div>

        <div class="cart-total">
            <p>total : <span>$<?= $grand_total; ?></span></p>
            <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceder al pago</a>
        </div>

        <div class="more-btn">
            <form action="" method="post">
                <button type="submit" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" name="delete_all" onclick="return confirm('quieres vaciar el carrito?');">quitar todo</button>
            </form>
            <a href="menu.php" class="btn">continuar comprando</a>
        </div>
    </section>    
    <!--seccion carrito fin-->

    <!--seccion footer inicio-->
    <?php include 'components/footer.php'; ?>
    <!--seccion footer fin-->

    <script src="js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>