<?php
if(isset($message)){
    foreach($message as $message){
        echo '
            <div class="message">
                <span>'.$message.'</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
    }
}
?>

<header>
    <a href="#" class="logo"><img src="images/burger_logo.png" alt="Burger Logo" height="22">FastFood</a>

    <div id="menu-bar" class="fas fa-bars"></div>

    <nav class="navbar">
        <?php
            $count_user_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_user_cart_items -> execute([$user_id]);
            $total_user_cart_items = $count_user_cart_items -> rowCount();
        ?>
        <a href="home.php">home</a>
        <a href="about.php">about</a>            
        <a href="menu.php">menu</a>
        <a href="order.php">orders</a>
        <a href="contact.php">contact</a>
        <a href="search.php"><i class="fas fa-search"></i></a>
        <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_user_cart_items; ?>)</span></a>
        <a href="user-btn"><i class="fas fa-user"></i></a>
    </nav>
</header>