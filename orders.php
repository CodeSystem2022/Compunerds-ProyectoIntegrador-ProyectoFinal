<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:home.php');
    };

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        <h3>pedidos</h3>
        <p><a href="home.php">home</a> <span> / pedidos</span></p>
    </div>
    
    <!--seccion orden inicio-->
    <section class="orders">
        <h1 class="title">tus pedidos</h1>
        <div class="box-container">
            <?php
            if($user_id == ''){
                echo '<p class="empty">por favor, inicia sesión para ver tus pedidos</p>';
            }else{
                $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
                $select_orders->execute([$user_id]);
                if($select_orders->rowCount() > 0){
                    while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="box">
            <p>realizado el : <span><?= $fetch_orders['placed_on']; ?></span></p>
            <p>nombre : <span><?= $fetch_orders['name']; ?></span></p>
            <p>email : <span><?= $fetch_orders['email']; ?></span></p>
            <p>número : <span><?= $fetch_orders['number']; ?></span></p>
            <p>dirección : <span><?= $fetch_orders['address']; ?></span></p>
            <p>método de pago : <span><?= $fetch_orders['method']; ?></span></p>
            <p>tus pedidos : <span><?= $fetch_orders['total_products']; ?></span></p>
            <p>precio final : <span>$<?= $fetch_orders['total_price']; ?>/-</span></p>
            <p>estado del pago : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
            </div>
            <?php
            }
            }else{
                echo '<p class="empty">aún no has realizado ningún pedido!</p>';
            }
            }
            ?>
        </div>
    </section>
    <!--seccion orden fin-->

    <!--seccion footer inicio-->
    <?php include 'components/footer.php'; ?>
    <!--seccion footer fin-->

    <script src="js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>