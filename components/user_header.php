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

<header class="header">
    <section class="flex">
        <a href="#" class="logo"><img src="images/burger_logo.png" alt="Burger Logo" height="22">Burgizza</a>

        <nav class="navbar">
            <a href="home.php">home</a>
            <a href="about.php">about</a>            
            <a href="menu.php">menu</a>
            <a href="orders.php">orders</a>
            <a href="contact.php">contact</a>
        </nav>

        <div class="icons">
            <?php
                $count_user_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $count_user_cart_items -> execute([$user_id]);
                $total_user_cart_items = $count_user_cart_items -> rowCount();
            ?>
            <a href="search.php"><i class="fas fa-search"></i></a>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_user_cart_items; ?>)</span></a>
            <div id="user-btn" class="fas fa-user"></div>
            <div id="menu-bar" class="fas fa-bars"></div>
        </div>
        

        <div class="profile">
            <?php
                $select_profile = $conn -> prepare("SELECT * FROM `users` WHERE id = ?");
                $select_profile -> execute([$user_id]);
                if($select_profile -> rowCount() > 0){
                    $fetch_profile = $select_profile -> fetch(PDO::FETCH_ASSOC);
            ?>
            <p class="name"><?= $fetch_profile['name']; ?></p>
            <div class="flex">
                <a href="profile.php" class="btn">perfil</a>
                <a href="components/user_logout.php" onclick="return confirm('¿quieres cerrar sesión?');" class="delete-btn">cerrar sesión</a> 
            </div>
            <p class="account"><a href="register.php">registrate</a> o <a href="login.php">logueate!</a></p>
            <?php
                }else{
            ?>
            <p class="name">por favor, inicia sesión</p>
            <a href="login.php" class="btn">login</a>
            <?php
                }        
            ?>
        </div>
    </section>    
</header>